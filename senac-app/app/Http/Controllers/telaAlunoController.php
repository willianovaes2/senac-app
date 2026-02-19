<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\alunoModel;
use App\Models\ucModel;
use App\Models\aulaModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class telaAlunoController extends Controller
{
    public function consultarTelaAluno(Request $request)
    {
        $alunoId = Session::get('usuario');

        if (!$alunoId) {
            return redirect('/')->with('erro', 'Aluno não autenticado');
        }

        $aluno = alunoModel::with('turmas.curso.ucs')->find($alunoId);

        if (!$aluno) {
            return redirect('/')->with('erro', 'Aluno não encontrado');
        }

        $turma = $aluno->turmas->first();

        if (!$turma || !$turma->curso) {
            return view('paginas.aluno.telaInicialAluno', [
                'aluno' => $aluno,
                'ucsAtuais' => collect(),
                'ucsPassadas' => collect(),
                'ucsFuturas' => collect(),
                'ucAtual' => null,
            ]);
        }

        $hoje = Carbon::now();
        $ucs = $turma->curso->ucs;

        $ucsAtuais = $ucs->filter(function ($uc) use ($hoje) {
            return $uc->dataInicio <= $hoje && $uc->dataFim >= $hoje;
        });

        $ucsPassadas = $ucs->filter(function ($uc) use ($hoje) {
            return $uc->dataFim < $hoje;
        });

        $ucsFuturas = $ucs->filter(function ($uc) use ($hoje) {
            return $uc->dataInicio > $hoje;
        });

        // 🔥 DEFINIR UC ATUAL
        if ($request->has('uc_id')) {
            $ucAtual = $ucs->where('id', $request->uc_id)->first();
        }

        if (empty($ucAtual)) {
            $ucAtual = $ucsAtuais->first();
        }

        // ==============================
        // 🔥 CÁLCULO DE PRESENÇA
        // ==============================

        $totalAulas = 0;
        $totalPresencas = 0;
        $totalFaltas = 0;
        $percentualPresenca = 0;
        $limiteFaltas = 0;
        $faltasRestantes = 0;
        $reprovadoPorFalta = false;

        if ($ucAtual) {

            $aulas = aulaModel::where('uc_id', $ucAtual->id)
                ->whereDate('dia', '<=', now())
                ->where('status', '!=', 'cancelada')
                ->get();

            $totalAulas = $aulas->count();

            if ($totalAulas > 0) {

                $totalPresencas = DB::table('aula_aluno')
                    ->where('aluno_id', $aluno->id)
                    ->whereIn('aula_id', $aulas->pluck('id'))
                    ->where('presenca', 1)
                    ->count();

                $totalFaltas = $totalAulas - $totalPresencas;

                $percentualPresenca = ($totalPresencas / $totalAulas) * 100;

                $limiteFaltas = floor($totalAulas * 0.25);

                $faltasRestantes = $limiteFaltas - $totalFaltas;

                if ($faltasRestantes < 0) {
                    $reprovadoPorFalta = true;
                    $faltasRestantes = 0;
                }
            }
        }

        return view('paginas.aluno.telaInicialAluno', compact(
            'aluno',
            'ucsAtuais',
            'ucsPassadas',
            'ucsFuturas',
            'ucAtual',
            'totalAulas',
            'totalPresencas',
            'totalFaltas',
            'percentualPresenca',
            'limiteFaltas',
            'faltasRestantes',
            'reprovadoPorFalta'
        ));
    }
}
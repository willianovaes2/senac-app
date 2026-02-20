<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\alunoModel;
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

        // Definir UC Atual
        if ($request->has('uc_id')) {
            $ucAtual = $ucs->where('id', $request->uc_id)->first();
        }

        if (empty($ucAtual)) {
            $ucAtual = $ucsAtuais->first();
        }

        // ==============================
        // CÁLCULO DE PRESENÇA CORRIGIDO
        // ==============================

        $totalAulas = 0;
        $totalPresencas = 0;
        $totalFaltas = 0;
        $percentualPresenca = 0;
        $reprovadoPorFalta = false;
        $aulasPendentes = 0;

        if ($ucAtual) {

            // Todas as aulas já ocorridas da UC
            $aulas = aulaModel::where('uc_id', $ucAtual->id)
                ->whereDate('dia', '<=', now())
                ->where('status', '!=', 'cancelada')
                ->get();

            $totalAulas = $aulas->count();
            $aulaIds = $aulas->pluck('id');

            // Buscar apenas registros realmente lançados pelo docente
            $registros = DB::table('aula_aluno')
                ->where('aluno_id', $aluno->id)
                ->whereIn('aula_id', $aulaIds)
                ->get();

            $totalAulasRegistradas = $registros->count();

            if ($totalAulasRegistradas > 0) {

                $totalPresencas = $registros->where('presenca', 1)->count();
                $totalFaltas = $registros->where('presenca', 0)->count();

                $percentualPresenca = ($totalPresencas / $totalAulasRegistradas) * 100;

                // Regra oficial: mínimo 75%
                if ($percentualPresenca < 75) {
                    $reprovadoPorFalta = true;
                }
            }

            // Aulas que ainda não tiveram registro
            $aulasPendentes = $totalAulas - $totalAulasRegistradas;
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
            'reprovadoPorFalta',
            'aulasPendentes'
        ));
    }
}

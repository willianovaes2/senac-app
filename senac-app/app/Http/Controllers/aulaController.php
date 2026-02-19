<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\aulaModel;
use App\Models\alunoModel;
use App\Models\ucModel;
use App\Models\turmaModel;
use App\Models\docenteModel;
use App\Models\cursoModel;
use App\Models\UcTurmaModel;
use App\Models\indicadorModel;
use App\Services\CalendarioLetivoService;

class aulaController extends Controller
{
    // Consulta todas as aulas para a Blade
    public function consultarAula()
    {
        $aulas = aulaModel::with(['uc', 'curso', 'turmas', 'docenteResponsavel'])
            ->orderBy('dia', 'asc')
            ->get()
            ->groupBy(fn($aula) => $aula->uc->nome ?? 'Sem UC');


        $cursos   = cursoModel::all();
        $turmas   = turmaModel::all();
        $docentes = docenteModel::all();

        return view('paginas.aulas', compact('aulas', 'cursos', 'turmas', 'docentes'));
    }

    // Inserir aula manual
    public function inserirAula(Request $request)
    {
        DB::transaction(function () use ($request) {
            $aula = aulaModel::create([
                'curso_id'               => $request->curso_id,
                'uc_id'                  => $request->uc_id,
                'dia'                    => $request->dia,
                'status'                 => $request->status,
                'docente_responsavel_id' => $request->docente_responsavel_id
            ]);

            if ($request->turma_id) {
                $aula->turmas()->attach($request->turma_id);
            }

            if ($request->docentes) {
                $aula->docentes()->attach($request->docentes);
            }
        });

        return redirect('/aulas')->with('success', 'Aula criada.');
    }

    // Editar aula
    public function editarAulas($id)
    {
        $dado     = aulaModel::findOrFail($id);
        $cursos   = cursoModel::with('ucs')->get();
        $turmas   = turmaModel::all();
        $docentes = docenteModel::all();

        return view('paginas.editarAulas', compact('dado', 'cursos', 'turmas', 'docentes'));
    }

    // Atualizar aula
    public function atualizarAula(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $aula = aulaModel::findOrFail($id);

            $aula->update([
                'curso_id'               => $request->curso_id,
                'uc_id'                  => $request->uc_id,
                'dia'                    => $request->dia,
                'status'                 => $request->status,
                'docente_responsavel_id' => $request->docente_responsavel_id
            ]);

            $aula->turmas()->sync($request->turma_id ? [$request->turma_id] : []);
            $aula->docentes()->sync($request->docentes ?? []);
        });

        return redirect('/aulas')->with('success', 'Aula atualizada.');
    }

    // Excluir aula
    public function excluirAula($id)
    {
        $aula = aulaModel::findOrFail($id);
        $aula->turmas()->detach();
        $aula->docentes()->detach();
        $aula->delete();

        return redirect('/aulas')->with('success', 'Aula removida.');
    }

    // Inicia UC e gera aulas automaticamente
    public function iniciarUc(Request $request, CalendarioLetivoService $service)
    {
        $uc    = ucModel::findOrFail($request->uc_id);
        $turma = turmaModel::findOrFail($request->turma_id);
        $curso = cursoModel::findOrFail($turma->curso_id);

        // Remove aulas antigas da UC na turma
        $uc->aulas()->whereHas('turmas', fn($q) => $q->where('turma_id', $turma->id))->delete();

        // Atualiza UC-Turma
        UcTurmaModel::updateOrCreate(
            ['uc_id' => $uc->id, 'turma_id' => $turma->id],
            [
                'data_inicio' => $request->data_inicio,
                'data_fim'    => $service->calcularDataFinal(
                    $request->data_inicio,
                    $curso->dias,
                    $uc->cargaHoraria,
                    $turma->horasPorDia
                ),
                'status'      => 'em_andamento'
            ]
        );

        // Gera aulas vinculadas à turma e docente responsável
        $datas = $service->listarDatasLetivas(
            $request->data_inicio,
            $request->data_fim ?? now()->addDays(30), // fallback
            $curso->dias
        );

        foreach ($datas as $dia) {
            $aula = aulaModel::create([
                'curso_id'               => $curso->id,
                'uc_id'                  => $uc->id,
                'dia'                    => $dia,
                'status'                 => 'prevista',
                'docente_responsavel_id' => $request->docente_responsavel_id
            ]);

            $aula->turmas()->attach($turma->id);
        }

        return redirect('/aulas')->with('success', 'UC iniciada e aulas geradas com sucesso!');
    }

    public function realizarChamada($aulaId)
    {
        $aula = aulaModel::with('turmas.alunos', 'alunos')->findOrFail($aulaId);

        // Pegando apenas a primeira turma vinculada
        $turma = $aula->turmas->first();

        if (!$turma) {
            return back()->with('erro', 'Aula sem turma vinculada.');
        }

        $alunos = $turma->alunos->sortBy('nomeAluno');

        $totalAlunos = $alunos->count();

        $totalPresenca = $aula->alunos->where('pivot.presenca', 1)->count();

        $totalFaltas = $totalAlunos - $totalPresenca;

        $percentualFalta = $totalAlunos > 0
            ? round(($totalFaltas / $totalAlunos) * 100, 1)
            : 0;

        return view('paginas.docente.realizarChamada', compact(
            'aula',
            'alunos',
            'totalAlunos',
            'totalPresenca',
            'totalFaltas',
            'percentualFalta'
        ));
    }

    public function salvarChamada(Request $request, $aulaId)
    {
        $aula = aulaModel::with('turmas.alunos')->findOrFail($aulaId);
        $turma = $aula->turmas->first();

        if (!$turma) {
            return back()->with('erro', 'Aula sem turma vinculada.');
        }

        foreach ($turma->alunos as $aluno) {
            $presenca = $request->presenca[$aluno->id] ?? 0;
            $observacao = $request->observacao[$aluno->id] ?? null;

            $aula->alunos()->syncWithoutDetaching([
                $aluno->id => [
                    'presenca' => $presenca,
                    'observacao' => $observacao
                ]
            ]);
        }

        // Observação geral da aula
        $aula->descricao = $request->input('descricao');
        $aula->save();

        return redirect()->route('centralAula', $aula->id)
            ->with('sucesso', 'Chamada e observações salvas com sucesso!');
    }


    public function avaliacaoParcial(Request $request, $aulaId)
    {
        $aula = aulaModel::with('turma.alunos')->findOrFail($aulaId);
        $uc   = ucModel::findOrFail($aula->uc_id);

        // 🔹 Buscar alunos pela turma
        $alunos = $aula->alunos()->withPivot('presenca', 'conceito_final')->get();

        // 🔹 Garantir que todos estejam vinculados na pivot aula_aluno
        foreach ($alunos as $aluno) {

            if (!$aula->alunos()->where('aluno_id', $aluno->id)->exists()) {

                $aula->alunos()->attach($aluno->id, [
                    'presenca' => 0,
                    'conceito_final' => null,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

        // 🔹 Recarregar alunos agora pela pivot
        $alunos = $aula->alunos()->withPivot('presenca', 'conceito_final')->get();

        $indicadores = $uc->indicadores;

        // 🔹 Avaliações por indicador
        $avaliacoesIndicadores = DB::table('aluno_indicador')
            ->where('aula_id', $aulaId)
            ->get()
            ->groupBy('aluno_id');

        // 🔹 Contadores
        $totalAlunos  = $alunos->count();
        $avaliados    = 0;
        $atendido     = 0;
        $parcial      = 0;
        $naoAtendido  = 0;

        foreach ($alunos as $aluno) {

            if (!empty($aluno->pivot->conceito_final)) {

                $avaliados++;

                switch ($aluno->pivot->conceito_final) {

                    case 'Atendido':
                        $atendido++;
                        break;

                    case 'Parcialmente Atendido':
                        $parcial++;
                        break;

                    case 'Não Atendido':
                        $naoAtendido++;
                        break;
                }
            }
        }

        // 🔹 Calcular porcentagem de presença
        foreach ($alunos as $aluno) {

            $totalAulas = $aluno->aulas()->count();

            $presencas = $aluno->aulas()
                ->wherePivot('presenca', 1)
                ->count();

            $porcentagem = $totalAulas > 0
                ? round(($presencas / $totalAulas) * 100)
                : 0;

            $aluno->porcentagem_presenca = $porcentagem;
        }

        return view('paginas.docente.avaliacaoParcial', compact(
            'uc',
            'alunos',
            'indicadores',
            'aula',
            'avaliacoesIndicadores',
            'totalAlunos',
            'avaliados',
            'atendido',
            'parcial',
            'naoAtendido'
        ));
    }

    public function salvarParcial(Request $request, $aulaId)
    {
        $aula = aulaModel::findOrFail($aulaId);

        // 🔹 Salvar conceito final na pivot aula_aluno
        if ($request->has('conceito_final')) {

            foreach ($request->conceito_final as $alunoId => $conceito) {

                $aula->alunos()->updateExistingPivot(
                    $alunoId,
                    ['conceito_final' => $conceito]
                );
            }
        }

        //🔹 Salvar avaliação por indicador
        if ($request->has('indicadores')) {

            foreach ($request->indicadores as $alunoId => $indicadores) {

                foreach ($indicadores as $indicadorId => $conceito) {

                    if ($conceito !== null && $conceito !== '') {

                        DB::table('aluno_indicador')->updateOrInsert(
                            [
                                'aula_id' => $aulaId,
                                'aluno_id' => $alunoId,
                                'indicador_id' => $indicadorId
                            ],
                            [
                                'conceito' => $conceito,
                                'updated_at' => now(),
                                'created_at' => now()
                            ]
                        );
                    }
                }
            }
        }
        return redirect()->route('centralAula', $aula->id)->with('sucesso', 'Avaliação salva com sucesso!');
    }

    public function avaliacaoFinal(Request $request, $aulaId)
    {
        // Buscar aula com alunos vinculados
        $aula = aulaModel::with('alunos', 'uc.indicadores')->findOrFail($aulaId);

        // Buscar alunos da aula
        $alunos = $aula->alunos()->get();

        // UC da aula
        $uc = $aula->uc;

        // Indicadores da UC
        $indicadores = $uc->indicadores ?? collect();

        // Avaliações existentes por indicador
        $avaliacoesIndicadores = DB::table('avaliacoes_indicadores')
            ->whereIn('aluno_id', $alunos->pluck('id'))
            ->whereIn('indicador_id', $indicadores->pluck('id'))
            ->get()
            ->groupBy('aluno_id');

        // Estatísticas
        $totalAlunos = $alunos->count();
        $avaliados   = $alunos->filter(fn($aluno) => $aluno->conceito_final)->count();
        $desenvolvido    = $alunos->filter(fn($aluno) => $aluno->conceito_final === 'Desenvolvido')->count();
        $naoDesenvolvido = $alunos->filter(fn($aluno) => $aluno->conceito_final === 'Não Desenvolvido')->count();
        $parcial     = $totalAlunos - ($desenvolvido + $naoDesenvolvido);

        // 🔹 Calcular porcentagem de presença
        foreach ($alunos as $aluno) {

            $totalAulas = $aluno->aulas()->count();

            $presencas = $aluno->aulas()
                ->wherePivot('presenca', 1)
                ->count();

            $porcentagem = $totalAulas > 0
                ? round(($presencas / $totalAulas) * 100)
                : 0;

            $aluno->porcentagem_presenca = $porcentagem;
        }

        // Retornar view
        return view('paginas.docente.avaliacaoFinal', [
            'uc' => $uc,
            'alunos' => $alunos,
            'indicadores' => $indicadores,
            'aula' => $aula,
            'avaliacoesIndicadores' => $avaliacoesIndicadores,
            'totalAlunos' => $totalAlunos,
            'avaliados' => $avaliados,
            'desenvolvido' => $desenvolvido,
            'parcial' => $parcial,
            'naoDesenvolvido' => $naoDesenvolvido
        ]);
    }

    public function salvarFinal(Request $request, $aulaId)
    {
        $aula = aulaModel::findOrFail($aulaId);
        $alunos = $aula->alunos;

        // Mapeamento de conceitos para o banco
        $mapBanco = [
            'Desenvolvido' => 'Atendido',
            'Não Desenvolvido' => 'Não Atendido',
        ];

        foreach ($alunos as $aluno) {
            // Conceito final selecionado manualmente
            $conceitoFinal = $request->input("conceito_final.{$aluno->id}");

            // Observação individual
            $observacao = $request->input("observacao.{$aluno->id}");

            // Avaliação por indicadores
            if ($request->has("indicadores.{$aluno->id}")) {
                foreach ($request->input("indicadores.{$aluno->id}") as $indicadorId => $conceito) {
                    $conceitoBanco = $mapBanco[$conceito] ?? $conceito;

                    DB::table('avaliacoes_indicadores')->updateOrInsert(
                        [
                            'aluno_id' => $aluno->id,
                            'indicador_id' => $indicadorId,
                            'aula_id' => $aulaId
                        ],
                        [
                            'conceito' => $conceitoBanco,
                            'observacao' => $observacao,
                            'updated_at' => now(),
                            'created_at' => now()
                        ]
                    );
                }
            }

            // Determinar conceito final automático baseado nos indicadores
            $todosIndicadores = $request->input("indicadores.{$aluno->id}") ?? [];
            $conceitoFinalCalculado = in_array('Não Desenvolvido', $todosIndicadores) ? 'Não Desenvolvido' : 'Desenvolvido';

            // Se o usuário selecionou manualmente, sobrescreve
            if ($conceitoFinal) {
                $conceitoFinalCalculado = $conceitoFinal;
            }

            $conceitoBancoFinal = $mapBanco[$conceitoFinalCalculado] ?? $conceitoFinalCalculado;

            // Salvar conceito final em pivot aula_aluno
            $aula->alunos()->updateExistingPivot($aluno->id, [
                'conceito_final' => $conceitoBancoFinal,
                'presenca' => $aluno->presenca ?? 0,
                'updated_at' => now()
            ]);
        }

        return redirect()->route('centralAula', $aula->id)
            ->with('sucesso', 'Avaliação final salva com sucesso!');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\ucModel;
use App\Models\cursoModel;
use App\Models\aulaModel;
use App\Models\turmaModel;
use App\Models\docenteModel;
use App\Services\CalendarioLetivoService;

class ucController extends Controller
{
    // Direciona para a view de cadastro
    public function cadastrarUc()
    {
        return view('paginas.unidadesCurriculares');
    }

    // Insere UC no banco
    public function inserirUc(Request $request)
    {
        $model = ucModel::create([
            'codigoUc'       => $request->input('codigoUc'),
            'nome'           => $request->input('nome'),
            'cargaHoraria'   => $request->input('cargaHoraria'),
            'presencaMinima' => $request->input('presencaMinima'),
            'descricao'      => $request->input('descricao'),
            'status'         => $request->input('status'),
            'cursoCodigo'    => $request->input('cursoCodigo'),
        ]);

        // Vincula docentes, se houver
        if ($request->has('docentes')) {
            $model->docentes()->attach($request->input('docentes'));
        }

        return redirect('/unidadesCurriculares');
    }

    // Consulta UCs existentes
    public function consultarUc()
    {
        $ucs = ucModel::with(['curso', 'docentes', 'aulas.docenteResponsavel'])->get();
        $cursos = cursoModel::all();
        $turmas = turmaModel::all();
        $docentes = docenteModel::all();
        $aulas = aulaModel::all();

        return view('paginas.unidadesCurriculares', compact('aulas', 'ucs', 'cursos', 'turmas', 'docentes'));
    }

    // Edita uma UC
    public function editarUc($id)
    {
        $dado = ucModel::with('docentes')->findOrFail($id);
        $cursos = cursoModel::all();
        $docentes = docenteModel::all();

        return view('paginas.editarUnidadesCurriculares', compact('dado', 'cursos', 'docentes'));
    }

    // Atualiza UC
    public function atualizarUc(Request $request, $id)
    {
        $uc = ucModel::findOrFail($id);
        $uc->update($request->except(['_token', '_method']));

        // Atualiza docentes vinculados
        if ($request->has('docentes')) {
            $uc->docentes()->sync($request->input('docentes'));
        }

        return redirect('/unidadesCurriculares');
    }

    // Exclui UC
    public function excluirUc($id)
    {
        ucModel::where('id', $id)->delete();
        return redirect('/unidadesCurriculares');
    }

    // Inicia UC: cria aulas automaticamente e vincula docente responsável e turma
    public function iniciarUc(Request $request)
    {
        $request->validate([
            'uc_id' => 'required|exists:uc,id',
            'turma_id' => 'required|exists:turma,id',
            'data_inicio' => 'required|date',
            'docente_responsavel' => 'required|exists:docente,id'
        ]);

        $uc = ucModel::with('curso', 'docentes')->findOrFail($request->uc_id);
        $turma = turmaModel::findOrFail($request->turma_id);
        $docenteResponsavel = docenteModel::findOrFail($request->docente_responsavel);
        $curso = $uc->curso;

        DB::transaction(function () use ($uc, $turma, $curso, $docenteResponsavel, $request) {

            // Vincula o docente responsável à UC, se ainda não estiver
            if (!$uc->docentes->contains($docenteResponsavel->id)) {
                $uc->docentes()->attach($docenteResponsavel->id);
                $uc->load('docentes');
            }

            // Dias da semana do curso e carga diária
            $diasSemana = $curso->dias ?? ['segunda', 'terca', 'quarta', 'quinta', 'sexta'];
            $horasPorDia = $curso->cargaDiaria ?? 4;

            // Serviço de calendário
            $calendario = new CalendarioLetivoService();

            // Calcula a data final da UC
            $dataFim = $calendario->calcularDataFinal(
                $request->data_inicio,
                $diasSemana,
                $uc->cargaHoraria,
                $horasPorDia
            );

            // Lista datas letivas
            $datasAulas = $calendario->listarDatasLetivas(
                $request->data_inicio,
                $dataFim,
                $diasSemana
            );

            // Remove aulas antigas dessa UC na turma (evita duplicidade)
            $uc->aulas()->whereHas('turmas', function ($q) use ($turma) {
                $q->where('turma_id', $turma->id);
            })->delete();


            // Cria aulas e vincula docente responsável e turma
            foreach ($datasAulas as $dataAula) {
                $aula = aulaModel::create([
                    'uc_id' => $uc->id,
                    'curso_id' => $curso->id,
                    'dia' => $dataAula,
                    'status' => 'prevista',
                    'docente_responsavel_id' => $docenteResponsavel->id,
                ]);

                // Vincula turma
                $aula->turmas()->attach($turma->id);
            }
        });

        return redirect('/unidadesCurriculares');
    }
}
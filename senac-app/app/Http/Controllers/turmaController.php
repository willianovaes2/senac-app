<?php

namespace App\Http\Controllers;

use App\Models\turmaModel;
use App\Models\cursoModel;
use App\Models\docenteModel;
use App\Models\alunoModel;
use App\Services\CalendarioLetivoService;
use Illuminate\Http\Request;

class turmaController extends Controller
{
    public function __construct(){

    }//fim do método

    public function cadastrarTurma()
    {
        return view('paginas.turmas');
    } //fim do metodo de direcionamento

    public function inserirTurma(Request $request)
    {
        $curso = cursoModel::findOrFail($request->curso_id);

        $ultimaTurma = turmaModel::where('curso_id', $curso->id)
            ->orderBy('id', 'desc')
            ->first();

        $numeroSequencial = 1;

        if ($ultimaTurma) {
            preg_match('/(\d+)/', $ultimaTurma->codigoTurma, $matches);
            $numeroSequencial = intval($matches[1]) + 1;
        }

        $codigoTurma = $curso->sigla . $numeroSequencial . $request->turno;

        $service = new CalendarioLetivoService();

        $dataFim = $service->calcularDataFinal(
            $request->dataInicio,
            $curso->dias,
            $curso->cargaHoraria,
            $request->horasPorDia
        );

        $turma = new turmaModel();

        $turma->curso_id    = $curso->id;
        $turma->codigoTurma = $codigoTurma;
        $turma->dataInicio  = $request->dataInicio;
        $turma->dataFim     = $dataFim;
        $turma->horasPorDia = $request->horasPorDia;
        $turma->turno       = $request->turno;
        $turma->status      = $request->status;

        $turma->save();

        if ($request->has('docentes')) {
            $turma->docentes()->sync($request->docentes);
        }

        if ($request->has('alunos')) {
            $turma->alunos()->sync($request->alunos);
        }

        return redirect('/turmas');
    } //fim do metodo inserir

    public function consultarTurma()
    {
        $turmas   = turmaModel::with(['curso', 'docentes', 'alunos'])->get();
        $cursos   = cursoModel::all();
        $docentes = docenteModel::all();
        $alunos   = alunoModel::all();

        return view('paginas.turmas', compact(
            'turmas',
            'cursos',
            'docentes',
            'alunos'
        ));
    } //fim do metodo consultar


    public function editarTurma($id)
    {
        $dado = turmaModel::with(['docentes', 'alunos'])->findOrFail($id);

        $cursos   = cursoModel::all();
        $docentes = docenteModel::all();
        $alunos   = alunoModel::all();

        return view('paginas.editarTurmas', compact(
            'dado',
            'cursos',
            'docentes',
            'alunos'
        ));
    }
    //fim do metodo editar

    public function atualizarTurma(Request $request, $id)
    {
        $turma = turmaModel::findOrFail($id);

        $turma->update(
            $request->except(['_token', 'docentes', 'alunos'])
        );

        if ($request->has('docentes')) {
            $turma->docentes()->sync($request->docentes);
        }

        if ($request->has('alunos')) {
            $turma->alunos()->sync($request->alunos);
        }

        return redirect('/turmas');
    } //fim do metodo atualizar

    public function excluirTurma($id)
    {
        turmaModel::where('id', $id)->delete();
        return redirect('/turmas');
    } //fim do metodo excluir
}//fim da classe
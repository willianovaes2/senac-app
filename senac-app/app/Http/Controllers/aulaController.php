<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\aulaModel;
use App\Models\cursoModel;
use App\Models\turmaModel;
use App\Models\docenteModel;
use App\Models\ucModel;

class aulaController extends Controller
{
    public function inserirAula(Request $request)
    {
        // Pega os dados do form
        $uc_id    = $request->input('uc_id');
        $curso_id = $request->input('curso_id');
        $turma_id = $request->input('turma_id');
        $dia      = $request->input('dia');
        $status   = $request->input('status');

        // Cria a aula
        $model = new aulaModel();
        $model->curso_id = $curso_id;
        $model->uc_id    = $uc_id;
        $model->dia      = $dia;
        $model->status   = $status;
        $model->save();

        if ($turma_id) {
            $model->turmas()->attach([$turma_id]);
        }

        if ($request->docentes) {
            $model->docentes()->attach($request->docentes);
        }

        return redirect('/aulas');
    }

    public function consultarAula()
    {
        $aulas    = aulaModel::with(['curso', 'uc', 'turmas', 'docentes'])->get();
        $cursos   = cursoModel::all();
        $turmas   = turmaModel::all();
        $docentes = docenteModel::all();
        $ucs      = ucModel::all(); // <- garante que $ucs exista na view

        return view('paginas.aulas', compact(
            'aulas',
            'cursos',
            'turmas',
            'docentes',
            'ucs' // <- inclua aqui
        ));
    }


    public function editarAulas($id)
    {
        $dado    = aulaModel::findOrFail($id);
        $cursos  = cursoModel::with('ucs')->get();
        $turmas  = turmaModel::all();
        $docentes = docenteModel::all();

        return view('paginas.editarAulas', compact('dado', 'cursos', 'turmas', 'docentes'));
    }

    public function atualizarAula(Request $request, $id)
    {
        $aula = aulaModel::findOrFail($id);

        // Atualiza campos diretos da aula
        $aula->curso_id = $request->input('curso_id');
        $aula->uc_id    = $request->input('uc_id');
        $aula->dia      = $request->input('dia');
        $aula->status   = $request->input('status');
        $aula->save();

        // Atualiza turmas (Many-to-Many)
        if ($request->turma_id) {
            // Substitui as turmas atuais pelas novas selecionadas
            $aula->turmas()->sync([$request->turma_id]);
        }

        // Atualiza docentes (Many-to-Many)
        if ($request->docentes) {
            $aula->docentes()->sync($request->docentes);
        } else {
            $aula->docentes()->sync([]); // Remove todos se nenhum selecionado
        }

        return redirect('/aulas');
    }


    public function excluirAula($id)
    {
        aulaModel::where('id', $id)->delete();
        return redirect('/aulas');
    }
}
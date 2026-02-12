<?php

namespace App\Http\Controllers;

use App\Models\administradorModel;
use App\Models\alunoModel;
use App\Models\cursoModel;
use App\Models\docenteModel;
use App\Models\turmaModel;
use App\Models\ucModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class administradorController extends Controller
{
    public function cadastrarAdministrador()
    {
        return view('paginas.dashboardAdm');
    } //fim do metodo de direcionamento

    public function inserirAdministrador(Request $request)
    {
        // 🔢 Remove máscara do CPF antes de salvar
        $cpfLimpo = preg_replace('/\D/', '', $request->cpf);

        $nomeAdministrador      = $request->input('nomeAdministrador');
        $cpf                    = $request->input('cpf');
        $dataNascimento         = $request->input('dataNascimento');
        $telefone               = $request->input('telefone');
        $email                  = $request->input('email');
        $senha                  = $request->input('senha');
        $status                 = $request->input('status');

        //valida o cpf 
        if (administradorModel::where('cpf', $cpfLimpo)->exists()) {
            return back()
                ->withInput()
                ->withErrors([
                    'cpf' => 'Este CPF já está cadastrado.'
                ]);
        }

        //data limite de idade
        $dataLimite = Carbon::now()->subYears(15);
        if (Carbon::parse($dataNascimento)->greaterThan($dataLimite)) {
            return back()
                ->withInput()
                ->withErrors([
                    'dataNascimento' => 'O aluno deve ter no mínimo 15 anos.'
                ]);
        }

        //chamando model
        $model = new administradorModel();

        $model->nomeAdministrador= $nomeAdministrador;
        $model->cpf              = $cpf;
        $model->dataNascimento   = $dataNascimento;
        $model->telefone         = $telefone;
        $model->email            = $email;
        $model->senha            = $senha;
        $model->status           = $status;


        $model->save();
        return redirect('/');
    } //fim do metodo inserir

    public function consultarAdministrador()
    {
        // cards do dashboard
        $totalCursos   = cursoModel::count();
        $totalDocentes = docenteModel::count();
        $totalAlunos   = alunoModel::count();
        $turmasAtivas  = turmaModel::where('status', 'ativo')->count();

        // dados para gestão de vínculos (modais)
        $alunos   = alunoModel::all();
        $turmas   = turmaModel::with('curso')->get();
        $cursos   = cursoModel::all();
        $docentes = docenteModel::all();
        $ucs      = ucModel::all();

        return view('paginas.dashboardAdm', compact(
            'totalCursos',
            'totalDocentes',
            'totalAlunos',
            'turmasAtivas',
            'alunos',
            'turmas',
            'cursos',
            'docentes',
            'ucs'
        ));
    } //fim do metodo consultar


    public function editarAdministrador($id)
    {
        $dado = administradorModel::findOrFail($id);
        return view('paginas.', compact('dado'));
    } //fim do metodo editar

    public function atualizarAdministrador(Request $request, $id)
    {
        administradorModel::where('id', $id)->update($request->all());
        return redirect('/consultar');
    } //fim do metodo atualizar

    public function excluirAdministrador(Request $request, $id)
    {
        administradorModel::where('id', $id)->delete($request->all());
        return redirect('/consultar');
    } //fim do metodo excluir

}

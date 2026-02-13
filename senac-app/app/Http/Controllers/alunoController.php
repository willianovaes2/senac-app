<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\authController;
use App\Models\alunoModel;
use App\Models\cursoModel;
use App\Rules\ValidaCpf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class alunoController extends Controller
{
    public function cadastrarAluno()
    {
        return view('paginas.alunos');
    } //fim do metodo de direcionamento

    public function inserirAluno(Request $request)
    {

        $nomeAluno              = $request->input('nomeAluno');
        $intencao               = $request->input('intencao');
        $ra                     = $request->input('ra');
        $cpf                    = $request->input('cpf');
        $dataNascimento         = $request->input('dataNascimento');
        $telefone               = $request->input('telefone');
        $emailAluno             = $request->input('emailAluno');
        $senhaAluno             = $request->input('senhaAluno');
        $dataMatricula          = now();
        $status                 = $request->input('status');
        $tipo                   = $request->input('tipo');
        $endereco               = $request->input('endereco');

        //chamando model
        $model = new alunoModel();

        $model->nomeAluno             = $nomeAluno;
        $model->intencao              = $intencao;
        $model->ra                    = $ra;
        $model->cpf                   = $cpf;
        $model->dataNascimento        = $dataNascimento;
        $model->telefone              = $telefone;
        $model->emailAluno            = $emailAluno;
        $model->senhaAluno            = $senhaAluno;
        $model->dataMatricula         = $dataMatricula;
        $model->tipo                  = $tipo;
        $model->status                = $status;
        $model->endereco              = $endereco;

        $model->save();
        return redirect('/alunos');
    } //fim do metodo inserir

    public function consultarAluno()
    {
        $alunos = alunoModel::all();
        $cursos = cursoModel::all();

        $totalAlunos    = alunoModel::count();
        $alunosPagantes = alunoModel::where('tipo', 'pagante')->count();
        $alunosBolsistas = alunoModel::where('tipo', 'bolsista')->count();

        return view('paginas.alunos', compact(
            'alunos',
            'cursos',
            'totalAlunos',
            'alunosPagantes',
            'alunosBolsistas'
        ));
    } //fim do metodo de consulta


    public function editarAluno($id)
    {
        $dado = alunoModel::findOrFail($id);
        return view('paginas.editarAlunos', compact('dado'));
    } //fim do metodo editar

    public function atualizarAluno(Request $request, $id)
    {
        alunoModel::where('id', $id)->update(
            $request->except(['_token', '_method'])
        );

        return redirect('/alunos');
    } //fim do metodo atualizar

    public function excluirAluno($id)
    {
        alunoModel::where('id', $id)->delete();
        return redirect('/alunos');
    } //fim do metodo excluir

    public function exibirAluno($id)
    {
        $aluno = Session::get('usuario');

        // Buscar aluno com UCs
        $aluno = alunoModel::with('ucs')->find($aluno->id);

        $ucs = $aluno->ucs;
        $uc  = $ucs->first(); // pega a primeira UC

        return view('paginas.aluno.telaInicialAluno', compact('aluno','ucs','uc'));
    }
}

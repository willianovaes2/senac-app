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
use Illuminate\Support\Facades\DB;


class administradorController extends Controller
{
    public function cadastrarAdministrador()
    {
        return view('paginas.cadastrarAdministrador');
    } //fim do metodo de direcionamento

    

    public function inserirAdministrador(Request $request)
    {
        // 🔢 Remove máscara do CPF antes de salvar
        $cpfLimpo = preg_replace('/\D/', '', $request->cpf);

        $nome                   = $request->input('nome');
        $cpf                    = $request->input('cpf');
        $dataNascimento         = $request->input('dataNascimento');
        $telefone                 = $request->input('telefone');
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

        $model->nome             = $nome;
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

        $totalCursos        = cursoModel::count();
        $totalDocentes      = docenteModel::count();
        $totalAlunos        = alunoModel::count();
        $turmasAtivas       = turmaModel::count();

        $alunos             = alunoModel::all();
        $turmas             = turmaModel::with('curso')->get();
        $cursos             = cursoModel::all();
        $docentes           = docenteModel::all();
        $ucs                = ucModel::all();

        $alunoTurmas = DB::table('aluno_turma')
            ->join('aluno', 'aluno.id', '=', 'aluno_turma.aluno_id')
            ->join('turma', 'turma.id', '=', 'aluno_turma.turma_id')
            ->select(
                'aluno_turma.id',
                'aluno.nomeAluno',
                'turma.codigoTurma'
            )
            ->get();

        $cursoUcs = DB::table('curso_uc')
                ->join('uc', 'uc.id', '=', 'curso_uc.uc_id')
                ->join('curso', 'curso.id', '=', 'curso_uc.curso_id')
                ->select(
                    'curso_uc.id',
                    'uc.codigoUc',
                    'curso.nome as nomeCurso'
                )
                ->get();
        $docenteCursos = DB::table('docente_curso')
                ->join('curso', 'curso.id', '=', 'docente_curso.curso_id')
                ->join('docente', 'docente.id', '=', 'docente_curso.docente_id')
                ->select(
                    'docente_curso.id',
                    'docente.nomeDocente',
                    'curso.nome as nomeCurso'
                )
                ->get();
        $docenteUcs = DB::table('docente_uc')
                ->join('uc', 'uc.id', '=', 'docente_uc.uc_id')
                ->join('docente', 'docente.id', '=', 'docente_uc.docente_id')
                ->select(
                    'docente_uc.id',
                    'docente.nomeDocente',
                    'uc.codigoUc'
                )
                ->get();
        $docenteTurmas = DB::table('docente_turma')
                ->join('turma', 'turma.id', '=', 'docente_turma.turma_id')
                ->join('docente', 'docente.id', '=', 'docente_turma.docente_id')
                ->select(
                    'docente_turma.id',
                    'docente.nomeDocente',
                    'turma.codigoTurma'
                )
                ->get();

        return view('paginas.dashboardAdm', compact(
            'totalCursos', 
            'totalDocentes', 
            'totalAlunos', 
            'turmasAtivas', 
            'alunos', 
            'turmas', 
            'cursos', 
            'docentes', 
            'ucs', 
            'alunoTurmas', 
            'cursoUcs', 
            'docenteCursos', 
            'docenteUcs', 
            'docenteTurmas',
        ));
    } //fim do metodo de consulta 

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
<?php

namespace App\Http\Controllers;

use App\Models\alunoModel;
use App\Models\turmaModel;
use App\Models\cursoModel;
use App\Models\ucModel;
use App\Models\docenteModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class vinculoController extends Controller
{
    public function index()
    {
        return view('paginas.dashboardAdm', [

            'totalCursos' => cursoModel::count(),
            'totalDocentes' => docenteModel::count(),
            'totalAlunos' => alunoModel::count(),
            'turmasAtivas' => turmaModel::count(),

            'cursos' => cursoModel::all(),
            'docentes' => docenteModel::all(),
            'ucs' => ucModel::all(),
            'turmas' => turmaModel::withCount('alunos')->get(),

            'alunoTurmas' => DB::table('aluno_turma')
                ->join('aluno', 'aluno.id', '=', 'aluno_turma.aluno_id')
                ->join('turma', 'turma.id', '=', 'aluno_turma.turma_id')
                ->select(
                    'aluno_turma.id',
                    'aluno.nomeAluno',
                    'turma.codigoTurma'
                )
                ->get(),
            'cursoUcs' => DB::table('curso_uc')
                ->join('uc', 'uc.id', '=', 'curso_uc.uc_id')
                ->join('curso', 'curso.id', '=', 'curso_uc.curso_id')
                ->select(
                    'curso_uc.id',
                    'uc.codigoUc',
                    'curso.nome as nomeCurso'
                )
                ->get(),
            'docenteCursos' => DB::table('docente_curso')
                ->join('curso', 'curso.id', '=', 'docente_curso.curso_id')
                ->join('docente', 'docente.id', '=', 'docente_curso.docente_id')
                ->select(
                    'docente_curso.id',
                    'docente.nomeDocente',
                    'curso.nome as nomeCurso'
                )
                ->get(),
            'docenteUcs' => DB::table('docente_uc')
                ->join('uc', 'uc.id', '=', 'docente_uc.uc_id')
                ->join('docente', 'docente.id', '=', 'docente_uc.docente_id')
                ->select(
                    'docente_uc.id',
                    'docente.nomeDocente',
                    'uc.codigoUc'
                )
                ->get(),
            'docenteTurmas' => DB::table('docente_turma')
                ->join('turma', 'turma.id', '=', 'docente_turma.turma_id')
                ->join('docente', 'docente.id', '=', 'docente_turma.docente_id')
                ->select(
                    'docente_turma.id',
                    'docente.nomeDocente',
                    'turma.codigoTurma'
                )
                ->get(),
        ]);
    }

    public function docenteCurso(Request $request)
    {
        $request->validate([
            'docente_id' => 'required|exists:docente,id',
            'cursos' => 'required|array'
        ]);

        $docente = docenteModel::find($request->docente_id);

        $docente->cursos()->syncWithoutDetaching($request->cursos);

        return redirect()->back()->with('success', 'Vínculo realizado com sucesso!');
    }

    public function docenteUc(Request $request)
    {
        $request->validate([
            'uc_id' => 'required|exists:uc,id',
            'docentes' => 'required|array'
        ]);

        $uc = ucModel::find($request->uc_id);

        $uc->docentes()->syncWithoutDetaching($request->docentes);

        return redirect()->back()->with('success', 'Vínculo realizado com sucesso!');
    }

    public function docenteTurma(Request $request)
    {
        $request->validate([
            'docente_id' => 'required|exists:docente,id',
            'turmas' => 'required|array'
        ]);

        $docente = docenteModel::find($request->docente_id);

        $docente->turmas()->syncWithoutDetaching($request->turmas);

        return redirect()->back()->with('success', 'Vínculo realizado com sucesso!');
    }

    public function alunoTurma(Request $request)
    {
        $request->validate([
            'aluno_id' => 'required|exists:aluno,id',
            'turmas' => 'required|array'
        ]);

        $aluno = alunoModel::find($request->aluno_id);

        $aluno->turmas()->syncWithoutDetaching($request->turmas);

        return redirect()->back()->with('success', 'Vínculo realizado com sucesso!');
    }

    public function cursoUcs(Request $request)
    {
        $request->validate([
            'curso_id' => 'required|exists:curso,id',
            'ucs' => 'required|array'
        ]);

        $curso = cursoModel::find($request->curso_id);

        $curso->ucs()->syncWithoutDetaching($request->ucs);

        return redirect()->back()->with('success', 'Vínculo realizado com sucesso!');
    }


    public function removerAlunoTurma($id)
    {
        DB::table('aluno_turma')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Vínculo removido com sucesso!');
    }

    public function removerCursoUc($id)
    {
        DB::table('curso_uc')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Vínculo removido com sucesso!');
    }

    public function removerDocenteCurso($id)
    {
        DB::table('docente_curso')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Vínculo removido com sucesso!');
    }

    public function removerDocenteUc($id)
    {
        DB::table('docente_uc')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Vínculo removido com sucesso!');
    }

    public function removerDocenteTurma($id)
    {
        DB::table('docente_turma')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Vínculo removido com sucesso!');
    }
}

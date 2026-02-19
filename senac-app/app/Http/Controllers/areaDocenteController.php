<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\aulaModel;
use App\Models\cursoModel;
use App\Models\turmaModel;
use App\Models\ucModel;
use App\Models\alunoModel;



class AreaDocenteController extends Controller
{
    public function consultarPainelDocente(Request $request)
    {
        $query = aulaModel::with(['curso', 'uc', 'turmas', 'docenteResponsavel']);

        if ($request->filled('curso_id')) {
            $query->where('curso_id', $request->curso_id);
        }

        if ($request->filled('turma_id')) {
            $query->whereHas(
                'turmas',
                fn($q) =>
                $q->where('turma_id', $request->turma_id)
            );
        }

        if ($request->filled('ano')) {
            $query->whereBetween('dia', [
                $request->ano . '-01-01',
                $request->ano . '-12-31'
            ]);
        }

        $aulas = $query->orderBy('dia')->get();

        return view('paginas.docente.telaInicial', [
            'aulas'  => $aulas,
            'cursos' => cursoModel::all(),
            'turmas' => turmaModel::all(),
            'anos'   => aulaModel::pluck('dia')
                ->map(fn($d) => date('Y', strtotime($d)))
                ->unique()
                ->sort()
                ->values()
        ]);
    }

    public function consultarNotas(Request $request)
    {
        $query = ucModel::query();

        if ($request->filled('curso_id')) {
            $query->where('curso_id', $request->curso_id);
        }

        if ($request->filled('turma_id')) {
            $query->where('turma_id', $request->turma_id);
        }

        if ($request->filled('ano')) {
            $query->whereRaw("strftime('%Y', dataInicio) = ?", [$request->ano]);
        }

        $ucs = $query->get();

        return view('docente.notas.index', [
            'ucs'    => $ucs,
            'cursos' => cursoModel::all(),
            'turmas' => turmaModel::all(),
            'anos'   => turmaModel::selectRaw("strftime('%Y', dataInicio) as ano")
                ->distinct()
                ->pluck('ano')
        ]);
    }

    public function centralAula($id)
    {
        $aula = aulaModel::with([
            'uc',
            'curso',
            'turmas',
            'docenteResponsavel',
            'alunos' // se existir relação
        ])->findOrFail($id);

        return view('paginas.docente.centralAula', [
            'aula' => $aula
        ]);
    }
}
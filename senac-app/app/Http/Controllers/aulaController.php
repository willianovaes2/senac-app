<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 
use App\Models\aulaModel;
use App\Models\ucModel;
use App\Models\turmaModel;
use App\Models\docenteModel;
use App\Models\cursoModel;
use App\Models\UcTurmaModel;
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
}
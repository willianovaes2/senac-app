<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IndicadorModel;
use App\Models\cursoModel;
use App\Models\ucModel;

class IndicadorController extends Controller
{

    // Inserir novo indicador
    public function inserirIndicador(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'ucs' => 'required|array|min:1'
        ]);

        $indicador = new IndicadorModel();
        $indicador->nome = $request->input('nome');
        $indicador->descricao = $request->input('descricao');
        $indicador->save();

        if ($request->ucs) {
            $indicador->ucs()->attach($request->ucs);
        }

        return redirect('/indicadores');
    }
    // Consultar todos os indicadores
    public function consultarIndicador()
    {
        $indicadores = IndicadorModel::with('ucs')->get();
        $cursos      = cursoModel::with('ucs')->get();
        $ucs         = ucModel::all();

        return view('paginas.indicadores', compact('indicadores', 'cursos', 'ucs'));
    }

    // Formulário de edição
    public function editarIndicador($id)
    {
        $dado   = IndicadorModel::with('ucs')->findOrFail($id);
        $cursos = cursoModel::with('ucs')->get();

        return view('paginas.editarIndicadores', compact('dado', 'cursos'));
    }

    // Atualizar indicador
    public function atualizarIndicador(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'ucs' => 'required|array|min:1'
        ]);

        $indicador = IndicadorModel::findOrFail($id);
        $indicador->nome = $request->input('nome');
        $indicador->descricao = $request->input('descricao');
        $indicador->save();

        // Atualiza UCs (Many-to-Many)
        $indicador->ucs()->sync($request->ucs ?? []);

        return redirect('/indicadores');
    }

    // Excluir indicador
    public function excluirIndicador($id)
    {
        $indicador = IndicadorModel::findOrFail($id);
        $indicador->ucs()->detach(); // limpa pivot
        $indicador->delete();

        return redirect('/indicadores');
    }
}
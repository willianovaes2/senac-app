<?php

namespace App\Http\Controllers;

use App\Models\relatorioModel;
use Illuminate\Http\Request;

class relatorioController extends Controller
{
    public function cadastrarRelatorio()
    {
        return view('paginas.relatorios');
    } //fim do metodo de direcionamento

    public function inserirRelatorio(Request $request)
    {
        $feedbackAluno   = $request->input('feedbackAluno');
        $dataEnvio       = $request->input('dataEnvio');
        $resultado       = $request->input('resultado');


        //chamando model
        $model = new relatorioModel();

        $model->feedbackAluno    = $feedbackAluno;
        $model->dataEnvio        = $dataEnvio;
        $model->resultado        = $resultado;

        $model->save();
        return redirect('/');
    } //fim do metodo inserir

    public function consultarRelatorio()
    {
        $ids = relatorioModel::all();

        $pendente   = relatorioModel::count();
        $aprovado   = relatorioModel::count();
        $rejeitado  = relatorioModel::count();

        return view('paginas.relatorios', compact(
            'ids',
            'pendente',
            'aprovado',
            'rejeitado'
        ));
    } //fim do metodo de consulta

    public function editarRelatorio($id)
    {
        $dado = relatorioModel::findOrFail($id);
        return view('paginas.relatorios', compact('dado'));
    } //fim do metodo editar

    public function atualizarRelatorio(Request $request, $id)
    {
        relatorioModel::where('id', $id)->update($request->all());
        return redirect('/consultar');
    } //fim do metodo atualizar

    public function excluirRelatorio(Request $request, $id)
    {
        relatorioModel::where('id', $id)->delete($request->all());
        return redirect('/consultar');
    } //fim do metodo excluir
}
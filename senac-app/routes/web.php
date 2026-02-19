<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// exibir o formulário
Route::get('/cadastrarAdministrador', [\App\Http\Controllers\administradorController::class, 'cadastrarAdministrador']);

// salvar os dados
Route::get('/inserirAdministrador', [\App\Http\Controllers\administradorController::class, 'inserirAdministrador']);

//login
Route::get('/', [\App\Http\Controllers\authController::class, 'home']);
Route::post('/login', [\App\Http\Controllers\authController::class, 'login']);
Route::post('/logout', [\App\Http\Controllers\authController::class, 'logout'])->name('logout');

//dashboard
Route::get('/dashboardAdm', [\App\Http\Controllers\administradorController::class, 'consultarAdministrador']);
Route::get('/inserir', [\App\Http\Controllers\administradorController::class, 'inserirAdministrador']);

//curso
Route::get('/cursos', [\App\Http\Controllers\cursoController::class, 'consultarCurso']);
Route::post('/inserir', [\App\Http\Controllers\cursoController::class, 'inserirCurso']);
Route::get('/editarCurso/{id}', [\App\Http\Controllers\cursoController::class, 'editarCursos']);
Route::post('/atualizarCurso/{id}', [\App\Http\Controllers\cursoController::class, 'atualizarCurso']);
Route::get('/excluirCurso/{id}', [\App\Http\Controllers\cursoController::class, 'excluirCurso']);
//uc
Route::get('/unidadesCurriculares', [\App\Http\Controllers\ucController::class, 'consultarUc']);
Route::post('/inserirUc', [\App\Http\Controllers\ucController::class, 'inserirUc']);
Route::get('/editarUnidadesCurriculares/{id}', [\App\Http\Controllers\ucController::class, 'editarUc']);
Route::post('/atualizarUc/{id}', [\App\Http\Controllers\ucController::class, 'atualizarUc']);
Route::get('/excluirUc/{id}', [\App\Http\Controllers\ucController::class, 'excluirUc']);
Route::post('/iniciarUc', [\App\Http\Controllers\ucController::class, 'iniciarUc']);
//docente
Route::get('/docentes', [\App\Http\Controllers\docenteController::class, 'consultarDocente']);
Route::post('/inserirDocente', [\App\Http\Controllers\docenteController::class, 'inserirDocente']);
Route::get('/editarDocentes/{id}', [\App\Http\Controllers\docenteController::class, 'editarDocente']);
Route::post('/atualizarDocente/{id}', [\App\Http\Controllers\docenteController::class, 'atualizarDocente']);
Route::get('/excluirDocente/{id}', [\App\Http\Controllers\docenteController::class, 'excluirDocente']);
//aluno
Route::get('/alunos', [\App\Http\Controllers\alunoController::class, 'consultarAluno']);
Route::post('/inserirAluno', [\App\Http\Controllers\alunoController::class, 'inserirAluno']);
Route::get('/editarAlunos/{id}', [\App\Http\Controllers\alunoController::class, 'editarAluno']);
Route::post('/atualizarAluno/{id}', [\App\Http\Controllers\alunoController::class, 'atualizarAluno']);
Route::get('/excluirAluno/{id}', [\App\Http\Controllers\alunoController::class, 'excluirAluno']);
//turma
Route::get('/turmas', [\App\Http\Controllers\turmaController::class, 'consultarTurma']);
Route::post('/inserirTurma', [\App\Http\Controllers\turmaController::class, 'inserirTurma']);
Route::get('/editarTurmas/{id}', [\App\Http\Controllers\turmaController::class, 'editarTurma']);
Route::post('/atualizarTurmas/{id}', [\App\Http\Controllers\turmaController::class, 'atualizarTurma']);
Route::get('/excluirTurma/{id}', [\App\Http\Controllers\turmaController::class, 'excluirTurma']);
Route::get('/pergunta/{data}', [\App\Http\Controllers\turmaController::class, 'retornarDataFinal']);

//aulas
Route::get('/aulas', [\App\Http\Controllers\aulaController::class, 'consultarAula']);
Route::post('/inserirAula', [\App\Http\Controllers\aulaController::class, 'inserirAula']);
Route::get('/editarAulas/{id}', [\App\Http\Controllers\aulaController::class, 'editarAulas']);
Route::post('/atualizarAula/{id}', [\App\Http\Controllers\aulaController::class, 'atualizarAula']);
Route::get('/excluirAula/{id}', [\App\Http\Controllers\aulaController::class, 'excluirAula']);

// Indicadores
Route::get('/indicadores', [\App\Http\Controllers\IndicadorController::class, 'consultarIndicador']);
Route::post('/inserirIndicador', [\App\Http\Controllers\IndicadorController::class, 'inserirIndicador']);
Route::get('/editarIndicador/{id}', [\App\Http\Controllers\IndicadorController::class, 'editarIndicador']);
Route::post('/atualizarIndicador/{id}', [\App\Http\Controllers\IndicadorController::class, 'atualizarIndicador']);
Route::get('/excluirIndicador/{id}', [\App\Http\Controllers\IndicadorController::class, 'excluirIndicador']);

//relatorio
Route::get('/relatorios', [\App\Http\Controllers\relatorioController::class, 'consultarRelatorio']);

//Gestao de Vinculo
Route::post('/vinculos/docenteCurso', [\App\Http\Controllers\vinculoController::class, 'docenteCurso'])->name('vinculos.docenteCurso');;
Route::post('/vinculos/docenteUc', [\App\Http\Controllers\vinculoController::class, 'docenteUc'])->name('vinculos.docenteUc');;
Route::post('/vinculos/docenteTurma', [\App\Http\Controllers\vinculoController::class, 'docenteTurma'])->name('vinculos.docenteTurma');;
Route::post('/vinculos/alunoTurma', [\App\Http\Controllers\vinculoController::class, 'alunoTurma'])->name('vinculos.alunoTurma');;
Route::post('/vinculos/cursoUc', [\App\Http\Controllers\vinculoController::class, 'cursoUcs'])->name('vinculos.cursoUc');;
Route::post('/vinculos/removerAlunoTurma', [\App\Http\Controllers\vinculoController::class, 'removerAlunoTurma'])->name('vinculos.removerAluno');;
Route::post('/vinculos/removerCursoUc', [\App\Http\Controllers\vinculoController::class, 'removerCursoUc'])->name('vinculos.removerCursoUc');;
Route::post('/vinculos/removerDocenteCurso', [\App\Http\Controllers\vinculoController::class, 'removerDocenteCurso'])->name('vinculos.removerDocenteCurso');;
Route::post('/vinculos/removerDocenteUc', [\App\Http\Controllers\vinculoController::class, 'removerDocenteUc'])->name('vinculos.removerDocenteUc');;
Route::post('/vinculos/removerDocenteTurma', [\App\Http\Controllers\vinculoController::class, 'removerDocenteTurma'])->name('vinculos.removerDocenteTurma');;

//tela aluno
Route::get('/telaInicialAluno', [\App\Http\Controllers\telaAlunoController::class, 'consultarTelaAluno'])->name('aluno.telaInicialAluno');

// PAINEL DOCENTE
Route::get('/telaInicial', [\App\Http\Controllers\areaDocenteController::class, 'consultarPainelDocente'])->name('telaInicial');
Route::get('/notas', [\App\Http\Controllers\areaDocenteController::class, 'consultarNotas']);
Route::get('/centralAula/{id}', [\App\Http\Controllers\AreaDocenteController::class, 'centralAula'])->name('centralAula');
Route::get('/realizarChamada/{id}', [\App\Http\Controllers\aulaController::class, 'realizarChamada'])->name('chamada');
Route::post('/realizarChamada/{aula}', [\App\Http\Controllers\aulaController::class, 'salvarChamada'])->name('salvarChamada');
Route::get('/avaliacaoParcial/{aula}', [\App\Http\Controllers\aulaController::class, 'avaliacaoParcial'])->name('avaliacaoParcial');
Route::post('/avaliacaoParcial/{aula}', [\App\Http\Controllers\aulaController::class, 'salvarParcial'])->name('salvarParcial');
Route::get('/avaliacaoFinal/{aula}', [\App\Http\Controllers\aulaController::class, 'avaliacaoFinal'])->name('avaliacaoFinal');
Route::post('/avaliacaoFinal/{aula}', [\App\Http\Controllers\aulaController::class, 'salvarFinal'])->name('salvarFinal');
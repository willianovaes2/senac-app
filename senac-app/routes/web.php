<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ===============================
// LOGIN
// ===============================
Route::get('/', [\App\Http\Controllers\authController::class, 'home']);
Route::get('/login', [\App\Http\Controllers\authController::class, 'login']);
Route::get('/logout', [\App\Http\Controllers\authController::class, 'logout']);


// ===============================
// ADMINISTRADOR
// ===============================
Route::get('/addAdministrador', [\App\Http\Controllers\administradorController::class, 'addAdministrador']);
//Route para entrar na página cadastrarAdministrador

Route::get('/cadastrarAdministrador', [\App\Http\Controllers\administradorController::class, 'cadastrarAdministrador']);
Route::get('/inserirAdministrador', [\App\Http\Controllers\administradorController::class, 'inserirAdministrador']);
Route::get('/dashboardAdm', [\App\Http\Controllers\administradorController::class, 'consultarAdministrador']);
Route::get('/inserir', [\App\Http\Controllers\administradorController::class, 'inserirAdministrador']);


// ===============================
// AÇÕES RÁPIDAS
// ===============================
Route::post('/inserirCurso', [\App\Http\Controllers\cursoController::class, 'inserirCurso']);
Route::post('/inserirDocente', [\App\Http\Controllers\docenteController::class, 'inserirDocente']);
Route::post('/inserirAluno', [\App\Http\Controllers\alunoController::class, 'inserirAluno']);


// ===============================
// CURSOS
// ===============================
Route::get('/cursos', [\App\Http\Controllers\cursoController::class, 'consultarCurso']);
Route::post('/inserir', [\App\Http\Controllers\cursoController::class, 'inserirCurso']);
Route::get('/editarCurso/{id}', [\App\Http\Controllers\cursoController::class, 'editarCursos']);
Route::post('/atualizarCurso/{id}', [\App\Http\Controllers\cursoController::class, 'atualizarCurso']);
Route::get('/excluirCurso/{id}', [\App\Http\Controllers\cursoController::class, 'excluirCurso']);


// ===============================
// UNIDADES CURRICULARES (UC)
// ===============================
Route::get('/unidadesCurriculares', [\App\Http\Controllers\ucController::class, 'consultarUc']);
Route::post('/inserirUc', [\App\Http\Controllers\ucController::class, 'inserirUc']);
Route::get('/editarUnidadesCurriculares/{id}', [\App\Http\Controllers\ucController::class, 'editarUc']);
Route::post('/atualizarUc/{id}', [\App\Http\Controllers\ucController::class, 'atualizarUc']);
Route::get('/excluirUc/{id}', [\App\Http\Controllers\ucController::class, 'excluirUc']);
Route::post('/iniciarUc', [\App\Http\Controllers\ucController::class, 'iniciarUc']);


// ===============================
// DOCENTES
// ===============================
Route::get('/docentes', [\App\Http\Controllers\docenteController::class, 'consultarDocente']);
Route::post('/inserirDocente', [\App\Http\Controllers\docenteController::class, 'inserirDocente']);
Route::get('/editarDocentes/{id}', [\App\Http\Controllers\docenteController::class, 'editarDocente']);
Route::post('/atualizarDocente/{id}', [\App\Http\Controllers\docenteController::class, 'atualizarDocente']);
Route::get('/excluirDocente/{id}', [\App\Http\Controllers\docenteController::class, 'excluirDocente']);


// ===============================
// ALUNOS
// ===============================
Route::get('/alunos', [\App\Http\Controllers\alunoController::class, 'consultarAluno']);
Route::post('/inserirAluno', [\App\Http\Controllers\alunoController::class, 'inserirAluno']);
Route::get('/editarAlunos/{id}', [\App\Http\Controllers\alunoController::class, 'editarAluno']);
Route::post('/atualizarAluno/{id}', [\App\Http\Controllers\alunoController::class, 'atualizarAluno']);
Route::get('/excluirAluno/{id}', [\App\Http\Controllers\alunoController::class, 'excluirAluno']);

Route::get('/exibirAluno/{id}', [\App\Http\Controllers\alunoController::class, 'exibirAluno']);




// ===============================
// TURMAS
// ===============================
Route::get('/turmas', [\App\Http\Controllers\turmaController::class, 'consultarTurma']);
Route::post('/inserirTurma', [\App\Http\Controllers\turmaController::class, 'inserirTurma']);
Route::get('/editarTurmas/{id}', [\App\Http\Controllers\turmaController::class, 'editarTurma']);
Route::post('/atualizarTurma/{id}', [\App\Http\Controllers\turmaController::class, 'atualizarTurma']);
Route::get('/excluirTurma/{id}', [\App\Http\Controllers\turmaController::class, 'excluirTurma']);
Route::get('/pergunta/{data}', [\App\Http\Controllers\turmaController::class, 'retornarDataFinal']);


// ===============================
// AULAS
// ===============================
Route::get('/aulas', [\App\Http\Controllers\aulaController::class, 'consultarAula']);
Route::post('/inserirAula', [\App\Http\Controllers\aulaController::class, 'inserirAula']);
Route::get('/editarAulas/{id}', [\App\Http\Controllers\aulaController::class, 'editarAulas']);
Route::post('/atualizarAula/{id}', [\App\Http\Controllers\aulaController::class, 'atualizarAula']);
Route::get('/excluirAula/{id}', [\App\Http\Controllers\aulaController::class, 'excluirAula']);

// ===============================
// INDICADORES
// ===============================

Route::get('/indicadores', [\App\Http\Controllers\IndicadorController::class, 'consultarIndicador']);
Route::post('/inserirIndicador', [\App\Http\Controllers\IndicadorController::class, 'inserirIndicador']);
Route::get('/editarIndicador/{id}', [\App\Http\Controllers\IndicadorController::class, 'editarIndicador']);
Route::post('/atualizarIndicador/{id}', [\App\Http\Controllers\IndicadorController::class, 'atualizarIndicador']);
Route::get('/excluirIndicador/{id}', [\App\Http\Controllers\IndicadorController::class, 'excluirIndicador']);
// ===============================
// RELATÓRIOS
// ===============================
Route::get('/relatorios', [\App\Http\Controllers\relatorioController::class, 'consultarRelatorio']);


// ===============================
// GESTÃO DE VÍNCULOS
// ===============================
Route::post('/vinculos/alunoTurma', [\App\Http\Controllers\vinculoController::class, 'alunoTurma']);
Route::post('/vinculos/cursoUc', [\App\Http\Controllers\vinculoController::class, 'cursoUc']);
Route::post('/vinculos/docenteCurso', [\App\Http\Controllers\vinculoController::class, 'docenteCurso']);
Route::post('/vinculos/docenteUc', [\App\Http\Controllers\vinculoController::class, 'docenteUc']);
Route::post('/vinculos/docenteTurma', [\App\Http\Controllers\vinculoController::class, 'docenteTurma']);

// web.php
Route::post('/logout', [\App\Http\Controllers\authController::class, 'logout'])->name('logout');

<?php

namespace App\Http\Controllers;

use App\Models\administradorModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function home()
    {
        return view('paginas.index');
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $senha = $request->input('senha');
        $tipo = $request->input('opcao');

        $usuario = administradorModel::where('email', $email)->first();

        if (!$usuario || $usuario->senha !== $senha) {
            return redirect('/')->with ('erro', 'Credenciais inválidas');
        }

        // Administrador
        if ($tipo == 1) {
            return redirect('/dashboardAdm');
        }

        // Docente
        if ($tipo == 2) {
            return redirect('/telaInicialDocente');
        }

        // Aluno
        if ($tipo == 3) {
            return redirect('/telaInicialAluno');
        }

        return redirect('/');

        /*if($usuario && $usuario->senha == $senha && $tipo == 1){
            return view('paginas.dashboardAdm');
        }else if($usuario && $usuario->senha == $senha && $tipo == 2) {
            return view('paginas.docentes');
        }else if($usuario && $usuario->senha == $senha && $tipo == 3) {
            return view('paginas.alunos');
        }else{
            return view('paginas.index');
        }*/

    } //fim da autenticação de login

    public function logout()
    {
        Session::flush(); // Limpa todas as variáveis de sessão
        return redirect()->route('login'); // Redireciona para a página inicial
    }
}

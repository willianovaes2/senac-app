<?php

namespace App\Http\Controllers;

use App\Models\administradorModel;
use App\Models\alunoModel;
use App\Models\docenteModel;
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

        // ADMIN
        if ($tipo == 1) {
            $usuario = administradorModel::where('email', $email)->first();

            if (!$usuario || $usuario->senha !== $senha) {
                return redirect('/')->with('erro', 'Email ou Senha inválidas');
            }

            Session::put('usuario', $usuario);
            Session::put('tipo', 1);

            return redirect('/dashboardAdm');
        }

        // ALUNO
        if ($tipo == 2) {
            $usuario = docenteModel::where('emailDocente', $email)->first();

            if (!$usuario || $usuario->senhaDocente !== $senha) {
                return redirect('/')->with('erro', 'Email ou Senha inválidas');
            }

            Session::put('usuario', $usuario);
            Session::put('tipo', 3);

            return redirect('/exibirDocente/' . $usuario->id);
        }

        // ALUNO
        if ($tipo == 3) {
            $usuario = alunoModel::where('emailAluno', $email)->first();

            if (!$usuario || $usuario->senhaAluno !== $senha) {
                return redirect('/')->with('erro', 'Email ou Senha inválidas');
            }

            Session::put('usuario', $usuario);
            Session::put('tipo', 3);

            return redirect('/exibirAluno/' . $usuario->id);
        }
        return redirect('/');
    } //fim da autenticação de login

    public function logout()
    {
        Session::flush(); // Limpa todas as variáveis de sessão
        return redirect('/'); // Redireciona para a página inicial
    }
}

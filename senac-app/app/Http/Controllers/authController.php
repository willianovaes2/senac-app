<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\administradorModel;
use App\Models\alunoModel;
use App\Models\docenteModel;

class AuthController extends Controller
{

    public function home(){
        return view('paginas.index');
    }
    
    public function login(Request $request)
    {
        $email = $request->input('emailLogin');
        $senha = $request->input('senhaLogin');
        $tipo = $request->input('opcao');

        // aluno
        if ($tipo == 'aluno') {
            $usuario = alunoModel::where('emailAluno', $email)->first();

            if (!$usuario || $usuario->senhaAluno !== $senha) {
                return redirect('/')->with('erro', 'Credenciais inválidas');
            }  
            Session::put('usuario', $usuario->id);
            Session::put('tipo', 'aluno');
            return redirect('/telaInicialAluno');
        }

        // Docente
        if ($tipo == 'docente') {
            $usuario = docenteModel::where('emailDocente', $email)->first();

            if (!$usuario || $usuario->senhaDocente !== $senha) {
                return redirect('/')->with('erro', 'Credenciais inválidas');
            }
            Session::put('usuario', $usuario->id);
            Session::put('tipo', 'docente');
            return redirect('/telaInicial');
        }

        // Aluno
        if ($tipo == 'administrador') {
            
            $usuario = administradorModel::where('email', $email)->first();

            if (!$usuario || $usuario->senha !== $senha) {
                return redirect('/')->with('erro', 'Credenciais inválidas');
            }
            Session::put('usuario', $usuario->id);
            Session::put('tipo', 'administrador');
            return redirect('/dashboardAdm');
        }
    }//fim da autenticação de login

    public function logout()
    {   
        Session::flush(); // Limpa todas as variáveis de sessão
        return redirect('/'); // Redireciona para a página inicial
    }
}
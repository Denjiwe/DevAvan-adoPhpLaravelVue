<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request) {

        $erro = '';

        if ($request->get('erro') == 1) {
            $erro = 'Usuário não existe';
        }

        if ($request->get('erro') == 2) {
            $erro = 'Autenticação necessária';
        }

        return view('site.login', ['titulo' => 'Login', 'erro' => $erro]);
    }

    public function autenticar(Request $request) {

        $regras = 
        [
            'usuario' => 'email',
            'senha' => 'required|min:8'
        ];

        $feedback = 
        [
            'usuario.email' => 'O campo usuário (email) deve ser válido',
            'senha.required' => 'O campo senha deve ser preenchido',
            'senha.min' => 'A senha deve ter pelo menos 8 caracteres',
        ];

        $request->validate($regras, $feedback);

        $email = $request->get('usuario');
        $senha = $request->get('senha');

        $user = new User;

        $usuario = $user->where('email', $email)
                    ->where('password', $senha)
                    ->get()
                    ->first();  

        if (isset($usuario->name)) {
            session_start();
            $_SESSION['nome'] = $usuario->name;
            $_SESSION['email'] = $usuario->email;

            return redirect()->route('app.home');
        } else {
            return redirect()->route('site.login', ['erro' => 1]);
        }
    }

    public function sair() {
        session_destroy();
        return redirect()->route('site.index');
    }
}

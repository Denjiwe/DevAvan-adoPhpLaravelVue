<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request) {
        $credenciais = $request->all(['email', 'password']);

        // faz autenticação retornando o token de autorização
        $token = auth('api')->attempt($credenciais);

        if($token) { // autenticado com sucesso
            return response()->json(['token' => $token]);
        } else { // erro de senha ou email
            return response()->json(['erro' => 'Usuário ou senha incorretos'], 403);

            // 401 = Unauthorized -> não tem autorização do acesso
            // 403 = Forbidden -> não tem autenticação
        }
    }

    public function logout() {
        auth('api')->logout();
        return reponse()->json(['msg' => 'Logout realizado com sucesso']);
    }

    public function refresh() {
        $token = auth('api')->refresh(); //cliente encaminhe um jwt válido
        return response()->json(['token' => $token]);
    }

    public function me() {
        return response()->json(auth()->user());
    }
}

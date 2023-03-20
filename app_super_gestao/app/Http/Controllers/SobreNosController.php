<?php

namespace App\Http\Controllers;

use App\Http\Middleware\LogAcessoMiddleware;
use Illuminate\Http\Request;

class SobreNosController extends Controller
{
    // middleware presente no kernel
    // public function __construct()
    // {
    //     $this->middleware(LogAcessoMiddleware::class);
    // }

    public function sobreNos() {
        return view('site.sobre-nos', ['titulo' => 'Sobre nós']);
    }
}

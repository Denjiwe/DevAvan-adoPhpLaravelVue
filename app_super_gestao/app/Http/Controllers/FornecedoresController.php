<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FornecedoresController extends Controller
{
    public function index() {
        $fornecedores = [
            0 => [
                'nome' => 'nf',
                'status' => 'N',
                'cnpj' => '00.000.000/000-00',
                'ddd' => '32',
                'telefone' => '0000-000'
            ],
            1 => [
                'nome' => 'f',
                'status' => 'S',
                'cnpj' => null,
                'ddd' => '11',
                'telefone' => '0000-000'
            ],
            2 => [
                'nome' => 'n',
                'status' => 'S',
                'cnpj' => null,
                'ddd' => '85',
                'telefone' => '0000-000'
            ]
        ];
        return view('app.fornecedores.index', compact('fornecedores'));
    }
}

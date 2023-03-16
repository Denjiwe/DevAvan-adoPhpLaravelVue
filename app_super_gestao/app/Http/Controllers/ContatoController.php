<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteContato;
use App\Models\MotivoContato;

class ContatoController extends Controller
{
    public function contato() {
        $motivo_contatos= MotivoContato::all();

        return view('site.contato', ['titulo' => 'Contato', 'motivo_contatos' => $motivo_contatos]);
    }

    public function salvar(Request $request){
        $regras = [
            'nome' => 'required|min:3|max:40',
            'telefone' => 'required|min:8|max:18|',
            'email' => 'email',
            'motivo_contatos_id' => 'required',
            'mensagem' => 'required|max:2000',
        ];
        $feedback = [
            'motivo_contatos_id.required' => 'O motivo do contato deve ser selecionado',
            'telefone.min' => 'O campo telefone deve possuir no mínimo 8 caracteres',
            'telefone.max' => 'O campo telefone deve possuir no máximo 18 caracteres',
            'nome.min' => 'O campo nome deve possuir no mínimo 3 caracteres',
            'nome.max' => 'O campo nome deve possuir no maximo 40 caracteres',    
            'mensagem.max' => 'O campo mensagem deve possuir no máximo 2000 caracteres',
            
            'required' => 'O campo :attribute deve ser preenchido',
            'email' => 'O email inserido precisa ser válido'
        ];

        // validar os campos
        $request->validate($regras, $feedback);

        // $contato = new SiteContato();
        // $contato->nome = $request->input('nome');
        // $contato->telefone = $request->input('telefone');
        // $contato->email = $request->input('email');
        // $contato->motivo_contato = $request->input('motivo_contato');
        // $contato->mensagem = $request->input('mensagem');
        // $contato->save();

        // $contato->fill($request->all());
        
        SiteContato::create($request->all()); // Inserção rápida e simples!
        return redirect()->route('site.index');
    }
}

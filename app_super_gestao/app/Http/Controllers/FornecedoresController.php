<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;

class FornecedoresController extends Controller
{
    public function index() {
        return view('app.fornecedor.index');
    }

    public function listar(Request $request) {

        $fornecedores = Fornecedor::with(['produtos'])->where('nome', 'like', '%'.$request->input('nome').'%')
            ->where('site', 'like', '%'.$request->input('site').'%')
            ->where('uf', 'like', '%'.$request->input('uf').'%')
            ->where('email', 'like', '%'.$request->input('email').'%')
            ->paginate(5);

        return view('app.fornecedor.listar', ['fornecedores' => $fornecedores, 'request' => $request->all()]);
    }

    public function adicionar(Request $request) {

        $msg = '';

        function validar($request) {
            // validação
            $regras = 
            [
                'nome' => 'required|min:3|max:40',
                'site' => 'required',
                'uf' => 'required|min:2|max:2',
                'email' => 'email',
            ];

            $feedback = 
            [
                'required' => 'O campo :attribute deve ser preenchido',
                'nome.min' => 'O campo :attribute deve ter no mínimo 3 caracteres',
                'nome.max' => 'O campo :attribute deve ter no máximo 40 caracteres',
                'uf.min' => 'O campo :attribute deve ter no mínimo 2 caracteres',
                'uf.max' => 'O campo :attribute deve ter no máximo 2 caracteres',
                'email' => 'O email preenchido deve ser válido'
            ];

            $request->validate($regras, $feedback);
        }

        // cadastro
        if ($request->input('_token') != '' && $request->input('id') == '') {
            validar($request);

            // cadastro
            $fornecedor = new Fornecedor();

            $fornecedor->create($request->all());

            $msg = 'Registro criado com sucesso';
        }

        // edição
        if ($request->input('_token') != '' && $request->input('id') != '') {
            $fornecedor = Fornecedor::find($request->input('id'));
            $update = $fornecedor->update($request->all());

            validar($request);

            if ($update) {
                $msg = 'Registro atualizado com sucesso';
            } else {
                $msg = 'Erro ao atualizar o registro';
            }

            return redirect()->route('app.fornecedor.editar', ['id' => $request->input('id') ,'msg' => $msg]);
        }

        return view('app.fornecedor.adicionar', ['msg' => $msg]);
    }

    public function editar($id, $msg = '') {
        
        $fornecedor = Fornecedor::find($id);

        return view('app.fornecedor.adicionar', ['fornecedor' => $fornecedor, 'msg' => $msg]);
    }

    public function excluir($id){
        
        Fornecedor::find($id)->delete();

        $msg = 'Registro excluído com sucesso';

        return redirect()->route('app.fornecedor.index', ['msg' => $msg]);
    }
}

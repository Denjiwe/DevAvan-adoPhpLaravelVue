<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\PedidoProduto;
use App\Models\Produto;

class PedidoProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Pedido $pedido)
    {
        $produtos = Produto::all();
        $pedido->produtos;
        return view('app.pedido_produto.create', ['pedido' => $pedido, 'produtos' => $produtos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Pedido $pedido)
    {
        $regras = 
        [
            'produto_id' => 'exists:produtos,id',
            'qntde' => 'required'
        ];

        $feedback = 
        [
            'exists' => 'O produto selecionado não existe',
            'required' => 'O campo :attribute é obrigatório'
        ];

        $request->validate($regras, $feedback);

        /*
        $pedidoProduto = new PedidoProduto;
        $pedidoProduto->pedido_id = $pedido->id;
        $pedidoProduto->produto_id = $request->get('produto_id');
        $pedidoProduto->qntde = $request->get('qntde');
        $pedidoProduto->save();
        */

        /*
        $pedido->produtos; //os registro do relacionamento
        $pedido->produtos()->attach(
            $request->get('produto_id'),
            [
                'qntde' => $request->get('qntde'), //podem ser inseridas quantas colunas necessárias da tabela do relacionamento
                // coluna2,
                // coluna3
            ]
        ); //objeto
        */
        
        $pedido->produtos()->attach(
            [
                $request->get('produto_id') => 
                [
                    'qntde' => $request->get('qntde')
                ],
                // $request->get('produto_id') => 
                // [
                //     'qntde' => $request->get('qntde')
                // ], 
                // Quantos objetos forem necessários, provavelmente por um foreach, perfeito para o tcc, cadastrando vários produtos a um pedido de uma vez
            ]
        );

        return redirect()->route('pedido-produto.create', ['pedido' => $pedido->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Pedido $pedido, Produto $produto)
    public function destroy(PedidoProduto $pedidoProduto, $pedido_id)
    {
        // convencional
        // PedidoProduto::where([
        //     'pedido_id' => $pedido->id,
        //     'produto_id' => $produto->id
        // ])->delete();

        // detach (delete pelo relacionamento)
        // $pedido->produtos()->detach($produto->id);
        // pedido_id já é reconhecido pelo laravel por conta do próprio objeto pedido estar fazendo a chamada
        // $produto->pedidos()->detach($pedido->id); também iria remover o relacionamento

        $pedidoProduto->delete();

        return redirect()->route('pedido-produto.create', ['pedido' => $pedido_id]);
    }
}



<?php

namespace App\Http\Controllers;

use App\Models\Locacao;
use Illuminate\Http\Request;
use App\Repositories\LocacaoRepository;

class LocacaoController extends Controller
{
    public function __construct(Locacao $locacao)
    {
        $this->locacao = $locacao;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $locacaoRepository = new LocacaoRepository($this->locacao);

        if($request->has('atributos_carro')) {
            $atributos_carro = 'carro:id,'.$request->atributos_carro;

            $locacaoRepository->selectAtributosRegistrosRelacionados($atributos_carro);
        } else {
            $locacaoRepository->selectAtributosRegistrosRelacionados('carro');
        }

        if($request->has('atributos_cliente')) {
            $atributos_cliente = 'cliente:id,'.$request->atributos_cliente;

            $locacaoRepository->selectAtributosRegistrosRelacionados($atributos_cliente);
        } else {
            $locacaoRepository->selectAtributosRegistrosRelacionados('cliente');
        }


        if($request->has('filtro')) {
            $locacaoRepository->filtro($request->filtro);
        }

        if($request->has('atributos')) {
            $locacaoRepository->selectAtributos($request->atributos);
        }
        
        return response()->json($locacaoRepository->getResultado(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->locacao->rules());

        $locacao = $this->locacao->create($request->all());
        return response()->json($locacao, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Locacao  $locacao
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $locacao = $this->locacao->with('carro')->with('cliente')->find($id);

        if($locacao === null) {
            return response()->json(['erro'=>'Não foi possível exibir o registro pois o mesmo não foi encontrado'], 404);
        }

        return response()->json($locacao, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Locacao  $locacao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $locacao = $this->locacao->with('carro')->with('cliente')->find($id);

        if($locacao === null) {
            return response()->json(['erro'=>'Não foi possível fazer a atualização pois o registro não foi encontrado'], 404);
        }

        if($request->method() == 'PATCH') {
            $regrasDinamicas = array();

            // percorrendo todas as regras definidas na model
            foreach ($locacao->rules() as $input => $regras) {

                // coletando apenas as regras encontradas na requisição
                if(array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regras;
                }

            }

            $request->validate($regrasDinamicas);
        } else {

            $request->validate($locacao->rules());
        }

        $locacao->update([
            'nome' => $request->nome,
        ]);
        
        return response()->json($locacao, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Locacao  $locacao
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $locacao = $this->locacao->find($id);

        if($locacao === null) {
            return response()->json(['erro'=>'Não foi possível fazer a exclusão pois o registro não foi encontrado'], 404);
        }

        $locacao->delete();
        return response()->json(['msg' => 'Registro excluído!'], 200);
    }
}
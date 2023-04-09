<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use Illuminate\Http\Request;
use App\Repositories\CarroRepository;

class CarroController extends Controller
{
    public function __construct(Carro $carro)
    {
        $this->carro = $carro;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $carroRepository = new CarroRepository($this->carro);

        if($request->has('atributos_locacoes')) {
            $atributos_locacoes = 'locacoes:id,'.$request->atributos_locacoes;

            $carroRepository->selectAtributosRegistrosRelacionados($atributos_locacoes);
        } else {
            $carroRepository->selectAtributosRegistrosRelacionados('locacoes');
        }

        if($request->has('atributos_modelo')) {
            $atributos_modelo = 'modelo:id,'.$request->atributos_modelo;

            $carroRepository->selectAtributosRegistrosRelacionados($atributos_modelo);
        } else {
            $carroRepository->selectAtributosRegistrosRelacionados('modelo');
        }


        if($request->has('filtro')) {
            $carroRepository->filtro($request->filtro);
        }

        if($request->has('atributos')) {
            $carroRepository->selectAtributos($request->atributos);
        }
        
        return response()->json($carroRepository->getResultado(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCarrpRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->carro->rules());

        $carro = $this->carro->create($request->all());
        return response()->json($carro, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carrp  $carrp
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carro = $this->carro->with('locacoes')->with('modelo')->find($id);

        if($carro === null) {
            return response()->json(['erro'=>'Não foi possível exibir o registro pois o mesmo não foi encontrado'], 404);
        }

        return response()->json($carro, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCarrpRequest  $request
     * @param  \App\Models\Carrp  $carrp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $carro = $this->carro->with('locacoes')->with('modelo')->find($id);

        if($carro === null) {
            return response()->json(['erro'=>'Não foi possível fazer a atualização pois o registro não foi encontrado'], 404);
        }

        if($request->method() == 'PATCH') {
            $regrasDinamicas = array();

            // percorrendo todas as regras definidas na model
            foreach ($carro->rules() as $input => $regras) {

                // coletando apenas as regras encontradas na requisição
                if(array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regras;
                }

            }

            $request->validate($regrasDinamicas);
        } else {

            $request->validate($carro->rules());
        }

        $carro->update([
            'nome' => $request->nome,
        ]);
        
        return response()->json($carro, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carrp  $carrp
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carro = $this->carro->find($id);

        if($carro === null) {
            return response()->json(['erro'=>'Não foi possível fazer a exclusão pois o registro não foi encontrado'], 404);
        }

        $carro->delete();
        return response()->json(['msg' => 'Registro excluído!'], 200);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    private Marca $marca;

    public function __construct(Marca $marca)
    {
        $this->marca = $marca;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$marcas = Marca::all();
        $marcas = $this->marca->all();
        return response()->json($marcas, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$marca = Marca::create($request->all());

        $request->validate($this->marca->rules(), $this->marca->feedback());

        $marca = $this->marca->create($request->all());
        return response()->json($marca, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  integer id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $marca = $this->marca->find($id);

        if($marca === null) {
            return response()->json(['erro'=>'Não foi possível exibir o registro pois o mesmo não foi encontrado'], 404);
        }

        return response()->json($marca, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $marca->update($request->all());

        $marca = $this->marca->find($id);

        if($marca === null) {
            return response()->json(['erro'=>'Não foi possível fazer a atualização pois o registro não foi encontrado'], 404);
        }

        $request->validate($marca->rules(), $marca->feedback());

        $marca->update($request->all());
        return response()->json($marca, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $marca->delete();

        // $this->marca->find($id)->delete();
        $marca = $this->marca->find($id);

        if($marca === null) {
            return response()->json(['erro'=>'Não foi possível fazer a exclusão pois o registro não foi encontrado'], 404);
        }

        $marca->delete();
        return response()->json(['msg' => 'Registro excluído!'], 200);
    }
}

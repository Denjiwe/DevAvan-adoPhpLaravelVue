<?php

namespace App\Http\Controllers;

use App\Models\Carrp;
use App\Http\Requests\StoreCarrpRequest;
use App\Http\Requests\UpdateCarrpRequest;

class CarroController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCarrpRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarrpRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carrp  $carrp
     * @return \Illuminate\Http\Response
     */
    public function show(Carrp $carrp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carrp  $carrp
     * @return \Illuminate\Http\Response
     */
    public function edit(Carrp $carrp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCarrpRequest  $request
     * @param  \App\Models\Carrp  $carrp
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarrpRequest $request, Carrp $carrp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carrp  $carrp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carrp $carrp)
    {
        //
    }
}

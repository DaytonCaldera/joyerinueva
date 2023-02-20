<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientesRequest;
use App\Http\Requests\UpdateClientesRequest;
use App\Models\Clientes;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('paginas.clientes.admin')->with(['clientes'=>Clientes::all()]);
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
     * @param  \App\Http\Requests\StoreClientesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientesRequest $request)
    {
        $cliente = new Clientes();
        $cliente->cedula = $request->cedula;
        $cliente->nombre = $request->nombre;
        $cliente->apellido1 = $request->apellido1;
        $cliente->apellido2 = $request->apellido2;
        $cliente->direccion = $request->direccion;
        $cliente->telefono = $request->telefono;
        $cliente->problemas = false;
        if($cliente->save()){
            return redirect()->route('clientes')->with(['success' => 'Cliente agregado correctamente']);
        }else{
            return redirect()->route('clientes')->with(['error' => 'Hubo un error al guardar']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function show(Clientes $clientes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function edit(Clientes $clientes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClientesRequest  $request
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientesRequest $request, Clientes $clientes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clientes $clientes)
    {
        //
    }
}

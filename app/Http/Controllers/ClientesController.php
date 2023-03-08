<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientesRequest;
use App\Http\Requests\UpdateClientesRequest;
use Illuminate\Support\Facades\Request;
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
        return view('paginas.clientes.admin')->with(['clientes' => Clientes::all()]);
    }

    public function get_select2_items()
    {
        $search = Request::input('search');
        $clientes = Clientes::where('cedula', 'LIKE', $search . '%')->orWhere('nombre', 'LIKE', $search . '%')->orWhere('apellido1', 'LIKE', $search . '%')->orWhere('apellido2', 'LIKE', $search . '%')->get();
        $json = [];
        foreach ($clientes as $cliente) {
            $json['results'][] = [
                'id' => $cliente->id,
                'text' => $cliente->cedula . ' - ' . $cliente->nombre . ' ' . $cliente->apellido1 . ' ' . $cliente->apellido2,
                'nombre' => $cliente->nombre,
                'apellido1' => $cliente->apellido1,
                'apellido2' => $cliente->apellido2,
            ];
        }
        $json['pagination']['more'] = false;
        return response()->json($json);
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
        if ($cliente->save()) {
            return redirect()->route('clientes')->with(['success' => 'Cliente agregado correctamente']);
        } else {
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

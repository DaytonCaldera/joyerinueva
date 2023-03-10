<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContratosRequest;
use App\Http\Requests\UpdateContratosRequest;
use App\Models\Articulo;
use App\Models\Clientes;
use App\Models\Contratos;
use App\Models\Inventario;
use Illuminate\Support\Facades\Request;

class ContratosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('paginas.contratos.admin')->with(['articulos' => Articulo::all(), 'clientes' => Clientes::all()]);
    }

    public function history($id)
    {
        return response()->json(Contratos::select('*')->whereRaw('cedula = ' . $id)->get());
    }

    public function find_contract()
    {
        $search = Request::input('contrato');
        $contrato = Contratos::find($search);
        $inventario = Inventario::where('id_contrato', '=', $contrato->id)->get();
        return response()->json([
            'contrato' => $contrato,
            'inventario' => $inventario,
        ]);
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
     * @param  \App\Http\Requests\StoreContratosRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContratosRequest $request)
    {
        $contrato = new Contratos();
        $json = json_decode($request->contrato);
        // dd($request->contrato);
        $cliente = Clientes::find($json->cliente);
        $contrato->fecha_contrato = $json->fecha_contrato;
        $contrato->fecha_vencimiento = $json->fecha_vencimiento;
        $contrato->fecha_interes = $json->fecha_vencimiento;
        $contrato->cedula = $cliente->cedula;
        $contrato->prestamo = $json->total;
        $contrato->cancelado = false;
        $contrato->vencido = false;
        $contrato->anulado = false;
        $contrato->descripcion = $json->descripcion;
        if ($contrato->save()) {
            $insert_inventario = [];
            foreach ($json->inventario as $invent) {
                $insert_inventario[] = [
                    'id_contrato' => $contrato->id,
                    'articulo' => $invent->id_articulo,
                    'cantidad' => $invent->prestamo
                ];
            }
            Inventario::insert($insert_inventario);
            return response()->json(['id_contrato' => $contrato->id]);
        }
        return false;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contratos  $contratos
     * @return \Illuminate\Http\Response
     */
    public function show(Contratos $contratos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contratos  $contratos
     * @return \Illuminate\Http\Response
     */
    public function edit(Contratos $contratos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContratosRequest  $request
     * @param  \App\Models\Contratos  $contratos
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContratosRequest $request, Contratos $contratos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contratos  $contratos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contratos $contratos)
    {
        //
    }
}

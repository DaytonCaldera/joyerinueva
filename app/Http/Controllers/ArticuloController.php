<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticuloRequest;
use App\Http\Requests\UpdateArticuloRequest;
use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\Familia;
use Illuminate\Http\Request;

class ArticuloController extends Controller
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

    public function admin_view()
    {
        $familias = Familia::all();
        $categorias = Categoria::all();
        $articulos = Articulo::all();
        return view('paginas.articulos.admin')->with(['familias' => $familias, 'categorias' => $categorias, 'articulos' => $articulos]);
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
     * @param  \App\Http\Requests\StoreArticuloRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticuloRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function show(Articulo $articulo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function edit(Articulo $articulo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateArticuloRequest  $request
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticuloRequest $request, Articulo $articulo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Articulo $articulo)
    {
        //
    }

    public function add_familia(Request $request)
    {
        $familia = new Familia();
        $familia->descripcion = $request->descripcion;
        if($familia->save()){
            return redirect()->route('articulos')->with(['success' => 'Familia agregada correctamente']);
        }else{
            return redirect()->route('articulos')->with(['error' => 'Hubo un error al guardar']);
        }
    }

    public function add_categoria(Request $request)
    {
        $categoria = new Categoria();
        $categoria->familia = $request->familia;
        $categoria->descripcion = $request->descripcion;
        if($categoria->save()){
            return redirect()->route('articulos')->with(['success' => 'Categoria agregada correctamente']);
        }else{
            return redirect()->route('articulos')->with(['error' => 'Hubo un error al guardar']);
        }
    }

    public function add_articulo(Request $request)
    {
        $articulo = new Articulo();
        $split = explode('-',$request->categoria);
        $articulo->familia = $split[0];
        $articulo->categoria = $split[1];
        $articulo->descripcion = $request->descripcion;
        if($articulo->save()){
            return redirect()->route('articulos')->with(['success' => 'Articulo agregado correctamente']);
        }else{
            return redirect()->route('articulos')->with(['error' => 'Hubo un error al guardar']);
        }
    }
}

@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Inicio'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header mx-4 p-3">
                        Contratos
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input class="form-control" type="text"
                                    placeholder="Ingrese un numero de contrato para buscar" onfocus="focused(this)"
                                    onfocusout="defocused(this)">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <button class="btn btn-warning form-control" id="btn_buscar">
                                    <span class="spinner-border spinner-border-sm loading" role="status"
                                        aria-hidden="true"></span>
                                    <span class="">Buscar contrato</span>
                                </button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-success form-control" id="btn_nuevo">
                                    <span class="">Nuevo contrato</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header mx-4 p-3">Buscar contratos de cliente</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input class="form-control" type="text" placeholder="Ingrese la cedula del cliente"
                                    onfocus="focused(this)" id="client_id" onfocusout="defocused(this)">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <button class="btn btn-info form-control" id="client_history_btn">
                                    <span class="spinner-border spinner-border-sm loading" role="status" aria-hidden="true"
                                        hidden></span>
                                    <span class="">Buscar historial</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card" id="nuevo_contrato" style="display: none">
                    <div class="card-header" id="contrato_title">
                        <div class="d-flex">
                            <p>Nuevo contrato</p>
                            <div class="ms-auto">
                                <button class="btn btn-sm btn-danger">Cancelar contrato</button>
                            </div>
                        </div>
                        {{-- <span class="title">Nuevo contrato</span>
                        <button class="btn btn-sm btn-danger">Cancelar contrato</button> --}}
                    </div> 
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <select name="articulos" class="form-control input-lg" id="articulos">
                                    <option value="-1">Seleccione para añadir articulo</option>
                                    @foreach ($articulos as $articulo)
                                        <option value="{{ $articulo->id }}">{{ $articulo->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <input type="number" class="form-control form-control-sm" placeholder="Prestamo"
                                    id="prestamo">
                            </div>
                            <div class="col-lg-4">
                                <button class="btn btn-xs btn-danger" id="add_item">
                                    Agregar articulo
                                </button>
                            </div>
                        </div>
                        <div id="newjsGrid"></div>
                    </div>
                </div>
                <div class="card" id="buscar_contrato" style="display: none">
                    <div class="card-header" id="contrato_title">Ver contrato</div>
                    <div class="card-body">
                        <div id="whatchjsGrid"></div>
                    </div>
                </div>
                <div class="card" id="historial_cliente" style="display: none">
                    <div class="card-header">Historial de un cliente</div>
                    <div class="card-body">
                        <div id="historialJsGrid">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection

@push('css')
    {{-- <link rel="stylesheet" href="{{ asset('/public/assets/css/jsgrid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/public/assets/css/jsgrid-theme.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('/public/assets/css/jquery-ui.css') }}">
@endpush
@push('js')
    <script src="{{ asset('/public/assets/js/paginas/Contratos.js') }}"></script>
@endpush

@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Inicio'])
    <div class="container-fluid py-4">
        <div class="row" id="main_row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header mx-4 p-3">
                        Contratos
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input class="form-control" type="text" id="num_contrato"
                                    placeholder="Ingrese un numero de contrato para buscar" onfocus="focused(this)"
                                    onfocusout="defocused(this)">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <button class="btn btn-warning form-control" id="btn_buscar">
                                    <span class="spinner-border spinner-border-sm loading" role="status" aria-hidden="true"
                                        hidden></span>
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
                                    onfocus="focused(this)" id="client_id_history" onfocusout="defocused(this)">
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
        <div class="row">
            <div class="col-lg-12">
                <div class="card" id="nuevo_contrato" style="display: none">
                    <div class="card-header" id="contrato_title">
                        <div class="d-flex">
                            <p>
                            <h4>Nuevo contrato</h4>
                            </p>
                            <div class="ms-auto">
                                <button class="btn btn-sm btn-danger" id="btn_cancelar_nuevo_contrato">Cancelar
                                    contrato</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- <div class="row">
                            <div class="col-lg-3">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#buscar_cliente_avanzado" id="btn_open_search_modal">
                                    Busqueda cliente avanzado
                                </button>
                            </div>
                        </div> --}}
                        <div class="row mt-2">
                            <div class="col-lg-6">
                                <label for="clientes_search">Cliente</label>
                                <select name="clientes_search" class="form-control" id="clientes_search">
                                    <option value="-1" data-notselectable="true">Buscar cedula o nombre de cliente</option>
                                    {{-- @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}" data-name="{{ $cliente->nombre }}"
                                            data-ape1="{{ $cliente->apellido1 }}" data-ape2="{{ $cliente->apellido2 }}">
                                            {{ $cliente->cedula }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                            {{-- <div class="col-lg-3">
                                <input type="text" disabled id="cl_name" class="form-control">
                            </div>
                            <div class="col-lg-3">
                                <input type="text" disabled id="cl_ape1" class="form-control">
                            </div>
                            <div class="col-lg-3">
                                <input type="text" disabled id="cl_ape2" class="form-control">
                            </div> --}}
                        </div>
                        <hr>
                        <div class="row mt-4">
                            <div class="col-lg-3">
                                <select name="articulos" class="form-control input-lg" id="articulos">
                                    <option value="-1" data-notselectable="true">Seleccione para añadir articulo
                                    </option>
                                    @foreach ($articulos as $articulo)
                                        <option value="{{ $articulo->id }}">{{ $articulo->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <input type="number" class="form-control form-control-sm" placeholder="Prestamo"
                                    value="0" id="prestamo">
                            </div>
                            <div class="col-lg-3">
                                <button class="btn btn-xs btn-info" id="add_item">
                                    Agregar articulo
                                </button>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <div id="newjsGrid" style="font-size: 0.8rem"></div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-6">
                                <label for="descripcion_contrato">Descripcion</label>
                                <textarea class="form-control" name="descripcion_contrato" id="descripcion_contrato" rows="5" style="resize: none;font-size: 12px;"></textarea>
                            </div>
                            <div class="col-lg-6">
                                <label for="descripcion_final">Descripcion final en el recibo</label>
                                <textarea class="form-control" name="descripcion_final" id="descripcion_final" rows="5" style="resize: none;font-size: 12px;" disabled></textarea>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-3">
                                <label for="total_prestamo">Total del prestamo</label>
                                <input type="number" class="form-control" name="total_prestamo" id="total_prestamo"
                                    placeholder="Total del prestamo">
                            </div>
                            <div class="col-lg-3">
                                <label for="fecha_prestamo">Fecha de contrato</label>
                                <input type="date" class="form-control" name="fecha_contrato" id="fecha_contrato"
                                    placeholder="Total del prestamo" value="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-lg-3">
                                <label for="fecha_prestamo">Fecha de vencimiento</label>
                                <input type="date" class="form-control" name="fecha_vencimiento"
                                    id="fecha_vencimiento" placeholder="Total del prestamo"
                                    value="{{ (new DateTime(date('Y-m-d')))->modify('+1 month')->format('Y-m-d') }}">
                            </div>
                            {{-- <div class="col-lg-4">
                                <input type="number" class="form-control" name="total" id="total_prestamo" placeholder="Total del prestamo">
                            </div> --}}
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-3">
                                <button class="btn btn-success form-control" id="btn_save_contract">
                                    <span class="spinner-border spinner-border-sm loading" role="status"
                                        aria-hidden="true" hidden></span>
                                    <span class="btn_save_title">Guardar contrato</span>
                                </button>
                            </div>
                            <div class="col-lg-3">
                                <button class="btn btn-warning form-control"
                                    id="btn_print_contract_receipt">Imprimir</button>
                            </div>
                            <div class="col-lg-4">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" id="buscar_contrato" style="display: none">
                    <div class="card-header" id="contrato_title">Ver contrato</div>
                    <div class="card-body">
                        <div id="whatchjsGrid"></div>
                    </div>
                </div>
                <div class="card" id="historial_cliente" style="display: none">
                    <div class="card-header">
                        <div class="d-flex">
                            <p>
                            <h4>Historial de un cliente</h4>
                            </p>
                            <div class="ms-auto">
                                <button class="btn btn-sm btn-danger" id="btn_history_return">Regresar</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="historialJsGrid">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
        {{-- @include('paginas.contratos.buscar_modal', ['clientes' => $clientes]) --}}
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

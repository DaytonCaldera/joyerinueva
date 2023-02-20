@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Inicio'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header mx-4 p-3 text-center">
                        Agregar cliente
                    </div>
                    <div class="card-body pt-0 p-3">
                        <form action="{{ route('agregar.cliente') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-lg-3">
                                    <label for="cedula">Cedula</label>
                                    <input type="text" class="form-control" id="cedula" required
                                        oninvalid="this.setCustomValidity('Favor, llenar este campo')"
                                        oninput="setCustomValidity('')" placeholder="Cedula" name="cedula">
                                </div>
                                <div class="mb-3 col-lg-3">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" required
                                        oninvalid="this.setCustomValidity('Favor, llenar este campo')"
                                        oninput="setCustomValidity('')" placeholder="Nombre" name="nombre">
                                </div>
                                <div class="mb-3 col-lg-3">
                                    <label for="apellido1">Apellido 1</label>
                                    <input type="text" class="form-control" id="apellido1" required
                                        oninvalid="this.setCustomValidity('Favor, llenar este campo')"
                                        oninput="setCustomValidity('')" placeholder="Apellido 1" name="apellido1">
                                </div>
                                <div class="mb-3 col-lg-3">
                                    <label for="apellido2">Apellido 2</label>
                                    <input type="text" class="form-control" id="apellido2" required
                                        oninvalid="this.setCustomValidity('Favor, llenar este campo')"
                                        oninput="setCustomValidity('')" placeholder="Apellido 2" name="apellido2">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="direccion">Direccion</label>
                                    <input type="text" class="form-control" id="direccion" required
                                        oninvalid="this.setCustomValidity('Favor, llenar este campo')"
                                        oninput="setCustomValidity('')" placeholder="Escriba una direccion"
                                        name="direccion">
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="telefono">Telefono</label>
                                    <input type="text" class="form-control" id="telefono" required
                                        oninvalid="this.setCustomValidity('Favor, llenar este campo')"
                                        oninput="setCustomValidity('')" placeholder="Escriba un numero de telefono"
                                        name="telefono">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <button type="submit" class="form-control btn btn-success">Agregar cliente</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        <table class="table" id="table">
                            <thead>
                                <tr class="text-xs text-uppercase">
                                    <th class="">Cedula</th>
                                    <th class="">Nombre</th>
                                    <th class="">Apellido 1</th>
                                    <th class="">Apellido 2</th>
                                    <th class="">Direccion</th>
                                    <th class="">Telefono</th>
                                    <th class="">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clientes as $cliente)
                                    <tr class="text-sm">
                                        <td>{{ $cliente->cedula }}</td>
                                        <td>{{ $cliente->nombre }}</td>
                                        <td>{{ $cliente->apellido1 }}</td>
                                        <td>{{ $cliente->apellido2 }}</td>
                                        <td>{{ $cliente->direccion }}</td>
                                        <td>{{ $cliente->telefono }}</td>
                                        <td>
                                            <button class="btn-xs btn btn-warning">Editar</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('/public/assets/css/jquery.dataTables.min.css') }}">
@endpush

@push('js')
    @if (session('success'))
        <script>
            let alert =
                '<div class="toast alert alert-success alert-dismissible text-white" id="successToast" role="alert" aria-live="assertive" id="successToast" aria-atomic="true" style="position:absolute;bottom:20px;right:20px"> {{ session('success') }} </div>';
            var div = document.createElement('div');
            div.innerHTML = alert.trim();
            document.querySelector('body').append(div);
            let toastHTMLElement = document.getElementById('successToast');
            let toastElement = new bootstrap.Toast(toastHTMLElement, {
                animation: true,
                delay: 2000
            });
            toastElement.show();
        </script>
    @endif
    <script src="{{ asset('/public/assets/js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('/public/assets/js/core/jquery.dataTables.min.js') }}"></script>
    <script>
        $("#table").DataTable({
            ordering: false,
        });
    </script>
@endpush

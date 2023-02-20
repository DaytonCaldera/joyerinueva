@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Articulos'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header mx-4 p-3 text-center">
                        Agregar articulo
                    </div>
                    <div class="card-body pt-0 p-3 text-center">
                        <form action="{{ route('agregar.articulo') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="mb-3">
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" required
                                        name="categoria">
                                        <option selected>Escoger categoria</option>
                                        @php
                                            foreach ($categorias as $categoria) {
                                                echo '<option value="' . $categoria->familia . '-' . $categoria->id . '">' . $categoria->descripcion . '</option>';
                                            }
                                        @endphp
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="nuevo_articulo" required
                                        oninvalid="this.setCustomValidity('Favor, llenar este campo')"
                                        oninput="setCustomValidity('')" placeholder="Nombre articulo" name="descripcion">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-danger">Agregar articulo</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card" id="add-category">
                    <div class="card-header mx-4 p-3 text-center">
                        Agregar categoria
                    </div>
                    <div class="card-body pt-0 p-3 text-center">
                        <form action="{{ route('agregar.categoria') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="mb-3">
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" required
                                        name="familia">
                                        <option selected>Escoger familia</option>
                                        @php
                                            foreach ($familias as $familia) {
                                                echo '<option value="' . $familia->id . '">' . $familia->descripcion . '</option>';
                                            }
                                        @endphp
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="nueva_categoria" required
                                        oninvalid="this.setCustomValidity('Favor, llenar este campo')"
                                        oninput="setCustomValidity('')" placeholder="Nombre categoria" name="descripcion">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-success">Agregar categoria</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header mx-4 p-3 text-center">
                        Agregar familia
                    </div>
                    <div class="card-body pt-0 p-3 text-center">
                        <form action="{{ route('agregar.familia') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="nueva_familia" name="descripcion"
                                        oninvalid="this.setCustomValidity('Favor, llenar este campo')"
                                        oninput="setCustomValidity('')" required placeholder="Nombre familia">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary">Agregar familia</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header mx-4 p-3 text-center">
                        Articulos
                    </div>
                    <div class="card-body pt-0 p-3 text-center">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Descripcion</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Categoria</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Familia</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    {{-- {{dd($categorias)}} --}}
                                    @foreach ($articulos as $articulo)
                                        <tr>
                                            <td>{{ $articulo->descripcion }}</td>
                                            <td class="align-middle text-xs">
                                                {{ $categorias->find($articulo->categoria)->descripcion }}</td>
                                            <td class="align-middle text-xs">
                                                {{ $familias->find($articulo->familia)->descripcion }}</td>
                                            <td class="align-middle">
                                                <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                                    data-toggle="tooltip" data-original-title="Edit user">
                                                    Editar
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footers.auth.footer')
        </div>
    </div>
    @endsection
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
    @endpush

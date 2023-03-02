<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main" data-color="info">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('home') }}" target="_blank">
            <img src="/public/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">Argon Dashboard 2 Laravel</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}"
                    href="{{ route('home') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Inicio</span>
                </a>
            </li>
            {{-- <li class="nav-item mt-3 d-flex align-items-center">
                <div class="ps-4">
                    <i class="fab fa-laravel" style="color: #f4645f;"></i>
                </div>
                <h6 class="ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">Procesos</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'contratos' ? 'active' : '' }}"
                    href="{{ route('contratos') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-copy-04 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Contratos</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'renovaciones' ? 'active' : '' }}"
                    href="{{ route('renovaciones') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-book-bookmark text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Renovaciones</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'clientes' ? 'active' : '' }}"
                    href="{{ route('clientes') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Clientes</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'usuarios' ? 'active' : '' }}"
                    href="{{ route('usuarios') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-circle-08 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Usuarios</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'articulos' ? 'active' : '' }}"
                    href="{{ route('articulos') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-bullet-list-67 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Articulos</span>
                </a>
            </li> --}}
            @php
                $activeLinkProcesos = in_array(Route::currentRouteName(), ['contratos', 'renovaciones', 'articulos', 'clientes', 'usuarios']) ? 'active' : '';
                $activeLinkAdmin = in_array(Route::currentRouteName(), ['parametros']) ? 'active' : '';
            @endphp
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#procesos"
                    class="nav-link collapsed {{ $activeLinkProcesos ? 'active' : '' }}" aria-controls="procesos"
                    role="button" aria-expanded="{{ $activeLinkProcesos ? 'true' : 'false' }}">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-ungroup text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Procesos</span>
                </a>
                <div class="collapse {{ $activeLinkProcesos ? 'show' : '' }}" id="procesos" style="">
                    <ul class="nav ms-4">
                        <li class="nav-item ">
                            <a class="nav-link {{ Route::currentRouteName() == 'contratos' ? 'active' : '' }}"
                                href="{{ route('contratos') }}">
                                <span class="sidenav-mini-icon"> <i
                                        class="ni ni-single-copy-04 text-dark text-sm opacity-10"></i> </span>
                                <i class="ni ni-single-copy-04 text-dark text-sm opacity-10"></i>
                                <span class="sidenav-normal"> Contratos</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link {{ Route::currentRouteName() == 'renovaciones' ? 'active' : '' }}"
                                href="{{ route('renovaciones') }}">
                                <span class="sidenav-mini-icon"> <i
                                        class="ni ni-book-bookmark text-dark text-sm opacity-10"></i> </span>
                                <i class="ni ni-book-bookmark text-dark text-sm opacity-10"></i>
                                <span class="sidenav-normal"> Renovaciones </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link {{ Route::currentRouteName() == 'clientes' ? 'active' : '' }}"
                                href="{{ route('clientes') }}">
                                <span class="sidenav-mini-icon"> <i
                                        class="ni ni-single-02 text-dark text-sm opacity-10"></i> </span>
                                <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                                <span class="sidenav-normal"> Clientes </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link {{ Route::currentRouteName() == 'articulos' ? 'active' : '' }}"
                                href="{{ route('articulos') }}">
                                <span class="sidenav-mini-icon"> <i
                                        class="ni ni-bullet-list-67 text-dark text-sm opacity-10"></i> </span>
                                <i class="ni ni-bullet-list-67 text-dark text-sm opacity-10"></i>
                                <span class="sidenav-normal"> Articulos </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link {{ Route::currentRouteName() == 'usuarios' ? 'active' : '' }}"
                                href="{{ route('usuarios') }}">
                                <span class="sidenav-mini-icon"> <i
                                        class="ni ni-circle-08 text-dark text-sm opacity-10"></i> </span>
                                <i class="ni ni-circle-08 text-dark text-sm opacity-10"></i>
                                <span class="sidenav-normal"> Usuarios </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#admin"
                    class="nav-link collapsed {{ $activeLinkAdmin ? 'active' : '' }}" aria-controls="admin"
                    role="button" aria-expanded="{{ $activeLinkAdmin ? 'true' : 'false' }}">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-ungroup text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Administracion</span>
                </a>
                <div class="collapse {{ $activeLinkAdmin ? 'show' : '' }}" id="admin" style="">
                    <ul class="nav ms-4">
                        <li class="nav-item ">
                            <a class="nav-link {{ Route::currentRouteName() == 'parametros' ? 'active' : '' }}"
                                href="{{ route('parametros') }}">
                                <span class="sidenav-mini-icon"> <i
                                        class="ni ni-single-copy-04 text-dark text-sm opacity-10"></i> </span>
                                <i class="ni ni-single-copy-04 text-dark text-sm opacity-10"></i>
                                <span class="sidenav-normal"> Parametros</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>

</aside>

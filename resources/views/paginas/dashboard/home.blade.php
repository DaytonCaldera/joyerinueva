@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Inicio'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header mx-4 p-3 text-center">
                        <div
                            class="icon icon-shape icon-lg bg-gradient-info shadow text-center border-radius-lg">
                            <i class="fas fa-landmark opacity-10"></i>
                        </div>
                    </div>
                    <div class="card-body pt-0 p-3 text-center">
                        
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
@push('js')
    
@endpush
@extends('layouts.app_personalized')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <h5 class="card-title">404</h5>
                    <p class="card-text">Ops! Pagina no encontrada</p>
                    <a href="{{url('/')}}" class="btn btn-primary">Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
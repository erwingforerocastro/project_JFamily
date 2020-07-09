@extends('layouts.app_personalized')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <h5 class="card-title">403</h5>
                    <p class="card-text">Acceso no autorizado</p>
                    <a href="{{url('/')}}" class="btn btn-primary">Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
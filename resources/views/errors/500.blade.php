@extends('layouts.app')

@section('web_title', 'Sin Servicio')

@section('title')
    <i class="fas fa-exclamation-circle"></i> Error Interno del Servidor
@endsection


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-outline card-danger">
                    <div class="card-body text-center">
                        <i class="fas fa-exclamation-circle fa-4x text-danger mb-3"></i>
                        <p class="card-text">Lo sentimos, ha ocurrido un error inesperado en el servidor. Inténtalo de nuevo más tarde.</p>
                        <a href="{{ route('home') }}" class="btn btn-primary">
                            <i class="fas fa-home"></i> Volver al Inicio
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')


@endpush
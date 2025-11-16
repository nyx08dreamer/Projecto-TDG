@extends('layouts.app')

@section('web_title', 'Acceso Restringido')

@section('title')
    <i class="fas fa-exclamation-triangle"></i> Acceso Restringido
@endsection


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-outline card-danger">
                    <div class="card-body text-center">
                        <i class="fas fa-exclamation-triangle fa-4x text-danger mb-3"></i>
                        
                        <p class="card-text">No tiene los permisos necesarios para acceder a esta página.</p>
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
@extends('layouts.app')

@section('web_title', 'Listado de Permisos de Usuario')

@section('title')
    <i class="fa-solid fa-key"></i> Listado de Permisos de Usuario
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route('admin.permission.index') }}">Permisos</a></li>
@endsection

@push('css')

@endpush

@section('content')

    <div class="row">
        Listado de Usuarios que tienen el permiso
    </div>
    <!-- /.row -->

@endsection

@push('js')

@endpush

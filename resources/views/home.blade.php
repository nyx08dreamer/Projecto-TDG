@extends('layouts.app')

@section('web_title', 'Inicio')

@section('title')
    <i class="fa fa-home"></i> Inicio
@endsection


@section('content')

    Pagina de Inicio

    {{-- {{ dd(auth()->user()->roles) }} --}}
@endsection
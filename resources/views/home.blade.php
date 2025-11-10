@extends('layouts.app')

@section('web_title', 'Inicio')

@section('title')
    <i class="fa fa-home"></i> Dashboard
@endsection


@section('content')

    @if (auth()->user() && auth()->user()->hasRole('root'))
        @include('home-page.admin')
    @elseif (auth()->user() && auth()->user()->hasRole('ITsupport'))
        @include('home-page.support')
    @else
        @include('home-page.user')
    @endif


@endsection

@push('js')


@endpush
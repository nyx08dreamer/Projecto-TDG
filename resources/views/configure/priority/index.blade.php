@extends('layouts.app')

@section('web_title', 'Listado de Prioridades')

@section('title')
    <i class="fa-solid fa-ticket"></i> Listado de Prioridades
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route('config.priority.index') }}">Prioridades</a></li>
@endsection

@push('css')

@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    
                    <a href="{{ route('ticket.create') }}" class="btn btn-success">Crear prioridad</a>
                
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Colapsar">
                        <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table  class="table table-hover" id="ticket-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Título</th>
                                    <th>Prioridad</th>
                                    <th>Personal Asignado</th>
                                    <th>Fecha de Creación</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        var route_registros = '{{ route("admin.user.get") }}'
    </script>

    <script src="{{asset('assets/dist/js/users-table.js')}}"></script>
    
@endpush
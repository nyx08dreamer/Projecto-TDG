@extends('layouts.app')

@section('web_title', 'Listado de Solicitudes')

@section('title')
    <i class="fa-solid fa-ticket"></i> Listado de Solicitudes
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route('ticket.index') }}">Solicitudes</a></li>
@endsection

@push('css')

@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    
                    <a href="{{ route('ticket.create') }}" class="btn btn-success">Crear solicitud</a>
                
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
                                    <th class="text-center">Acciones</th>
                                    <th class="text-center">Título</th>
                                    <th class="text-center">Solicitante</th>
                                    <th class="text-center">Prioridad</th>
                                    <th class="text-center">Tipo</th>
                                    <th class="text-center">Fecha de Creación</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                
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
        var route_registros = '{{ route("ticket.get") }}'
    </script>

    <script src="{{asset('assets/dist/js/ticket-table.js')}}"></script>
    
@endpush
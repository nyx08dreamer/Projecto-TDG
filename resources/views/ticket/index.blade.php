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

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title text-center">Registros para Editar Solicitudes</h3>
            </div>
            <div class="card-body pb-0">
                
                <form class="mb-4">
                    <div class="row">

                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="form-label" for="status_solicitud">Prioridad</label>
                                    <select class="custom-select rounded-0" name="priority_id" id="priority_id">
                                        <option value="">Seleccionar</option>
                                        @foreach ($priorities as $priority)
                                            <option value="{{$priority->id}}">{{$priority->name}}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button type="button" class="btn btn-primary me-1" id="search">Buscar</button>
                            <a href="" class="btn btn-secondary">Limpiar</a>
                        </div>
                    </div>
                
            </div>
        </div>
    </section>
    
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
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        var route_registros = '{{ route("ticket.get") }}'
    </script>

    <script src="{{asset('assets/dist/js/ticket-table.js')}}"></script>
    
@endpush
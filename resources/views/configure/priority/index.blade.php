@extends('layouts.app')

@section('web_title', 'Listado de Prioridades')

@section('title')
    <i class="fa-solid fa-circle-exclamation"></i> Listado de Prioridades
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
                    
                    @can('configure-priority-create')
                        <a href="{{ route('config.priority.create') }}" class="btn btn-success">Crear prioridad</a>
                    @endcan
                
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Colapsar">
                        <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table  class="table table-hover" id="priority-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Acciones</th>
                                    <th>Nombre de Prioridad</th>
                                    <th>Fecha de Creación</th>
                                    <th>Creado Por</th>
                                    <th>Fecha de Actualización</th>
                                    <th>Actualizado Por</th>
                                    <th>Estado</th>
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
        var route_registros = '{{ route("config.priority.get") }}'
    </script>

    <script src="{{asset('assets/dist/js/priority-table.js')}}"></script>

@endpush
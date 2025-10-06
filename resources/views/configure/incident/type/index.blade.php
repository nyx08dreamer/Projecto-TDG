@extends('layouts.app')

@section('web_title', 'Tipos de Incidencias')

@section('title')
    <i class="fa-solid fa-ticket"></i> Tipos de Incidencias
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route('config.incidents.type.index') }}">Tipos</a></li>
@endsection

@push('css')

@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    
                    <a href="{{ route('config.incidents.type.create') }}" class="btn btn-success">Crear tipo</a>
                
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Colapsar">
                        <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table  class="table table-hover" id="type-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Acciones</th>
                                    <th>Tipo de Incidencia</th>
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
        var route_registros = '{{ route("config.incidents.type.get") }}'
    </script>

    <script src="{{asset('assets/dist/js/type-table.js')}}"></script>
    
@endpush
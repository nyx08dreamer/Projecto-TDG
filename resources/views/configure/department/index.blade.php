@extends('layouts.app')

@section('web_title', 'Listado de Departamentos')

@section('title')
    <i class="fa-solid fa-circle-exclamation"></i> Listado de Departamentos
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route('config.department.index') }}">Departamentos</a></li>
@endsection

@push('css')

@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    
                    @can('configure-department-create')
                        <a href="{{ route('config.department.create') }}" class="btn btn-success">Crear Departamento</a>
                    @endcan
                
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Colapsar">
                        <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table  class="table table-hover" id="department-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Acciones</th>
                                    <th>Nombre del Departamento</th>
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
        var route_registros = '{{ route("config.department.get") }}'
    </script>

    <script src="{{asset('assets/dist/js/department-table.js')}}"></script>

@endpush
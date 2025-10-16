@extends('layouts.app')

@section('web_title', 'Archivar Solicitudes')

@section('title')
    <i class="fa-solid fa-ticket"></i> Archivar Solicitudes
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route('gestion.archive.index') }}">Archivar</a></li>
@endsection

@push('css')

@endpush

@section('content')

    <section class="section">
        <div class="card">
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label class="form-label" for="priority_id">Prioridad</label>
                                <select class="custom-select rounded-0" name="priority_id" id="priority_id">
                                    <option value="">Seleccionar</option>
                                    @foreach ($priorities as $priority)
                                        <option value="{{$priority->id}}">{{$priority->name}}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label class="form-label" for="type_id">Tipo de Solicitud</label>
                                <select class="custom-select rounded-0" name="type_id" id="type_id">
                                    <option value="">Seleccionar</option>
                                    @foreach ($types as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <label class="form-label" for="department_id">Departamento</label>
                                <select class="custom-select rounded-0" name="department_id" id="department_id">
                                    <option value="">Seleccionar</option>
                                    @foreach ($departments as $department)
                                        <option value="{{$department->id}}">{{$department->name}}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label" for="from_date">Fecha desde</label>
                            <input type="date" class="form-control"  id="from_date" name="from_date">
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label" for="until_date">Fecha hasta</label>
                            <input type="date" class="form-control" id="until_date" name="until_date">
                        </div>
                    </div>
                </div>

                <div class="float-right pb-3">
                    <a href="" class="btn btn-outline-secondary">Limpiar</a>
                        <button type="button" class="btn btn-primary ml-2" id="search">Buscar</button>
                </div>
            </div>
        </div>
    </section>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">

                    <a href="{{ route('gestion.archive.create') }}" class="btn btn-success">Archivar</a>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Colapsar">
                        <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table  class="table table-hover" id="archiveTickets-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">Acciones</th>
                                    <th class="text-center">Título</th>
                                    <th class="text-center">Solicitante</th>
                                    <th class="text-center">Prioridad</th>
                                    <th class="text-center">Tipo</th>
                                    <th class="text-center">Departamento</th>
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
        var route_registros = '{{ route("gestion.archive.get") }}'
    </script>

    <script src="{{asset('assets/dist/js/archiveTickets-table.js')}}"></script>
    
@endpush
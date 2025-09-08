@extends('layouts.app')

@section('web_title', 'Listado de Usuarios')

@section('title')
    <i class="fa-solid fa-fw fa-users"></i> Listado de Usuarios
@endsection


@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route('admin.user.index') }}">Usuarios</a></li>
@endsection

@push('css')

@endpush

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Listado de Usuarios</h3>
                
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Colapsar">
                        <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remover">
                        <i class="fas fa-times"></i>
                        </button>
                        <a href="{{ route('admin.user.create') }}" class="btn btn-tool" data-card-widget="add" title="Crear Usuario">
                        <i class="fa-solid fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table  class="table table-hover" id="tabla" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombres</th>
                                    <th>Cedula</th>
                                    <th>Correo</th>
                                    <th>Usuario</th>
                                    <th>Fecha de Creación</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- <div class="card-footer">
                    Footer
                </div> --}}
                
            </div>
        </div>
    </div>

@endsection

@push('js')

    <script>
        var route_registros = '{{ route("admin.user.get") }}'
    </script>

    <script src="{{asset('assets/dist/js/tabla-usuarios.js')}}"></script>

@endpush


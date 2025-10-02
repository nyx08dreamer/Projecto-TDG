@extends('layouts.app')

@section('web_title', 'Visualización de Permiso')

@section('title')
    <i class="fa-solid fa-key"></i> Visualización de Permiso
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route('admin.permission.index') }}">Permisos</a></li>
@endsection

@push('css')

@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Información de Permiso</h3>
                </div>

                <div class="card-body pb-0 mb-0">
                    <div class="row">
                        <div class="form-group col-12 col-md-4">
                            <label for="name">Nombre</label>
                            <p class="pb-0 mb-0">{{$permission->name}}</p>
                            
                        </div>
                        <div class="form-group col-12 col-md-8">
                            <label for="description">Descripción</label>
                            <p class="pb-0 mb-0">{{$permission->description}}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Usuarios Asignados</h3>
                </div>

                <div class="card-body pb-1 mb-1">
                    <div class="table-responsive">
                        <table class="table table-hover" id="permissionsUsers-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nombres y Apellidos</th>
                                    <th>Login</th>
                                    <th>Correo Electronico</th> 
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Roles Asignados</h3>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="permissionsRoles-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Descripción</th> 
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
        var permissionUsers_registros = '{{ route('admin.permissionDetails.get', $permission->id) }}'
    </script>

    <script src="{{asset('assets/dist/js/permissionUsers-table.js')}}"></script>

    <script>
        var permissionRoles_registros = '{{ route('admin.permissionDetails.get', $permission->id) }}'
    </script>

    <script src="{{asset('assets/dist/js/permissionRoles-table.js')}}"></script>
@endpush

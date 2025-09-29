@extends('layouts.app')

@section('web_title', 'Edición del Rol')

@section('title')
    <i class="fa-regular fa-pen-to-square"></i> Edición del Rol
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route('admin.role.index') }}">Roles</a></li>
@endsection

@push('css')

@endpush

@section('content')

    <div class="row">
        <div class="col-12">
            <form id="role-edit" method="post" action="{{ route('admin.role.update', $role->id)}}">
                @csrf
                @method('PATCH')
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Editar Rol</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-12 col-md-4">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" value="{{$role->name}}">
                            </div>
                            <div class="form-group col-12 col-md-8">
                                <label for="description">Descripción</label>
                                <input type="text" class="form-control" id="description" name="description" placeholder="Descripción" value="{{$role->description}}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Asignar Permisos</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                        <div class="card-body">
                        @php
                            // IDs de permisos asignados al rol (vacío si es creación)
                            $rolePermissions = isset($role) ? $role->permissions->pluck('id')->toArray() : [];
                        @endphp

                        @foreach ($permissions as $permission)
                            <div class="row">
                                <div class="form-check col-12">
                                        <input type="checkbox" 
                                        class="form-check-input" 
                                        name="permission[]" 
                                        id="permission_{{ $permission->id }}" 
                                        value="{{ $permission->id }}"
                                        {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="permission_{{ $permission->id }}">{{$permission->description}}</label>
                                </div>
                                
                            </div>
                        @endforeach
                        </div>
                        <!-- /.card-body -->
                </div>

                <div class="float-right">
                    <a href="{{ route('admin.role.index') }}" class="btn btn-outline-danger">Cancelar</a>
                    <button type="submit" class="ml-2 btn btn-success">Guardar</button>
                </div>
            </form> 

            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

@endsection

    

@push('js')
    <script>
        $(function () {
            $('#role-edit').validate({
                rules: {
                name: {
                    required: true
                },
                description: {
                    required: true
                },

                },
                messages: {
                name: {
                required: "Por favor ingrese el nombre",
                },
                description: {
                    required: "Por favor ingrese la descripción",
                },

                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endpush

@extends('layouts.app')

@section('web_title', 'Visualización de Rol')

@section('title')
    <i class="fa-solid fa-unlock"></i> Visualización de Rol
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route('admin.role.index') }}">Roles</a></li>
@endsection

@push('css')

@endpush

@section('content')

    <div class="row">
        <div class="col-12">
            <!-- general form elements -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Información de Rol</h3>

                    <div class="card-tools">
                        <a href="{{ route('admin.role.edit', $role->id) }}" class="btn btn-tool" title="Editar Rol">
                        <i class="fa-solid fa-pen-to-square text-primary"></i>
                        </a>

                        <a href="#" class="btn btn-tool" onclick="event.preventDefault(); document.getElementById('role-delete').submit();" title="Eliminar Rol">
                            <i class="fa-solid fa-trash text-danger"></i>
                        </a>
                        <form id="role-delete" action="{{ route('admin.role.destroy', $role->id) }}" method="post" style="display: none;">
                            @csrf
                            @method('delete')
                        </form>
                    </div>
                </div>
                    
                <!-- /.card-header -->
                <!-- form start -->
                    <div class="card-body pb-0 mb-0">
                        <div class="row">
                            <div class="form-group col-12 col-md-4">
                                <label for="name">Nombre</label>
                                <p class="pb-0 mb-0">{{$role->name}}</p>
                                
                            </div>
                            <div class="form-group col-12 col-md-8">
                                <label for="description">Descripción</label>
                                <p class="pb-0 mb-0">{{$role->description}}</p>
                                
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Permisos Asignados</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                    <div class="card-body">
                        @foreach ($role->permissions as $permission)
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
                        @endforeach
                    </div>
                    <!-- /.card-body -->

            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Usuarios asignados al Rol</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                
                    <div class="card-body">
                        <div class="row">
                        
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        
                    </div>
            </div>
            <!-- /.card -->
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
    <!-- /.row -->

@endsection

@push('js')
    <script>
        $(function () {
            $('#role-update').validate({
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

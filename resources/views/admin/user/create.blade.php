@extends('layouts.app')

@section('web_title', 'Creación de Usuario')

@section('title')
    <i class="fa-solid fa-fw fa-user-plus"></i> Creación de Usuario
@endsection

@push('css')

@endpush

@section('content')

    <div class="row">
        <div class="col-12">
            <form id="user-create" method="post" action="{{ route('admin.user.store')}}">
                @csrf
            <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Crear Usuario</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-12 col-md-6">
                                    <label for="first_name">Nombres</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Nombres">
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="last_name">Apellidos</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Apellidos">
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="document_number">Cédula de Identidad</label>
                                    <input type="number" class="form-control" id="document_number" name="document_number" placeholder="Cédula de Identidad">
                                </div>

                                <div class="form-group col-12 col-md-6">
                                    <label for="email">Correo Electrónico</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Correo Electrónico">
                                </div>

                                <div class="form-group col-12 col-md-6">
                                    <label for="username">Nombre de Usuario</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Nombre de Usuario">
                                </div>

                                <div class="form-group col-12 col-md-6">
                                    <label for="start_date">Fecha de Activación</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date">
                                </div>

                                
                                
                            </div>
                        </div>
                        <!-- /.card-body -->
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Asignar Rol</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Colapsar">
                            <i class="fas fa-minus"></i>
                            </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                            @foreach ($roles as $role)
                                <div class="row">
                                    <div class="form-check col-12">
                                            <input type="checkbox" 
                                            class="form-check-input" 
                                            name="role[]" 
                                            id="role_{{ $role->id }}" 
                                            value="{{ $role->id }}"
                                            >
                                            <label class="form-check-label" for="role_{{ $role->id }}">{{$role->description}}</label>
                                    </div>
                                </div>
                            @endforeach
                    </div>
                        <!-- /.card-body -->
                </div>

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Asignar Permisos</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Colapsar">
                            <i class="fas fa-minus"></i>
                            </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                        <div class="card-body">
                        @foreach ($permissions as $permission)
                            <div class="row">
                                <div class="form-check col-12">
                                        <input type="checkbox" class="form-check-input" name="permission[{{ $permission->id }}]" id="permission_{{ $permission->id }}" value="{{ $permission->id }}">
                                        <label class="form-check-label" for="permission_{{ $permission->id }}">{{$permission->description}}</label>
                                </div>
                                
                            </div>
                        @endforeach
                        </div>
                        <!-- /.card-body -->
                </div>


                <div class="float-right pb-3">
                    <a href="{{ route('admin.user.index') }}" class="btn btn-outline-danger">Cancelar</a>
                    <button type="submit" class="ml-2 btn btn-success">Guardar</button>
                </div>
            </form>
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

@endsection

    

@push('js')
    <script>
        $(function () {
            
            $('#user-create').validate({
                rules: {
                first_name: {
                    required: true
                },
                document_number: {
                    required: true,
                    minlength: 7
                },
                email: {
                    required: true,
                    email: true,
                },
                username: {
                    required: true
                },

                },
                messages: {
                first_name: {
                required: "Por favor ingrese los nombres",
                },
                document_number: {
                    required: "Por favor ingrese el documento de identidad del usuario",
                    minlength: "El documento de identidad debe ser de 7 digitos minimo"
                },
                email: {
                    required: "Por favor ingrese un correo electrónico",
                    email: "Por favor ingrese un correo electrónico válido"
                },
                username: {
                    required: "Por favor ingrese el usuario",
                    email: "Please enter a valid email address"
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

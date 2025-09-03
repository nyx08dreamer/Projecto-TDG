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
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Crear Usuario</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="user-create" method="post" action="{{ route('admin.user.store')}}">
                @csrf
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

                            {{-- <div class="form-group col-12 col-md-6">
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" id="password" placeholder="Contraseña">
                            </div>

                            <div class="form-group col-12 col-md-6">
                                <label for="Confirmpassword">Confirmar contraseña</label>
                                <input type="password" class="form-control" id="Confirmpassword" placeholder="Confirmar contraseña">
                            </div> --}}
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <div class="float-right">
                            <a href="{{ route('admin.user.index') }}" class="btn btn-outline-danger">Cancelar</a>
                            <button type="submit" class="ml-2 btn btn-success">Guardar</button>
                        </div>
                    </div>
                </form>
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

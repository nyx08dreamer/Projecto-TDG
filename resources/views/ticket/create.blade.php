@extends('layouts.app')

@section('web_title', 'Creación de Solicitud')

@section('title')
    <i class="fa-solid fa-file-circle-plus"></i> Creación de Solicitud
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route('ticket.index') }}">Solicitudes</a></li>
@endsection

@push('css')

@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <form id="ticket-create" method="post" action="{{ route('ticket.store') }}">
                @csrf
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Crear Solicitud</h3>
                        </div>
                        
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-12 col-md-12">
                                    <label for="first_name">Título de la Solicitud</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Título de la Solicitud">
                                </div>
                                <div class="form-group col-12">
                                    <label for="last_name">Prioridad</label>
                                    <select class="custom-select rounded-0" name="" id="">
                                        <option value="">Seleccionar</option>
                                    </select>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="last_name">Tipo de Solicitud</label>
                                    <select class="custom-select rounded-0" name="" id="">
                                        <option value="">Seleccionar</option>
                                    </select>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="document_number">Categoria</label>
                                    <select class="custom-select rounded-0" name="" id="">
                                        <option value="">Seleccionar</option>
                                    </select>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="form-group col-12 col-md-12">
                                    <label for="document_number">Descripción</label>
                                    <textarea class="form-control" name="" id="" rows="10">Escriba aquí...</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="float-right pb-3">
                        <a href="" class="btn btn-outline-danger">Cancelar</a>
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
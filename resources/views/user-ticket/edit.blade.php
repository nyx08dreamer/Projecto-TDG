@extends('layouts.app')

@section('web_title', 'Edición de Mi Solicitud')

@section('title')
    <i class="fa-solid fa-file-circle-plus"></i> Edición de Mi Solicitud
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route('ticket.user.index') }}">Mis Solicitudes</a></li>
@endsection

@push('css')

@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <form id="ticket-edit" method="post" action="{{ route('ticket.user.update', $ticket->id) }}">
                @csrf
                @method('PATCH')
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Editar Solicitud</h3>
                        </div>
                        
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-12 col-md-12">
                                    <label for="title">Título de la Solicitud</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Título de la Solicitud" value="{{$ticket->title}}">
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="department">Departamento</label>
                                    <select class="custom-select rounded-0" name="department" id="department">
                                        <option value="{{$selected_department->id}}">{{$selected_department->name}}</option>
                                        @foreach ($departments as $department)
                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="priority">Prioridad</label>
                                    <select class="custom-select rounded-0" name="priority" id="priority">
                                        <option value="{{$selected_priority->id}}">{{$selected_priority->name}}</option>
                                        @foreach ($priorities as $priority)
                                            <option value="{{$priority->id}}">{{$priority->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="type">Tipo de Solicitud</label>
                                    <select class="custom-select rounded-0" name="type" id="type">
                                        <option value="{{$selected_type->id}}">{{$selected_type->name}}</option>
                                        @foreach ($types as $type)
                                            <option value="{{$type->id}}">{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="category">Categoria</label>
                                    <select class="custom-select rounded-0" name="category" id="category">
                                        <option value="">Seleccionar</option>
                                    </select>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="form-group col-12 col-md-12">
                                    <label for="message">Descripción</label>
                                    <textarea class="form-control" name="message" id="message" rows="10" placeholder="Escriba aquí...">{{$ticket->message}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">
                            <i class="fa-solid fa-file"></i>
                            Documentos Adjuntados
                            </h3>
                        </div>

                        <div class="card-body">
                            @if($documents->isEmpty())
                                <p>No hay documentos adjuntos para esta solicitud.</p>
                            @else
                                <ul class="mt-4">
                                    @foreach($documents as $document)
                                        <li>{{ $document->name}} - <a href="{{ asset($document->route.$document->name) }}" target="_blank">Ver</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                    </div>

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">
                            <i class="fa-solid fa-file"></i>
                            Adjuntar Documentos (Opcional)
                            </h3>
                        </div>

                        <div class="card-body">
                            <p class="card-text">Los archivos a subir deben estar en formato PNG, JPEG, JPG...</p>
                        <input type="file" id="archivos" name="archivos[]" class="basic-filepond" multiple>
                        </div>
                    </div>

                    <div class="float-right pb-3">
                        <a href="{{ route('ticket.user.index') }}" class="btn btn-outline-danger">Cancelar</a>
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
        $('input[type=file]').each(function(){
            filepond.create({id : $(this).attr("id") });
        })
    </script>


    <script>
        $(function () {
            $('#ticket-edit').validate({
                rules: {
                title: {
                    required: true
                    
                },
                department: {
                    required: true,
                },
                priority: {
                    required: true,
                },
                type: {
                    required: true,
                },
                message: {
                    required: true
                },

                },
                messages: {
                title: {
                    required: "Ingrese el título de la solicitud",
                    
                },
                department: {
                    required: "Seleccione el departamento correspondiente",
                },
                priority: {
                    required: "Seleccione la prioridad correspondiente",
                },
                type: {
                    required: "Seleccione el tipo de solicitud correspondiente",
                },
                message: {
                    required: "Ingrese la descripción de la solicitud",
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
@extends('layouts.app')

@section('web_title', 'Asignación de Solicitudes')

@section('title')
    <i class="fa-solid fa-file-circle-plus"></i> Asignación de Solicitudes
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route('gestion.assign.index') }}">Asignación</a></li>
@endsection

@push('css')

@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <form id="ticket-assign" method="post" action="{{ route('gestion.assign.update', $ticket->id) }}">
                @csrf
                @method('PATCH')
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fa-solid fa-headset"></i>
                                Datos del Tecnico Seleccionado
                            </h3>
                        </div>
                        
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-12 col-md-6">
                                    <label for="title">Nombres</label>
                                    <input type="hidden" id="user_id" name="user_id" >
                                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Nombres">
                                </div>

                                <div class="form-group col-12 col-md-6">
                                    <label for="title">Apellidos</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Apellidos">
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="title">Cedula de Identidad</label>
                                    <input type="number" class="form-control" id="document_number" name="document_number" placeholder="Cedula de Identidad">
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="title">Correo Electronico</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Correo Electronico">
                                </div>
                                
                            </div>
                            <div class="float-right">
                                <button class="btn btn-success" id="select" name="select">Seleccionar</button>
                            </div>
                        </div>
                    </div>

            <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle"></i> Información General
                </h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Identificador:</dt>
                    <dd class="col-sm-3">{{ $ticket->uuid }}</dd>
                </dl>
                <dl class="row">
                    <dt class="col-sm-3">Título:</dt>
                    <dd class="col-sm-9">{{ $ticket->title }}</dd>
                </dl>
                <dl class="row">
                    
                    <dt class="col-sm-3">Creado:</dt>
                    <dd class="col-sm-3">{{ TimeZoneCarbon::parse($ticket->created_at)->tz('America/Caracas')->format('d-m-Y h:i A') }}</dd>
                    <dt class="col-sm-3">Actualizado:</dt>
                    <dd class="col-sm-3">{{ TimeZoneCarbon::parse($ticket->updated_at)->tz('America/Caracas')->format('d-m-Y h:i A') }}</dd>
                </dl>
                <dl class="row">
                    
                
                    <dt class="col-sm-3">Estatus:</dt>
                    <dd class="col-sm-3">
                        <span class="badge {{ TicketStatusHelper::get_ticket_status_color($ticket->status) }} badge-lg">
                            {{ TicketStatusHelper::get_ticket_status($ticket->status) }}
                        </span>
                    </dd>

                    <dt class="col-sm-3">Departamento:</dt>
                    <dd class="col-sm-3">{{ $department->name }}</dd>
                    
                </dl>
                <dl class="row">
                    <dt class="col-sm-3">Prioridad:</dt>
                    <dd class="col-sm-3">
                        <span class="badge badge-secondary">{{ $priority->name }}</span>
                    </dd>
                    <dt class="col-sm-3">Tipo de Solicitud:</dt>
                    <dd class="col-sm-3">
                        <span class="badge badge-info">{{ $type->name }}</span>
                    </dd>
                </dl>
                <dl class="row">
                    <dt class="col-sm-3">Descripción:</dt>
                    <dd class="col-sm-9">{{ $ticket->message }}</dd>
                </dl>
                <hr class="my-4">
                <!-- Sección: Solicitante -->
                <h5 class="text-primary mb-3">
                    <i class="fas fa-user"></i> Solicitante
                </h5>
                <div class="bg-light p-3 rounded">
                    <dl class="row mb-0">
                        <dt class="col-sm-3">Nombre y Apellido:</dt>
                        <dd class="col-sm-3">{{ $solicitor->first_name }} {{ $solicitor->last_name }}</dd>
                        <dt class="col-sm-3">Cédula de Identidad:</dt>
                        <dd class="col-sm-3">{{ $solicitor->document_number }}</dd>
                    </dl>
                    <dl class="row mb-0">
                        <dt class="col-sm-3">Correo Electrónico:</dt>
                        <dd class="col-sm-9">{{ $solicitor->email }}</dd>
                    </dl>
                </div>
                <hr class="my-4">
                <!-- Sección: Técnico Asignado -->
                <h5 class="text-primary mb-3">
                    <i class="fas fa-user-cog"></i> Técnico Asignado
                </h5>

                 @if($support)
                    <div class="bg-light p-3 rounded">
                        <dl class="row mb-0">
                            <dt class="col-sm-3">Nombre y Apellido:</dt>
                            <dd class="col-sm-3">{{ $support->first_name }} {{ $support->last_name }}</dd>
                            <dt class="col-sm-3">Cédula de Identidad:</dt>
                            <dd class="col-sm-3">{{ $support->document_number }}</dd>
                        </dl>
                        <dl class="row mb-0">
                            <dt class="col-sm-3">Correo Electrónico:</dt>
                            <dd class="col-sm-9">{{ $support->email }}</dd>
                        </dl>
                    </div>
                @else
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i> Técnico por asignar.
                    </div>
                @endif
            </div>
        </div>
        <!-- Sección: Documentos Adjuntos -->
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-file-alt"></i> Documentos Adjuntos
                </h3>
            </div>
            <div class="card-body">
                @if($documents->isEmpty())
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> No hay documentos adjuntos para esta solicitud.
                    </div>
                @else
                    <div class="list-group">
                        @foreach($documents as $document)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-file"></i> {{ $document->name }}
                                </div>
                                <a href="{{ asset($document->route . $document->name) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i> Ver
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

                    <div class="float-right pb-3">
                        <a href="{{ route('gestion.assign.index') }}" class="btn btn-outline-danger">Cancelar</a>
                        <button type="submit" class="ml-2 btn btn-success">Asignar</button>
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

    <script src="{{asset('assets/dist/js/ItSupport-modal.js')}}"></script>

    <script>
        $('#select').on('click', function () {
            event.preventDefault();
            support('{{ route("gestion.assign.ItUsers.get") }}')  
        })
    </script>


    <script>
        $(function () {
            $('#ticket-assign').validate({
                rules: {
                first_name: {
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
                first_name: {
                    required: "Seleccione el tecnico a asignar",
                    
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
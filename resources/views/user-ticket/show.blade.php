@extends('layouts.app')

@section('web_title', 'Detalles de Mi Solicitud')

@section('title')
    <i class="fa-solid fa-file-circle-plus"></i> Detalles de Mi Solicitud
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route('ticket.user.index') }}">Mis Solicitudes</a></li>
@endsection

@push('css')

@endpush

@section('content')
    <div class="row">
        <div class="col-12">
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
            <!-- Botón de Regreso -->
            <div class="float-right pb-3">
                <a href="{{ route('ticket.user.index') }}" class="btn btn-primary">
                    Regresar
                </a>
            </div>
        </div>
    </div>
@endsection

@push('js')
    
@endpush
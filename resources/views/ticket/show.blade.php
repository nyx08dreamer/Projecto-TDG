@extends('layouts.app')

@section('web_title', 'Detalles de Solicitud')

@section('title')
    <i class="fa-solid fa-file-circle-plus"></i> Detalles de Solicitud
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route('ticket.all.index') }}">Solicitudes</a></li>
@endsection

@push('css')

@endpush

@section('content')
    <div class="row">
        <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Datos de la Solicitud</h3>
                        </div>
                        
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="title" >ID:</label>
                                <div class="col-4">
                                    <p> {{$ticket->id}}</p>
                                </div>
                                
                                <label for="title">Identificador: </label>
                                <div class="col-4">
                                    <p>{{$ticket->uuid}}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title">Título de la Solicitud:</label>
                                <div class="col-6">
                                    <p>{{$ticket->title}}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title">Estatus:</label>
                                <div class="col-1">
                                    <p>{{$ticket->status}}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title">Creado:</label>
                                <div class="col-6">
                                    <p>{{\Carbon\Carbon::parse($ticket->created_at)->tz('America/Caracas')->format('d-m-Y h:i A')}}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title">Actualizado:</label>
                                <div class="col-6">
                                    <p>{{\Carbon\Carbon::parse($ticket->updated_at)->tz('America/Caracas')->format('d-m-Y h:i A')}}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title">Departamento:</label>
                                <div class="col-4">
                                    <p>{{$department->name}}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title">Prioridad:</label>
                                <div class="col-1">
                                    <p>{{$priority->name}}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title">Tipo de Solicitud:</label>
                                <div class="col-4">
                                    <p>{{$type->name}}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title">Descripción:</label>
                                <div class="col-10">
                                    <p>{{$ticket->message}}</p>
                                </div>
                            </div>

                            <label for="title" class="col-12">Solicitante:</label>

                            <div class="form-group row ">
                                <label for="title">Nombre y Apellido:</label>
                                <div class="col-2">
                                    <p>{{$solicitor->first_name}} {{ $solicitor->last_name }}</p>
                                </div>
                                
                                <label for="title">Cedula de identidad:</label>
                                <div class="col-1">
                                    <p>{{$solicitor->document_number }}</p>
                                </div>

                                <label for="title">Correo Electrónico:</label>
                                <div class="col-2">
                                    <p>{{$solicitor->email }}</p>
                                </div>
                            </div>

                            <label for="title" class="col-12">Tecnico asignado:</label>

                            @if($support)
                                <div class="form-group row ">
                                    <label for="title">Nombre y Apellido:</label>
                                    <div class="col-2">
                                        <p>{{$support->first_name}} {{ $support->last_name }}</p>
                                    </div>
                                    
                                    <label for="title">Cedula de identidad:</label>
                                    <div class="col-1">
                                        <p>{{$support->document_number }}</p>
                                    </div>

                                    <label for="title">Correo Electrónico:</label>
                                    <div class="col-2">
                                        <p>{{$support->email }}</p>
                                    </div>
                                </div>
                            @else
                                Tenico Por Asignar
                            @endif

                            @if($document)
                                <div class="form-group row">
                                    Documentos
                                </div>
                            @else
                                <div class="form-group row">
                                    Sin documentos adjuntos.
                                </div>
                            @endif

                        
                        </div>
                    </div>

                    <div class="float-right pb-3">
                        <a href="{{ route('ticket.all.index') }}" class="btn btn-primary">Regresar</a>
                    </div>

        </div>
    </div>
@endsection

@push('js')
    
@endpush
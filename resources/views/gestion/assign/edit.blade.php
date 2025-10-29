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
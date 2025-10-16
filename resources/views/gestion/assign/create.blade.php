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
            <form id="ticket-assign" method="post" action="{{ route('gestion.assign.assignation') }}">
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
                            <i class="fa-solid fa-ticket"></i>
                            Solicitudes por Asignar
                            </h3>
                        </div>

                        <div class="card-body">
                            <ul class="todo-list">

                                @foreach($tickets as $ticket)
                                    <li>
                                        <div  class="icheck-primary d-inline ml-2">
                                        <input type="checkbox" name="ticket_ids[]" id="ticket_{{ $ticket->id ?? $ticket['id'] }}" value="{{ $ticket->id ?? $ticket['id'] }}">
                                        <label for="todoCheck1"></label>
                                        </div>
                                        <!-- todo text -->
                                        <span class="text">Título: {{ Str::limit($ticket->title ?? $ticket['title'], 30, '...') }}</span>

                                        <span class="text">Solicitante: {{ $ticket->creator_name ?? $ticket['creator_name'] }}</span>
                                        
                                        <small class="badge {{ \App\Helpers\PriorityHelper::get_priority_color($ticket->priority_id) }}">
                                            {{ $ticket->priority_name ?? $ticket['priority_name'] }}
                                        </small>
                                        <small class="badge {{ \App\Helpers\TypeHelper::get_type_color($ticket->type_id) }}">
                                            {{ $ticket->type_name ?? $ticket['type_name'] }}
                                        </small>
                                        <small class="badge badge-primary">
                                            {{ $ticket->department_name ?? $ticket['department_name'] }}
                                        </small>
                                    </li>
                                @endforeach

                            </ul>
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
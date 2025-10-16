@extends('layouts.app')

@section('web_title', 'Desarchivar Solicitudes')

@section('title')
    <i class="fa-solid fa-file-circle-plus"></i> Desarchivar Solicitudes
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route('gestion.archive.index') }}">Solicitudes Archivadas</a></li>
@endsection

@push('css')

@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <form id="ticket-assign" method="post" action="{{ route('gestion.archived-tickets.unarchived') }}">
                @csrf
                @method('PATCH')

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">
                            <i class="fa-solid fa-ticket"></i>
                            Solicitudes
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
                        <a href="{{ route('gestion.archived-tickets.index') }}" class="btn btn-outline-danger">Cancelar</a>
                        <button type="submit" class="ml-2 btn btn-success">Desarchivar</button>
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
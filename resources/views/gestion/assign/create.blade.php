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
            <form id="ticket-assign" method="post" action="{{ route('gestion.assign.assignation') }}">
                @csrf
                @method('PATCH')
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Crear Solicitud</h3>
                        </div>
                        
                        <div class="card-body">
                            <div class="row">
                                <label for="user_id">Tecnico de Soporte</label>
                                    <select class="custom-select rounded-0" name="user_id" id="user_id">
                                        <option value="">Seleccionar</option>
                                        @foreach ($users as $user)
                                            <option value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
                                        @endforeach
                                    </select>
                                
                                    
                            </div>

                            <div class="row">
                                    <div>
                                        @foreach($tickets as $ticket)
                                            <div class="row">
                                                <div class="form-check col-12">
                                                    <input type="checkbox" class="form-check-input" name="ticket_ids[]" id="ticket_{{ $ticket->id ?? $ticket['id'] }}" value="{{ $ticket->id ?? $ticket['id'] }}">
                                                    <label class="form-check-label" for="ticket_{{ $ticket->id ?? $ticket['id'] }}">{{ $ticket->title ?? $ticket['title'] }}</label>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="float-right pb-3">
                        <a href="{{ route('ticket.index') }}" class="btn btn-outline-danger">Cancelar</a>
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
            $('#ticket-assign').validate({
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
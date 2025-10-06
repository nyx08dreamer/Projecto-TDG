@extends('layouts.app')

@section('web_title', 'Edición de Prioridad')

@section('title')
    <i class="fa-solid fa-circle-exclamation"></i> Edición de Prioridad
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route('config.priority.index') }}">Prioridades</a></li>
@endsection

@push('css')

@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <form id="priority-edit" method="post" action="{{ route('config.priority.update', $priority->id)}}">
                @csrf
                @method('PATCH')
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Editar Prioridad</h3>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-12 col-md-6">
                                    <label for="name">Nombre de la Prioridad</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" value="{{$priority->name}}">
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="name">Estado</label>
                                    <select class="custom-select rounded-0" id="flag_status" name="flag_status" >
                                        <option value="">Seleccionar</option>
                                        <option value="0" {{ old('flag_status', $priority->flag_status) == '0' ? 'selected' : '' }}>Desactivada</option>
                                        <option value="1" {{ old('flag_status', $priority->flag_status) == '1' ? 'selected' : '' }}>Activa</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="float-right pb-3">
                        <a href="{{ route('config.priority.index') }}" class="btn btn-outline-danger">Cancelar</a>
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
            $('#priority-edit').validate({
                rules: {
                name: {
                    required: true
                },
                flag_status: {
                    required: true
                },

                },
                messages: {
                name: {
                required: "Por favor ingrese el nombre de la prioridad",
                },
                flag_status: {
                    required: "Por favor ingrese el estado de la prioridad",
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

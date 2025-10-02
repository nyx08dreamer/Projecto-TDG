@extends('layouts.app')

@section('web_title', 'Visualización de Usuarios')

@section('title')
    <i class="fa-solid fa-fw fa-user"></i> Visualización de Usuarios
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route('admin.user.index') }}">Usuarios</a></li>
@endsection

@push('css')

@endpush

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                            src="{{asset('storage/image_profiles/'.$user->image_path)}}"
                            alt="User profile picture" id="image">
                    </div>
                    <h3 class="profile-username text-center">{{$user->first_name}}</h3>
                    <p class="text-muted text-center">Software Engineer</p>
                </div>
            </div>

            <!-- About Me Box -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Sobre Mi</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <strong><i class="fas fa-book mr-1"></i> Education</strong>

                    <p class="text-muted">
                        B.S. in Computer Science from the University of Tennessee at Knoxville
                    </p>

                    <hr>

                    <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                </div>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Actividad</a></li>
                        <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Historial</a></li>
                        <li class="nav-item"><a class="nav-link" href="#info" data-toggle="tab">Información</a></li>

                        @can('admin-role-show')
                        <li class="nav-item"><a class="nav-link" href="#role" data-toggle="tab">Roles</a></li>
                        @endcan

                        @can('admin-permission-show')
                        <li class="nav-item"><a class="nav-link" href="#permissions" data-toggle="tab">Permisos</a></li>
                        @endcan
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        @include('admin.user.activity.show')

                        @include('admin.user.timeline.show')

                        @include('admin.user.info.show')

                        @include('admin.user.role.'.(auth()->user()->can('admin-user-role') ? 'full_view' : 'limited_view'))

                        @include('admin.user.permission.'.(auth()->user()->can('admin-user-permission') ? 'full_view' : 'limited_view'))
                    </div>
                </div>
            </div>

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
        $('#image').on('click', function () {
            var mbody = $('#modal-userImage').find('.modal-body');
            
            $('#modal-userImage').modal('show');
        })
    </script>

    <script>
        $(function () {
            
            $('#user-update').validate({
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

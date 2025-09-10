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

        <!-- Profile Image -->
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
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

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
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
        <div class="card">
            <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Actividad</a></li>
                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Historial</a></li>
                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Información</a></li>
            </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <!-- Post -->
                        <div class="post">
                            <div class="user-block">
                            <img class="img-circle img-bordered-sm" src="{{asset('storage/image_profiles/default_profile.png')}}" alt="user image">
                            <span class="username">
                                <a href="#">Jonathan Burke Jr.</a>
                                <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                            </span>
                            <span class="description">Shared publicly - 7:30 PM today</span>
                            </div>
                            <!-- /.user-block -->
                            <p>
                            Lorem ipsum represents a long-held tradition for designers,
                            typographers and the like. Some people hate it and argue for
                            its demise, but others ignore the hate as they create awesome
                            tools to help create filler text for everyone from bacon lovers
                            to Charlie Sheen fans.
                            </p>

                            <p>
                            <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                            <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                            <span class="float-right">
                                <a href="#" class="link-black text-sm">
                                <i class="far fa-comments mr-1"></i> Comments (5)
                                </a>
                            </span>
                            </p>

                            <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                        </div>
                        <!-- /.post -->

                        <!-- Post -->
                        <div class="post clearfix">
                            <div class="user-block">
                            <img class="img-circle img-bordered-sm" src="{{asset('storage/image_profiles/default_profile.png')}}" alt="User Image">
                            <span class="username">
                                <a href="#">Sarah Ross</a>
                                <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                            </span>
                            <span class="description">Sent you a message - 3 days ago</span>
                            </div>
                            <!-- /.user-block -->
                            <p>
                            Lorem ipsum represents a long-held tradition for designers,
                            typographers and the like. Some people hate it and argue for
                            its demise, but others ignore the hate as they create awesome
                            tools to help create filler text for everyone from bacon lovers
                            to Charlie Sheen fans.
                            </p>

                            <form class="form-horizontal">
                            <div class="input-group input-group-sm mb-0">
                                <input class="form-control form-control-sm" placeholder="Response">
                                <div class="input-group-append">
                                <button type="submit" class="btn btn-danger">Send</button>
                                </div>
                            </div>
                            </form>
                        </div>
                        <!-- /.post -->

                        <!-- Post -->
                        <div class="post">
                            <div class="user-block">
                            <img class="img-circle img-bordered-sm" src="{{asset('storage/image_profiles/default_profile.png')}}" alt="User Image">
                            <span class="username">
                                <a href="#">Adam Jones</a>
                                <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                            </span>
                            <span class="description">Posted 5 photos - 5 days ago</span>
                            </div>
                            <!-- /.user-block -->
                            <div class="row mb-3">
                            <div class="col-sm-6">
                                <img class="img-fluid" src="#" alt="Photo">
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                                <div class="row">
                                <div class="col-sm-6">
                                    <img class="img-fluid mb-3" src="{{asset('storage/image_profiles/default_profile.png')}}" alt="Photo">
                                    <img class="img-fluid" src="{{asset('storage/image_profiles/default_profile.png')}}" alt="Photo">
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-6">
                                    <img class="img-fluid mb-3" src="{{asset('storage/image_profiles/default_profile.png')}}" alt="Photo">
                                    <img class="img-fluid" src="{{asset('storage/image_profiles/default_profile.png')}}" alt="Photo">
                                </div>
                                <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <p>
                            <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                            <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                            <span class="float-right">
                                <a href="#" class="link-black text-sm">
                                <i class="far fa-comments mr-1"></i> Comments (5)
                                </a>
                            </span>
                            </p>

                            <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                        </div>
                        <!-- /.post -->
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="timeline">
                        <!-- The timeline -->
                        <div class="timeline timeline-inverse">
                            <!-- timeline time label -->
                            <div class="time-label">
                            <span class="bg-danger">
                                10 Feb. 2014
                            </span>
                            </div>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <div>
                            <i class="fas fa-envelope bg-primary"></i>

                            <div class="timeline-item">
                                <span class="time"><i class="far fa-clock"></i> 12:05</span>

                                <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                <div class="timeline-body">
                                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                quora plaxo ideeli hulu weebly balihoo...
                                </div>
                                <div class="timeline-footer">
                                <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                </div>
                            </div>
                            </div>
                            <!-- END timeline item -->
                            <!-- timeline item -->
                            <div>
                            <i class="fas fa-user bg-info"></i>

                            <div class="timeline-item">
                                <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                                <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                                </h3>
                            </div>
                            </div>
                            <!-- END timeline item -->
                            <!-- timeline item -->
                            <div>
                            <i class="fas fa-comments bg-warning"></i>

                            <div class="timeline-item">
                                <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                                <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                                <div class="timeline-body">
                                Take me to your leader!
                                Switzerland is small and neutral!
                                We are more like Germany, ambitious and misunderstood!
                                </div>
                                <div class="timeline-footer">
                                <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                                </div>
                            </div>
                            </div>
                            <!-- END timeline item -->
                            <!-- timeline time label -->
                            <div class="time-label">
                            <span class="bg-success">
                                3 Jan. 2014
                            </span>
                            </div>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <div>
                            <i class="fas fa-camera bg-purple"></i>

                            <div class="timeline-item">
                                <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                                <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                                <div class="timeline-body">
                                <img src="#" alt="...">
                                </div>
                            </div>
                            </div>
                            <!-- END timeline item -->
                            <div>
                            <i class="far fa-clock bg-gray"></i>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="settings">
                        <form class="form-horizontal" id="user-update" method="post" action="{{ route('admin.user.update', $user->id)}}">
                        @csrf
                        @method('PATCH')
                            <div class="row">
                                <div class="form-group col-12 col-md-6">
                                    <label for="first_name">Nombres</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Nombres" value="{{$user->first_name}}">
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="last_name">Apellidos</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Apellidos" value="{{$user->last_name}}">
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="document_number">Cédula de Identidad</label>
                                    <input type="number" class="form-control" id="document_number" name="document_number" placeholder="Cédula de Identidad" value="{{$user->document_number}}">
                                </div>

                                <div class="form-group col-12 col-md-6">
                                    <label for="email">Correo Electrónico</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Correo Electrónico" value="{{$user->email}}">
                                </div>

                                <div class="form-group col-12 col-md-6">
                                    <label for="username">Nombre de Usuario</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Nombre de Usuario" value="{{$user->username}}">
                                </div>

                                <div class="form-group col-12 col-md-6">
                                    <label for="start_date">Fecha de Activación</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ \Carbon\Carbon::parse($user->start_date)->format('Y-m-d') }}">
                                </div>

                                
                            </div>
                            <div class="float-right">
                                <a href="{{ route('admin.user.index') }}" class="btn btn-outline-danger">Cancelar</a>
                                <button type="submit" class="ml-2 btn btn-success">Guardar</button>
                            </div>                            
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
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
        <!-- /.col -->
    </div>
    <!-- /.row -->

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

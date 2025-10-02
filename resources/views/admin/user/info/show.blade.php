<div class="tab-pane" id="info">
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
                <button type="submit" class="ml-2 btn btn-success">Guardar</button>
            </div>                            
    </form>
</div>
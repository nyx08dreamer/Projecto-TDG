<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>Se le ha asignado una nueva solicitud.</p>

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


                </div>
            </div>

    <a href="{{route('ticket.support.show', $ticket->id)}}">
        Clic para visualizar solicitud asignada
    </a>
</body>
</html>
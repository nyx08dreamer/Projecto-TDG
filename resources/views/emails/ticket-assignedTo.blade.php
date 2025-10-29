<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>Su solicitud a sido asignada a un tecnico.</p>

    <label for="title" class="col-12">Datos:</label>

                    
                        <div class="form-group row ">
                            <label for="title">Nombre y Apellido:</label>
                            <div class="col-2">
                                <p>{{$technician->first_name}} {{ $technician->last_name }}</p>
                            </div>
                            
                            <label for="title">Cedula de identidad:</label>
                            <div class="col-1">
                                <p>{{$technician->document_number }}</p>
                            </div>

                            <label for="title">Correo Electrónico:</label>
                            <div class="col-2">
                                <p>{{$technician->email }}</p>
                            </div>
                        </div>

    <a href="{{route('ticket.user.show', $ticket->id)}}">
        Clic para visualizar solicitud asignada
    </a>
</body>
</html>

        @php

            
            $asignadas = $userTickets->where('assigned_to', '!=', null)->count(); // Ajusta 'assigned_to' si el campo es diferente (nota: corregí de !null a '!=', null)
            
            $abiertas = $userTickets->where('status', 'open')->count();
            $cerradas = $userTickets->where('status', 'closed')->count();
            
            // Agrupar y contar por prioridad
            $userTicketsByPriority = $userTickets->groupBy('priority_name')->map->count()->sort();
            
            // Agrupar y contar por departamento
            $userTicketsByDepartment = $userTickets->groupBy('department_name')->map->count()->sort();
            
            // Agrupar y contar por tipo de incidencia
            $userTicketsByType = $userTickets->groupBy('type_name')->map->count()->sort();
        @endphp

        {{-- Fila de tarjetas de estadísticas de solicitudes --}}
        <div class="row">
            <div class="col-lg-4 col-4">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $asignadas }}</h3>
                        <p>Mis Solicitudes Asignadas</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-4">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $abiertas }}</h3>
                        <p>Mis Solicitudes Por Resolver</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-4">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $cerradas }}</h3>
                        <p>Mis Solicitudes Cerradas</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>
        </div>

        <h1>Bienvenido {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h1>
        <p>Esta es tu página de inicio. Aquí puedes ver un resumen de tus solicitudes.</p>


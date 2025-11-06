@extends('layouts.app')

@section('web_title', 'Inicio')

@section('title')
    <i class="fa fa-home"></i> Dashboard
@endsection


@section('content')

    @php
        // Asumiendo que $tickets es una colección de Laravel (e.g., desde el controlador)
        $totalSolicitudes = $tickets->count();
        $asignadas = $tickets->where('assigned_to', !null)->count(); // Ajusta 'status' si el campo es diferente
        $archivadas = $tickets->where('is_archived', 1)->count();
        $abiertas = $tickets->where('status', 'open')->count();
        $cerradas = $tickets->where('status', 'closed')->count();


        // Agrupar y contar por prioridad
        $ticketsByPriority = $tickets->groupBy('priority_name')->map->count()->sort();

        // Agrupar y contar por departamento
        $ticketsByDepartment = $tickets->groupBy('department_name')->map->count()->sort();

        // Agrupar y contar por tipo de incidencia
        $ticketsByType = $tickets->groupBy('type_name')->map->count()->sort();
    @endphp

    <div class="row">
        <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                <h3>{{$totalSolicitudes}}</h3>

                <p>Total de Solicitudes</p>
                </div>
                <div class="icon">
                <i class="ion ion-bag"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                <h3>{{$archivadas}}</h3>

                <p>Solicitudes Archivadas</p>
                </div>
                <div class="icon">
                <i class="ion ion-stats-bars"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box bg-primary">
                <div class="inner">
                <h3>{{$asignadas}}</h3>

                <p>Solicitudes Asignadas</p>
                </div>
                <div class="icon">
                <i class="ion ion-stats-bars"></i>
                </div>
            </div>
        </div>
    </div>


    <div class="row justify-content-center">
          <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$abiertas}}</h3>

                <p>Solicitudes Por Resolver</p>
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
                <h3>{{$cerradas}}</h3>

                <p>Solicitudes Cerradas</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </div>
    </div>

    <!-- Nueva fila para gráficos -->
    <div class="row">
        <div class="col-lg-4 col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Solicitudes por Prioridad</h3>
                </div>
                <div class="card-body">
                    <canvas id="chartPriority" style="max-height: 300px;"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Solicitudes por Tipo de Incidencia</h3>
                </div>
                <div class="card-body">
                    <canvas id="chartType" style="max-height: 300px;"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Solicitudes por Departamento</h3>
                </div>
                <div class="card-body">
                    <canvas id="chartDepartment" style="max-height: 300px;"></canvas>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('js')


    <script>
        // Función para obtener colores fijos
        function getFixedColors(count) {
            const fixedColors = [
                '#FF6384', // Rojo claro
                '#36A2EB', // Azul
                '#FFCE56', // Amarillo
                '#4BC0C0', // Verde azulado
                '#9966FF', // Morado
                '#FF9F40', // Naranja
                '#C9CBCF', // Gris
                '#FF6384', // Repite si hay más de 7
                '#36A2EB',
                '#FFCE56'
            ];
            return fixedColors.slice(0, count);
        }

        // Gráfico por Tipo de Incidencia
        const ctxType = document.getElementById('chartType').getContext('2d');
        new Chart(ctxType, {
            type: 'pie',
            data: {
                labels: @json($ticketsByType->keys()), // Nombres de tipos
                datasets: [{
                    data: @json($ticketsByType->values()), // Conteos
                    backgroundColor: getFixedColors({{ $ticketsByType->count() }}),
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });

        // Gráfico por Departamento
        const ctxDepartment = document.getElementById('chartDepartment').getContext('2d');
        new Chart(ctxDepartment, {
            type: 'pie',
            data: {
                labels: @json($ticketsByDepartment->keys()),
                datasets: [{
                    data: @json($ticketsByDepartment->values()),
                    backgroundColor: getFixedColors({{ $ticketsByDepartment->count() }}),
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });

        // Gráfico por Prioridad
        const ctxPriority = document.getElementById('chartPriority').getContext('2d');
        new Chart(ctxPriority, {
            type: 'pie',
            data: {
                labels: @json($ticketsByPriority->keys()),
                datasets: [{
                    data: @json($ticketsByPriority->values()),
                    backgroundColor: getFixedColors({{ $ticketsByPriority->count() }}),
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });
    </script>
@endpush
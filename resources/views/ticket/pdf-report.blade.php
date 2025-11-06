<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen de Solicitudes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #007bff;
        }
        h2 {
            margin-top: 30px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .summary {
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
    <h1>Resumen de Solicitudes</h1>
    <p>Reporte generado el {{ now()->tz('America/Caracas')->format('d/m/Y H:i') }}</p>

    @php
        \Carbon\Carbon::setLocale('es_ES');
        // Convertir la colección de tickets a una colección de Laravel
        $ticketsCollection = collect($tickets);

        // Agrupar y contar tickets por mes (formato: Y-m, e.g., 2023-10)
        $ticketsByMonth = $ticketsCollection->groupBy(function($ticket) {
            return \Carbon\Carbon::parse($ticket->created_at)->format('Y-m');
        })->map(function($group) {
            return $group->count();
        })->sortKeys(); // Ordenar por mes

        // Agrupar y contar por prioridad
        $ticketsByPriority = $ticketsCollection->groupBy('priority_name')->map->count()->sort();

        // Agrupar y contar por departamento
        $ticketsByDepartment = $ticketsCollection->groupBy('department_name')->map->count()->sort();

        // Agrupar y contar por tipo de incidencia
        $ticketsByType = $ticketsCollection->groupBy('type_name')->map->count()->sort();
    @endphp

    <div class="summary">
        <h2>Cantidad de Solicitudes por Mes</h2>
        <table>
            <thead>
                <tr>
                    <th>Mes</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ticketsByMonth as $month => $count)
                    <tr>
                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m', $month)->format('F Y') }}</td>
                        <td>{{ $count }}</td>
                    </tr>
                    
                @empty
                    <tr>
                        <td colspan="2">No hay datos disponibles.</td>
                    </tr>
                @endforelse
                    <tr>
                        <td>Total de Solicitudes</td>
                        <td>{{ $ticketsByMonth->sum() }}</td>
                    </tr>
            </tbody>
        </table>
    </div>

    <div class="summary">
        <h2>Cantidad de Solicitudes por Prioridad</h2>
        <table>
            <thead>
                <tr>
                    <th>Prioridad</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ticketsByPriority as $priority => $count)
                    <tr>
                        <td>{{ $priority }}</td>
                        <td>{{ $count }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">No hay datos disponibles.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="summary">
        <h2>Cantidad de Solicitudes por Departamento</h2>
        <table>
            <thead>
                <tr>
                    <th>Departamento</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ticketsByDepartment as $department => $count)
                    <tr>
                        <td>{{ $department }}</td>
                        <td>{{ $count }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">No hay datos disponibles.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="summary">
        <h2>Cantidad de Solicitudes por Tipo de Incidencia</h2>
        <table>
            <thead>
                <tr>
                    <th>Tipo de Incidencia</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ticketsByType as $type => $count)
                    <tr>
                        <td>{{ $type }}</td>
                        <td>{{ $count }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">No hay datos disponibles.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>


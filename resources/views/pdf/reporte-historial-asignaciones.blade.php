<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Ajuste de inventario</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 11px;
            color: #334155;
        }

        .header-table {
            width: 100%;
            margin-bottom: 25px;
            border-bottom: 3px solid #D99B00;
            padding-bottom: 15px;
        }

        .header-table td {
            vertical-align: middle;
            border: none;
            padding: 0;
        }

        .logo-container {
            width: 30%;
            text-align: left;
        }

        .logo {
            max-width: 140px;
            max-height: 60px;
        }

        .title-container {
            width: 70%;
            text-align: right;
        }

        .title-container h1 {
            color: #0f172a;
            margin: 0 0 5px 0;
            font-size: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .fecha {
            font-size: 10px;
            color: #64748b;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .data-table th {
            background-color: #1e293b;
            color: #ffffff;
            padding: 10px 8px;
            text-align: left;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .data-table td {
            padding: 8px;
            border-bottom: 1px solid #e2e8f0;
            color: #334155;
            vertical-align: top;
        }

        .col-number {
            text-align: right;
        }

        .col-center {
            text-align: center;
        }

        .bg-gray {
            background-color: #f8fafc;
        }

        .font-bold {
            font-weight: bold;
            color: #0f172a;
        }

        .text-sm {
            font-size: 9px;
            color: #64748b;
            display: block;
            margin-top: 2px;
        }

        .text-alert {
            color: #b45309;
            /* Un tono ámbar oscuro para advertencias/devoluciones */
            font-weight: bold;
        }

        footer {
            position: fixed;
            bottom: -20px;
            left: 0px;
            right: 0px;
            height: 30px;
            font-size: 10px;
            color: #94a3b8;
            text-align: center;
            border-top: 1px solid #e2e8f0;
            padding-top: 8px;
        }

        .page-number:before {
            content: "Página " counter(page);
        }
    </style>
</head>

<body>
    <footer>
        Sistema de Producción e Inventario - <span class="page-number"></span>
    </footer>

    <!-- Encabezado -->
    <table class="header-table">
        <tr>
            <td class="logo-container">
                <img src="{{ public_path('Images/Guantes.png') }}" class="logo" alt="Logo Empresa">
            </td>
            <td class="title-container">
                <h1>Historial de Asignaciones</h1>
                <div class="fecha">
                    Generado el: {{ \Carbon\Carbon::now('America/Mexico_City')->format('d/m/Y h:i A') }}
                </div>
            </td>
        </tr>
    </table>

    <!-- Tabla Principal -->
    <table class="data-table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Cortador</th>
                <th>Material Utilizado</th>
                <th class="col-center">Tareas</th>
                <th class="col-center">Rendimiento</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($asignaciones as $index =>$asignacion)
                <tr class="{{ $index % 2 === 0 ? 'bg-gray' : '' }}">

                    {{-- Fecha --}}
                    <td>
                        <span class="font-bold">{{ $asignacion->updated_at->format('d/m/Y') }}</span>
                        <span class="text-sm">{{ $asignacion->updated_at->format('h:i A') }}</span>
                    </td>

                    {{-- Cortador --}}
                    <td class="font-bold">
                        {{ $asignacion->user->name ?? 'N/A' }}
                    </td>

                    {{-- Material (Desglose de mesa y devoluciones) --}}
                    <td>
                        <span class="font-bold">{{ $asignacion->materiaPrima->nombre ?? 'N/A' }}</span>
                        <span class="text-sm">
                            Total en mesa:
                            {{ number_format($asignacion->dm_iniciales + ($asignacion->dm_adicionales ?? 0), 2) }} dm
                        </span>
                        @if ($asignacion->dm_sobrantes > 0)
                            <span class="text-sm text-alert">
                                Devolvió: {{ number_format($asignacion->dm_sobrantes, 2) }} dm
                            </span>
                        @endif
                    </td>

                    {{-- Tareas reales vs meta --}}
                    <td class="col-center">
                        <span class="font-bold" style="font-size: 13px;">{{ $asignacion->cortes_reales }}</span>
                        <span class="text-sm">Meta: {{ number_format($asignacion->cortes_estimados, 2) }}</span>
                    </td>

                    {{-- Rendimiento real vs estimado --}}
                    <td class="col-center">
                        <span class="font-bold"
                            style="font-size: 13px;">{{ number_format($asignacion->rendimiento_real, 2) }} dm</span>
                        <span class="text-sm">Est: {{ number_format($asignacion->consumo_estimado, 2) }} dm</span>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="5" class="col-center" style="padding: 30px; color: #64748b;">
                        No se encontraron registros en el historial para los filtros seleccionados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>

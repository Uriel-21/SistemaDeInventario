<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Ajustes de Producto Terminado</title>
    <style>
        @page {
            margin: 40px 40px;
        }

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 11px;
            color: #334155;
        }

        .header-table {
            width: 100%;
            margin-bottom: 20px;
            border-bottom: 3px solid #D99B00;
            padding-bottom: 12px;
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
            margin: 0 0 4px 0;
            font-size: 18px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
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
            vertical-align: middle;
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

        .font-mono {
            font-family: monospace;
            font-size: 10px;
            color: #475569;
        }

        .text-green {
            color: #15803d;
            font-weight: bold;
        }

        .text-red {
            color: #b91c1c;
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
        Sistema de Inventario - <span class="page-number"></span>
    </footer>

    <!-- Encabezado -->
    <table class="header-table">
        <tr>
            <td class="logo-container">
                <img src="{{ public_path('Images/Guantes.png') }}" class="logo" alt="Logo Empresa">
            </td>
            <td class="title-container">
                <h1>Reporte de Ajustes de Producto Terminado</h1>
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
                <th>Lote / Producto</th>
                <th class="col-center">Tipo</th>
                <th class="col-number">Cantidad (pzs)</th>
                <th>Motivo</th>
                <th>Registrado por</th>
                <th class="col-center">Fecha y Hora</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ajustes as $index => $ajuste)
                <tr class="{{ $index % 2 === 0 ? 'bg-gray' : '' }}">
                    <td>
                        <div class="font-bold">{{ $ajuste->lote->productos->nombre_modelo ?? 'N/A' }}</div>
                        <div class="font-mono">Código: {{ $ajuste->lote->codigo_barras ?? 'S/C' }}</div>
                    </td>
                    <td class="col-center">
                        @if ($ajuste->tipo_ajuste === 'aumentar')
                            <span class="text-green">+ Aumento</span>
                        @else
                            <span class="text-red">- Disminución</span>
                        @endif
                    </td>
                    <td class="col-number font-bold">{{ number_format($ajuste->cantidad) }}</td>
                    <td>{{ $ajuste->motivo }}</td>
                    <td>{{ $ajuste->user->name ?? 'N/A' }}</td>
                    <td class="col-center">{{ $ajuste->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="col-center" style="padding: 30px; color: #64748b;">
                        No se encontraron registros para los filtros seleccionados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>

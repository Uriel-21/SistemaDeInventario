<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Devoluciones</title>
    <style>
        @page {
            margin: 40px 50px;
        }

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 12px;
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
            font-size: 22px;
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
            padding: 12px 10px;
            text-align: left;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .data-table td {
            padding: 10px;
            border-bottom: 1px solid #e2e8f0;
            color: #334155;
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
                <h1>Reporte de Devoluciones</h1>
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
                <th>Material</th>
                <th class="col-number">Cantidad (dm)</th>
                <th>Proveedor</th>
                <th>Registrado por</th>
                <th class="col-center">Fecha y Hora</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($devoluciones as $index => $devolucion)
                <tr class="{{ $index % 2 === 0 ? 'bg-gray' : '' }}">
                    <td>{{ $devolucion->materiaPrima->nombre ?? 'N/A' }}</td>
                    <td class="col-number font-bold">{{ number_format($devolucion->cantidad_dm, 2) }}</td>
                    <td>{{ $devolucion->proveedor }}</td>
                    <td>{{ $devolucion->user->name ?? 'N/A' }}</td>
                    <td class="col-center">{{ $devolucion->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="col-center" style="padding: 30px; color: #64748b;">
                        No se encontraron registros para los filtros seleccionados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>

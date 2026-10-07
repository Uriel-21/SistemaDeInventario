<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Entradas</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #333;
        }

        .cabecera {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #D99B00;
            padding-bottom: 10px;
        }

        .cabecera h1 {
            color: #1a202c;
            margin: 0;
            font-size: 20px;
            text-transform: uppercase;
        }

        .fecha {
            font-size: 10px;
            color: #666;
            text-align: right;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            background-color: #f3f4f6;
            padding: 10px;
            border: 1px solid #cbd5e1;
            text-align: center;
            font-weight: bold;
        }

        td {
            padding: 8px;
            border: 1px solid #cbd5e1;
            text-align: center;
        }

        .bg-gray {
            background-color: #f8fafc;
        }
    </style>
</head>

<body>
    <div class="fecha">
        Generado el: {{ \Carbon\Carbon::now('America/Mexico_City')->format('d/m/Y H:i') }}
    </div>

    <div class="cabecera">
        <h1>Reporte de Entradas de Materia Prima</h1>
    </div>

    <table>
        <thead>
            <tr>
                <th>Material</th>
                <th>Cantidad (dm)</th>
                <th>Proveedor</th>
                <th>Registrado por</th>
                <th>Fecha y Hora</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($entradas as $index => $entrada)
                <tr class="{{ $index % 2 === 0 ? 'bg-gray' : '' }}">
                    <td>{{ $entrada->materiaPrima->nombre ?? 'N/A' }}</td>
                    <td>{{ number_format($entrada->cantidad_dm, 2) }}</td>
                    <td>{{ $entrada->proveedor }}</td>
                    <td>{{ $entrada->user->name ?? 'N/A' }}</td>
                    <td>{{ $entrada->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No se encontraron registros para los filtros seleccionados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>

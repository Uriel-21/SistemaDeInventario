<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <style>
        @page {
            margin: 0px;
        }

        html,
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }

        .contenedor-pagina {
            height: 96%;
            width: 92%;
            margin: 2% 4%;
        }

        .etiqueta {
            height: 18.5%;
            margin-bottom: 1.8%;
            border: 2px solid #1e293b;
            border-radius: 6px;
            box-sizing: border-box;
            text-align: center;
        }

        .etiqueta:last-child {
            margin-bottom: 0;
        }

        .texto-info {
            font-size: 12px;
            font-weight: bold;
            margin: 6px 0 4px 0;
            color: #000;
        }

        .imagen-barras {
            height: 45px;
            width: auto;
            margin: 0;
        }

        .texto-codigo {
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 2px;
            margin: 3px 0 0 0;
        }
    </style>
</head>

<body>
    <div class="contenedor-pagina">
        @foreach ($etiquetas as $etiqueta)
            <div class="etiqueta">
                <p class="texto-info">
                    {{ $etiqueta['modelo'] }} - Talla: {{ $etiqueta['talla'] }}
                </p>

                <img class="imagen-barras" src="data:image/png;base64,{{ $etiqueta['codigo_base64'] }}" alt="Código">

                <p class="texto-codigo">{{ $etiqueta['codigo'] }}</p>
            </div>
        @endforeach
    </div>
</body>

</html>

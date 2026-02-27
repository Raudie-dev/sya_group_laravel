<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro {{ $registro->id }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; line-height: 1.4; }
        h1 { font-size: 18px; }
        h2 { font-size: 14px; margin-top: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 5px; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <h1>Registro #{{ $registro->id }}</h1>
    <p><strong>Título:</strong> {{ $registro->titulo_informe }}</p>
    <p><strong>Código:</strong> {{ $registro->codigo_informe }}</p>
    <p><strong>Empresa:</strong> {{ $registro->empresa_nombre }}</p>
    <p><strong>Fecha emisión:</strong> {{ \Carbon\Carbon::parse($registro->fecha_emision)->format('d/m/Y') }}</p>
    <p><strong>Proyecto:</strong> {{ $registro->nombre_proyecto }}</p>

    @if($registro->formulario)
        <h2>Formulario Asociado</h2>
        <p><strong>Inspector:</strong> {{ $registro->formulario->inspector_nombre }}</p>
        <p><strong>Dirección muestreo:</strong> {{ $registro->formulario->direccion_muestreo }}</p>
        <p><strong>Observaciones:</strong> {{ $registro->formulario->observaciones }}</p>

        <h2>Anexos</h2>
        <ul>
            @foreach(range(1,4) as $i)
                @if($registro->formulario->{'anexo_'.$i.'_file'})
                    <li>
                        {{ $registro->formulario->{'anexo_'.$i.'_titulo'} ?? 'Anexo '.$i }}
                    </li>
                @endif
            @endforeach
        </ul>
    @endif
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>RVMR - {{ $registro->codigo_informe }}</title>
    <style>
        @page {
            size: A4;
            margin: 2cm 1cm 2.5cm 1cm;
        }

        .page-number:before { content: "Página " counter(page) " de 2"; }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: Arial, sans-serif;
            color: #333;
            font-size: 9pt;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .pagina {
            page-break-after: always;
            display: block;
        }
        .pagina:last-child { page-break-after: auto; }

        /* ── HEADER ── */
        .page-header {
            display: table;
            width: 100%;
            border-bottom: 2px solid #333;
            padding: 0.4cm 0.8cm 0.3cm 0.8cm;
            margin-bottom: 0.3cm;
        }
        .col-logo {
            display: table-cell;
            width: 22%;
            vertical-align: middle;
        }
        .col-logo img { height: 1.2cm; object-fit: contain; }
        .col-titulo {
            display: table-cell;
            width: 48%;
            text-align: center;
            vertical-align: middle;
            font-size: 10pt;
            font-weight: bold;
            color: #333;
            letter-spacing: 0.5px;
            line-height: 1.4;
        }
        .col-meta {
            display: table-cell;
            width: 30%;
            vertical-align: middle;
        }
        .col-meta table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 0;
        }
        .col-meta td {
            border: 1px solid #bbb;
            padding: 2px 5px;
            font-size: 7.5pt;
            vertical-align: middle;
        }
        .m-label {
            font-weight: bold;
            color: #555;
            width: 58%;
            background-color: #f0f0f0 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .m-val { font-weight: bold; color: #222; }

        /* ── CONTENIDO ── */
        .page-content { padding: 0 0.8cm; }

        /* ── TABLAS ── */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0.3cm;
            table-layout: fixed;
        }
        th, td {
            border: 1px solid #333;
            padding: 5px 6px;
            font-size: 8pt;
            word-wrap: break-word;
            vertical-align: middle;
        }

        .th-seccion {
            background-color: #1B3A6B !important;
            color: #fff !important;
            font-weight: bold;
            text-align: center;
            font-size: 8.5pt;
            text-transform: uppercase;
            padding: 7px 6px;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .th-col {
            background-color: #E0E0E0 !important;
            font-weight: bold;
            text-align: center;
            font-size: 7.5pt;
            padding: 5px 4px;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .td-label {
            font-weight: bold;
            background-color: #EFEFEF !important;
            text-align: center;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .td-val { background-color: #fff; }
        .td-cumple   { font-weight: bold; text-align: center; font-size: 8pt; background-color: #fff; }
        .td-nocumple { font-weight: bold; text-align: center; font-size: 8pt; color: #c00; background-color: #fff; }

        /* Checkbox cuadrado (SI/NO aplica) */
        .chk-box {
            display: inline-block;
            width: 12px; height: 12px;
            border: 1.5px solid #555;
            text-align: center;
            line-height: 11px;
            font-size: 8pt;
            font-weight: bold;
            vertical-align: middle;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .chk-box.on {
            background-color: #1B3A6B !important;
            color: #fff !important;
            border-color: #1B3A6B !important;
        }

        /* Marca de verificación (cumple/no_cumple) — cuadrado CSS puro, sin Unicode */
        .mark-si {
            display: inline-block;
            width: 12px; height: 12px;
            background-color: #1B3A6B !important;
            border: 1px solid #1B3A6B;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .mark-no {
            display: inline-block;
            width: 12px; height: 12px;
            border: 1px solid #aaa;
        }

        .obs-col { font-size: 7.5pt; color: #444; vertical-align: top; padding-top: 5px; }
        .criterio { font-size: 7pt; color: #666; font-style: italic; text-align: center; }

        .firma-cell {
            text-align: center; height: 1.3cm;
            vertical-align: middle; padding: 2px;
        }
        .firma-cell img { max-height: 1cm; max-width: 3cm; object-fit: contain; }

        .footer-pagina {
            position: absolute; bottom: 1.3cm; right: 1cm;
            font-weight: bold; font-size: 9pt;
        }
        .footer-img { position: absolute; bottom: 0; left: 0; width: 100%; }

        table { page-break-inside: avoid; }
        tr    { page-break-inside: avoid; }
    </style>
</head>
<body>

{{-- ══════════════════════════════════════════════════════
     ÚNICO BLOQUE PHP — todas las variables se definen aquí
     para que estén disponibles en AMBAS páginas
══════════════════════════════════════════════════════ --}}
@php
    $f = $formulario;

    /* ── Helpers ── */
    $chk = function(bool $v): string {
        return $v
            ? '<span class="chk-box on">X</span>'
            : '<span class="chk-box">&nbsp;</span>';
    };

    // CORREGIDO: Solo muestra el cuadrado cuando es true, nada cuando es false
    $mark = function(bool $v): string {
        return $v
            ? '<span class="chk-box on">X</span>'
            : '<span class="chk-box">&nbsp;</span>';
    };

    // CORREGIDO: Verifica explícitamente que exista y sea '1'
    $cumple   = function($arr, $col): bool { 
        return isset($arr['cumple'][$col]) && $arr['cumple'][$col] === '1'; 
    };
    
    // CORREGIDO: Verifica explícitamente que exista y sea '1'  
    $noCumple = function($arr, $col): bool { 
        return isset($arr['no_cumple'][$col]) && $arr['no_cumple'][$col] === '1'; 
    };
    
    $val      = function($arr, $col): string { 
        return $arr['valores'][$col] ?? ''; 
    };

    /* ── Datos del formulario ── */
    $env = $f->envases_externos         ?? [];
    $sOp = $f->sonda_operatividad       ?? [];
    $sVr = $f->sonda_verificacion       ?? [];
    $mOp = $f->muestreador_operatividad ?? [];
    $mVr = $f->muestreador_verificacion ?? [];
    $pOp = $f->ph_operatividad          ?? [];
    $pVr = $f->ph_verificacion          ?? [];

    /* ── Definiciones de columnas — disponibles en AMBAS páginas ── */
    $envCols = [
        'sin_preservante' => 'Envases sin preservante',
        'con_preservante' => 'Envases con preservante',
        'limpieza'        => 'Limpieza (Lote Lavado)',
        'identificacion'  => 'Identificación y Rótulo',
        'gelpack'         => 'Gelpack o refrig. en cantidad suficiente',
    ];

    $sondaOpCols = [
        'envase_exterior'    => 'Envase exterior',
        'apreciacion_visual' => 'Apreciación visual sonda y componentes (cables, buffer, conectores)',
        'prueba_encendido'   => 'Prueba de Encendido',
        'prueba_conexion_pc' => 'Prueba de conexión a PC, si aplica',
    ];
    $sondaVrCols = [
        'ph'           => 'pH',
        'temperatura'  => 'Temperatura',
        'od'           => 'OD',
        'ce_salinidad' => 'CE/Salinidad',
    ];

    $muestOpCols = [
        'estado_envases'     => 'Estado adecuado envases',
        'apreciacion_visual' => 'Apreciación visual de equipo y sus componentes (cables, mangueras, conectores)',
        'prueba_encendido'   => 'Prueba de Encendido',
        'estado_bateria'     => 'Estado de Batería',
        'gelpack'            => 'Gel pack o Refrig.',
    ];

    $phOpCols = [
        'estado_envase_exterior' => 'Estado adecuado envase exterior',
        'apreciacion_visual'     => 'Apreciación visual (cables, buffer)',
        'prueba_encendido'       => 'Prueba de Encendido',
        'prueba_conexion_pc'     => 'Prueba de conexión a PC, si aplica',
    ];
@endphp


{{-- ══════════════════════════════════════════
     PÁGINA 1 — Datos + Envases + Sonda
══════════════════════════════════════════ --}}
<div class="pagina">

    <div class="page-header">
        <div class="col-logo">
            <img src="{{ public_path('images/logo.png') }}" alt="SyA Group">
        </div>
        <div class="col-titulo">
            REGISTRO VERIFICACIÓN ENVASES Y EQUIPOS EN TERRENO<br>
            <span style="font-size:9pt; font-weight:normal">MUESTREO RILES</span>
        </div>
        <div class="col-meta">
            <table>
                <tr><td class="m-label">Identificación</td><td class="m-val">RVMR</td></tr>
                <tr><td class="m-label">Fecha Vigencia:</td><td class="m-val">18-04-2024</td></tr>
                <tr><td class="m-label">Versión</td><td class="m-val">04</td></tr>
            </table>
        </div>
    </div>

    <div class="page-content">

        {{-- DATOS GENERALES --}}
        <table>
            <tr>
                <td class="td-label" style="width:22%">Proyecto</td>
                <td class="td-val" colspan="3">{{ $f->proyecto ?? '' }}</td>
            </tr>
            <tr>
                <td class="td-label">Fecha</td>
                <td class="td-val" style="width:26%">
                    {{ $f->fecha ? \Carbon\Carbon::parse($f->fecha)->format('d/m/Y') : '' }}
                </td>
                <td class="td-label" style="width:24%; font-weight:bold">Cadena de Custodia N°:</td>
                <td class="td-val" style="width:28%">{{ $f->cadena_custodia ?? '' }}</td>
            </tr>
            <tr>
                <td class="td-label">Responsable Verificación</td>
                <td class="td-val">{{ $f->responsable_verificacion ?? '' }}</td>
                <td class="td-label" style="font-weight:bold; text-align:center">Firma:</td>
                <td class="firma-cell">
                    @if($f->firma_verificacion_file)
                        <img src="{{ storage_path('app/public/' . $f->firma_verificacion_file) }}" alt="Firma">
                    @endif
                </td>
            </tr>
        </table>

        {{-- ENVASES EXTERNOS --}}
        <table>
            <colgroup>
                <col style="width:14%">
                <col style="width:14%">
                <col style="width:14%">
                <col style="width:14%">
                <col style="width:14%">
                <col style="width:15%">
                <col style="width:15%">
            </colgroup>
            <tr>
                <td colspan="7" class="th-seccion">
                    VERIFICACIÓN DE ENVASES EXTERNOS (PROPORCIONADOS POR LABORATORIO)
                </td>
            </tr>
            <tr>
                <td class="th-col">Verificación</td>
                @foreach($envCols as $label)
                    <td class="th-col">{{ $label }}</td>
                @endforeach
                <td class="th-col">Observaciones</td>
            </tr>
            <tr>
                <td class="td-cumple">Cumple</td>
                @foreach(array_keys($envCols) as $col)
                    <td style="text-align:center">{!! $mark($cumple($env, $col)) !!}</td>
                @endforeach
                <td class="obs-col" rowspan="2">{{ $env['observaciones'] ?? '' }}</td>
            </tr>
            <tr>
                <td class="td-nocumple">No Cumple</td>
                @foreach(array_keys($envCols) as $col)
                    <td style="text-align:center">{!! $mark($noCumple($env, $col)) !!}</td>
                @endforeach
            </tr>
        </table>

        {{-- SONDA MULTIPARÁMETROS --}}
        <table>
            <colgroup>
                <col style="width:16%">
                <col style="width:11%">
                <col style="width:15%">
                <col style="width:12%">
                <col style="width:13%">
                <col style="width:13%">
                <col style="width:10%">
                <col style="width:10%">
            </colgroup>

            <tr>
                <td class="th-seccion" colspan="3">SONDAS MULTIPARÁMETROS</td>
                <td class="th-col" style="text-align:center">APLICA</td>
                <td class="th-col" style="text-align:center">SI</td>
                <td style="text-align:center">{!! $chk($f->sonda_aplica ?? false) !!}</td>
                <td class="th-col" style="text-align:center">NO</td>
                <td style="text-align:center">{!! $chk(!($f->sonda_aplica ?? false)) !!}</td>
                {{-- <td></td> --}}
            </tr>
            <tr>
                <td class="th-col" style="text-align:center">MARCA</td>
                <td colspan="2" style="text-align:center; font-weight:bold; font-size:8pt">{{ $f->sonda_marca ?? '' }}</td>
                <td class="th-col" style="text-align:center">MODELO</td>
                <td colspan="2" style="text-align:center; font-size:8pt">{{ $f->sonda_modelo ?? '' }}</td>
                <td class="th-col" style="text-align:center">SERIE</td>
                <td style="text-align:center; font-size:8pt">{{ $f->sonda_serie ?? '' }}</td>
            </tr>
            <tr>
                <td class="th-col" style="text-align:center">Operatividad</td>
                @foreach($sondaOpCols as $label)
                    <td class="th-col" style="text-align:center">{{ $label }}</td>
                @endforeach
                <td class="th-col" colspan="3" style="text-align:center">Observaciones</td>
            </tr>
            <tr>
                <td class="td-cumple">Cumple</td>
                @foreach(array_keys($sondaOpCols) as $col)
                    <td style="text-align:center">{!! $mark($cumple($sOp, $col)) !!}</td>
                @endforeach
                <td class="obs-col" colspan="3" rowspan="2">{{ $f->sonda_observaciones ?? '' }}</td>
            </tr>
            <tr>
                <td class="td-nocumple">No Cumple</td>
                @foreach(array_keys($sondaOpCols) as $col)
                    <td style="text-align:center">{!! $mark($noCumple($sOp, $col)) !!}</td>
                @endforeach
            </tr>
            <tr>
                <td class="td-label">Verificación Rápida</td>
                @foreach($sondaVrCols as $label)
                    <td class="th-col" style="text-align:center">{{ $label }}</td>
                @endforeach
                <td colspan="3"></td>
            </tr>
            <tr>
                <td class="td-cumple">Cumple</td>
                @foreach(array_keys($sondaVrCols) as $col)
                    <td style="text-align:center">{!! $mark($cumple($sVr, $col)) !!}</td>
                @endforeach
                <td colspan="3"></td>
            </tr>
            <tr>
                <td class="td-nocumple">No Cumple</td>
                @foreach(array_keys($sondaVrCols) as $col)
                    <td style="text-align:center">{!! $mark($noCumple($sVr, $col)) !!}</td>
                @endforeach
                <td colspan="3"></td>
            </tr>
            <tr>
                <td class="td-label" style="font-size:7.5pt">N° Lote Buffer pH</td>
                <td colspan="4" style="text-align:center; font-size:7.5pt">{{ $f->sonda_lote_buffer ?? '' }}</td>
                <td colspan="3" class="criterio">Criterio aceptación Buffer ± 0,1 pH</td>
            </tr>
        </table>

    </div>

    <div class="footer-pagina"><span class="page-number"></span></div>
    <img src="{{ public_path('images/footer.png') }}" class="footer-img">
</div>


{{-- ══════════════════════════════════════════
     PÁGINA 2 — Muestreador + pH Portátil
══════════════════════════════════════════ --}}
<div class="pagina">

    <div class="page-header">
        <div class="col-logo">
            <img src="{{ public_path('images/logo.png') }}" alt="SyA Group">
        </div>
        <div class="col-titulo">
            REGISTRO VERIFICACIÓN ENVASES Y EQUIPOS EN TERRENO<br>
            <span style="font-size:9pt; font-weight:normal">MUESTREO RILES</span>
        </div>
        <div class="col-meta">
            <table>
                <tr><td class="m-label">Identificación</td><td class="m-val">RVMR</td></tr>
                <tr><td class="m-label">Fecha Vigencia:</td><td class="m-val">18-04-2024</td></tr>
                <tr><td class="m-label">Versión</td><td class="m-val">04</td></tr>
            </table>
        </div>
    </div>

    <div class="page-content">

        {{-- MUESTREADOR AUTOMÁTICO --}}
        <table>
            <colgroup>
                <col style="width:14%">
                <col style="width:11%">
                <col style="width:14%">
                <col style="width:10%">
                <col style="width:10%">
                <col style="width:10%">
                <col style="width:10%">
                <col style="width:10%">
                <col style="width:11%">
            </colgroup>

            <tr>
                <td class="th-seccion" colspan="4">MUESTREADOR AUTOMÁTICO</td>
                <td class="th-col" style="text-align:center">APLICA</td>
                <td class="th-col" style="text-align:center">SI</td>
                <td style="text-align:center">{!! $chk($f->muestreador_aplica ?? false) !!}</td>
                <td class="th-col" style="text-align:center">NO</td>
                <td style="text-align:center">{!! $chk(!($f->muestreador_aplica ?? false)) !!}</td>
                {{-- <td colspan="2"></td> --}}
            </tr>
            <tr>
                <td class="th-col" style="text-align:center">MARCA</td>
                <td colspan="2" style="text-align:center; font-weight:bold">{{ $f->muestreador_marca ?? '' }}</td>
                <td class="th-col" style="text-align:center">MODELO</td>
                <td colspan="2" style="text-align:center">{{ $f->muestreador_modelo ?? '' }}</td>
                <td class="th-col" style="text-align:center">SERIE</td>
                <td colspan="2" style="text-align:center; font-size:7.5pt">{{ $f->muestreador_serie ?? '' }}</td>
            </tr>
            <tr>
                <td class="th-col" style="text-align:center">Operatividad</td>
                @foreach($muestOpCols as $label)
                    <td class="th-col" style="text-align:center">{{ $label }}</td>
                @endforeach
                <td class="th-col" colspan="3" style="text-align:center">Observaciones</td>
            </tr>
            <tr>
                <td class="td-cumple">Cumple</td>
                @foreach(array_keys($muestOpCols) as $col)
                    <td style="text-align:center">{!! $mark($cumple($mOp, $col)) !!}</td>
                @endforeach
                <td class="obs-col" colspan="3" rowspan="2">{{ $f->muestreador_observaciones ?? '' }}</td>
            </tr>
            <tr>
                <td class="td-nocumple">No Cumple</td>
                @foreach(array_keys($muestOpCols) as $col)
                    <td style="text-align:center">{!! $mark($noCumple($mOp, $col)) !!}</td>
                @endforeach
            </tr>
            <tr>
                <td class="td-label" rowspan="2">Verificación</td>
                <td class="th-col" colspan="3" style="text-align:center">pH</td>
                <td class="th-col" style="text-align:center">Temperatura</td>
                <td class="th-col" style="text-align:center">OD</td>
                <td class="th-col" style="text-align:center">Conductividad</td>
                <td class="th-col" style="text-align:center">Sonda Caudal</td>
                <td class="th-col" style="text-align:center">Observaciones</td>
            </tr>
            <tr>
                <td class="th-col" style="text-align:center; font-size:7pt">pH 4</td>
                <td class="th-col" style="text-align:center; font-size:7pt">pH 7</td>
                <td class="th-col" style="text-align:center; font-size:7pt">pH 10</td>
                <td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td class="td-cumple">Cumple</td>
                @foreach(['ph4','ph7','ph10','temperatura','od','conductividad','sonda_caudal'] as $col)
                    <td style="text-align:center">{!! $mark($cumple($mVr, $col)) !!}</td>
                @endforeach
                <td class="obs-col" rowspan="2">{{ $mVr['observaciones'] ?? '' }}</td>
            </tr>
            <tr>
                <td class="td-nocumple">No Cumple</td>
                @foreach(['ph4','ph7','ph10','temperatura','od','conductividad','sonda_caudal'] as $col)
                    <td style="text-align:center">{!! $mark($noCumple($mVr, $col)) !!}</td>
                @endforeach
            </tr>
            <tr>
                <td class="td-label" style="font-size:7.5pt">N° Lote Buffer pH</td>
                <td colspan="5" class="criterio">Criterio aceptación Buffer ± 0,1 pH</td>
                <td colspan="3" style="text-align:center; font-size:7.5pt">{{ $f->muestreador_lote_buffer ?? '' }}</td>
            </tr>
        </table>

        {{-- pH PORTÁTIL --}}
        <table>
            <colgroup>
                <col style="width:12%">
                <col style="width:11%">
                <col style="width:11%">
                <col style="width:10%">
                <col style="width:10%">
                <col style="width:7%">
                <col style="width:8%">
                <col style="width:7%">
                <col style="width:8%">
                <col style="width:16%">
            </colgroup>

            <tr>
                <td class="th-seccion" colspan="2">pH PORTÁTIL</td>
                <td class="th-col" style="text-align:center">APLICA</td>
                <td class="th-col" style="text-align:center">SI</td>
                <td style="text-align:center">{!! $chk($f->ph_aplica ?? false) !!}</td>
                <td class="th-col" style="text-align:center">NO</td>
                <td style="text-align:center">{!! $chk(!($f->ph_aplica ?? false)) !!}</td>
                <td class="th-col" style="text-align:center">Modelo</td>
                <td style="text-align:center; font-size:7.5pt">{{ $f->ph_modelo ?? '' }}</td>
                <td style="text-align:left; font-size:7pt">
                    <strong>N° Serie:</strong> {{ $f->ph_serie ?? '' }}
                </td>
            </tr>
            <tr>
                <td class="th-col" style="text-align:center">Operatividad</td>
                @foreach($phOpCols as $label)
                    <td class="th-col" style="text-align:center">{{ $label }}</td>
                @endforeach
                <td class="th-col" colspan="5" style="text-align:center">Observaciones</td>
            </tr>
            <tr>
                <td class="td-cumple">Cumple</td>
                @foreach(array_keys($phOpCols) as $col)
                    <td style="text-align:center">{!! $mark($cumple($pOp, $col)) !!}</td>
                @endforeach
                <td class="obs-col" colspan="5" rowspan="2">{{ $f->ph_observaciones ?? '' }}</td>
            </tr>
            <tr>
                <td class="td-nocumple">No Cumple</td>
                @foreach(array_keys($phOpCols) as $col)
                    <td style="text-align:center">{!! $mark($noCumple($pOp, $col)) !!}</td>
                @endforeach
            </tr>
            <tr>
                <td class="td-label">Verificación</td>
                <td class="th-col" colspan="2" style="text-align:center">pH 4</td>
                <td class="th-col" colspan="2" style="text-align:center">pH 7</td>
                <td class="th-col" colspan="2" style="text-align:center">pH 10</td>
                <td class="th-col" colspan="2" style="text-align:center">Temperatura</td>
                <td class="th-col" style="text-align:center">Observaciones</td>
            </tr>
            <tr>
                <td class="td-cumple">Cumple</td>
                @foreach(['ph4','ph7','ph10','temperatura'] as $col)
                    <td style="text-align:center">{!! $mark($cumple($pVr, $col)) !!}</td>
                    <td style="text-align:center; font-size:8pt; font-weight:bold">{{ $val($pVr, $col) }}</td>
                @endforeach
                <td class="obs-col" rowspan="2">{{ $pVr['observaciones'] ?? '' }}</td>
            </tr>
            <tr>
                <td class="td-nocumple">No Cumple</td>
                @foreach(['ph4','ph7','ph10','temperatura'] as $col)
                    <td style="text-align:center">{!! $mark($noCumple($pVr, $col)) !!}</td>
                    <td></td>
                @endforeach
            </tr>
            <tr>
                <td class="td-label" style="font-size:7.5pt">N° Lote Buffer pH</td>
                <td colspan="2" style="text-align:center; font-size:7.5pt">{{ $f->ph_lote_buffer_4  ?? '' }}</td>
                <td colspan="2" style="text-align:center; font-size:7.5pt">{{ $f->ph_lote_buffer_7  ?? '' }}</td>
                <td colspan="2" style="text-align:center; font-size:7.5pt">{{ $f->ph_lote_buffer_10 ?? '' }}</td>
                <td colspan="3" class="criterio">Criterio aceptación Buffer ± 0,1 pH</td>
            </tr>
        </table>

    </div>

    <div class="footer-pagina"><span class="page-number"></span></div>
    <img src="{{ public_path('images/footer.png') }}" class="footer-img">
</div>

</body>
</html>
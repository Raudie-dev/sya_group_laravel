<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CMCL - {{ $registro->codigo_informe }}</title>
    <style>
        @page {
            size: A4;
            margin: 2cm 1cm 2.5cm 1cm;
        }

        .page-number:before { content: "Página " counter(page); }

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
            margin-bottom: 0.35cm;
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
            font-size: 11pt;
            font-weight: bold;
            color: #333;
            letter-spacing: 0.5px;
            line-height: 1.3;
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
            width: 55%;
            background-color: #f0f0f0 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .m-val { font-weight: bold; color: #222; }

        /* ── CONTENIDO ── */
        .page-content { padding: 0 0.8cm; }

        /* ── TABLA DATOS INICIALES ── */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0.35cm;
            table-layout: fixed;
        }
        th, td {
            border: 1px solid #333;
            padding: 5px 7px;
            font-size: 8.5pt;
            word-wrap: break-word;
            vertical-align: middle;
        }

        .td-label {
            font-weight: bold;
            background-color: #fff;
            width: 30%;
        }
        .td-val { background-color: #fff; }

        /* ── TABLA DE REGISTROS ── */
        .th-col {
            background-color: #1B3A6B !important;
            color: #fff !important;
            font-weight: bold;
            text-align: center;
            font-size: 8pt;
            padding: 6px 5px;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .td-registro {
            font-size: 8pt;
            text-align: center;
            vertical-align: middle;
            padding: 5px 5px;
            min-height: 1.4cm;
        }
        .td-obs {
            font-size: 8pt;
            vertical-align: top;
            padding: 5px 7px;
        }

        /* Checkboxes Aprobado/Rechazado */
        .chk-box {
            display: inline-block;
            width: 11px; height: 11px;
            border: 1.5px solid #555;
            text-align: center;
            line-height: 10px;
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
        .criterio-label {
            font-size: 7.5pt;
            display: block;
            margin-bottom: 3px;
            text-align: left;
        }

        /* ── LEYENDA ── */
        .leyenda {
            margin-top: 0.3cm;
            font-size: 8pt;
        }
        .leyenda strong { font-weight: bold; }

        /* Footer */
        .footer-pagina {
            position: absolute;
            bottom: 1.3cm;
            right: 1cm;
            font-weight: bold;
            font-size: 9pt;
        }
        .footer-img {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
        }

        table { page-break-inside: auto; }
        tr    { page-break-inside: avoid; }
    </style>
</head>
<body>

@php
    $f    = $formulario;
    $rows = $f->registros ?? [];

    $chk = function(bool $v): string {
        return $v
            ? '<span class="chk-box on">X</span>'
            : '<span class="chk-box">&nbsp;</span>';
    };
@endphp

<div class="pagina">

    {{-- HEADER --}}
    <div class="page-header">
        <div class="col-logo">
            <img src="{{ public_path('images/logo.png') }}" alt="SyA Group">
        </div>
        <div class="col-titulo">Control equipo medidor de cloro libre residual</div>
        <div class="col-meta">
            <table>
                <tr><td class="m-label">Código:</td><td class="m-val">CMCL</td></tr>
                <tr><td class="m-label">Versión:</td><td class="m-val">1</td></tr>
                <tr><td class="m-label">Página:</td><td class="m-val">1 de 1</td></tr>
                <tr><td class="m-label">Fecha vigencia:</td><td class="m-val">04-09-2020</td></tr>
            </table>
        </div>
    </div>

    <div class="page-content">

        {{-- DATOS DEL EQUIPO --}}
        <table style="width:55%; margin-bottom:0.4cm">
            <tr>
                <td class="td-label">Frecuencia de control</td>
                <td class="td-val">{{ $f->frecuencia_control ?? 'cada uso' }}</td>
            </tr>
            <tr>
                <td class="td-label">Equipo (código)</td>
                <td class="td-val">{{ $f->equipo_codigo ?? '' }}</td>
            </tr>
        </table>

        {{-- TABLA DE REGISTROS --}}
        <table>
            <colgroup>
                <col style="width:10%">  {{-- Fecha --}}
                <col style="width:12%">  {{-- Responsable --}}
                <col style="width:10%">  {{-- Conc. estándar --}}
                <col style="width:13%">  {{-- Criterio --}}
                <col style="width:10%">  {{-- Estado celdas --}}
                <col style="width:10%">  {{-- Estado equipo --}}
                <col style="width:35%">  {{-- Observaciones --}}
            </colgroup>
            <tr>
                <td class="th-col">Fecha</td>
                <td class="th-col">Responsable</td>
                <td class="th-col">Conc. estándar (mg/l)</td>
                <td class="th-col">Criterio</td>
                <td class="th-col">Estado de las celdas</td>
                <td class="th-col">Estado del equipo</td>
                <td class="th-col">Observaciones</td>
            </tr>
            @forelse($rows as $row)
                <tr>
                    <td class="td-registro">
                        {{ !empty($row['fecha']) ? \Carbon\Carbon::parse($row['fecha'])->format('d/m/Y') : '' }}
                    </td>
                    <td class="td-registro">{{ $row['responsable'] ?? '' }}</td>
                    <td class="td-registro">{{ $row['conc_estandar'] ?? '' }}</td>
                    <td class="td-registro" style="text-align:left; padding-left:8px">
                        <span class="criterio-label">
                            {!! $chk(!empty($row['aprobado'])) !!} Aprobado
                        </span>
                        <span class="criterio-label">
                            {!! $chk(!empty($row['rechazado'])) !!} Rechazado
                        </span>
                    </td>
                    <td class="td-registro">{{ $row['estado_celdas'] ?? '' }}</td>
                    <td class="td-registro">{{ $row['estado_equipo'] ?? '' }}</td>
                    <td class="td-obs">{{ $row['observaciones'] ?? '' }}</td>
                </tr>
            @empty
                {{-- Filas vacías si no hay datos --}}
                @for($i = 0; $i < 6; $i++)
                    <tr>
                        <td class="td-registro" style="height:1.4cm"></td>
                        <td class="td-registro"></td>
                        <td class="td-registro"></td>
                        <td class="td-registro" style="text-align:left; padding-left:8px">
                            <span class="criterio-label">{!! $chk(false) !!} Aprobado</span>
                            <span class="criterio-label">{!! $chk(false) !!} Rechazado</span>
                        </td>
                        <td class="td-registro"></td>
                        <td class="td-registro"></td>
                        <td class="td-obs"></td>
                    </tr>
                @endfor
            @endforelse
        </table>

        {{-- LEYENDA --}}
        <div class="leyenda">
            <p><strong>Estado:</strong></p>
            <p style="margin-top:3px">1.- Buen estado &nbsp;&nbsp;&nbsp;&nbsp; 4.- Rayado</p>
            <p>2.- Sucio</p>
            <p>3.- Roto</p>
        </div>

    </div>

    <div class="footer-pagina"><span class="page-number"></span></div>
    <img src="{{ public_path('images/footer.png') }}" class="footer-img">
</div>

</body>
</html>
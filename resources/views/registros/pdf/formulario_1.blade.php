<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Informe de Terreno - {{ $registro->codigo_informe }}</title>
    <style>
        /* ══ PÁGINA ══ */
        @page {
            size: A4;
            margin: 2cm 1cm 2.5cm 1cm;
        }
        @page :first {
            margin: 0; /* La portada suele ser sin márgenes */
        }
        .page-number:before {
            content: "Página " counter(page);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            margin: 0; 
            padding: 0;
            font-family: Arial, sans-serif;
            color: #333;
            font-size: 9pt;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* ══ PORTADA ══ */
        .portada {
            width: 21cm;
            height: 29.7cm;
            background: #fff;
            page-break-after: always;
        }

        .portada-logo-top {
            position: absolute;
            top: 1cm;
            left: 1cm;
            z-index: 10;
        }

        .portada-logo-top img {
            height: 1.8cm;
            object-fit: contain;
        }

        .portada-contenido {
            position: absolute;
            top: 7.5cm;
            left: 0;
            right: 0;
            text-align: center;
            padding: 0 2cm;
            z-index: 10;
        }

        .portada-titulo-bloque {
            display: inline-block;
            text-align: center;
            margin-bottom: 0.2cm;
        }

        .portada-titulo-bloque h1 {
            font-size: 20pt;
            font-weight: bold;
            color: #333;
            padding: 4px 16px;
            margin: 3px 0;
            display: inline-block;
            line-height: 1.2;
            text-transform: uppercase;
        }

        .portada-titulo-bloque h1.grande { font-size: 20pt; /* text-transform: none; */}
        .portada-titulo-bloque h1.mediano { font-size: 16pt; }
        .portada-titulo-bloque h1.chico { font-size: 14pt; }

        .portada-codigo {
            margin-top: 1cm;
            text-align: center;
        }

        .portada-codigo span {
            padding: 4px 10px;
            font-size: 12pt;
            font-weight: bold;
            color: #333;
        }

        .portada-logos-footer {
            position: absolute;
            bottom: 9.5cm;
            left: 0;
            right: 0;
            display: table;
            width: 100%;
            padding: 0 2cm;
            z-index: 10;
        }

        .portada-logos-footer .col {
            display: table-cell;
            width: 50%;
            text-align: center;
            vertical-align: bottom;
        }

        .portada-logos-footer p {
            font-size: 9pt;
            font-weight: bold;
            margin-bottom: 0.3cm;
        }

        .portada-logos-footer img {
            max-height: 2.2cm;
            max-width: 6cm;
            object-fit: contain;
        }

        .portada-logos-footer .logo-placeholder {
            border: 1px solid #ccc;
            height: 2.2cm;
            width: 5cm;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 8pt;
            color: #999;
        }

        .portada-footer-img {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 1;
        }

        .portada-footer-img img {
            width: 100%;
            display: block;
        }

        .portada-footer-texto {
            position: absolute;
            bottom: 0.4cm;
            left: 0;
            right: 0;
            z-index: 20;
            display: table;
            width: 100%;
            padding: 0 1cm;
        }

        .portada-footer-texto .izq {
            display: table-cell;
            text-align: left;
            font-size: 7.5pt;
            color: #555;
            vertical-align: bottom;
        }

        .portada-footer-texto .der {
            display: table-cell;
            text-align: right;
            font-size: 8.5pt;
            font-weight: bold;
            color: #4a7c2f;
            vertical-align: bottom;
        }

        /* ══ PÁGINAS INTERNAS ══ */
        .pagina {
            page-break-after: always;
            display: block;
        }
        
        .pagina:last-child {
            page-break-after: auto;
        }

        /* Header de página interna */
        .page-header {
            display: table;
            width: 100%;
            border-bottom: 2px solid #333;
            padding: 0.4cm 0.8cm 0.3cm 0.8cm;
        }

        .page-header .col-logo {
            display: table-cell;
            width: 25%;
            vertical-align: middle;
        }

        .page-header .col-logo img {
            height: 1.2cm;
            object-fit: contain;
        }

        .page-header .col-titulo {
            display: table-cell;
            width: 50%;
            text-align: center;
            vertical-align: middle;
            font-size: 12pt;
            font-weight: bold;
            color: #333;
            letter-spacing: 1px;
        }

        .page-header .col-logo-cliente {
            display: table-cell;
            width: 25%;
            text-align: right;
            vertical-align: middle;
        }

        .page-header .col-logo-cliente img {
            max-height: 1.2cm;
            max-width: 4cm;
            object-fit: contain;
        }

        .page-header .col-logo-cliente span {
            font-size: 7.5pt;
            color: #999;
            border: 1px solid #ccc;
            padding: 2px 6px;
        }

        /* Contenido de página */
        .page-content {
            flex: 1;
            padding: 0.5cm 0.8cm 0.5cm 0.8cm;
        }

        .fecha-emision {
            font-size: 9.5pt;
            margin-bottom: 0.4cm;
        }

        .fecha-emision strong { font-weight: bold; }

        /* Tablas */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0.4cm;
            table-layout: fixed;
        }

        th, td {
            border: 1px solid #333;
            padding: 5px 8px;
            font-size: 8.5pt;
            word-wrap: break-word;
            vertical-align: middle;
        }

        /* Encabezado de sección — azul oscuro fondo, texto blanco */
        .th-seccion {
            background-color: #1B3A6B !important;
            color: #fff !important;
            font-weight: bold;
            text-align: center;
            font-size: 9.5pt;
            text-transform: uppercase;
            padding: 7px 8px;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* Encabezado de columna — gris claro */
        .th-col {
            background-color: #E0E0E0 !important;
            font-weight: bold;
            text-align: center;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* Celda etiqueta — negrita */
        .td-label {
            font-weight: bold;
            background-color: #fff;
            width: 40%;
        }

        /* Celda valor — fondo amarillo */
        .td-valor {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* Celda valor normal (sin amarillo) */
        .td-normal {
            background-color: #fff;
        }

        /* Fila inicio/fin resultados */
        .tr-resultado td {
            text-align: center;
            font-weight: bold;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .tr-resultado td:first-child {
            font-weight: bold;
        }

        /* Nota al pie de tabla */
        .nota-tabla {
            font-size: 7.5pt;
            text-align: center;
            padding: 4px 8px;
            border: 1px solid #333;
            border-top: none;
            background: #fff;
            margin-bottom: 0.4cm;
        }

        /* Observaciones */
        .obs-titulo {
            background-color: #1B3A6B !important;
            color: #fff !important;
            font-weight: bold;
            text-align: center;
            font-size: 9.5pt;
            text-transform: uppercase;
            padding: 7px 8px;
            border: 1px solid #333;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .obs-cuerpo {
            border: 1px solid #333;
            border-top: none;
            padding: 10px;
            min-height: 1.5cm;
            font-size: 8.5pt;
            text-align: center;
            margin-bottom: 0.4cm;
            white-space: pre-wrap;
        }

        /* Registro fotográfico */
        .foto-titulo {
            background-color: #1B3A6B !important;
            color: #fff !important;
            font-weight: bold;
            text-align: center;
            font-size: 9.5pt;
            text-transform: uppercase;
            padding: 7px 8px;
            border: 1px solid #333;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .foto-box {
            border: 1px solid #333;
            border-top: none;
            text-align: center;
            padding: 10px;
            height: 13cm;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.4cm;
        }

        .foto-box.grande {
            height: 20cm;
        }

        .foto-box img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .foto-box p {
            color: #aaa;
            font-style: italic;
            font-size: 8pt;
        }

        /* Footer de página interna */
        .page-footer {
            background-color: #4a7c2f !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
            display: table;
            width: 100%;
            padding: 0.25cm 0.8cm;
        }

        .page-footer .f-web {
            display: table-cell;
            color: #fff;
            font-size: 8pt;
            font-weight: bold;
            width: 30%;
            vertical-align: middle;
        }

        .page-footer .f-dir {
            display: table-cell;
            color: #fff;
            font-size: 7pt;
            text-align: center;
            width: 50%;
            vertical-align: middle;
        }

        .page-footer .f-pag {
            display: table-cell;
            color: #fff;
            font-size: 8pt;
            font-weight: bold;
            text-align: right;
            width: 20%;
            vertical-align: middle;
        }

        /* Firma */
        .firma-box {
            text-align: center;
            padding: 6px;
            min-height: 1.5cm;
            vertical-align: middle;
        }

        .firma-box img {
            max-height: 1.2cm;
            max-width: 3cm;
            object-fit: contain;
        }

        /* Nota bajo tabla antecedentes */
        .nota-responsabilidad {
            font-size: 7.5pt;
            text-align: center;
            font-weight: bold;
            border: 1px solid #333;
            padding: 5px 8px;
            margin-bottom: 0.4cm;
        }

        /* Anexos — etiqueta fuera de tabla */
        .anexo-label {
            font-size: 9pt;
            font-weight: bold;
            margin-bottom: 0.2cm;
        }

        table { page-break-inside: avoid; }
        tr    { page-break-inside: avoid; }

        .footer-img {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
        }

        .footer-pagina {
            position: absolute;
            bottom: 1.3cm;
            right: 1cm;
            font-weight: bold;
            font-size: 9pt;
        }

        .footer-interno {
    position: relative;
    height: 2cm; /* ajusta según la altura real de footer.png */
}
    </style>
</head>
<body>

{{-- ══════════════════════════════════════════════════════
     PÁGINA 1 — PORTADA
══════════════════════════════════════════════════════ --}}
<div class="portada">

    {{-- Logo empresa arriba izquierda 
    <div class="portada-logo-top">
        <img src="{{ public_path('images/logo.png') }}" alt="Logo Empresa">
    </div>
    --}}

    {{-- Títulos centrales --}}
    <div class="portada-contenido">
        <div class="portada-titulo-bloque">
            <h1 class="grande">{{ $registro->titulo_informe ?? 'INFORME DE TERRENO' }}</h1>
            <br>
            <h1 class="grande">{{ $registro->empresa_nombre ?? '' }}</h1>
            <br>
            @if($registro->fecha_emision ?? null)
                <h1 class="mediano">{{ \Carbon\Carbon::parse($registro->fecha_emision)->locale('es')->isoFormat('MMMM YYYY') }}</h1>
                <br>
            @endif
            <h1 class="chico"> {{ $registro->cliente_direccion ?? '' }}</h1>
            <h1 class="chico"> {{ $registro->region ?? '' }}</h1>
        </div>
        <div class="portada-codigo">
            <span>{{ $registro->codigo_informe }}</span>
        </div>
    </div>

    {{-- Logos inferiores (sobre el fondo) --}}
    <div class="portada-logos-footer">
        <div class="col">
            <p><small>Realizado por:</small></p>
            <img src="{{ public_path('images/logo.png') }}" alt="Logo Empresa">
        </div>
        <div class="col">
            <p><small>Realizado para:</small></p>
            @if($registro->logo_cliente)
                <img src="{{ storage_path('app/public/' . $registro->logo_cliente) }}" alt="Logo Cliente">
            @else
                <div class="logo-placeholder">Logo empresa</div>
            @endif
        </div>
    </div>

    {{-- Imagen de fondo portada --}}
    <div class="portada-footer-img">
        <img src="{{ public_path('images/portada.png') }}" alt="">
    </div>

</div>


{{-- ══════════════════════════════════════════════════════
     PÁGINA 2 — ANTECEDENTES Y MUESTREO
══════════════════════════════════════════════════════ --}}
<div class="pagina">

    <div class="page-header">
        <div class="col-logo">
            <img src="{{ public_path('images/logo.png') }}" alt="Logo Empresa">
        </div>
        <div class="col-titulo">INFORME DE TERRENO</div>
        <div class="col-logo-cliente">
            @if($registro->logo_cliente)
                <img src="{{ storage_path('app/public/' . $registro->logo_cliente) }}" alt="Logo Cliente">
            @else
                <span>Logo empresa</span>
            @endif
        </div>
    </div>

    <div class="page-content">

        <p class="fecha-emision">
            <strong>Fecha de emisión del informe:</strong>&nbsp;
            {{ $registro->fecha_emision
                ? \Carbon\Carbon::parse($registro->fecha_emision)->locale('es')->isoFormat('D [de] MMMM [de] YYYY')
                : '' }}
        </p>

        {{-- SECCIÓN 1: ANTECEDENTES GENERALES --}}
        <table>
            <tr><td colspan="2" class="th-seccion">1. ANTECEDENTES GENERALES</td></tr>
            <tr>
                <td class="td-label">Nombre Cliente</td>
                <td class="">{{ $registro->empresa_nombre ?? '' }}</td>
            </tr>
            <tr>
                <td class="td-label">Dirección</td>
                <td class="">{{ $registro->cliente_direccion ?? '' }}</td>
            </tr>
            <tr>
                <td class="td-label">Comuna / Ciudad</td>
                <td class="">{{ $registro->comuna ?? '' }}</td>
            </tr>
            <tr>
                <td class="td-label">Región</td>
                <td class="">{{ $registro->region ?? '' }}</td>
            </tr>
            <tr>
                <td class="td-label">Nombre Inspector Ambiental</td>
                <td class="td-normal">{{ $formulario->inspector_nombre ?? '' }}</td>
            </tr>
            <tr>
                <td class="td-label">Rut Inspector Ambiental</td>
                <td class="td-normal">{{ $formulario->inspector_rut ?? '' }}</td>
            </tr>
            <tr>
                <td class="td-label">Firma</td>
                <td class="firma-box">
                    <img src="{{ public_path('images/firma.png') }}" alt="firma">
                </td>
            </tr>
            <tr>
                <td class="td-label">Nº RCA</td>
                <td class="">{{ $registro->n_rca ?? '' }}</td>
            </tr>
            <tr>
                <td class="td-label">Nombre del Proyecto Aprobado</td>
                <td class="">{{ $registro->nombre_proyecto ?? '' }}</td>
            </tr>
        </table>
        <div class="nota-responsabilidad">
            Nota: SyA ambiental y el Inspector Ambiental identificado previamente se hace responsable solo por los
            resultados de esta inspección, correspondiente a las actividades solicitadas este informe no puede ser
            reproducido salvo en su totalidad.
        </div>

        {{-- SECCIÓN 2: INFORMACIÓN DE MUESTREO --}}
        <table>
            <thead>
                <tr>
                    <th colspan="4" class="th-seccion">2. INFORMACIÓN DE MUESTREO</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="td-label">Lugar de Muestreo</td>
                    <td colspan="3">{{ $formulario->lugar_muestreo ?? '' }}</td>
                </tr>
                <tr>
                    <td class="td-label">Dirección de Muestreo</td>
                    <td colspan="3">{{ $formulario->direccion_muestreo ?? '' }}</td>
                </tr>
                <tr>
                    <td class="td-label">Identificación Punto de Muestreo</td>
                    <td colspan="3">{{ $formulario->punto_muestreo ?? '' }}</td>
                </tr>
                <tr>
                    <td class="td-label">Fecha y Hora Inicio Muestreo</td>
                    <td colspan="3">
                        @if($formulario->inicio_muestreo)
                            {{ \Carbon\Carbon::parse($formulario->inicio_muestreo)->format('d/m/Y H:i') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="td-label">Fecha y Hora Término Muestreo</td>
                    <td colspan="3">
                        @if($formulario->fin_muestreo)
                            {{ \Carbon\Carbon::parse($formulario->fin_muestreo)->format('d/m/Y H:i') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="td-label">Tipo de Muestra</td>
                    <td colspan="3">{{ $formulario->tipo_muestra ?? '' }}</td>
                </tr>
                <tr>
                    <td class="td-label">Normativa Aplicada</td>
                    <td colspan="3">
                        NCh411/10. Of2005. Parte 10. Muestreo de aguas residuales - Recolección y manejo de las muestras. 2005. INN
                    </td>
                </tr>
            </tbody>
        </table>

        {{-- SECCIÓN 3: INFORMACIÓN DE LA MEDICIÓN --}}
        <table>
            <tr><td colspan="3" class="th-seccion">3. INFORMACIÓN DE LA MEDICIÓN</td></tr>
            <tr>
                <td class="th-col" style="width:55%">Medición / Norma</td>
                <td class="th-col" style="width:30%">Código Equipo</td>
                <td class="th-col" style="width:15%">Realizada</td>
            </tr>
            @foreach([
                ['label' => 'Toma de Muestra: NCh411/10.Of2005. Parte 10. Muestreo de aguas residuales - Recolección y manejo de las muestras. 2005. INN',
                 'cod'   => $formulario->eq_muestreo_cod ?? '',
                 'chk'   => $formulario->eq_muestreo_chk ?? false],
                ['label' => 'pH: (NCh2313/1.Of95. Parte 1. Determinación de pH.1995. INN)',
                 'cod'   => $formulario->eq_ph_cod ?? '',
                 'chk'   => $formulario->eq_ph_chk ?? false],
                ['label' => 'Temperatura: (NCh2313/2.Of95. Parte 2. Determinación de la temperatura.1995. INN)',
                 'cod'   => $formulario->eq_temp_cod ?? '',
                 'chk'   => $formulario->eq_temp_chk ?? false],
                ['label' => 'Cloro libre residual: IMCLB v.03 basado en Guía ISO 7393-2:1985',
                 'cod'   => $formulario->eq_cloro_cod ?? '',
                 'chk'   => $formulario->eq_cloro_chk ?? false],
            ] as $eq)
            <tr>
                <td style="font-size:8pt">{{ $eq['label'] }}</td>
                <td style="text-align:center">{{ $eq['cod'] }}</td>
                <td style="text-align:center; font-weight:bold; color:{{ $eq['chk'] ? '#333' : '#333' }}">
                    {{ $eq['chk'] ? 'Si' : 'No' }}
                </td>
            </tr>
            @endforeach
        </table>
        <div>
            <div class="footer-pagina"><span class="page-number"></span></div>
            <img src="{{ public_path('images/footer.png') }}" class="footer-img">
        </div>
    </div>
</div>


{{-- ══════════════════════════════════════════════════════
     PÁGINA 3 — RESULTADOS, OBSERVACIONES Y FOTO PRINCIPAL
══════════════════════════════════════════════════════ --}}
<div class="pagina">

    <div class="page-header">
        <div class="col-logo">
            <img src="{{ public_path('images/logo.png') }}" alt="Logo Empresa">
        </div>
        <div class="col-titulo">INFORME DE TERRENO</div>
        <div class="col-logo-cliente">
            @if($registro->logo_cliente)
                <img src="{{ storage_path('app/public/' . $registro->logo_cliente) }}" alt="Logo Cliente">
            @else
                <span>Logo empresa</span>
            @endif
        </div>
    </div>

    <div class="page-content">

        {{-- SECCIÓN 4: RESULTADOS MEDICIONES IN SITU --}}
        <table>
            <tr><td colspan="5" class="th-seccion">4.- RESULTADOS MEDICIONES <em>IN SITU</em></td></tr>
            <tr>
                <td class="th-col" style="width:15%">ÍTEM</td>
                <td class="th-col" style="width:22%">Fecha</td>
                <td class="th-col" style="width:18%">Hora</td>
                <td class="th-col" style="width:22%">pH (Unidades pH)</td>
                <td class="th-col" style="width:23%">Temperatura (ºC)</td>
            </tr>
            @foreach([
                [
                    'item'  => 'Inicio',
                    'fecha' => $formulario->r_f_inicio
                                ? \Carbon\Carbon::parse($formulario->r_f_inicio)->format('d/m/Y')
                                : ($formulario->inicio_muestreo ? \Carbon\Carbon::parse($formulario->inicio_muestreo)->format('d/m/Y') : '—'),
                    'hora'  => $formulario->r_h_inicio
                                ?? ($formulario->inicio_muestreo ? \Carbon\Carbon::parse($formulario->inicio_muestreo)->format('H:i') : '—'),
                    'ph'    => $formulario->r_ph_inicio ?? '—',
                    'temp'  => $formulario->r_t_inicio  ?? '—',
                ],
                [
                    'item'  => 'Fin',
                    'fecha' => $formulario->r_f_fin
                                ? \Carbon\Carbon::parse($formulario->r_f_fin)->format('d/m/Y')
                                : ($formulario->fin_muestreo ? \Carbon\Carbon::parse($formulario->fin_muestreo)->format('d/m/Y') : '—'),
                    'hora'  => $formulario->r_h_fin
                                ?? ($formulario->fin_muestreo ? \Carbon\Carbon::parse($formulario->fin_muestreo)->format('H:i') : '—'),
                    'ph'    => $formulario->r_ph_fin   ?? '—',
                    'temp'  => $formulario->r_t_fin    ?? '—',
                ],
            ] as $fila)
            <tr class="tr-resultado">
                <td>{{ $fila['item'] }}</td>
                <td>{{ $fila['fecha'] }}</td>
                <td>{{ $fila['hora'] }}</td>
                <td>{{ $fila['ph'] }}</td>
                <td>{{ $fila['temp'] }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="5" class="tr-resultado">Temperatura primera muestra al término del muestreo [ºC]: {{ $formulario->temperatura_inicial ?? 'Sin temperatura registrada.' }}</td>
            </tr>
        </table>

        {{-- SECCIÓN 5: OBSERVACIONES --}}
        <div class="obs-titulo">5.- OBSERVACIONES.</div>
        <div class="obs-cuerpo">{{ $formulario->observaciones ?? 'Sin observaciones registradas.' }}</div>

        {{-- SECCIÓN 6: REGISTRO FOTOGRÁFICO --}}
        <div class="foto-titulo">6.- REGISTRO FOTOGRÁFICO</div>
        <div class="foto-box">
            @if($formulario->anexo_1_file)
                <img src="{{ storage_path('app/public/' . $formulario->anexo_1_file) }}"
                     alt="{{ $formulario->anexo_1_titulo ?? 'Foto 1' }}">
            @else
                <p>No se adjuntó fotografía principal.</p>
            @endif
        </div>
        <div>
            <div class="footer-pagina"><span class="page-number"></span></div>
            <img src="{{ public_path('images/footer.png') }}" class="footer-img">
        </div>
    </div>
</div>


{{-- ══════════════════════════════════════════════════════
     PÁGINAS ADICIONALES — ANEXOS 2, 3 y 4
══════════════════════════════════════════════════════ --}}
@foreach([
    ['file' => $formulario->anexo_2_file ?? null, 'titulo' => $formulario->anexo_2_titulo ?? 'Documentación Técnica',  'n' => 1, 'pag' => 4],
    ['file' => $formulario->anexo_3_file ?? null, 'titulo' => $formulario->anexo_3_titulo ?? 'Cadena de Custodia',     'n' => 2, 'pag' => 5],
    ['file' => $formulario->anexo_4_file ?? null, 'titulo' => $formulario->anexo_4_titulo ?? 'Otros',                  'n' => 3, 'pag' => 6],
] as $anexo)
    @if($anexo['file'])
    <div class="pagina">

        <div class="page-header">
            <div class="col-logo">
                <img src="{{ public_path('images/logo.png') }}" alt="Logo Empresa">
            </div>
            <div class="col-titulo">INFORME DE TERRENO</div>
            <div class="col-logo-cliente">
                @if($registro->logo_cliente)
                    <img src="{{ storage_path('app/public/' . $registro->logo_cliente) }}" alt="Logo Cliente">
                @else
                    <span>Logo empresa</span>
                @endif
            </div>
        </div>

        <div class="page-content">
            <p class="anexo-label">Anexo {{ $anexo['n'] }}. {{ $anexo['titulo'] }}</p>
            <div class="foto-titulo">7.- ANEXOS</div>
            <div class="foto-box grande">
                <img src="{{ storage_path('app/public/' . $anexo['file']) }}"
                     alt="Anexo {{ $anexo['n'] }}">
            </div>
        </div>
        <div>
            <div class="footer-pagina"><span class="page-number"></span></div>
            <img src="{{ public_path('images/footer.png') }}" class="footer-img">
        </div>
    </div>
    @endif
@endforeach

</body>
</html>
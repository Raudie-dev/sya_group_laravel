<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Informe de Terreno - {{ $registro->codigo_informe }}</title>
    <style>
        @page {
            size: A4;
            margin: 2cm 1cm 2.5cm 1cm;
        }
        @page :first { margin: 0; }
        .page-number:before { content: "Página " counter(page); }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            margin: 0; padding: 0;
            font-family: Arial, sans-serif;
            color: #333; font-size: 9pt;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* ══ PORTADA ══ */
        .portada { width: 21cm; height: 29.7cm; background: #fff; page-break-after: always; }
        .portada-contenido {
            position: absolute; top: 7.5cm; left: 0; right: 0;
            text-align: center; padding: 0 2cm; z-index: 10;
        }
        .portada-titulo-bloque { display: inline-block; text-align: center; margin-bottom: 0.2cm; }
        .portada-titulo-bloque h1 {
            font-size: 20pt; font-weight: bold; color: #333;
            padding: 4px 16px; margin: 3px 0; display: inline-block; line-height: 1.2;
            text-transform: uppercase;
        }
        .portada-titulo-bloque h1.grande  { font-size: 20pt; }
        .portada-titulo-bloque h1.mediano { font-size: 16pt; }
        .portada-titulo-bloque h1.chico   { font-size: 14pt; }
        .portada-codigo { margin-top: 1cm; text-align: center; }
        .portada-codigo span { padding: 4px 10px; font-size: 12pt; font-weight: bold; color: #333; }
        .portada-logos-footer {
            position: absolute; bottom: 9.5cm; left: 0; right: 0;
            display: table; width: 100%; padding: 0 2cm; z-index: 10;
        }
        .portada-logos-footer .col { display: table-cell; width: 50%; text-align: center; vertical-align: bottom; }
        .portada-logos-footer p    { font-size: 9pt; font-weight: bold; margin-bottom: 0.3cm; }
        .portada-logos-footer img  { max-height: 2.2cm; max-width: 6cm; object-fit: contain; }
        .portada-logos-footer .logo-placeholder {
            border: 1px solid #ccc; height: 2.2cm; width: 5cm; margin: 0 auto;
            display: flex; align-items: center; justify-content: center;
            font-size: 8pt; color: #999;
        }
        .portada-footer-img { position: absolute; bottom: 0; left: 0; width: 100%; z-index: 1; }
        .portada-footer-img img { width: 100%; display: block; }

        /* ══ PÁGINAS INTERNAS ══ */
        .pagina { page-break-after: always; display: block; }
        .pagina:last-child { page-break-after: auto; }

        .page-header {
            display: table; width: 100%;
            border-bottom: 2px solid #333;
            padding: 0.4cm 0.8cm 0.3cm 0.8cm;
        }
        .page-header .col-logo         { display: table-cell; width: 25%; vertical-align: middle; }
        .page-header .col-logo img     { height: 1.2cm; object-fit: contain; }
        .page-header .col-titulo       {
            display: table-cell; width: 50%; text-align: center; vertical-align: middle;
            font-size: 12pt; font-weight: bold; color: #333; letter-spacing: 1px;
        }
        .page-header .col-logo-cliente { display: table-cell; width: 25%; text-align: right; vertical-align: middle; }
        .page-header .col-logo-cliente img  { max-height: 1.2cm; max-width: 4cm; object-fit: contain; }
        .page-header .col-logo-cliente span { font-size: 7.5pt; color: #999; border: 1px solid #ccc; padding: 2px 6px; }

        .page-content { flex: 1; padding: 0.5cm 0.8cm 0.5cm 0.8cm; }

        .fecha-emision          { font-size: 9.5pt; margin-bottom: 0.4cm; }
        .fecha-emision strong   { font-weight: bold; }

        /* ══ TABLAS ══ */
        table { width: 100%; border-collapse: collapse; margin-bottom: 0.4cm; table-layout: fixed; }
        th, td {
            border: 1px solid #333; padding: 5px 8px; font-size: 8.5pt;
            word-wrap: break-word; vertical-align: middle;
        }
        .th-seccion {
            background-color: #1B3A6B !important; color: #fff !important;
            font-weight: bold; text-align: center; font-size: 9.5pt;
            text-transform: uppercase; padding: 7px 8px;
            -webkit-print-color-adjust: exact; print-color-adjust: exact;
        }
        .th-col {
            background-color: #E0E0E0 !important; font-weight: bold; text-align: center;
            -webkit-print-color-adjust: exact; print-color-adjust: exact;
        }
        /* Sub-encabezado de ítem (ej: "Agua Residual") */
        .th-item {
            background-color: #f5f5f5 !important; font-weight: bold;
            text-align: center; font-style: italic; font-size: 8.5pt;
            -webkit-print-color-adjust: exact; print-color-adjust: exact;
        }
        .td-label  { font-weight: bold; background-color: #fff; width: 40%; }
        .td-normal { background-color: #fff; }
        .tr-resultado td { text-align: center; }
        .tr-resultado td:first-child { font-weight: bold; text-align: left; padding-left: 5px; }

        .nota-tabla {
            font-size: 7.5pt; text-align: center; padding: 4px 8px;
            border: 1px solid #333; border-top: none; background: #fff; margin-bottom: 0.4cm;
        }
        .nota-responsabilidad {
            font-size: 7.5pt; text-align: center; font-weight: bold;
            border: 1px solid #333; padding: 5px 8px; margin-bottom: 0.4cm;
        }

        /* ══ PUNTO DE MUESTREO ══ */
        .mapa-box {
            /* border: 1px solid #333; border-top: none; */
            text-align: center; padding: 6px;
            height: 5cm; margin-bottom: 0.4cm;
            display: flex; align-items: center; justify-content: center;
        }
        .mapa-box img { max-width: 100%; max-height: 100%; object-fit: contain; }
        .mapa-box p   { color: #aaa; font-style: italic; font-size: 8pt; }

        /* ══ REGISTRO FOTOGRÁFICO ══ */
        .foto-titulo {
            background-color: #1B3A6B !important; color: #fff !important;
            font-weight: bold; text-align: center; font-size: 9.5pt;
            text-transform: uppercase; padding: 7px 8px; border: 1px solid #333;
            -webkit-print-color-adjust: exact; print-color-adjust: exact;
        }
        /* Contenedor de 2 fotos lado a lado */
        .fotos-dobles {
            border: 1px solid #333; border-top: none;
            display: table; width: 100%; margin-bottom: 0.4cm;
        }
        .fotos-dobles .foto-celda {
            display: table-cell; width: 50%; padding: 8px;
            text-align: center; vertical-align: middle;
            height: 6cm;
        }
        .fotos-dobles .foto-celda:first-child { border-right: 1px /* solid #333 */; }
        .fotos-dobles .foto-celda img { max-width: 100%; max-height: 5.5cm; object-fit: contain; }
        .fotos-dobles .foto-celda p   { color: #aaa; font-style: italic; font-size: 8pt; }
        /* Pie de foto */
        .foto-caption {
            font-size: 7.5pt; text-align: center; color: #555;
            margin-top: 4px; font-style: italic;
        }
        /* Una sola foto grande */
        .foto-box {
            /* border: 1px solid #333; border-top: none; */ 
            text-align: center;
            padding: 10px; height: 13cm;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 0.4cm;
        }
        .foto-box.grande { height: 20cm; }
        .foto-box img { max-width: 100%; max-height: 100%; object-fit: contain; }
        .foto-box p   { color: #aaa; font-style: italic; font-size: 8pt; }

        /* ══ OBSERVACIONES ══ */
        .obs-titulo {
            background-color: #1B3A6B !important; color: #fff !important;
            font-weight: bold; text-align: center; font-size: 9.5pt;
            text-transform: uppercase; padding: 7px 8px; border: 1px solid #333;
            -webkit-print-color-adjust: exact; print-color-adjust: exact;
        }
        .obs-cuerpo {
            border: 1px solid #333; border-top: none; padding: 10px;
            min-height: 1.2cm; font-size: 8.5pt; text-align: center;
            margin-bottom: 0.4cm; white-space: pre-wrap;
        }

        /* ══ FIRMA ══ */
        .firma-box { text-align: center; padding: 6px; min-height: 1.5cm; vertical-align: middle; }
        .firma-box img { max-height: 1.2cm; max-width: 3cm; object-fit: contain; }

        /* ══ FOOTER ══ */
        .footer-img    { position: absolute; bottom: 0; left: 0; width: 100%; }
        .footer-pagina { position: absolute; bottom: 1.3cm; right: 1cm; font-weight: bold; font-size: 9pt; }

        /* ══ ANEXOS ══ */
        .anexo-label { font-size: 9pt; font-weight: bold; margin-bottom: 0.2cm; }

        /* ══ DECLARACIÓN JURADA ══ */
        .declaracion-jurada  { font-size: 10px; line-height: 1.6; }
        .dj-titulo           { font-size: 11px; font-weight: bold; text-align: center; margin-bottom: 20px; text-transform: uppercase; }
        .dj-cuerpo           { margin-bottom: 12px; text-align: justify; }
        .dj-lista            { margin: 0 0 12px 20px; padding: 0; }
        .dj-lista li         { margin-bottom: 8px; text-align: justify; list-style-type: none; }
        .dj-lista li::before { content: "- "; }
        .dj-firma            { margin-top: 40px; text-align: center; }
        .dj-footer-sma       { margin-top: 30px; border-top: 1px solid #ccc; padding-top: 8px; font-size: 8px; text-align: center; color: #555; }
        .page-content.texto  { padding: 1.5cm 2.5cm; }
        .dj-firma-linea      { font-size: 14px; margin-bottom: 6px; margin-top: 0; line-height: 1; }
        .dj-firma img        { max-height: 1.5cm; max-width: 4cm; object-fit: contain; display: block; margin: 0 auto -12px auto; }

        table { page-break-inside: avoid; }
        tr    { page-break-inside: avoid; }
    </style>
</head>
<body>

{{-- ══════════════════════════════════════════════════════
     PÁGINA 1 — PORTADA
══════════════════════════════════════════════════════ --}}
<div class="portada">
    <div class="portada-contenido">
        <div class="portada-titulo-bloque">
            <h1 class="grande">{{ $registro->titulo_informe ?? 'INFORME DE TERRENO' }}</h1>
            <br>
            <h1 class="grande">{{ $registro->empresa_nombre ?? '' }}</h1>
            <br>
            <h1 class="mediano">{{ $formulario->lugar_muestreo ?? '' }}</h1>
            <br>
            @if($registro->fecha_emision ?? null)
                <h1 class="mediano">{{ \Carbon\Carbon::parse($registro->fecha_emision)->locale('es')->isoFormat('MMMM YYYY') }}</h1>
                <br>
            @endif
            <h1 class="chico">{{ $registro->region ?? '' }}</h1>
        </div>
        <div class="portada-codigo">
            <span>{{ $registro->codigo_informe }}</span>
        </div>
    </div>
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
    <div class="portada-footer-img">
        <img src="{{ public_path('images/portada.png') }}" alt="">
    </div>
</div>

{{-- ══════════════════════════════════════════════════════
     PÁGINA 2 — ANTECEDENTES, MUESTREO Y MEDICIÓN
══════════════════════════════════════════════════════ --}}
<div class="pagina">
    <div class="page-header">
        <div class="col-logo"><img src="{{ public_path('images/logo.png') }}" alt="Logo"></div>
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

        {{-- 1. ANTECEDENTES GENERALES --}}
        <table>
            <tr><td colspan="2" class="th-seccion">1. ANTECEDENTES GENERALES</td></tr>
            <tr>
                <td class="td-label">Nombre Cliente</td>
                <td>{{ $registro->empresa_nombre ?? '' }}</td>
            </tr>
            <tr>
                <td class="td-label">Dirección</td>
                <td>{{ $registro->cliente_direccion ?? '' }}</td>
            </tr>
            <tr>
                <td class="td-label">Comuna / Ciudad</td>
                <td>{{ $registro->comuna ?? '' }}</td>
            </tr>
            <tr>
                <td class="td-label">Región</td>
                <td>{{ $registro->region ?? '' }}</td>
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
                    <img src="{{ public_path('images/firma.png') }}" alt="Firma">
                </td>
            </tr>
            <tr>
                <td class="td-label">Nº RCA</td>
                <td>{{ $registro->n_rca ?? '' }}</td>
            </tr>
            <tr>
                <td class="td-label">Nombre del Proyecto Aprobado</td>
                <td>{{ $registro->nombre_proyecto ?? '' }}</td>
            </tr>
        </table>

        <div class="nota-responsabilidad">
            Nota: SyA ambiental y el Inspector Ambiental identificado previamente se hace responsable solo por
            los resultados de esta inspección, correspondiente a las actividades solicitadas este informe no
            puede ser reproducido salvo en su totalidad.
        </div>

        {{-- 2. INFORMACIÓN DE MUESTREO --}}
        <table>
            <tr><td colspan="2" class="th-seccion">2. INFORMACIÓN DE MUESTREO</td></tr>
            <tr>
                <td class="td-label">Lugar de Muestreo</td>
                <td>{{ $formulario->lugar_muestreo ?? '' }}</td>
            </tr>
            <tr>
                <td class="td-label">Dirección de Muestreo</td>
                <td>{{ $formulario->direccion_muestreo ?? '' }}</td>
            </tr>
            <tr>
                <td class="td-label">Identificación Punto de Muestreo</td>
                <td>{{ $formulario->punto_muestreo ?? '' }}</td>
            </tr>
            <tr>
                <td class="td-label">Fecha y Hora Inicio Muestreo</td>
                <td>
                    @if($formulario->inicio_muestreo)
                        {{ \Carbon\Carbon::parse($formulario->inicio_muestreo)->format('d-m-Y') }}
                        &nbsp;&nbsp;
                        {{ \Carbon\Carbon::parse($formulario->inicio_muestreo)->format('H:i') }}
                    @endif
                </td>
            </tr>
            <tr>
                <td class="td-label">Fecha y Hora Término Muestreo</td>
                <td>
                    @if($formulario->fin_muestreo)
                        {{ \Carbon\Carbon::parse($formulario->fin_muestreo)->format('d-m-Y') }}
                        &nbsp;&nbsp;
                        {{ \Carbon\Carbon::parse($formulario->fin_muestreo)->format('H:i') }}
                    @endif
                </td>
            </tr>
            <tr>
                <td class="td-label">Tipo de Muestra</td>
                <td>{{ $formulario->tipo_muestra ?? '' }}</td>
            </tr>
            <tr>
                <td class="td-label">Normativa Aplicada</td>
                <td>
                    NCh411/10. Of2005. Parte 10. Muestreo de aguas residuales -
                    Recolección y manejo de las muestras. 2005. INN
                </td>
            </tr>
        </table>

        {{-- 3. INFORMACIÓN DE LA MEDICIÓN --}}
        <table>
            <tr><td colspan="3" class="th-seccion">3. INFORMACIÓN DE LA MEDICIÓN</td></tr>
            <tr>
                <td class="th-col" style="width:55%">Medición / Norma</td>
                <td class="th-col" style="width:30%">Código Equipo</td>
                <td class="th-col" style="width:15%">Realizada</td>
            </tr>
            @foreach($formulario->equipos_detalle ?? [] as $eq)
            <tr>
                <td style="font-size:8pt">{{ $eq['label'] ?? '' }}</td>
                <td style="text-align:center">{{ $eq['eq_val'] ?? '' }}</td>
                <td style="text-align:center; font-weight:bold">
                    {{ !empty($eq['chk_val']) ? 'Si' : 'No' }}
                </td>
            </tr>
            @endforeach
        </table>

    </div>
    <div>
        <div class="footer-pagina"><span class="page-number"></span></div>
        <img src="{{ public_path('images/footer.png') }}" class="footer-img">
    </div>
</div>

{{-- ══════════════════════════════════════════════════════
     PÁGINA 3 — PUNTO MUESTREO, MEDICIONES, FOTOS Y RESULTADOS
══════════════════════════════════════════════════════ --}}
<div class="pagina">
    <div class="page-header">
        <div class="col-logo"><img src="{{ public_path('images/logo.png') }}" alt="Logo"></div>
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

        {{-- 4. PUNTO DE MUESTREO --}}
        <table>
            <tr><td colspan="4" class="th-seccion">4.- PUNTO DE MUESTREO</td></tr>
            <tr>
                <td class="th-col" style="width:20%">Estación</td>
                <td class="th-col" style="width:35%">Punto Muestreo</td>
                <td class="th-col" style="width:22.5%">UTM Este (m)</td>
                <td class="th-col" style="width:22.5%">UTM Norte (m)</td>
            </tr>
            <tr class="tr-resultado">
                <td>{{ $formulario->estacion ?? '—' }}</td>
                <td style="text-align:left; padding-left:6px">{{ $formulario->punto_muestreo_sec4 ?? '—' }}</td>
                <td>{{ $formulario->utm_este ?? '—' }}</td>
                <td>{{ $formulario->utm_norte ?? '—' }}</td>
            </tr>
        </table>
        {{-- Imagen de mapa (Anexo 1 = Punto de Muestreo) --}}
        @if($formulario->anexo_1_file)
            <div class="mapa-box">
                <img src="{{ storage_path('app/public/' . $formulario->anexo_1_file) }}"
                     alt="{{ $formulario->anexo_1_titulo ?? 'Punto de Muestreo' }}">
            </div>
        @endif

        {{-- SECCIÓN 5: RESULTADOS MEDICIONES IN SITU --}}
        @php
            $medCols = $formulario->mediciones_detalle['cols'] ?? [];
            $medRows = $formulario->mediciones_detalle['rows'] ?? [];
        @endphp

        <table>
            <tr>
                <td colspan="{{ count($medCols) + 1 }}" class="th-seccion">5.- RESULTADOS MEDICIONES <em>IN SITU</em></td>
            </tr>
            <tr>
                <td class="th-col" style="width:15%">ÍTEM</td>
                @foreach($medCols as $col)
                <td class="th-col">{{ $col['label'] ?? '' }}</td>
                @endforeach
            </tr>
            @foreach($medRows as $row)
            <tr class="tr-resultado">
                <td>{{ $row['item'] ?? '' }}</td>
                @foreach($medCols as $col)
                <td>
                    @php
                        $val = $row['values'][$col['key']] ?? '—';
                        // Formatear fechas y horas para el PDF
                        if ($col['type'] === 'date' && !empty($val) && $val !== '—') {
                            $val = \Carbon\Carbon::parse($val)->format('d/m/Y');
                        } elseif ($col['type'] === 'time' && !empty($val) && $val !== '—') {
                            $val = \Carbon\Carbon::parse($val)->format('H:i');
                        }
                    @endphp
                    {{ $val }}
                </td>
                @endforeach
            </tr>
            @endforeach
            @if(!empty($formulario->temperatura_inicial))
            <tr>
                <td colspan="{{ count($medCols) + 1 }}" class="tr-resultado">
                    Temperatura primera muestra al término del muestreo [ºC]: {{ $formulario->temperatura_inicial }}
                </td>
            </tr>
            @endif
        </table>

        {{-- 6. REGISTRO FOTOGRÁFICO —  Anexo 2 y Anexo 3 lado a lado --}}
        <div class="foto-titulo">6.- REGISTRO FOTOGRÁFICO</div>
        <div class="fotos-dobles">
            {{-- Foto izquierda: Anexo 2 --}}
            <div class="foto-celda">
                @if($formulario->anexo_2_file)
                    <img src="{{ storage_path('app/public/' . $formulario->anexo_2_file) }}"
                         alt="{{ $formulario->anexo_2_titulo ?? 'Registro Fotográfico 1' }}">
                    @if($formulario->anexo_2_titulo)
                        <p class="foto-caption">{{ $formulario->anexo_2_titulo }}</p>
                    @endif
                @else
                    <p>Sin fotografía</p>
                @endif
            </div>
            {{-- Foto derecha: Anexo 3 --}}
            <div class="foto-celda">
                @if($formulario->anexo_3_file)
                    <img src="{{ storage_path('app/public/' . $formulario->anexo_3_file) }}"
                         alt="{{ $formulario->anexo_3_titulo ?? 'Registro Fotográfico 2' }}">
                    @if($formulario->anexo_3_titulo)
                        <p class="foto-caption">{{ $formulario->anexo_3_titulo }}</p>
                    @endif
                @else
                    <p>Sin fotografía</p>
                @endif
            </div>
        </div>

        {{-- 7. RESULTADOS --}}
        <table>
            <tr><td colspan="2" class="th-seccion">7.- RESULTADOS</td></tr>
            @forelse($formulario->resultados_array as $res)
                <tr class="tr-resultado">
                    <td style="width:50%; text-align:left; padding-left:8px; font-weight:bold">
                        {{ $res['item'] ?? '—' }}
                    </td>
                    <td style="width:50%">{{ $res['resultado'] ?? '—' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" style="text-align:center; padding:10px; color:#999;">
                        Sin resultados registrados.
                    </td>
                </tr>
            @endforelse
        </table>

    </div>
    <div>
        <div class="footer-pagina"><span class="page-number"></span></div>
        <img src="{{ public_path('images/footer.png') }}" class="footer-img">
    </div>
</div>

{{-- ════════PÁGINAS ADICIONALES — ANEXOS ════════════════--}}
     
{{-- ══════════════════════════════════════════════════════
     ANEXO 1 — Cadena de Custodia (anexo_4)
══════════════════════════════════════════════════════ --}}
@if($formulario->anexo_4_file)
<div class="pagina">
    <div class="page-header">
        <div class="col-logo"><img src="{{ public_path('images/logo.png') }}" alt="Logo"></div>
        <div class="col-titulo">INFORME DE TERRENO</div>
        <div class="col-logo-cliente">
            @if($registro->logo_cliente)
                <img src="{{ storage_path('app/public/' . $registro->logo_cliente) }}" alt="Logo Cliente">
            @else <span>Logo empresa</span>
            @endif
        </div>
    </div>
    <div class="page-content">
        <div class="foto-titulo">8.- ANEXOS</div>
        <p class="anexo-label" style="margin-top:0.3cm">
            Anexo 1. {{ $formulario->anexo_4_titulo ?? 'Cadena de Custodia' }}
        </p>
        <div class="foto-box grande">
            <img src="{{ storage_path('app/public/' . $formulario->anexo_4_file) }}" alt="Anexo 1">
        </div>
    </div>
    <div>
        <div class="footer-pagina"><span class="page-number"></span></div>
        <img src="{{ public_path('images/footer.png') }}" class="footer-img">
    </div>
</div>
@endif

{{-- ══════════════════════════════════════════════════════
     ANEXO 2 — Declaración Jurada Inspector Ambiental (estática)
══════════════════════════════════════════════════════ --}}
@if($formulario->mostrar_dj_inspector ?? true)
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

    <div class="page-content texto declaracion-jurada">

        <p class="dj-titulo">
            DECLARACIÓN JURADA PARA LA OPERATIVIDAD DEL<br>
            INSPECTOR AMBIENTAL
        </p>

        <p class="dj-cuerpo">
            Yo, René David Díaz Vásquez, RUN N° 11.296.786-9, domiciliado en Los Molinos 747, Quilpué,
            Viña del Mar, en mi calidad de inspector ambiental N° 11296786-9 y código de la ETFA N° 042-01,
            declaro que, en los últimos dos años:
        </p>

        <ul class="dj-lista">
            <li>
                No he tenido una relación directa ni indirecta, mercantil o laboral {{ $registro->empresa_nombre }},
                RUT {{ $registro->rut_empresa }}, titular del proyecto, sistema, actividad o fuente, objeto de las
                actividades de fiscalización ambiental.
            </li>
            <li>
                No he tenido una relación directa ni indirecta, mercantil o laboral con don {{ $registro->representante_nombre }}
                RUN: {{ $registro->representante_run }}, representante legal de {{ $registro->empresa_nombre }},
                RUT {{ $registro->rut_empresa }}, titular del proyecto, sistema, actividad o fuente, objeto de las
                actividades de fiscalización ambiental.
            </li>
            <li>
                No he sido legalmente reconocido como asociado en negocios con {{ $registro->empresa_nombre }},
                RUT {{ $registro->rut_empresa }}.
            </li>
            <li>
                No he tenido, directa ni indirectamente, la propiedad, el control o la posesión de acciones
                o títulos en circulación de {{ $registro->empresa_nombre }}, RUT {{ $registro->rut_empresa }}.
            </li>
            <li>
                No he controlado, directa ni indirectamente a {{ $registro->empresa_nombre }}, RUT {{ $registro->rut_empresa }}.
            </li>
        </ul>

        <p class="dj-cuerpo">
            Igualmente declaro que no tengo vínculo familiar de parentesco -hasta el tercer grado de
            consanguinidad y segundo de afinidad inclusive-, con los propietarios ni con los representantes
            legales del titular fiscalizado.
        </p>

        <p class="dj-cuerpo">
            Toda la información contenida en el informe de resultados
            <strong>{{ $registro->codigo_informe }}</strong> es veraz, auténtica
            (que no corresponde a una copia o transcripción de otros documentos) y exacta.
        </p>

        <p class="dj-cuerpo">
            Finalmente, ratifico que las declaraciones hechas son verídicas, según mi mejor conocimiento
            y entendimiento y declaro tener conocimiento que las infracciones a las obligaciones que impone
            el reglamento ETFA, según lo dispuesto en su artículo 19, se sancionan de conformidad a lo
            señalado en el Título III de la ley orgánica de la Superintendencia del Medio Ambiente.
        </p>

        <div class="dj-firma">
            <img src="{{ public_path('images/firma-inspector.png') }}" alt="firma">
            <div class="dj-firma-linea">________________________________</div>
            <p>Firma del inspector ambiental</p>
            <p class="mt-4">{{ \Carbon\Carbon::parse($formulario->fecha_emision)->translatedFormat('d \d\e F \d\e Y') }}</p>
        </div>

        <div class="dj-footer-sma">
            <p>Superintendencia del Medio Ambiente</p>
            <p>Teatinos 280, pisos 7, 8 y 9, Santiago – Chile | +56 2 26171800 | registroentidades@sma.gob.cl | www.sma.gob.cl</p>
            <p>Operatividad general - ETFA-GEN-02</p>
        </div>

    </div>

    <div>
        <div class="footer-pagina"><span class="page-number"></span></div>
        <img src="{{ public_path('images/footer.png') }}" class="footer-img">
    </div>

</div>
@endif

{{-- ══════════════════════════════════════════════════════
     ANEXO 3 — Declaración Jurada Operatividad ETFA (estática)
══════════════════════════════════════════════════════ --}}
@if($formulario->mostrar_dj_etfa ?? true)
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

    <div class="page-content texto declaracion-jurada">

        <p class="dj-titulo">
            DECLARACIÓN JURADA PARA LA OPERATIVIDAD DE LA<br>
            ENTIDAD TÉCNICA DE FISCALIZACIÓN AMBIENTAL
        </p>

        <p class="dj-cuerpo">
            Yo, Sergio Iván Sangüesa Fernández, RUN N° 12.001.419-6, domiciliado en Los Molinos 747 Quilpué,
            Viña del Mar, en mi calidad de representante legal de Sangüesa y Asociados Limitada, SyA Ambiental
            Of General, código ETFA: 042-01, declaro que, la persona jurídica que represento, en los dos
            últimos años:
        </p>

        <ul class="dj-lista">
            <li>
                No ha tenido una relación directa ni indirecta de tipo mercantil con {{ $registro->empresa_nombre }},
                RUT {{ $registro->rut_empresa }}, titular del proyecto, sistema, actividad o fuente, objeto la actividad de
                fiscalización ambiental.
            </li>
            <li>
                No ha tenido una relación directa ni indirecta, de tipo laboral con {{ $registro->representante_nombre }}
                RUN: {{ $registro->representante_run }}, representante legal de {{ $registro->empresa_nombre }},
                RUT {{ $registro->rut_empresa }}, titular del proyecto, sistema, actividad o fuente, objeto de la
                actividad de fiscalización ambiental.
            </li>
            <li>
                No ha sido legalmente reconocida como asociada en negocios con {{ $registro->empresa_nombre }},
                RUT {{ $registro->rut_empresa }}.
            </li>
            <li>
                No ha tenido, directa ni indirectamente, la propiedad, el control o la posesión de acciones
                o títulos en circulación de {{ $registro->empresa_nombre }}, RUT {{ $registro->rut_empresa }}.
            </li>
            <li>
                No ha controlado, directa ni indirectamente a {{ $registro->empresa_nombre }}, RUT {{ $registro->rut_empresa }}.
            </li>
            <li>
                No ha sido controlada, directa ni indirectamente por {{ $registro->empresa_nombre }}, RUT {{ $registro->rut_empresa }}.
            </li>
            <li>
                No hemos sido controlados, directa ni indirectamente, por una misma tercera persona.
            </li>
        </ul>

        <p class="dj-cuerpo">
            Igualmente declaro que, yo no he tenido una relación directa ni indirecta, mercantil o laboral
            con {{ $registro->representante_nombre }} RUN: {{ $registro->representante_run }},
            representante legal ni {{ $registro->empresa_nombre }}, RUT {{ $registro->rut_empresa }}.
        </p>

        <p class="dj-cuerpo">
            Declaro también que, no existe vínculo familiar de parentesco -hasta el tercer grado de
            consanguinidad y segundo de afinidad inclusive-, entre los propietarios y los representantes
            legales de {{ $registro->empresa_nombre }}, RUT {{ $registro->rut_empresa }}. y los propietarios
            y representantes legales de esta ETFA.
        </p>

        <p class="dj-cuerpo">
            Toda la información contenida en el informe de resultados
            <strong>{{ $registro->codigo_informe }}</strong> es veraz, auténtica
            (que no corresponde a una copia o transcripción de otros documentos) y exacta.
        </p>

        <p class="dj-cuerpo">
            Finalmente, ratifico que las declaraciones hechas son verídicas, según mi mejor conocimiento
            y entendimiento y declaro tener conocimiento que las infracciones a las obligaciones que impone
            el reglamento ETFA, según lo dispuesto en su artículo 19, se sancionan de conformidad a lo
            señalado en el Título III de la ley orgánica de la Superintendencia del Medio Ambiente.
        </p>

        <div class="dj-firma">
            <img src="{{ public_path('images/firma-representante.png') }}" alt="firma">
            <div class="dj-firma-linea">________________________________</div>
            <p>Firma del Representante Legal</p>
            <p class="mt-4">{{ \Carbon\Carbon::parse($formulario->fecha_emision)->translatedFormat('d \d\e F \d\e Y') }}</p>
        </div>

        <div class="dj-footer-sma">
            <p>Superintendencia del Medio Ambiente</p>
            <p>Teatinos 280, pisos 7, 8 y 9, Santiago – Chile | +56 2 26171800 | registroentidades@sma.gob.cl | www.sma.gob.cl</p>
            <p>Operatividad general - ETFA-GEN-02</p>
        </div>

    </div>

    <div>
        <div class="footer-pagina"><span class="page-number"></span></div>
        <img src="{{ public_path('images/footer.png') }}" class="footer-img">
    </div>

</div>
@endif

{{-- ══════════════════════════════════════════════════════
     ANEXO 4 — Resultados de Laboratorio (anexo_5)
══════════════════════════════════════════════════════ --}}
@if($formulario->anexo_5_file)
<div class="pagina">
    <div class="page-header">
        <div class="col-logo"><img src="{{ public_path('images/logo.png') }}" alt="Logo"></div>
        <div class="col-titulo">INFORME DE TERRENO</div>
        <div class="col-logo-cliente">
            @if($registro->logo_cliente)
                <img src="{{ storage_path('app/public/' . $registro->logo_cliente) }}" alt="Logo Cliente">
            @else <span>Logo empresa</span>
            @endif
        </div>
    </div>
    <div class="page-content">
        <div class="foto-titulo">8.- ANEXOS</div>
        <p class="anexo-label" style="margin-top:0.3cm">
            Anexo 4. {{ $formulario->anexo_5_titulo ?? 'Resultado de Laboratorio' }}
        </p>
        <div class="foto-box grande">
            <img src="{{ storage_path('app/public/' . $formulario->anexo_5_file) }}" alt="Anexo 4">
        </div>
    </div>
    <div>
        <div class="footer-pagina"><span class="page-number"></span></div>
        <img src="{{ public_path('images/footer.png') }}" class="footer-img">
    </div>
</div>
@endif

{{-- ══════════════════════════════════════════════════════
     ANEXO 5 — Declaración Jurada Operatividad ETFA (anexo_6)
══════════════════════════════════════════════════════ --}}
@if($formulario->anexo_6_file)
<div class="pagina">
    <div class="page-header">
        <div class="col-logo"><img src="{{ public_path('images/logo.png') }}" alt="Logo"></div>
        <div class="col-titulo">INFORME DE TERRENO</div>
        <div class="col-logo-cliente">
            @if($registro->logo_cliente)
                <img src="{{ storage_path('app/public/' . $registro->logo_cliente) }}" alt="Logo Cliente">
            @else <span>Logo empresa</span>
            @endif
        </div>
    </div>
    <div class="page-content">
        <div class="foto-titulo">8.- ANEXOS</div>
        <p class="anexo-label" style="margin-top:0.3cm">
            Anexo 5. {{ $formulario->anexo_6_titulo ?? 'Declaración Jurada Operatividad LAL' }}
        </p>
        <div class="foto-box grande">
            <img src="{{ storage_path('app/public/' . $formulario->anexo_6_file) }}" alt="Anexo 5">
        </div>
    </div>
    <div>
        <div class="footer-pagina"><span class="page-number"></span></div>
        <img src="{{ public_path('images/footer.png') }}" class="footer-img">
    </div>
</div>
@endif

{{-- ══════════════════════════════════════════════════════
     ANEXO 6 — Declaración Jurada Inspector Ambiental (anexo_7)
══════════════════════════════════════════════════════ --}}
@if($formulario->anexo_7_file)
<div class="pagina">
    <div class="page-header">
        <div class="col-logo"><img src="{{ public_path('images/logo.png') }}" alt="Logo"></div>
        <div class="col-titulo">INFORME DE TERRENO</div>
        <div class="col-logo-cliente">
            @if($registro->logo_cliente)
                <img src="{{ storage_path('app/public/' . $registro->logo_cliente) }}" alt="Logo Cliente">
            @else <span>Logo empresa</span>
            @endif
        </div>
    </div>
    <div class="page-content">
        <div class="foto-titulo">8.- ANEXOS</div>
        <p class="anexo-label" style="margin-top:0.3cm">
            Anexo 6. {{ $formulario->anexo_7_titulo ?? 'Declaración Jurada Inspector Ambiental' }}
        </p>
        <div class="foto-box grande">
            <img src="{{ storage_path('app/public/' . $formulario->anexo_7_file) }}" alt="Anexo 6">
        </div>
    </div>
    <div>
        <div class="footer-pagina"><span class="page-number"></span></div>
        <img src="{{ public_path('images/footer.png') }}" class="footer-img">
    </div>
</div>
@endif

</body>
</html>
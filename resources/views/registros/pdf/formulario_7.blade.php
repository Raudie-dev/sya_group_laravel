<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Chequeo Pre-Campaña - {{ $registro->codigo_informe }}</title>
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
            font-size: 12pt;
            font-weight: bold;
            color: #333;
            letter-spacing: 1px;
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
            width: 58%;
            background-color: #f0f0f0 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .m-val { font-weight: bold; color: #222; }

        /* ── CONTENIDO ── */
        .page-content { padding: 0 0.8cm; }

        /* ── TABLAS ESTÁNDAR (página 1) ── */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0.35cm;
            table-layout: fixed;
        }
        th, td {
            border: 1px solid #333;
            padding: 5px 8px;
            font-size: 8.5pt;
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
            padding: 7px 8px;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .th-col {
            background-color: #E0E0E0 !important;
            font-weight: bold;
            text-align: center;
            font-size: 8pt;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .td-label { font-weight: bold; background-color: #fff; }
        .td-val   { background-color: #fff; }
        .chk-col     { text-align: center; width: 12%; }
        .chk-col-ini { text-align: center; width: 11%; }
        .chk-col-ter { text-align: center; width: 11%; }
        .obs-col     { font-size: 8pt; color: #444; }

        /* ── TABLAS COMPACTAS (página 2) ── */
        .compact th,
        .compact td {
            border: 1px solid #333;
            padding: 2px 5px;
            font-size: 7.5pt;
            word-wrap: break-word;
            vertical-align: middle;
        }
        .compact .th-seccion {
            background-color: #1B3A6B !important;
            color: #fff !important;
            font-weight: bold;
            text-align: center;
            font-size: 8pt;
            text-transform: uppercase;
            padding: 4px 5px;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .compact .th-col {
            background-color: #E0E0E0 !important;
            font-weight: bold;
            text-align: center;
            font-size: 7.5pt;
            padding: 3px 4px;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* ── CHECKBOX ── */
        .chk-box {
            display: inline-block;
            width: 10px;
            height: 10px;
            border: 1.5px solid #555;
            text-align: center;
            line-height: 9px;
            font-size: 7.5pt;
            font-weight: bold;
            vertical-align: middle;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .chk-box.checked {
            background-color: #1B3A6B !important;
            color: #fff !important;
            border-color: #1B3A6B !important;
        }
        .chk-box.inicio {
            background-color: #1B3A6B !important;
            color: #fff !important;
            border-color: #1B3A6B !important;
        }
        .chk-box.termino {
            background-color: #D97706 !important;
            color: #fff !important;
            border-color: #D97706 !important;
        }

        /* ── MATERIALES 2 COLUMNAS ── */
        .mat-wrap {
            display: table;
            width: 100%;
            border-spacing: 0;
            margin-bottom: 0.2cm;
        }
        .mat-col-l {
            display: table-cell;
            width: 49%;
            vertical-align: top;
            padding-right: 0.15cm;
        }
        .mat-col-r {
            display: table-cell;
            width: 49%;
            vertical-align: top;
            padding-left: 0.15cm;
        }
        .mat-col-l table,
        .mat-col-r table { margin-bottom: 0; }

        /* ── NOTA ── */
        .nota-tabla {
            font-size: 7.5pt;
            padding: 4px 8px;
            border: 1px solid #333;
            font-weight: bold;
            margin-bottom: 0.35cm;
        }

        /* ── OBSERVACIONES / FOTO ── */
        .obs-titulo, .foto-titulo {
            background-color: #1B3A6B !important;
            color: #fff !important;
            font-weight: bold;
            text-align: center;
            font-size: 9.5pt;
            text-transform: uppercase;
            padding: 7px 8px;
            border: 1px solid #333;
            border-bottom: none;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .obs-cuerpo {
            border: 1px solid #333;
            border-top: none;
            padding: 10px;
            min-height: 1.5cm;
            font-size: 8.5pt;
            white-space: pre-wrap;
            margin-bottom: 0.4cm;
        }
        .foto-box {
            border: 1px solid #333;
            border-top: none;
            text-align: center;
            padding: 10px;
            height: 17cm;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.4cm;
        }
        .foto-box img { max-width: 100%; max-height: 100%; object-fit: contain; }
        .foto-box p   { color: #aaa; font-style: italic; font-size: 8pt; }

        /* ── FIRMA ── */
        .firma-cell {
            text-align: center;
            height: 1.5cm;
            vertical-align: bottom;
            padding-bottom: 3px;
        }

        /* ── FOOTER ── */
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

        /* ── DJ ── */
        .declaracion-jurada { font-size: 10px; line-height: 1.6; }
        .dj-titulo  { font-size: 11px; font-weight: bold; text-align: center; margin-bottom: 20px; text-transform: uppercase; }
        .dj-cuerpo  { margin-bottom: 12px; text-align: justify; }
        .dj-lista   { margin: 0 0 12px 20px; padding: 0; }
        .dj-lista li { margin-bottom: 8px; text-align: justify; list-style-type: none; }
        .dj-lista li::before { content: "- "; }
        .dj-firma   { margin-top: 40px; text-align: center; }
        .dj-footer-sma { margin-top: 30px; border-top: 1px solid #ccc; padding-top: 8px; font-size: 8px; text-align: center; color: #555; }
        .dj-firma-linea { font-size: 14px; margin-bottom: 6px; margin-top: 0; line-height: 1; }
        .dj-firma img { max-height: 1.5cm; max-width: 4cm; object-fit: contain; display: block; margin: 0 auto -12px auto; }
        .page-content.texto { padding: 1.5cm 2.5cm; }

        table { page-break-inside: avoid; }
        tr    { page-break-inside: avoid; }
    </style>
</head>
<body>

@php
    $f = $formulario;

    $chk = function(bool $v, string $tipo = 'default') {
        if ($v) {
            $cls = match($tipo) {
                'inicio'  => 'chk-box inicio',
                'termino' => 'chk-box termino',
                default   => 'chk-box checked',
            };
            return '<span class="'.$cls.'">X</span>';
        }
        return '<span class="chk-box">&nbsp;</span>';
    };

    $docItems   = collect($f->documentacion   ?? [])->keyBy('item');
    $logItems   = collect($f->logistica       ?? [])->keyBy('item');
    $matItems   = collect($f->materiales      ?? [])->keyBy('item');
    $equipItems = collect($f->equipos_chequeo ?? [])->keyBy('equipo');

    $docDefaults = [
        'Permiso SHOA','Permiso de Pesca y Investigación',
        'Cert. Inocuidad muestras transp.','Ficha Técnica de Proyecto',
        'Cadena de custodia','Certificado calibración equipos',
        'Orden de compra laboratorio','Envases laboratorio (externo/interno)',
    ];
    $logDefaults = [
        'Vehículo propio','Arriendo Camioneta','Pasajes Aéreo',
        'Hotel / Cabañas','Alimentación',
    ];
    $matColA = [
        'Cajas Plásticas','Amarras eléctricas','Bidones','Bolsas','Boyas',
        'Cinta adhesiva','Cuerdas','Tambores','Redes de Pesca','Pilas/Baterías',
        'Alcohol','Rodamina','Formalina','Tablas para apoyos documentos',
        'Libretas impermeables de Terreno','Plumones','Lápices Pasta, Grafitos y Gomas',
        'Hielo o Ice Pack','Coolers','Envases de Muestreo','Huincha de Medir',
        'Cuadricula - Intermareal','Guantes Quirúrgicos','Mascarillas',
        'Guantes de seguridad','Botella Niskin Horizontal','Botella Van Dorn Vertical',
    ];
    $matColB = [
        'Corer Sampler de PVC','Dragas Van Veen','GPS Garmin Etrex 20',
        'Disco Secchi','Mallas Fito-Zoo','Malla Sar-Ber para Rio Fito-Zoo',
        'Malla para Captura de Peces','Grameras para pesar peces','Ictiometros',
        'Chequeo Cables de Equipos','Estado de las Baterías','Termómetro de Laser',
        'Lentes de seguridad','Cascos de seguridad','Zapatos de seguridad',
        'Protector solar','Chaleco Salvavidas','Chalecos Reflectantes',
        'Gorros Legionarios','Guantes Aislantes de Electricidad',
        'Botas de Agua c/s Punta de fierro','Trajes de Agua (Verdes) con botas',
        'Protectores de Oídos','Botiquín','Botellas de agua para hidratación',
        'Binoculares Nikon','Derivadores',
    ];
    $equipDefaults = [
        'Sonda Multiparamétrica','Potencial Redox','HANNA Multiparamétrica',
        'Muestreador Automático','Caudalímetro','Termómetro','pH portátil',
        'Colorímetro','Equipo de Pesca Eléctrica','Notebook o Tablet',
        'Cámaras de Captura Nocturnas para Fauna','Cámaras Fotográficas','Otro',
    ];
@endphp


{{-- ═══════════════════════════════════════
     PÁGINA 1 — Datos + Documentación + Logística
══════════════════════════════════════════ --}}
<div class="pagina">

    <div class="page-header">
        <div class="col-logo">
            <img src="{{ public_path('images/logo.png') }}" alt="SyA Group">
        </div>
        <div class="col-titulo">LISTA DE CHEQUEO<br>PRE-CAMPAÑA</div>
        <div class="col-meta">
            <table>
                <tr><td class="m-label">Identificación</td><td class="m-val">FLCP</td></tr>
                <tr><td class="m-label">Fecha de Vigencia</td><td class="m-val">10/06/2024</td></tr>
                <tr><td class="m-label">Versión</td><td class="m-val">04</td></tr>
            </table>
        </div>
    </div>

    <div class="page-content">

        <table>
            <tr>
                <td class="td-label" style="width:28%">Proyecto</td>
                <td class="td-val" colspan="3">{{ $f->proyecto ?? '' }}</td>
            </tr>
            <tr>
                <td class="td-label">Fecha</td>
                <td class="td-val" colspan="3">{{ $f->fecha ? \Carbon\Carbon::parse($f->fecha)->format('d/m/Y') : '' }}</td>
            </tr>
            <tr>
                <td class="td-label">Participantes</td>
                <td class="td-val" colspan="3">{{ $f->participantes ?? '' }}</td>
            </tr>
            <tr>
                <td class="td-label" style="width:28%">Responsable Verificación</td>
                <td class="td-val"   style="width:30%">{{ $f->responsable_verificacion ?? '' }}</td>
                <td class="td-label" style="width:10%; text-align:center; font-size:7.5pt">Firma:</td>
                <td class="firma-cell">
                    @if($f->firma_responsable_verificacion)
                        <img src="{{ storage_path('app/public/' . $f->firma_responsable_verificacion) }}" 
                            alt="Firma Verificación"
                            style="max-height: 50px; max-width: 150px;">
                    @else
                        <span style="font-size: 7pt;">Sin firma</span>
                    @endif
                </td>
            </tr>
            <tr>
                <td class="td-label">Responsable Aprobación</td>
                <td class="td-val">{{ $f->responsable_aprobacion ?? '' }}</td>
                <td class="td-label" style="text-align:center; font-size:7.5pt">Firma:</td>
                <td class="firma-cell">
                    @if($f->firma_responsable_aprobacion)
                        <img src="{{ storage_path('app/public/' . $f->firma_responsable_aprobacion) }}" 
                            alt="Firma Aprobación"
                            style="max-height: 50px; max-width: 150px;">
                    @else
                        <span style="font-size: 7pt;">Sin firma</span>
                    @endif
                </td>
            </tr>
        </table>
        <div class="nota-tabla">
            Nota: Marque con una X en cada ítem una vez que haya verificado que esté disponible y en buenas condiciones para esta campaña.
        </div>

        <table>
            <tr>
                <td class="th-seccion" style="width:62%">Documentación</td>
                <td class="th-seccion" style="width:12%">Verificado</td>
                <td class="th-seccion" style="width:26%">Observaciones</td>
            </tr>
            @foreach($docDefaults as $item)
                @php $d = $docItems->get($item, []); @endphp
                <tr>
                    <td class="td-val">{{ $item }}</td>
                    <td class="chk-col">{!! $chk(!empty($d['verificado'])) !!}</td>
                    <td class="obs-col">{{ $d['observaciones'] ?? '' }}</td>
                </tr>
            @endforeach
        </table>

        <table>
            <tr>
                <td class="th-seccion" style="width:62%">Logística</td>
                <td class="th-seccion" style="width:12%">Verificado</td>
                <td class="th-seccion" style="width:26%">Observaciones</td>
            </tr>
            @foreach($logDefaults as $item)
                @php $d = $logItems->get($item, []); @endphp
                <tr>
                    <td class="td-val">{{ $item }}</td>
                    <td class="chk-col">{!! $chk(!empty($d['verificado'])) !!}</td>
                    <td class="obs-col">{{ $d['observaciones'] ?? '' }}</td>
                </tr>
            @endforeach
        </table>

    </div>

    <div class="footer-pagina"><span class="page-number"></span></div>
    <img src="{{ public_path('images/footer.png') }}" class="footer-img">
</div>


{{-- ═══════════════════════════════════════
     PÁGINA 2 — Materiales + Equipos (compacto)
══════════════════════════════════════════ --}}
<div class="pagina">

    <div class="page-header">
        <div class="col-logo">
            <img src="{{ public_path('images/logo.png') }}" alt="SyA Group">
        </div>
        <div class="col-titulo">LISTA DE CHEQUEO<br>PRE-CAMPAÑA</div>
        <div class="col-meta">
            <table>
                <tr><td class="m-label">Identificación</td><td class="m-val">FLCP</td></tr>
                <tr><td class="m-label">Fecha de Vigencia</td><td class="m-val">10/06/2024</td></tr>
                <tr><td class="m-label">Versión</td><td class="m-val">04</td></tr>
            </table>
        </div>
    </div>

    <div class="page-content compact">

        <div class="mat-wrap">
            <div class="mat-col-l">
                <table>
                    <tr>
                        <td class="th-seccion" style="width:60%">Materiales</td>
                        <td class="th-seccion"     style="width:20%">Inicio</td>
                        <td class="th-seccion"     style="width:20%">Término</td>
                    </tr>
                    @foreach($matColA as $item)
                        @php $d = $matItems->get($item, []); @endphp
                        <tr>
                            <td class="td-val">{{ $item }}</td>
                            <td class="chk-col-ini">{!! $chk(!empty($d['inicio']),  'inicio')  !!}</td>
                            <td class="chk-col-ter">{!! $chk(!empty($d['termino']), 'termino') !!}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="mat-col-r">
                <table>
                    <tr>
                        <td class="th-seccion" style="width:60%">Materiales</td>
                        <td class="th-seccion"     style="width:20%">Inicio</td>
                        <td class="th-seccion"     style="width:20%">Término</td>
                    </tr>
                    @foreach($matColB as $item)
                        @php $d = $matItems->get($item, []); @endphp
                        <tr>
                            <td class="td-val">{{ $item }}</td>
                            <td class="chk-col-ini">{!! $chk(!empty($d['inicio']),  'inicio')  !!}</td>
                            <td class="chk-col-ter">{!! $chk(!empty($d['termino']), 'termino') !!}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

        <table>
            <tr>
                <td class="th-seccion" style="width:34%">Equipos</td>
                <td class="th-seccion"     style="width:22%">Modelo</td>
                <td class="th-seccion"     style="width:22%">N° Serie</td>
                <td class="th-seccion"     style="width:11%">Inicio</td>
                <td class="th-seccion"     style="width:11%">Término</td>
            </tr>
            @foreach($equipDefaults as $equipo)
                @php $d = $equipItems->get($equipo, []); @endphp
                <tr>
                    <td class="td-val">{{ $equipo }}</td>
                    <td class="td-val" style="text-align:center">{{ $d['modelo']  ?? '' }}</td>
                    <td class="td-val" style="text-align:center">{{ $d['n_serie'] ?? '' }}</td>
                    <td class="chk-col-ini">{!! $chk(!empty($d['inicio']),  'inicio')  !!}</td>
                    <td class="chk-col-ter">{!! $chk(!empty($d['termino']), 'termino') !!}</td>
                </tr>
            @endforeach
        </table>

    </div>

    <div class="footer-pagina"><span class="page-number"></span></div>
    <img src="{{ public_path('images/footer.png') }}" class="footer-img">
</div>


</body>
</html>
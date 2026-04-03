{{-- resources/views/registros/includes/formulario_7.blade.php --}}
{{-- Formulario 7: Lista de Chequeo Pre-Campaña (FLCP) --}}

@php
    $inst = $instancia ?? null;
    $reg  = $registro  ?? null;

    $docDefaults = [
        'Permiso SHOA',
        'Permiso de Pesca y Investigación',
        'Cert. Inocuidad muestras transp.',
        'Ficha Técnica de Proyecto',
        'Cadena de custodia',
        'Certificado calibración equipos',
        'Orden de compra laboratorio',
        'Envases laboratorio (externo/interno)',
    ];
    $logDefaults = [
        'Vehículo propio',
        'Arriendo Camioneta',
        'Pasajes Aéreo',
        'Hotel / Cabañas',
        'Alimentación',
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
    $matAll = array_merge($matColA, $matColB);

    $equipDefaults = [
        'Sonda Multiparamétrica','Potencial Redox','HANNA Multiparamétrica',
        'Muestreador Automático','Caudalímetro','Termómetro','pH portátil',
        'Colorímetro','Equipo de Pesca Eléctrica','Notebook o Tablet',
        'Cámaras de Captura Nocturnas para Fauna','Cámaras Fotográficas','Otro',
    ];

    /* mapas para edición */
    $docMap   = collect($inst->documentacion   ?? [])->keyBy('item')->toArray();
    $logMap   = collect($inst->logistica       ?? [])->keyBy('item')->toArray();
    $matMap   = collect($inst->materiales      ?? [])->keyBy('item')->toArray();
    $equipMap = collect($inst->equipos_chequeo ?? [])->keyBy('equipo')->toArray();
@endphp

<form method="POST"
      id="Formulario"
      action="{{ $inst ? route('registros.update', $inst->registro_id ?? $inst->id) : route('registros.store') }}"
      enctype="multipart/form-data"
      class="space-y-5">
    @csrf
    @if($inst) @method('PUT') @endif
    <input type="hidden" name="tipo_form_id" value="7">

    {{-- ══════════════════════════════════════════════
         SECCIÓN 1 — Identificación
    ══════════════════════════════════════════════ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="flex items-center gap-3 px-5 py-4 border-b border-blue-dark/8 bg-blue-dark/3">
            <div class="w-7 h-7 rounded-lg bg-blue-dark flex items-center justify-center flex-shrink-0">
                <span class="text-white text-xs font-bold">1</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-blue-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3 class="font-semibold text-blue-dark text-sm">1. Identificación del Informe y Cliente</h3>
            </div>
        </div>
        <div class="p-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-4">

            <div class="lg:col-span-6 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Título del Informe</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="titulo_informe"
                           value="{{ old('titulo_informe', $reg->titulo_informe ?? '') }}"
                           placeholder="Ej: Lista de Chequeo Pre-Campaña"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            <div class="lg:col-span-3 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Código Informe</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="codigo"
                           value="{{ old('codigo', $reg->codigo_informe ?? '') }}"
                           placeholder="FLCP-2024-001"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            <div class="lg:col-span-3 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Fecha Emisión</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="date" name="fecha_emision"
                           value="{{ old('fecha_emision', $reg?->fecha_emision ?? '') }}"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 focus:outline-none focus:ring-0">
                </div>
            </div>

            <div class="lg:col-span-4 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Cliente / Razón Social</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="cliente_nombre"
                           value="{{ old('cliente_nombre', $reg->empresa_nombre ?? '') }}"
                           placeholder="Razón social del cliente"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            <div class="lg:col-span-3 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">RUT Empresa</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="rut_empresa"
                           value="{{ old('rut_empresa', $reg->rut_empresa ?? '') }}"
                           placeholder="76.123.456-7"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            <div class="lg:col-span-5 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Nombre Representante Legal</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="representante_nombre"
                           value="{{ old('representante_nombre', $reg->representante_nombre ?? '') }}"
                           placeholder="Nombre completo del representante"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            <div class="lg:col-span-4 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">RUN Representante Legal</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="representante_run"
                           value="{{ old('representante_run', $reg->representante_run ?? '') }}"
                           placeholder="12.345.678-9"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            <div class="lg:col-span-4 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Región</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="region"
                           value="{{ old('region', $reg->region ?? '') }}"
                           placeholder="Ej: Región de Valparaíso"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            <div class="lg:col-span-4 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Comuna / Ciudad</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="comuna"
                           value="{{ old('comuna', $reg->comuna ?? '') }}"
                           placeholder="Ej: Quilpué"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            <div class="lg:col-span-8 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Dirección Cliente</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="cliente_direccion"
                           value="{{ old('cliente_direccion', $reg->cliente_direccion ?? '') }}"
                           placeholder="Dirección completa del cliente"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            <div class="lg:col-span-4 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">N° RCA</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="n_rca"
                           value="{{ old('n_rca', $reg->n_rca ?? '') }}"
                           placeholder="Número RCA"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            <div class="lg:col-span-8 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Nombre del Proyecto Aprobado</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="nombre_proyecto"
                           value="{{ old('nombre_proyecto', $reg->nombre_proyecto ?? '') }}"
                           placeholder="Nombre completo del proyecto aprobado"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            {{-- Logo Cliente --}}
            <div class="lg:col-span-4">
                <label class="block text-xs font-medium text-gray-500 mb-1.5">Logo Empresa Cliente</label>
                <div class="flex items-center gap-2">
                    <div class="flex-1 flex items-center rounded-xl border border-gray-200 bg-gray-50 hover:border-blue-light/60 transition-all duration-200 overflow-hidden">
                        <label class="flex-shrink-0 px-3 py-2 text-xs text-gray-500 bg-gray-100 border-r border-gray-200 cursor-pointer hover:bg-gray-200 transition-colors">
                            Seleccionar
                            <input type="file" name="logo_cliente" accept="image/*" class="hidden"
                                   onchange="document.getElementById('logo_nombre_f7').textContent = this.files[0]?.name ?? 'Sin archivo'">
                        </label>
                        <span id="logo_nombre_f7" class="px-3 text-xs text-gray-400 truncate">
                            {{ $reg?->logo_cliente ? basename($reg->logo_cliente) : 'Sin archivo seleccionado' }}
                        </span>
                    </div>
                    @if($reg?->logo_cliente)
                        <button type="button"
                                onclick="viewImage('{{ asset('storage/' . $reg->logo_cliente) }}', 'Logo Cliente')"
                                class="flex-shrink-0 flex items-center gap-1.5 px-3 py-2 rounded-xl bg-blue/10 text-blue hover:bg-blue/20 text-xs font-medium transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Ver
                        </button>
                    @endif
                </div>
                @if($reg?->logo_cliente)
                    <p class="mt-1 text-xs text-green flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Imagen cargada actualmente
                    </p>
                @endif
            </div>

        </div>
    </div>

    {{-- ══════════════════════════════════════════════
         SECCIÓN 2 — Datos de la Campaña
    ══════════════════════════════════════════════ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="flex items-center gap-3 px-5 py-4 border-b border-orange/10 bg-orange/3">
            <div class="w-7 h-7 rounded-lg bg-orange flex items-center justify-center flex-shrink-0">
                <span class="text-white text-xs font-bold">2</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <h3 class="font-semibold text-orange text-sm">2. Datos de la Campaña</h3>
            </div>
        </div>
        <div class="p-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-4">

            <div class="lg:col-span-8 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Proyecto</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="proyecto"
                           value="{{ old('proyecto', $inst->proyecto ?? '') }}"
                           placeholder="Nombre o descripción del proyecto de campaña"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            <div class="lg:col-span-4 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Fecha de Campaña</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="date" name="fecha"
                           value="{{ old('fecha', $inst?->fecha ? \Carbon\Carbon::parse($inst->fecha)->format('Y-m-d') : '') }}"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 focus:outline-none focus:ring-0">
                </div>
            </div>

            <div class="lg:col-span-4 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Participantes</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="participantes"
                           value="{{ old('participantes', $inst->participantes ?? '') }}"
                           placeholder="Nombres de los participantes"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            <div class="lg:col-span-4 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Responsable Verificación</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="responsable_verificacion"
                           value="{{ old('responsable_verificacion', $inst->responsable_verificacion ?? '') }}"
                           placeholder="Nombre del responsable"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            <div class="lg:col-span-4 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Responsable Aprobación</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="responsable_aprobacion"
                           value="{{ old('responsable_aprobacion', $inst->responsable_aprobacion ?? '') }}"
                           placeholder="Nombre del responsable"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>
            {{-- firma Responsable Verificación --}}
            <div class="lg:col-span-4">
                <label class="block text-xs font-medium text-gray-500 mb-1.5">Firma Responsable Verificación</label>
                <div class="flex items-center gap-2">
                    <div class="flex-1 flex items-center rounded-xl border border-gray-200 bg-gray-50 hover:border-blue-light/60 transition-all duration-200 overflow-hidden">
                        <label class="flex-shrink-0 px-3 py-2 text-xs text-gray-500 bg-gray-100 border-r border-gray-200 cursor-pointer hover:bg-gray-200 transition-colors">
                            Seleccionar
                            <input type="file" name="firma_responsable_verificacion" accept="image/*" class="hidden"
                                   onchange="document.getElementById('firma_responsable_verificacion_f7').textContent = this.files[0]?.name ?? 'Sin archivo'">
                        </label>
                        <span id="firma_responsable_verificacion_f7" class="px-3 text-xs text-gray-400 truncate">
                            {{ $inst?->firma_responsable_verificacion ? basename($inst->firma_responsable_verificacion) : 'Sin archivo seleccionado' }}
                        </span>
                    </div>
                    @if($inst?->firma_responsable_verificacion)
                        <button type="button"
                                onclick="viewImage('{{ asset('storage/' . $inst->firma_responsable_verificacion) }}', 'Firma Responsable Verificación')"
                                class="flex-shrink-0 flex items-center gap-1.5 px-3 py-2 rounded-xl bg-blue/10 text-blue hover:bg-blue/20 text-xs font-medium transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Ver
                        </button>
                    @endif
                </div>
                @if($inst?->firma_responsable_verificacion)
                    <p class="mt-1 text-xs text-green flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Imagen cargada actualmente
                    </p>
                @endif
            </div>
            {{-- Firma Responsable Aprobación --}}
            <div class="lg:col-span-4">
                <label class="block text-xs font-medium text-gray-500 mb-1.5">Firma Responsable Aprobación</label>
                <div class="flex items-center gap-2">
                    <div class="flex-1 flex items-center rounded-xl border border-gray-200 bg-gray-50 hover:border-blue-light/60 transition-all duration-200 overflow-hidden">
                        <label class="flex-shrink-0 px-3 py-2 text-xs text-gray-500 bg-gray-100 border-r border-gray-200 cursor-pointer hover:bg-gray-200 transition-colors">
                            Seleccionar
                            <input type="file" name="firma_responsable_aprobacion" accept="image/*" class="hidden"
                                   onchange="document.getElementById('firma_responsable_aprobacion_f7').textContent = this.files[0]?.name ?? 'Sin archivo'">
                        </label>
                        <span id="firma_responsable_aprobacion_f7" class="px-3 text-xs text-gray-400 truncate">
                            {{ $inst?->firma_responsable_aprobacion ? basename($inst->firma_responsable_aprobacion) : 'Sin archivo seleccionado' }}
                        </span>
                    </div>
                    @if($inst?->firma_responsable_aprobacion)
                        <button type="button"
                                onclick="viewImage('{{ asset('storage/' . $inst->firma_responsable_aprobacion) }}', 'Firma Responsable Aprobación')"
                                class="flex-shrink-0 flex items-center gap-1.5 px-3 py-2 rounded-xl bg-blue/10 text-blue hover:bg-blue/20 text-xs font-medium transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Ver
                        </button>
                    @endif
                </div>
                @if($inst?->firma_responsable_aprobacion)
                    <p class="mt-1 text-xs text-green flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Imagen cargada actualmente
                    </p>
                @endif
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════
         SECCIÓN 3 — Documentación
    ══════════════════════════════════════════════ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="flex items-center gap-3 px-5 py-4 border-b border-green/10 bg-green/3">
            <div class="w-7 h-7 rounded-lg bg-green flex items-center justify-center flex-shrink-0">
                <span class="text-white text-xs font-bold">3</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <h3 class="font-semibold text-green text-sm">3. Documentación</h3>
            </div>
        </div>
        <div class="p-5">
            <p class="text-xs text-gray-400 mb-3 flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5 text-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Marque cada ítem una vez que haya verificado que está disponible y en buenas condiciones para esta campaña.
            </p>
            <div class="overflow-hidden rounded-xl border border-gray-200">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="text-left px-4 py-2.5 text-xs font-semibold text-gray-500">Ítem</th>
                            <th class="text-center px-4 py-2.5 text-xs font-semibold text-gray-500 w-24">Verificado</th>
                            <th class="text-left px-4 py-2.5 text-xs font-semibold text-gray-500 w-1/3">Observaciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($docDefaults as $idx => $itemName)
                            @php $saved = $docMap[$itemName] ?? []; @endphp
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-4 py-2.5 text-sm text-gray-700">
                                    <input type="hidden" name="documentacion[{{ $idx }}][item]" value="{{ $itemName }}">
                                    {{ $itemName }}
                                </td>
                                <td class="px-4 py-2.5 text-center">
                                    <input type="checkbox"
                                           name="documentacion[{{ $idx }}][verificado]"
                                           value="1"
                                           {{ !empty($saved['verificado']) ? 'checked' : '' }}
                                           class="w-4 h-4 rounded border-gray-300 text-orange focus:ring-orange cursor-pointer">
                                </td>
                                <td class="px-4 py-2.5">
                                    <div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 transition-all duration-150 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)]">
                                        <input type="text"
                                               name="documentacion[{{ $idx }}][observaciones]"
                                               value="{{ old('documentacion.'.$idx.'.observaciones', $saved['observaciones'] ?? '') }}"
                                               placeholder="Observación..."
                                               class="w-full bg-transparent border-none px-2.5 py-1.5 text-xs text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-0">
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════
         SECCIÓN 4 — Logística
    ══════════════════════════════════════════════ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="flex items-center gap-3 px-5 py-4 border-b border-blue-dark/8 bg-blue-dark/3">
            <div class="w-7 h-7 rounded-lg bg-blue flex items-center justify-center flex-shrink-0">
                <span class="text-white text-xs font-bold">4</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                </svg>
                <h3 class="font-semibold text-blue text-sm">4. Logística</h3>
            </div>
        </div>
        <div class="p-5">
            <div class="overflow-hidden rounded-xl border border-gray-200">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="text-left px-4 py-2.5 text-xs font-semibold text-gray-500">Ítem</th>
                            <th class="text-center px-4 py-2.5 text-xs font-semibold text-gray-500 w-24">Verificado</th>
                            <th class="text-left px-4 py-2.5 text-xs font-semibold text-gray-500 w-1/3">Observaciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($logDefaults as $idx => $itemName)
                            @php $saved = $logMap[$itemName] ?? []; @endphp
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-4 py-2.5 text-sm text-gray-700">
                                    <input type="hidden" name="logistica[{{ $idx }}][item]" value="{{ $itemName }}">
                                    {{ $itemName }}
                                </td>
                                <td class="px-4 py-2.5 text-center">
                                    <input type="checkbox"
                                           name="logistica[{{ $idx }}][verificado]"
                                           value="1"
                                           {{ !empty($saved['verificado']) ? 'checked' : '' }}
                                           class="w-4 h-4 rounded border-gray-300 text-orange focus:ring-orange cursor-pointer">
                                </td>
                                <td class="px-4 py-2.5">
                                    <div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 transition-all duration-150 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)]">
                                        <input type="text"
                                               name="logistica[{{ $idx }}][observaciones]"
                                               value="{{ old('logistica.'.$idx.'.observaciones', $saved['observaciones'] ?? '') }}"
                                               placeholder="Observación..."
                                               class="w-full bg-transparent border-none px-2.5 py-1.5 text-xs text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-0">
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════
         SECCIÓN 5 — Materiales
    ══════════════════════════════════════════════ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100">
            <div class="w-7 h-7 rounded-lg bg-gray-600 flex items-center justify-center flex-shrink-0">
                <span class="text-white text-xs font-bold">5</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                <h3 class="font-semibold text-gray-700 text-sm">5. Materiales</h3>
            </div>
        </div>
        <div class="p-5">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

                {{-- Columna A --}}
                <div class="overflow-hidden rounded-xl border border-gray-200">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200">
                                <th class="text-left px-4 py-2.5 text-xs font-semibold text-gray-500">Material</th>
                                <th class="text-center px-3 py-2.5 text-xs font-semibold text-gray-500 w-16">Inicio</th>
                                <th class="text-center px-3 py-2.5 text-xs font-semibold text-gray-500 w-16">Término</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($matColA as $idx => $itemName)
                                @php $saved = $matMap[$itemName] ?? []; @endphp
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-4 py-2 text-xs text-gray-700">
                                        <input type="hidden" name="materiales[{{ $idx }}][item]" value="{{ $itemName }}">
                                        {{ $itemName }}
                                    </td>
                                    <td class="px-3 py-2 text-center">
                                        <input type="checkbox"
                                               name="materiales[{{ $idx }}][inicio]"
                                               value="1"
                                               {{ !empty($saved['inicio']) ? 'checked' : '' }}
                                               class="w-4 h-4 rounded border-gray-300 text-orange focus:ring-orange cursor-pointer">
                                    </td>
                                    <td class="px-3 py-2 text-center">
                                        <input type="checkbox"
                                               name="materiales[{{ $idx }}][termino]"
                                               value="1"
                                               {{ !empty($saved['termino']) ? 'checked' : '' }}
                                               class="w-4 h-4 rounded border-gray-300 text-orange focus:ring-orange cursor-pointer">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Columna B --}}
                <div class="overflow-hidden rounded-xl border border-gray-200">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200">
                                <th class="text-left px-4 py-2.5 text-xs font-semibold text-gray-500">Material</th>
                                <th class="text-center px-3 py-2.5 text-xs font-semibold text-gray-500 w-16">Inicio</th>
                                <th class="text-center px-3 py-2.5 text-xs font-semibold text-gray-500 w-16">Término</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($matColB as $relIdx => $itemName)
                                @php
                                    $idx   = count($matColA) + $relIdx;
                                    $saved = $matMap[$itemName] ?? [];
                                @endphp
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-4 py-2 text-xs text-gray-700">
                                        <input type="hidden" name="materiales[{{ $idx }}][item]" value="{{ $itemName }}">
                                        {{ $itemName }}
                                    </td>
                                    <td class="px-3 py-2 text-center">
                                        <input type="checkbox"
                                               name="materiales[{{ $idx }}][inicio]"
                                               value="1"
                                               {{ !empty($saved['inicio']) ? 'checked' : '' }}
                                               class="w-4 h-4 rounded border-gray-300 text-orange focus:ring-orange cursor-pointer">
                                    </td>
                                    <td class="px-3 py-2 text-center">
                                        <input type="checkbox"
                                               name="materiales[{{ $idx }}][termino]"
                                               value="1"
                                               {{ !empty($saved['termino']) ? 'checked' : '' }}
                                               class="w-4 h-4 rounded border-gray-300 text-orange focus:ring-orange cursor-pointer">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════
         SECCIÓN 6 — Equipos
    ══════════════════════════════════════════════ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="flex items-center gap-3 px-5 py-4 border-b border-blue-dark/8 bg-blue-dark/3">
            <div class="w-7 h-7 rounded-lg bg-blue-dark flex items-center justify-center flex-shrink-0">
                <span class="text-white text-xs font-bold">6</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-blue-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"/>
                </svg>
                <h3 class="font-semibold text-blue-dark text-sm">6. Equipos</h3>
            </div>
        </div>
        <div class="p-5">
            <div class="overflow-hidden rounded-xl border border-gray-200">
                <div x-data="{
                    equiposData: @js($equipos ?? []),
                    modelosData: @js($modelos ?? []),
                    selectedValues: @js(collect($equipDefaults ?? [])->mapWithKeys(function($equipName, $idx) use ($equipMap) {
                        $saved = $equipMap[$equipName] ?? [];
                        return [$idx => [
                            'modelo' => $saved['modelo'] ?? '',
                            'n_serie' => $saved['n_serie'] ?? '',
                            'inicio' => !empty($saved['inicio']),
                            'termino' => !empty($saved['termino'])
                        ]];
                    })->toArray())
                }">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200">
                                <th class="text-left px-4 py-2.5 text-xs font-semibold text-gray-500">Equipo</th>
                                <th class="text-left px-4 py-2.5 text-xs font-semibold text-gray-500 w-40">Modelo</th>
                                <th class="text-left px-4 py-2.5 text-xs font-semibold text-gray-500 w-40">N° Serie</th>
                                <th class="text-center px-3 py-2.5 text-xs font-semibold text-gray-500 w-16">Inicio</th>
                                <th class="text-center px-3 py-2.5 text-xs font-semibold text-gray-500 w-16">Término</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($equipDefaults as $idx => $equipName)
                                <tr class="hover:bg-gray-50/50 transition-colors"
                                    x-data="{ rowHovered: false }"
                                    @mouseenter="rowHovered = true"
                                    @mouseleave="rowHovered = false">

                                    {{-- Nombre del equipo (fijo) --}}
                                    <td class="px-4 py-2.5 text-sm text-gray-700">
                                        <input type="hidden" name="equipos_chequeo[{{ $idx }}][equipo]" value="{{ $equipName }}">
                                        {{ $equipName }}
                                    </td>

                                    {{-- Modelo — dropdown searchable --}}
                                    <td class="px-4 py-2">
                                        <div x-data="{
                                                open: false,
                                                search: '',
                                                dropdownStyle: '',
                                                get filtered() {
                                                    return modelosData.filter(m => m.toLowerCase().includes(this.search.toLowerCase()));
                                                },
                                                select(val) {
                                                    selectedValues[{{ $idx }}].modelo = val;
                                                    this.search = '';
                                                    this.open = false;
                                                },
                                                toggle() {
                                                    if (!this.open) {
                                                        const rect = this.$refs.modeloTrigger.getBoundingClientRect();
                                                        this.dropdownStyle = `position:fixed;z-index:9999;top:${rect.bottom+4}px;left:${rect.left}px;width:${rect.width}px;`;
                                                    }
                                                    this.open = !this.open;
                                                }
                                            }"
                                            @click.outside="open = false"
                                            class="relative">

                                            <input type="hidden" :name="`equipos_chequeo[{{ $idx }}][modelo]`" x-model="selectedValues[{{ $idx }}].modelo">

                                            <button type="button" x-ref="modeloTrigger" @click="toggle()"
                                                    class="w-full flex items-center justify-between rounded-lg border border-gray-200 bg-gray-50 px-2.5 py-1.5 text-xs transition-all duration-150 focus:border-orange focus:bg-white focus:outline-none"
                                                    :class="selectedValues[{{ $idx }}].modelo ? 'text-gray-800' : 'text-gray-400'">
                                                <span x-text="selectedValues[{{ $idx }}].modelo || '— Seleccionar Modelo —'"></span>
                                                <svg class="w-3 h-3 text-gray-400 transition-transform duration-150" :class="open && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                                </svg>
                                            </button>

                                            <template x-teleport="body">
                                                <div x-show="open" :style="dropdownStyle"
                                                    x-transition:enter="transition ease-out duration-100"
                                                    x-transition:enter-start="opacity-0 scale-95"
                                                    x-transition:enter-end="opacity-100 scale-100"
                                                    x-transition:leave="transition ease-in duration-75"
                                                    x-transition:leave-start="opacity-100 scale-100"
                                                    x-transition:leave-end="opacity-0 scale-95"
                                                    @click.outside="open = false"
                                                    style="display:none"
                                                    class="modelo-dropdown">
                                                    <div class="rounded-lg border border-gray-200 bg-white shadow-lg">
                                                        <div class="p-1.5 border-b border-gray-100">
                                                            <div class="flex items-center gap-1.5 rounded-md border border-gray-200 bg-gray-50 px-2 py-1 focus-within:border-orange focus-within:bg-white">
                                                                <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                                                                </svg>
                                                                <input type="text" x-model="search" @keydown.escape="open = false"
                                                                    placeholder="Buscar modelo..."
                                                                    class="w-full bg-transparent border-none p-0 text-xs text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                                                                <button x-show="search" @click="search = ''" type="button" class="text-gray-400 hover:text-gray-600">
                                                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <ul class="max-h-40 overflow-y-auto py-1">
                                                            <li @click="select('')"
                                                                class="px-3 py-1.5 text-xs text-gray-400 cursor-pointer hover:bg-orange/10 hover:text-orange"
                                                                :class="selectedValues[{{ $idx }}].modelo === '' && 'bg-orange/5 font-medium text-orange'">
                                                                — Ninguno —
                                                            </li>
                                                            <template x-for="modelo in filtered" :key="modelo">
                                                                <li @click="select(modelo)"
                                                                    class="px-3 py-1.5 text-xs text-gray-700 cursor-pointer hover:bg-orange/10 hover:text-orange"
                                                                    :class="selectedValues[{{ $idx }}].modelo === modelo && 'bg-orange/10 font-semibold text-orange'"
                                                                    x-text="modelo"></li>
                                                            </template>
                                                            <li x-show="filtered.length === 0" class="px-3 py-2 text-xs text-gray-400 text-center">Sin resultados</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </td>

                                    {{-- N° Serie — dropdown searchable --}}
                                    <td class="px-4 py-2">
                                        <div x-data="{
                                                open: false,
                                                search: '',
                                                dropdownStyle: '',
                                                get filtered() {
                                                    return equiposData.filter(e => e.toLowerCase().includes(this.search.toLowerCase()));
                                                },
                                                select(val) {
                                                    selectedValues[{{ $idx }}].n_serie = val;
                                                    this.search = '';
                                                    this.open = false;
                                                },
                                                toggle() {
                                                    if (!this.open) {
                                                        const rect = this.$refs.serieTrigger.getBoundingClientRect();
                                                        this.dropdownStyle = `position:fixed;z-index:9999;top:${rect.bottom+4}px;left:${rect.left}px;width:${rect.width}px;`;
                                                    }
                                                    this.open = !this.open;
                                                }
                                            }"
                                            @click.outside="open = false"
                                            class="relative">

                                            <input type="hidden" :name="`equipos_chequeo[{{ $idx }}][n_serie]`" x-model="selectedValues[{{ $idx }}].n_serie">

                                            <button type="button" x-ref="serieTrigger" @click="toggle()"
                                                    class="w-full flex items-center justify-between rounded-lg border border-gray-200 bg-gray-50 px-2.5 py-1.5 text-xs transition-all duration-150 focus:border-orange focus:bg-white focus:outline-none"
                                                    :class="selectedValues[{{ $idx }}].n_serie ? 'text-gray-800' : 'text-gray-400'">
                                                <span x-text="selectedValues[{{ $idx }}].n_serie || '— Seleccionar Serie —'"></span>
                                                <svg class="w-3 h-3 text-gray-400 transition-transform duration-150" :class="open && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                                </svg>
                                            </button>

                                            <template x-teleport="body">
                                                <div x-show="open" :style="dropdownStyle"
                                                    x-transition:enter="transition ease-out duration-100"
                                                    x-transition:enter-start="opacity-0 scale-95"
                                                    x-transition:enter-end="opacity-100 scale-100"
                                                    x-transition:leave="transition ease-in duration-75"
                                                    x-transition:leave-start="opacity-100 scale-100"
                                                    x-transition:leave-end="opacity-0 scale-95"
                                                    @click.outside="open = false"
                                                    style="display:none"
                                                    class="serie-dropdown">
                                                    <div class="rounded-lg border border-gray-200 bg-white shadow-lg">
                                                        <div class="p-1.5 border-b border-gray-100">
                                                            <div class="flex items-center gap-1.5 rounded-md border border-gray-200 bg-gray-50 px-2 py-1 focus-within:border-orange focus-within:bg-white">
                                                                <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                                                                </svg>
                                                                <input type="text" x-model="search" @keydown.escape="open = false"
                                                                    placeholder="Buscar número de serie..."
                                                                    class="w-full bg-transparent border-none p-0 text-xs text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                                                                <button x-show="search" @click="search = ''" type="button" class="text-gray-400 hover:text-gray-600">
                                                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <ul class="max-h-40 overflow-y-auto py-1">
                                                            <li @click="select('')"
                                                                class="px-3 py-1.5 text-xs text-gray-400 cursor-pointer hover:bg-orange/10 hover:text-orange"
                                                                :class="selectedValues[{{ $idx }}].n_serie === '' && 'bg-orange/5 font-medium text-orange'">
                                                                — Ninguno —
                                                            </li>
                                                            <template x-for="equipo in filtered" :key="equipo">
                                                                <li @click="select(equipo)"
                                                                    class="px-3 py-1.5 text-xs text-gray-700 cursor-pointer hover:bg-orange/10 hover:text-orange"
                                                                    :class="selectedValues[{{ $idx }}].n_serie === equipo && 'bg-orange/10 font-semibold text-orange'"
                                                                    x-text="equipo"></li>
                                                            </template>
                                                            <li x-show="filtered.length === 0" class="px-3 py-2 text-xs text-gray-400 text-center">Sin resultados</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </td>

                                    {{-- Inicio --}}
                                    <td class="px-3 py-2.5 text-center">
                                        <input type="hidden" :name="`equipos_chequeo[{{ $idx }}][inicio]`" value="0">
                                        <input type="checkbox"
                                            x-model="selectedValues[{{ $idx }}].inicio"
                                            :name="`equipos_chequeo[{{ $idx }}][inicio]`"
                                            value="1"
                                            class="w-4 h-4 rounded border-gray-300 text-orange focus:ring-orange cursor-pointer">
                                    </td>

                                    {{-- Término --}}
                                    <td class="px-3 py-2.5 text-center">
                                        <input type="hidden" :name="`equipos_chequeo[{{ $idx }}][termino]`" value="0">
                                        <input type="checkbox"
                                            x-model="selectedValues[{{ $idx }}].termino"
                                            :name="`equipos_chequeo[{{ $idx }}][termino]`"
                                            value="1"
                                            class="w-4 h-4 rounded border-gray-300 text-orange focus:ring-orange cursor-pointer">
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
 
            {{-- Aviso si no hay modelos o equipos configurados --}}
            @if(empty($modelos) || empty($equipos))
                <p class="mt-3 text-xs text-amber-600 flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    @if(empty($modelos))
                        No hay modelos configurados.
                    @endif
                    @if(empty($equipos))
                        No hay equipos (N° Serie) configurados.
                    @endif
                    <a href="{{ route('configuracion.index') }}" class="font-semibold underline hover:no-underline">
                        Ir a Configuración →
                    </a>
                </p>
            @endif
        </div>
    </div>

    {{-- ── Botones de acción ── --}}
    <div class="flex items-center justify-end gap-3 pt-2 pb-4">
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-2 px-5 py-2.5 rounded-xl border border-gray-200 text-gray-600 hover:text-blue-dark hover:border-blue-dark/30 text-sm font-medium transition-all duration-150">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
            Cancelar
        </a>
        <button type="submit"
                class="flex items-center gap-2 px-6 py-2.5 rounded-xl bg-orange hover:bg-orange-dark text-white text-sm font-semibold shadow-md hover:shadow-lg transition-all duration-150">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
            </svg>
            {{ $inst ? 'Actualizar Informe' : 'Guardar Informe' }}
        </button>
    </div>

</form>

<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('input, textarea, select').forEach(el => {
        el.removeAttribute('required');
    });
});
</script>
{{-- resources/views/registros/includes/formulario_6.blade.php --}}
{{-- Formulario 6: DBO 5 -IDE --}}
@php
    $inst = $instancia ?? null;
    $reg  = $registro ?? null;
@endphp
<form method="POST"
      id="Formulario"
      action="{{ $inst ? route('registros.update', $inst->registro_id ?? $inst->id) : route('registros.store') }}"
      enctype="multipart/form-data"
      class="space-y-5"
      >
    @csrf
    @if($inst) @method('PUT') @endif
    <input type="hidden" name="tipo_form_id" value="6" >
    
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
            {{-- Título Informe (span 6) --}}
            <div class="lg:col-span-6 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Título del Informe</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="titulo_informe"
                           value="{{ old('titulo_informe', $reg->titulo_informe ?? '') }}"
                           placeholder="Ej: Informe RIL Puntual Enero 2025"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>
            {{-- Código (span 3) --}}
            <div class="lg:col-span-3 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Código Informe</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="codigo"
                           value="{{ old('codigo', $reg->codigo_informe ?? '') }}"
                           placeholder="QEN_V4_..."
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>
            {{-- Fecha Emisión (span 3) --}}
            <div class="lg:col-span-3 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Fecha Emisión</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="date" name="fecha_emision"
                           value="{{ old('fecha_emision', $reg?->fecha_emision ?? '') }}"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 focus:outline-none focus:ring-0">
                </div>
            </div>
            
            {{-- Cliente (span 4) --}}
            <div class="lg:col-span-4 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Cliente / Razón Social</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="cliente_nombre"
                        value="{{ old('cliente_nombre', $reg->empresa_nombre ?? '') }}"
                        placeholder="Razón social del cliente"
                        class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            {{-- RUT Empresa (span 3) --}}  {{-- ← NUEVO --}}
            <div class="lg:col-span-3 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">RUT Empresa</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="rut_empresa"
                        value="{{ old('rut_empresa', $reg->rut_empresa ?? '') }}"
                        placeholder="76.580.736-0"
                        class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            {{-- Representante Legal (span 5) --}}  {{-- ← NUEVO --}}
            <div class="lg:col-span-5 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Nombre Representante Legal</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="representante_nombre"
                        value="{{ old('representante_nombre', $reg->representante_nombre ?? '') }}"
                        placeholder="Nombre completo del representante"
                        class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            {{-- RUN Representante (span 4) --}}  {{-- ← NUEVO --}}
            <div class="lg:col-span-4 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">RUN Representante Legal</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="representante_run"
                        value="{{ old('representante_run', $reg->representante_run ?? '') }}"
                        placeholder="14.653.735-9"
                        class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>
            {{-- Región (span 4) --}}
            <div class="lg:col-span-4 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Región</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="region"
                           value="{{ old('region', $reg->region ?? '') }}"
                           placeholder="Ej: Región Metropolitana"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>
            {{-- Comuna (span 4) --}}
            <div class="lg:col-span-4 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Comuna / Ciudad</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="comuna"
                           value="{{ old('comuna', $reg->comuna ?? '') }}"
                           placeholder="Ej: Santiago"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>
            {{-- Dirección Cliente (span 8) --}}
            <div class="lg:col-span-8 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Dirección Cliente</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="cliente_direccion"
                           value="{{ old('cliente_direccion', $reg->cliente_direccion ?? '') }}"
                           placeholder="Dirección completa del cliente"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>
            {{-- Logo Cliente (span 4) --}}
            <div class="lg:col-span-4">
                <label class="block text-xs font-medium text-gray-500 mb-1.5">Logo Empresa Cliente</label>
                <div class="flex items-center gap-2">
                    <div class="flex-1 flex items-center rounded-xl border border-gray-200 bg-gray-50 hover:border-blue-light/60 transition-all duration-200 overflow-hidden">
                        <label class="flex-shrink-0 px-3 py-2 text-xs text-gray-500 bg-gray-100 border-r border-gray-200 cursor-pointer hover:bg-gray-200 transition-colors">
                            Seleccionar
                            <input type="file" name="logo_cliente" accept="image/*" class="hidden"
                                   onchange="document.getElementById('logo_nombre_f1').textContent = this.files[0]?.name ?? 'Sin archivo'">
                        </label>
                        <span id="logo_nombre_f1" class="px-3 text-xs text-gray-400 truncate">
                            {{ $reg?->logo_cliente ? basename($reg->logo_cliente) : 'Sin archivo seleccionado' }}
                        </span>
                    </div>
                    @if($reg?->logo_cliente)
                        <button type="button"
                                onclick="viewImage('{{ asset('storage/' . $reg->logo_cliente) }}', 'Logo Cliente: {{ $reg->empresa_nombre }}')"
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
         SECCIÓN 2 — Inspector y Proyecto
    ══════════════════════════════════════════════ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="flex items-center gap-3 px-5 py-4 border-b border-orange/10 bg-orange/3">
            <div class="w-7 h-7 rounded-lg bg-orange flex items-center justify-center flex-shrink-0">
                <span class="text-white text-xs font-bold">2</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <h3 class="font-semibold text-orange text-sm">2. Inspector Ambiental y Proyecto</h3>
            </div>
        </div>
        <div class="p-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-4">
            {{-- Nombre Inspector (span 4) --}}
            <div class="lg:col-span-4 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Nombre Inspector</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="inspector_nombre"
                           value="{{ old('inspector_nombre', $inst->inspector_nombre ?? 'René Díaz V.') }}"
                           placeholder="Nombre completo"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>
            {{-- RUT Inspector (span 3) --}}
            <div class="lg:col-span-3 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">RUT Inspector</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="inspector_rut"
                           value="{{ old('inspector_rut', $inst->inspector_rut ?? '11.296.786-9') }}"
                           placeholder="12.345.678-9"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>
            {{-- No RCA (span 2) --}}
            <div class="lg:col-span-2 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">No RCA</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="n_rca"
                           value="{{ old('n_rca', $reg->n_rca ?? 'Resolución Exenta No 275/ 2010') }}"
                           placeholder="No"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>
            {{-- Nombre Proyecto (span 9) --}}
            <div class="lg:col-span-9 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Nombre del Proyecto Aprobado</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="nombre_proyecto"
                           value="{{ old('nombre_proyecto', $reg->nombre_proyecto ?? 'Monitoreo Autocontrol Central Termoeléctrica Campiche') }}"
                           placeholder="Nombre completo del proyecto aprobado"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════
         SECCIÓN 3 — Información del Muestreo
    ══════════════════════════════════════════════ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="flex items-center gap-3 px-5 py-4 border-b border-green/10 bg-green/3">
            <div class="w-7 h-7 rounded-lg bg-green flex items-center justify-center flex-shrink-0">
                <span class="text-white text-xs font-bold">3</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <h3 class="font-semibold text-green text-sm">3. Información del Muestreo</h3>
            </div>
        </div>
        <div class="p-5 space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach([
                    ['label'=>'Lugar de Muestreo',                  'name'=>'lugar_muestreo',       'value'=>$inst->lugar_muestreo ?? 'Unidad 4',       'placeholder'=>'Nombre del lugar'],
                    ['label'=>'Dirección de Muestreo',              'name'=>'direccion_muestreo',   'value'=>$inst->direccion_muestreo ?? 'Ruta F- 30 S/N, Puchuncavi, región de Valparaíso',   'placeholder'=>'Dirección completa'],
                    ['label'=>'Identificación Punto de Muestreo',   'name'=>'punto_muestreo',       'value'=>$inst->punto_muestreo ?? 'Descarga',       'placeholder'=>'Ej: Punto A, Aducción...'],
                    ['label'=>'Tipo de Muestra',                    'name'=>'tipo_muestra',         'value'=>$inst->tipo_muestra ?? 'Muestreo automático compuesto',         'placeholder'=>'Muestreo automático compuesto'],
                ] as $field)
                    <div class="group">
                        <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">{{ $field['label'] }}</label>
                        <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                            <input type="text" name="{{ $field['name'] }}"
                                   value="{{ old($field['name'], $field['value']) }}"
                                   placeholder="{{ $field['placeholder'] }}"
                                   class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                        </div>
                    </div>
                @endforeach
                <div class="group">
                    <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Fecha y Hora Inicio Muestreo</label>
                    <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                        <input type="datetime-local" name="inicio_muestreo"
                               value="{{ old('inicio_muestreo', $inst?->inicio_muestreo?->format('Y-m-d\TH:i') ?? '') }}"
                               class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 focus:outline-none focus:ring-0">
                    </div>
                </div>
                <div class="group">
                    <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Fecha y Hora Término Muestreo</label>
                    <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                        <input type="datetime-local" name="fin_muestreo"
                               value="{{ old('fin_muestreo', $inst?->fin_muestreo?->format('Y-m-d\TH:i') ?? '') }}"
                               class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 focus:outline-none focus:ring-0">
                    </div>
                </div>
            </div>

            {{-- Tabla de equipos --}}
            <div class="mt-2 overflow-hidden rounded-xl border border-gray-200">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="text-left px-4 py-2.5 text-xs font-semibold text-gray-500 w-1/2">Medición / Norma</th>
                            <th class="text-left px-4 py-2.5 text-xs font-semibold text-gray-500 w-1/3">Código Equipo</th>
                            <th class="text-center px-4 py-2.5 text-xs font-semibold text-gray-500 w-1/6">Realizada</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach([
                            ['label'=>'Toma de Muestra: NCh411/10.Of2005.',  'name_eq'=>'eq_muestreo_cod',   'name_chk'=>'eq_muestreo_chk',   'eq_val'=>$inst->eq_muestreo_cod ?? '',  'chk_val'=>$inst->eq_muestreo_chk ?? true],
                            ['label'=>'pH: (NCh2313/1.Of95.)',                'name_eq'=>'eq_ph_cod',         'name_chk'=>'eq_ph_chk',         'eq_val'=>$inst->eq_ph_cod ?? '',         'chk_val'=>$inst->eq_ph_chk ?? true],
                            ['label'=>'Temperatura: (NCh2313/2.Of95.)',       'name_eq'=>'eq_temp_cod',       'name_chk'=>'eq_temp_chk',       'eq_val'=>$inst->eq_temp_cod ?? '',       'chk_val'=>$inst->eq_temp_chk ?? true],
                        ] as $row)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-4 py-2.5 text-xs text-gray-600">{{ $row['label'] }}</td>
                            <td class="px-4 py-2.5">
                                {{-- Searchable select con Alpine.js --}}
                                <div x-data="{
                                        open: false,
                                        search: '',
                                        selected: '{{ old($row['name_eq'], $row['eq_val']) }}',
                                        equipos: @js($equipos),
                                        dropdownStyle: '',
                                        get filtered() {
                                            return this.equipos.filter(e =>
                                                e.toLowerCase().includes(this.search.toLowerCase())
                                            )
                                        },
                                        select(val) {
                                            this.selected = val;
                                            this.search = '';
                                            this.open = false;
                                        },
                                        toggle() {
                                            if (!this.open) {
                                                const rect = this.$refs.trigger.getBoundingClientRect();
                                                this.dropdownStyle = `position:fixed; z-index:9999; top:${rect.bottom + 4}px; left:${rect.left}px; width:${rect.width}px;`;
                                            }
                                            this.open = !this.open;
                                        }
                                    }"
                                    @click.outside="if(!$event.target.closest('.equipo-dropdown')) open = false"
                                    class="relative">
                                    {{-- Input hidden para el form --}}
                                    <input type="hidden" name="{{ $row['name_eq'] }}" :value="selected">
                                    {{-- Botón trigger --}}
                                    <button type="button"
                                            x-ref="trigger"
                                            @click="toggle()"
                                            class="w-full flex items-center justify-between rounded-lg border border-gray-200 bg-gray-50 px-2.5 py-1.5 text-xs transition-all duration-150 focus:border-orange focus:bg-white focus:shadow-[0_0_0_2px_rgba(255,140,66,0.15)] focus:outline-none"
                                            :class="selected ? 'text-gray-800' : 'text-gray-400'">
                                        <span x-text="selected || '— Seleccionar —'"></span>
                                        <svg class="w-3 h-3 text-gray-400 transition-transform duration-150" :class="open && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </button>
                                    {{-- Dropdown teletransportado al body --}}
                                    <template x-teleport="body">
                                        <div x-show="open"
                                            :style="dropdownStyle"
                                            x-transition:enter="transition ease-out duration-100"
                                            x-transition:enter-start="opacity-0 scale-95"
                                            x-transition:enter-end="opacity-100 scale-100"
                                            x-transition:leave="transition ease-in duration-75"
                                            x-transition:leave-start="opacity-100 scale-100"
                                            x-transition:leave-end="opacity-0 scale-95"
                                            @click.outside="open = false"
                                            style="display:none"
                                            class="equipo-dropdown">
                                            <div class="rounded-lg border border-gray-200 bg-white shadow-lg">
                                                {{-- Buscador --}}
                                                <div class="p-1.5 border-b border-gray-100">
                                                    <div class="flex items-center gap-1.5 rounded-md border border-gray-200 bg-gray-50 px-2 py-1 focus-within:border-orange focus-within:bg-white">
                                                        <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                                                        </svg>
                                                        <input type="text"
                                                            x-model="search"
                                                            @keydown.escape="open = false"
                                                            placeholder="Buscar serie..."
                                                            class="w-full bg-transparent border-none p-0 text-xs text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                                                        <button x-show="search" @click="search = ''" type="button" class="text-gray-400 hover:text-gray-600">
                                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                                {{-- Opciones --}}
                                                <ul class="max-h-40 overflow-y-auto py-1">
                                                    <li @click="select('')"
                                                        class="px-3 py-1.5 text-xs text-gray-400 cursor-pointer hover:bg-orange/10 hover:text-orange"
                                                        :class="selected === '' && 'bg-orange/5 font-medium text-orange'">
                                                        — Ninguno —
                                                    </li>
                                                    <template x-for="equipo in filtered" :key="equipo">
                                                        <li @click="select(equipo)"
                                                            class="px-3 py-1.5 text-xs text-gray-700 cursor-pointer hover:bg-orange/10 hover:text-orange"
                                                            :class="selected === equipo && 'bg-orange/10 font-semibold text-orange'"
                                                            x-text="equipo">
                                                        </li>
                                                    </template>
                                                    <li x-show="filtered.length === 0" class="px-3 py-2 text-xs text-gray-400 text-center">
                                                        Sin resultados
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </td>
                            <td class="px-4 py-2.5 text-center">
                                <input type="hidden" name="{{ $row['name_chk'] }}" value="0">
                                <input type="checkbox" name="{{ $row['name_chk'] }}" value="1"
                                    {{ old($row['name_chk'], $row['chk_val']) ? 'checked' : '' }}
                                    class="w-4 h-4 rounded border-gray-300 text-orange focus:ring-orange cursor-pointer">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════
         SECCIÓN 4 — PUNTO DE MUESTREO
    ══════════════════════════════════════════════ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="flex items-center gap-3 px-5 py-4 border-b border-purple-500/10 bg-purple-500/3">
            <div class="w-7 h-7 rounded-lg bg-purple-500 flex items-center justify-center flex-shrink-0">
                <span class="text-white text-xs font-bold">4</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <h3 class="font-semibold text-purple-500 text-sm">4. Punto de Muestreo</h3>
            </div>
        </div>
        <div class="p-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Estación</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="estacion"
                           value="{{ old('estacion', $inst->estacion ?? '') }}"
                           placeholder="Nombre de la estación"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>
            <div class="group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Punto de Muestreo</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="punto_muestreo_sec4"
                           value="{{ old('punto_muestreo_sec4', $inst->punto_muestreo_sec4 ?? '') }}"
                           placeholder="Identificación del punto"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>
            <div class="group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">UTM Este (m)</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="utm_este"
                           value="{{ old('utm_este', $inst->utm_este ?? '') }}"
                           placeholder="Ej: 283456"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>
            <div class="group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">UTM Norte (m)</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="utm_norte"
                           value="{{ old('utm_norte', $inst->utm_norte ?? '') }}"
                           placeholder="Ej: 6345678"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════
         SECCIÓN 5 — Mediciones In Situ
    ══════════════════════════════════════════════ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="flex items-center gap-3 px-5 py-4 border-b border-blue-dark/8 bg-blue-dark/3">
            <div class="w-7 h-7 rounded-lg bg-blue flex items-center justify-center flex-shrink-0">
                <span class="text-white text-xs font-bold">5</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                <h3 class="font-semibold text-blue text-sm">5. Mediciones In Situ</h3>
            </div>
        </div>
        <div class="p-5 overflow-x-auto">
            <p class="text-xs text-gray-400 mb-3 flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5 text-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Todos los campos de la tabla son editables.
            </p>
            <table class="w-full text-sm min-w-[650px]">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="text-left px-3 py-2.5 text-xs font-semibold text-gray-500 rounded-l-xl w-1/6">Ítem</th>
                        <th class="text-left px-3 py-2.5 text-xs font-semibold text-gray-500">Fecha</th>
                        <th class="text-left px-3 py-2.5 text-xs font-semibold text-gray-500">Hora</th>
                        <th class="text-left px-3 py-2.5 text-xs font-semibold text-gray-500">pH (U)</th>
                        <th class="text-left px-3 py-2.5 text-xs font-semibold text-gray-500">Temp (°C)</th>
                        <th class="w-10 rounded-r-xl"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100" id="f6_tbody_mediciones">
                    @php
                        $mediciones = $inst->mediciones_array ?? [
                            ['item' => 'RIL', 'fecha' => '', 'hora' => '', 'ph' => '', 'temp' => ''],
                            ['item' => 'SST', 'fecha' => '', 'hora' => '', 'ph' => '', 'temp' => '']
                        ];
                    @endphp
                    @foreach($mediciones as $i => $med)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-3 py-2.5">
                                <div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)] transition-all">
                                    <input type="text" name="mediciones[{{$i}}][item]" value="{{ $med['item'] ?? '' }}" class="w-full bg-transparent border-none px-2.5 py-1.5 text-xs font-semibold text-gray-800 focus:outline-none focus:ring-0">
                                </div>
                            </td>
                            <td class="px-3 py-2.5">
                                <div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)] transition-all">
                                    <input type="date" name="mediciones[{{$i}}][fecha]" value="{{ $med['fecha'] ?? '' }}" class="w-full bg-transparent border-none px-2.5 py-1.5 text-xs text-gray-800 focus:outline-none focus:ring-0">
                                </div>
                            </td>
                            <td class="px-3 py-2.5">
                                <div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)] transition-all">
                                    <input type="time" name="mediciones[{{$i}}][hora]" value="{{ $med['hora'] ?? '' }}" class="w-full bg-transparent border-none px-2.5 py-1.5 text-xs text-gray-800 focus:outline-none focus:ring-0">
                                </div>
                            </td>
                            <td class="px-3 py-2.5">
                                <div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)] transition-all">
                                    <input type="number" step="0.01" name="mediciones[{{$i}}][ph]" value="{{ $med['ph'] ?? '' }}" class="w-full bg-transparent border-none px-2.5 py-1.5 text-xs text-gray-800 focus:outline-none focus:ring-0">
                                </div>
                            </td>
                            <td class="px-3 py-2.5">
                                <div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)] transition-all">
                                    <input type="number" step="0.01" name="mediciones[{{$i}}][temp]" value="{{ $med['temp'] ?? '' }}" class="w-full bg-transparent border-none px-2.5 py-1.5 text-xs text-gray-800 focus:outline-none focus:ring-0">
                                </div>
                            </td>
                            <td class="px-2 text-center">
                                <button type="button" onclick="eliminarFila(this)" class="text-gray-400 hover:text-red-500 transition-colors p-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="mt-2 flex justify-end">
                <button type="button" onclick="agregarMedicion()" 
                        class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-dashed border-gray-300 text-gray-500 hover:border-blue hover:text-blue hover:bg-blue/5 text-xs font-semibold transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Agregar Medición
                </button>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════
         SECCIÓN 6 — Observaciones
    ══════════════════════════════════════════════ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100">
            <div class="w-7 h-7 rounded-lg bg-gray-600 flex items-center justify-center flex-shrink-0">
                <span class="text-white text-xs font-bold">6</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                <h3 class="font-semibold text-gray-700 text-sm">6. Observaciones</h3>
            </div>
        </div>
        <div class="p-5">
            <div class="group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Observaciones</label>
                <div class="rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <textarea name="observaciones" rows="3"
                              class="w-full bg-transparent border-none px-3 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0 resize-none rounded-xl"
                              placeholder="Observaciones del muestreo...">{{ old('observaciones', $inst->observaciones ?? '') }}</textarea>
                </div>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════
         SECCIÓN 7 — Resultados (Dinámica)
    ══════════════════════════════════════════════ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="flex items-center gap-3 px-5 py-4 border-b border-indigo-500/10 bg-indigo-500/3">
            <div class="w-7 h-7 rounded-lg bg-indigo-500 flex items-center justify-center flex-shrink-0">
                <span class="text-white text-xs font-bold">7</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                <h3 class="font-semibold text-indigo-500 text-sm">7. Resultados</h3>
            </div>
        </div>
        <div class="p-5">
            <p class="text-xs text-gray-400 mb-3 flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Agregue los resultados necesarios para este informe.
            </p>
            
            <div class="space-y-3" id="resultados_container">
                @php
                    $resultados = $inst->resultados_array ?? [
                        ['item' => '', 'resultado' => '']
                    ];
                @endphp
                @foreach($resultados as $i => $res)
                    <div class="grid grid-cols-12 gap-3 items-start resultado-row">
                        <div class="col-span-5 group">
                            <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Ítem</label>
                            <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                                <input type="text" name="resultados[{{$i}}][item]" 
                                       value="{{ old('resultados.'.$i.'.item', $res['item'] ?? '') }}"
                                       placeholder="Ej: DBO5, SST, pH..."
                                       class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                            </div>
                        </div>
                        <div class="col-span-6 group">
                            <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Resultado</label>
                            <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                                <input type="text" name="resultados[{{$i}}][resultado]" 
                                       value="{{ old('resultados.'.$i.'.resultado', $res['resultado'] ?? '') }}"
                                       placeholder="Valor del resultado"
                                       class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                            </div>
                        </div>
                        <div class="col-span-1 flex items-end pb-0.5">
                            <button type="button" onclick="eliminarResultado(this)" 
                                    class="w-full h-10 flex items-center justify-center text-gray-400 hover:text-red-500 transition-colors rounded-lg hover:bg-red-50">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-3 flex justify-end">
                <button type="button" onclick="agregarResultado()" 
                        class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-dashed border-gray-300 text-gray-500 hover:border-indigo-500 hover:text-indigo-500 hover:bg-indigo-500/5 text-xs font-semibold transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Agregar Resultado
                </button>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════
         SECCIÓN 8 — Anexos (7 imágenes)
    ══════════════════════════════════════════════ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100">
            <div class="w-7 h-7 rounded-lg bg-gray-700 flex items-center justify-center flex-shrink-0">
                <span class="text-white text-xs font-bold">8</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <h3 class="font-semibold text-gray-700 text-sm">8. Anexos</h3>
            </div>
        </div>
        <div class="p-5">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @php
                    $anexos = [
                        ['n'=>1, 'name'=>'anexo_1', 'title_name'=>'anexo_1_titulo', 'title_val'=>$inst->anexo_1_titulo ?? 'Punto de Muestreo', 'file'=>$inst->anexo_1_file ?? null],
                        ['n'=>2, 'name'=>'anexo_2', 'title_name'=>'anexo_2_titulo', 'title_val'=>$inst->anexo_2_titulo ?? 'Registro Fotográfico 1', 'file'=>$inst->anexo_2_file ?? null],
                        ['n'=>3, 'name'=>'anexo_3', 'title_name'=>'anexo_3_titulo', 'title_val'=>$inst->anexo_3_titulo ?? 'Registro Fotográfico 2', 'file'=>$inst->anexo_3_file ?? null],
                        ['n'=>4, 'name'=>'anexo_4', 'title_name'=>'anexo_4_titulo', 'title_val'=>$inst->anexo_4_titulo ?? 'Cadena de Custodia', 'file'=>$inst->anexo_4_file ?? null],
                        ['n'=>5, 'name'=>'anexo_5', 'title_name'=>'anexo_5_titulo', 'title_val'=>$inst->anexo_5_titulo ?? 'Resultado de Laboratorio', 'file'=>$inst->anexo_5_file ?? null],
                        ['n'=>6, 'name'=>'anexo_6', 'title_name'=>'anexo_6_titulo', 'title_val'=>$inst->anexo_6_titulo ?? 'Declaración Jurada para la Operatividad de la entidad Técnica de Fiscalización Ambiental', 'file'=>$inst->anexo_6_file ?? null],
                        ['n'=>7, 'name'=>'anexo_7', 'title_name'=>'anexo_7_titulo', 'title_val'=>$inst->anexo_7_titulo ?? 'Declaración Jurada para la Operatividad del Inspector Ambiental', 'file'=>$inst->anexo_7_file ?? null],
                    ];
                @endphp
                @foreach($anexos as $anexo)
                    <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 space-y-3 hover:border-blue-light/40 transition-colors">
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center justify-center w-6 h-6 rounded-lg bg-blue-dark text-white text-xs font-bold">
                                {{ $anexo['n'] }}
                            </span>
                            @if($anexo['file'])
                                <button type="button"
                                        onclick="viewImage('{{ asset('storage/' . $anexo['file']) }}', 'Anexo {{ $anexo['n'] }}: {{ $anexo['title_val'] }}')"
                                        class="flex items-center gap-1 text-xs text-blue hover:text-blue-dark transition-colors font-medium">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Ver
                                </button>
                            @endif
                        </div>
                        <div class="group">
                            <label class="block text-xs text-gray-400 mb-1">Título</label>
                            <div class="flex items-center rounded-lg border border-gray-200 bg-white transition-all duration-150 focus-within:border-orange focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)]">
                                <input type="text"
                                    name="{{ $anexo['title_name'] }}"
                                    value="{{ old($anexo['title_name'], $anexo['title_val']) }}"
                                    placeholder="Título del anexo"
                                    class="w-full bg-transparent border-none px-2.5 py-1.5 text-xs text-gray-600 focus:outline-none focus:ring-0">
                            </div>
                        </div>
                        <label class="block cursor-pointer">
                            <div class="flex items-center gap-2 px-3 py-2 rounded-lg border border-dashed border-gray-300 bg-white hover:border-orange/50 hover:bg-orange/3 transition-all text-xs text-gray-500 hover:text-orange">
                                <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="font-medium">Subir imagen</span>
                            </div>
                            <input type="file" 
                                name="{{ $anexo['name'] }}" 
                                accept="image/*" 
                                class="hidden">
                        </label>
                        {{-- Eliminado el div que mostraba el nombre del archivo --}}
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ══ Templates (hidden) ══ --}}
    <template id="f6_template-medicion">
        <tr class="hover:bg-gray-50/50 transition-colors">
            {{-- Item --}}
            <td class="px-3 py-2.5">
                <div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)] transition-all">
                    <input type="text" name="mediciones[INDEX][item]" class="w-full bg-transparent border-none px-2.5 py-1.5 text-xs font-semibold text-gray-800 focus:outline-none focus:ring-0" placeholder="Item...">
                </div>
            </td>
            {{-- Fecha --}}
            <td class="px-3 py-2.5">
                <div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)] transition-all">
                    <input type="date" name="mediciones[INDEX][fecha]" class="w-full bg-transparent border-none px-2.5 py-1.5 text-xs text-gray-800 focus:outline-none focus:ring-0">
                </div>
            </td>
            {{-- Hora --}}
            <td class="px-3 py-2.5">
                <div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)] transition-all">
                    <input type="time" name="mediciones[INDEX][hora]" class="w-full bg-transparent border-none px-2.5 py-1.5 text-xs text-gray-800 focus:outline-none focus:ring-0">
                </div>
            </td>
            {{-- Ph --}}
            <td class="px-3 py-2.5">
                <div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)] transition-all">
                    <input type="number" step="0.01" name="mediciones[INDEX][ph]" class="w-full bg-transparent border-none px-2.5 py-1.5 text-xs text-gray-800 focus:outline-none focus:ring-0">
                </div>
            </td>
            {{-- Temperatura --}}
            <td class="px-3 py-2.5">
                <div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)] transition-all">
                    <input type="number" step="0.01" name="mediciones[INDEX][temp]" class="w-full bg-transparent border-none px-2.5 py-1.5 text-xs text-gray-800 focus:outline-none focus:ring-0">
                </div>
            </td>
            <td class="px-2 text-center">
                <button type="button" onclick="eliminarFila(this)" class="text-gray-400 hover:text-red-500 transition-colors p-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                </button>
            </td>
        </tr>
    </template>

    {{-- ══════════════════════════════════════════════
        SECCIÓN 9 — Configuración del PDF
    ══════════════════════════════════════════════ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100">
            <div class="w-7 h-7 rounded-lg bg-gray-500 flex items-center justify-center flex-shrink-0">
                <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <div>
                <h3 class="font-semibold text-gray-700 text-sm">9. Configuración del PDF</h3>
                <p class="text-xs text-gray-400 mt-0.5">Selecciona qué páginas estáticas se incluirán en el documento final</p>
            </div>
        </div>
        <div class="p-5">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wide mb-3">Páginas de Declaraciones Juradas</p>
            <div class="space-y-3">

                {{-- Toggle: DJ Inspector Ambiental --}}
                <div x-data="{ on: {{ old('mostrar_dj_inspector', $inst->mostrar_dj_inspector ?? true) ? 'true' : 'false' }} }"
                    class="flex items-center justify-between px-4 py-3 rounded-xl border transition-colors duration-200"
                    :class="on ? 'border-blue-dark/20 bg-blue-dark/3' : 'border-gray-200 bg-gray-50'">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors duration-200"
                            :class="on ? 'bg-blue-dark' : 'bg-gray-200'">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-700">Declaración Jurada — Inspector Ambiental</p>
                            <p class="text-xs text-gray-400">Operatividad del Inspector Ambiental (ETFA-GEN-02)</p>
                        </div>
                    </div>
                    <label class="relative flex-shrink-0 cursor-pointer">
                        <input type="hidden" name="mostrar_dj_inspector" value="0">
                        <input type="checkbox" name="mostrar_dj_inspector" value="1"
                            x-model="on"
                            {{ old('mostrar_dj_inspector', $inst->mostrar_dj_inspector ?? true) ? 'checked' : '' }}
                            class="sr-only peer">
                        <div class="w-10 h-5 rounded-full transition-colors duration-200 peer-focus:outline-none
                                    bg-gray-200 peer-checked:bg-blue-dark"
                            :class="on ? 'bg-blue-dark' : 'bg-gray-200'">
                        </div>
                        <div class="absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full shadow transition-transform duration-200"
                            :class="on ? 'translate-x-5' : 'translate-x-0'">
                        </div>
                    </label>
                </div>

                {{-- Toggle: DJ ETFA --}}
                <div x-data="{ on: {{ old('mostrar_dj_etfa', $inst->mostrar_dj_etfa ?? true) ? 'true' : 'false' }} }"
                    class="flex items-center justify-between px-4 py-3 rounded-xl border transition-colors duration-200"
                    :class="on ? 'border-blue-dark/20 bg-blue-dark/3' : 'border-gray-200 bg-gray-50'">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors duration-200"
                            :class="on ? 'bg-blue-dark' : 'bg-gray-200'">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-2 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-700">Declaración Jurada — ETFA</p>
                            <p class="text-xs text-gray-400">Operatividad de la Entidad Técnica de Fiscalización Ambiental</p>
                        </div>
                    </div>
                    <label class="relative flex-shrink-0 cursor-pointer">
                        <input type="hidden" name="mostrar_dj_etfa" value="0">
                        <input type="checkbox" name="mostrar_dj_etfa" value="1"
                            x-model="on"
                            {{ old('mostrar_dj_etfa', $inst->mostrar_dj_etfa ?? true) ? 'checked' : '' }}
                            class="sr-only peer">
                        <div class="w-10 h-5 rounded-full transition-colors duration-200 peer-focus:outline-none"
                            :class="on ? 'bg-blue-dark' : 'bg-gray-200'">
                        </div>
                        <div class="absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full shadow transition-transform duration-200"
                            :class="on ? 'translate-x-5' : 'translate-x-0'">
                        </div>
                    </label>
                </div>

            </div>
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
function agregarMedicion() {
    const tbody = document.getElementById('f6_tbody_mediciones');
    const template = document.getElementById('f6_template-medicion');
    
    if (!template) {
        console.error('Template no encontrado');
        return;
    }
    
    const clone = template.content.cloneNode(true);
    const index = Date.now();
    
    // Reemplazar INDEX por el timestamp único
    clone.querySelectorAll('[name*="INDEX"]').forEach(el => {
        el.name = el.name.replace('INDEX', index);
    });
    
    tbody.appendChild(clone);
}

function agregarResultado() {
    const container = document.getElementById('resultados_container');
    const index = Date.now();
    
    const div = document.createElement('div');
    div.className = 'grid grid-cols-12 gap-3 items-start resultado-row';
    div.innerHTML = `
        <div class="col-span-5 group">
            <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Ítem</label>
            <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                <input type="text" name="resultados[${index}][item]" 
                       placeholder="Ej: DBO5, SST, pH..."
                       class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
            </div>
        </div>
        <div class="col-span-6 group">
            <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Resultado</label>
            <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                <input type="text" name="resultados[${index}][resultado]" 
                       placeholder="Valor del resultado"
                       class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
            </div>
        </div>
        <div class="col-span-1 flex items-end pb-0.5">
            <button type="button" onclick="eliminarResultado(this)" 
                    class="w-full h-10 flex items-center justify-center text-gray-400 hover:text-red-500 transition-colors rounded-lg hover:bg-red-50">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </button>
        </div>
    `;
    
    container.appendChild(div);
}

function eliminarFila(btn) {
    btn.closest('tr').remove();
}

function eliminarResultado(btn) {
    btn.closest('.resultado-row').remove();
}

function onAnexoChange(input, n) {
    const nombreSpan = document.getElementById(`anexo_nombre_${n}`);
    const infoDiv = document.getElementById(`anexo_info_${n}`);
    
    if (input.files.length > 0) {
        nombreSpan.textContent = input.files[0].name;
        infoDiv.classList.remove('hidden');
    } else {
        nombreSpan.textContent = '';
        infoDiv.classList.add('hidden');
    }
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('input, textarea, select').forEach(el => {
        el.removeAttribute('required');
    });
    
    const observer = new MutationObserver(() => {
        document.querySelectorAll('[required]').forEach(el => el.removeAttribute('required'));
    });
    observer.observe(document.body, { attributes: true, subtree: true, attributeFilter: ['required'] });
});
</script>
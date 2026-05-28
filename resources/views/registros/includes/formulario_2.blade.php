{{-- resources/views/registros/includes/formulario_2.blade.php --}}
{{-- Formulario 2: RIL 24 Horas --}}
@php
    $inst = $instancia ?? null;
    $reg  = $registro ?? null;
@endphp
<form method="POST"
      id="Formulario"
      action="{{ $inst ? route('registros.update', $inst->registro_id ?? $inst->id) : route('registros.store') }}"
      enctype="multipart/form-data"
      class="space-y-5">
    @csrf
    @if($inst) @method('PUT') @endif
    <input type="hidden" name="tipo_form_id" value="2">
    {{-- Macro: input field wrapper --}}
    @php
        $fieldClass = 'w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0';
        $wrapClass  = 'flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60';
    @endphp
    {{-- ══ SECCIÓN 1 — Identificación ══ --}}
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
                    <div class="flex-1 file-input-wrapper flex items-center rounded-xl border border-gray-200 bg-gray-50 hover:border-blue-light/60 transition-all duration-200 overflow-hidden">
                        <label class="flex-shrink-0 px-3 py-2 text-xs text-gray-500 bg-gray-100 border-r border-gray-200 cursor-pointer hover:bg-gray-200 transition-colors">
                            Seleccionar
                            <input type="file" name="logo_cliente" accept="image/*" class="hidden">
                        </label>
                        <span class="file-name-display px-3 text-xs text-gray-400 truncate">
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

            {{-- Nº RCA (span 2) --}}
            <div class="lg:col-span-2 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Nº RCA</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="n_rca"
                           value="{{ old('n_rca', $reg->n_rca ?? 'Resolución Exenta Nº 275/ 2010') }}"
                           placeholder="Nº"
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

    {{-- ══ SECCIÓN 3 — Información del Muestreo ══ --}}
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
            <div
                x-data="{
                    rows: @js(
                        collect($inst?->equipos_array ?? [
                            ['label' => 'Toma de Muestra: NCh411/10.Of2005. Parte 10. Muestreo de aguas residuales - Recolección y manejo de las muestras. 2005. INN', 'eq_val' => '', 'chk_val' => true],
                            ['label' => 'pH: (NCh2313/1.Of2021. Parte 1. Determinación de pH.1995. INN',             'eq_val' => '', 'chk_val' => true],
                            ['label' => 'Temperatura: (NCh2313/2.Of95. Parte 2. Determinación de la temperatura.1995. INN)',      'eq_val' => '', 'chk_val' => true],
                        ])->map(fn($r, $i) => [
                            'id'      => 'row_' . $i,
                            'label'   => $r['label']   ?? '',
                            'eq_val'  => $r['eq_val']  ?? '',
                            'chk_val' => (bool)($r['chk_val'] ?? true),
                        ])
                    ),
                    equipos: @js($equipos),
                    getLabel(eq) {
                        let label = eq.codigo;
                        if (eq.descripcion) label += ' — ' + eq.descripcion;
                        if (eq.modelos && eq.modelos.length) label += ' (' + eq.modelos.join(', ') + ')';
                        return label;
                    },
                    addRow() {
                        this.rows.push({ id: 'r_' + Date.now(), label: '', eq_val: '', chk_val: true });
                    },
                    removeRow(id) {
                        this.rows = this.rows.filter(r => r.id !== id);
                    },
                }"
                class="mt-2 overflow-hidden rounded-xl border border-gray-200">

                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="text-left px-4 py-2.5 text-xs font-semibold text-gray-500 w-1/2">Medición / Norma</th>
                            <th class="text-left px-4 py-2.5 text-xs font-semibold text-gray-500 w-1/3">Código Equipo</th>
                            <th class="text-center px-4 py-2.5 text-xs font-semibold text-gray-500 w-1/6">Realizada</th>
                            <th class="w-8"></th> {{-- columna acciones --}}
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <template x-for="(row, rowIdx) in rows" :key="row.id">
                            <tr class="hover:bg-gray-50/50 transition-colors"
                                x-data="{ hovered: false }"
                                @mouseenter="hovered = true"
                                @mouseleave="hovered = false">

                                {{-- Medición / Norma --}}
                                <td class="px-4 py-2.5">
                                    <div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 transition-all duration-150
                                                focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)]">
                                        <input type="text"
                                            :name="`equipos[${rowIdx}][label]`"
                                            x-model="row.label"
                                            placeholder="Ej: pH: NCh2313/1..."
                                            class="w-full bg-transparent border-none px-2.5 py-1.5 text-xs text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-0">
                                    </div>
                                </td>

                                {{-- Código Equipo — searchable dropdown --}}
                                <td class="px-4 py-2.5">
                                    <div x-data="{
                                            open: false,
                                            search: '',
                                            dropdownStyle: '',
                                            _scrollHandler: null,
                                            get filtered() {
                                                const q = this.search.toLowerCase();
                                                return equipos.filter(e =>
                                                    e.codigo.toLowerCase().includes(q) ||
                                                    (e.descripcion && e.descripcion.toLowerCase().includes(q)) ||
                                                    (e.modelos && e.modelos.some(m => m.toLowerCase().includes(q)))
                                                );
                                            },
                                            select(val) { row.eq_val = val; this.search = ''; this.close(); },
                                            calcPos() {
                                                const rect = this.$refs.trigger.getBoundingClientRect();
                                                this.dropdownStyle = `position:fixed;z-index:9999;top:${rect.bottom+4}px;left:${rect.left}px;width:${Math.max(rect.width, 220)}px;`;
                                            },
                                            open_dd() {
                                                this.calcPos();
                                                this.open = true;
                                                this._scrollHandler = () => { if (this.open) this.calcPos(); };
                                                window.addEventListener('scroll', this._scrollHandler, true);
                                                this.$nextTick(() => this.$refs.searchInput?.focus());
                                            },
                                            close() {
                                                this.open = false;
                                                if (this._scrollHandler) {
                                                    window.removeEventListener('scroll', this._scrollHandler, true);
                                                    this._scrollHandler = null;
                                                }
                                            },
                                            toggle() { this.open ? this.close() : this.open_dd(); }
                                        }"
                                        class="relative">

                                        <input type="hidden" :name="`equipos[${rowIdx}][eq_val]`" x-bind:value="row.eq_val">

                                        <button type="button" x-ref="trigger" @click="toggle()"
                                                class="w-full flex items-center justify-between rounded-lg border border-gray-200 bg-gray-50 px-2.5 py-1.5 text-xs transition-all duration-150 focus:border-orange focus:bg-white focus:outline-none"
                                                :class="row.eq_val ? 'text-gray-800' : 'text-gray-400'">
                                            <span x-text="row.eq_val ? (equipos.find(e => e.codigo === row.eq_val)?.descripcion ? row.eq_val + ' — ' + equipos.find(e => e.codigo === row.eq_val).descripcion : row.eq_val) : '— Seleccionar —'"></span>
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
                                                @click.outside="close()"
                                                @keydown.escape.window="close()"
                                                style="display:none"
                                                class="equipo-dropdown">
                                                <div class="rounded-lg border border-gray-200 bg-white shadow-lg">
                                                    <div class="p-1.5 border-b border-gray-100">
                                                        <div class="flex items-center gap-1.5 rounded-md border border-gray-200 bg-gray-50 px-2 py-1 focus-within:border-orange focus-within:bg-white">
                                                            <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                                                            </svg>
                                                            <input type="text" x-model="search"
                                                                x-ref="searchInput"
                                                                @click.stop
                                                                @keydown.escape="close()"
                                                                placeholder="Buscar serie o descripción..."
                                                                class="w-full bg-transparent border-none p-0 text-xs text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                                                            <button x-show="search" @click.stop="search = ''" type="button" class="text-gray-400 hover:text-gray-600">
                                                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <ul class="max-h-48 overflow-y-auto py-1">
                                                        <li @click.stop="select('')"
                                                            class="px-3 py-1.5 text-xs text-gray-400 cursor-pointer hover:bg-orange/10 hover:text-orange"
                                                            :class="row.eq_val === '' && 'bg-orange/5 font-medium text-orange'">
                                                            — Ninguno —
                                                        </li>
                                                        <template x-for="equipo in filtered" :key="equipo.codigo">
                                                            <li @click.stop="select(equipo.codigo)"
                                                                class="px-3 py-2 cursor-pointer hover:bg-orange/10 transition-colors"
                                                                :class="row.eq_val === equipo.codigo && 'bg-orange/10'">
                                                                <p class="text-xs font-semibold"
                                                                   :class="row.eq_val === equipo.codigo ? 'text-orange' : 'text-blue-dark'"
                                                                   x-text="equipo.codigo"></p>
                                                                <p x-show="equipo.descripcion"
                                                                   class="text-[10px] text-gray-400 mt-0.5 truncate"
                                                                   x-text="equipo.descripcion"></p>
                                                                <div x-show="equipo.modelos && equipo.modelos.length" class="flex flex-wrap gap-1 mt-1">
                                                                    <template x-for="mod in equipo.modelos" :key="mod">
                                                                        <span class="inline-flex items-center px-1.5 py-0.5 rounded bg-blue/10 text-blue text-[9px] font-medium" x-text="mod"></span>
                                                                    </template>
                                                                </div>
                                                            </li>
                                                        </template>
                                                        <li x-show="filtered.length === 0" class="px-3 py-2 text-xs text-gray-400 text-center">Sin resultados</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </td>

                                {{-- Checkbox Realizada --}}
                                <td class="px-4 py-2.5 text-center">
                                    <input type="hidden"   :name="`equipos[${rowIdx}][chk_val]`" value="0">
                                    <input type="checkbox" :name="`equipos[${rowIdx}][chk_val]`" value="1"
                                        x-model="row.chk_val"
                                        class="w-4 h-4 rounded border-gray-300 text-orange focus:ring-orange cursor-pointer">
                                </td>

                                {{-- Botón eliminar --}}
                                <td class="pr-3 py-2.5 text-center">
                                    <button type="button"
                                            @click="removeRow(row.id)"
                                            :class="hovered ? 'visible opacity-100' : 'invisible opacity-0'"
                                            class="w-6 h-6 flex items-center justify-center rounded-md text-gray-400 hover:text-red-500 hover:bg-red-50 transition-opacity duration-100">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>

                {{-- Footer: botón agregar fila --}}
                <div class="px-4 py-2.5 border-t border-gray-100 bg-gray-50/50">
                    <button type="button" @click="addRow()"
                            class="flex items-center gap-1.5 text-xs font-medium text-gray-500
                                hover:text-orange transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Agregar Equipo
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- ══ SECCIÓN 4 — Tabla dinámica de mediciones ══ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="flex items-center gap-3 px-5 py-4 border-b border-blue-dark/8 bg-blue-dark/3">
            <div class="w-7 h-7 rounded-lg bg-blue flex items-center justify-center flex-shrink-0">
                <span class="text-white text-xs font-bold">4</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                <h3 class="font-semibold text-blue text-sm">4. Resultados Mediciones In Situ</h3>
            </div>
        </div>
        <div class="p-5 space-y-4">
            <div class="flex items-center gap-2 px-4 py-2.5 bg-blue/5 border border-blue/15 rounded-xl">
                <svg class="w-4 h-4 text-blue flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-xs text-blue">El resumen estadístico (Mín, Máx, Media) y los gráficos se generarán automáticamente en el reporte final.</p>
            </div>
            {{-- Área paste desde Excel --}}
            <div class="flex items-center gap-2 px-4 py-2.5 bg-amber-50 border border-amber-200 rounded-xl">
                <svg class="w-4 h-4 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <p class="text-xs text-amber-700 font-medium">Pega aquí datos desde Excel (Fecha · Hora · Temp · pH) y se cargarán automáticamente en la tabla:</p>
            </div>
            <textarea id="pasteExcel" rows="3"
                placeholder="Pega aquí (Ctrl+V) tus datos copiados desde Excel..."
                class="w-full text-xs border border-dashed border-amber-300 rounded-xl px-3 py-2 bg-amber-50 focus:outline-none focus:border-amber-500 resize-none font-mono"></textarea>
            <div class="overflow-x-auto rounded-xl border border-gray-200">
                <table class="w-full text-sm min-w-[650px]" id="tablaMediciones">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="text-center px-3 py-2.5 text-xs font-semibold text-gray-500 w-10">#</th>
                            <th class="text-left px-3 py-2.5 text-xs font-semibold text-gray-500">Fecha</th>
                            <th class="text-left px-3 py-2.5 text-xs font-semibold text-gray-500">Hora</th>
                            <th class="text-left px-3 py-2.5 text-xs font-semibold text-gray-500">Nº Muestra</th>
                            <th class="text-left px-3 py-2.5 text-xs font-semibold text-gray-500">pH (U)</th>
                            <th class="text-left px-3 py-2.5 text-xs font-semibold text-gray-500">Temp (°C)</th>
                            <th class="text-center px-3 py-2.5 text-xs font-semibold text-gray-500 w-12"></th>
                        </tr>
                    </thead>
                    <tbody id="medicionesBody" class="divide-y divide-gray-100">
                        @if($inst && $inst->lecturas?->count())
                            @foreach($inst->lecturas as $i => $lectura)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-3 py-2 text-center text-xs text-gray-400 rownum">{{ $loop->iteration }}</td>
                                    <td class="px-3 py-2"><div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)] transition-all"><input type="date" name="lectura_fecha[]" value="{{ $lectura->fecha?->format('Y-m-d') }}" class="w-full bg-transparent border-none px-2 py-1.5 text-xs text-gray-800 focus:outline-none focus:ring-0"></div></td>
                                    <td class="px-3 py-2"><div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)] transition-all"><input type="time" name="lectura_hora[]" value="{{ $lectura->hora?->format('H:i') }}" class="w-full bg-transparent border-none px-2 py-1.5 text-xs text-gray-800 focus:outline-none focus:ring-0"></div></td>
                                    <td class="px-3 py-2"><div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)] transition-all"><input type="number" name="lectura_n[]" value="{{ $lectura->n_muestra }}" class="w-full bg-transparent border-none px-2 py-1.5 text-xs text-gray-800 focus:outline-none focus:ring-0"></div></td>
                                    <td class="px-3 py-2"><div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)] transition-all"><input type="number" step="0.01" name="lectura_ph[]" value="{{ $lectura->valor_ph }}" class="w-full bg-transparent border-none px-2 py-1.5 text-xs text-gray-800 focus:outline-none focus:ring-0"></div></td>
                                    <td class="px-3 py-2"><div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)] transition-all"><input type="number" step="0.1" name="lectura_temp[]" value="{{ $lectura->valor_temp }}" class="w-full bg-transparent border-none px-2 py-1.5 text-xs text-gray-800 focus:outline-none focus:ring-0"></div></td>
                                    <td class="px-3 py-2 text-center">
                                        <button type="button" onclick="eliminarFila(this)" class="w-7 h-7 flex items-center justify-center rounded-lg text-gray-400 hover:bg-red/10 hover:text-red transition-all mx-auto">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            {{-- Fila inicial vacía --}}
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-3 py-2 text-center text-xs text-gray-400 rownum">1</td>
                                <td class="px-3 py-2"><div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)] transition-all"><input type="date" name="lectura_fecha[]" class="w-full bg-transparent border-none px-2 py-1.5 text-xs text-gray-800 focus:outline-none focus:ring-0"></div></td>
                                <td class="px-3 py-2"><div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)] transition-all"><input type="time" name="lectura_hora[]" class="w-full bg-transparent border-none px-2 py-1.5 text-xs text-gray-800 focus:outline-none focus:ring-0"></div></td>
                                <td class="px-3 py-2"><div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)] transition-all"><input type="number" name="lectura_n[]" value="1" class="w-full bg-transparent border-none px-2 py-1.5 text-xs text-gray-800 focus:outline-none focus:ring-0"></div></td>
                                <td class="px-3 py-2"><div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)] transition-all"><input type="number" step="0.01" name="lectura_ph[]" class="w-full bg-transparent border-none px-2 py-1.5 text-xs text-gray-800 focus:outline-none focus:ring-0"></div></td>
                                <td class="px-3 py-2"><div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)] transition-all"><input type="number" step="0.1" name="lectura_temp[]" class="w-full bg-transparent border-none px-2 py-1.5 text-xs text-gray-800 focus:outline-none focus:ring-0"></div></td>
                                <td class="px-3 py-2 text-center">
                                    <button type="button" onclick="eliminarFila(this)" class="w-7 h-7 flex items-center justify-center rounded-lg text-gray-400 hover:bg-red/10 hover:text-red transition-all mx-auto">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <button type="button" onclick="agregarFila()"
                    class="flex items-center gap-2 px-4 py-2 rounded-xl border border-dashed border-green/40 text-green hover:bg-green/5 hover:border-green text-xs font-medium transition-all duration-150">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Agregar Fila
            </button>
            <div class="max-w-xs group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-orange transition-colors">
                    Temperatura primera muestra al término del muestreo (°C)
                </label>
                <div class="{{ $wrapClass }}">
                    <input type="number" step="0.1" name="temp_termino"
                           value="{{ old('temp_termino', $inst->temp_termino ?? '') }}"
                           placeholder="Ej: 12.8"
                           class="{{ $fieldClass }}">
                </div>
            </div>
        </div>
    </div>
    
    {{-- ══════════════════════════════════════════════
         SECCIÓN 5 — Observaciones y Anexos
    ══════════════════════════════════════════════ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100">
            <div class="w-7 h-7 rounded-lg bg-gray-600 flex items-center justify-center flex-shrink-0">
                <span class="text-white text-xs font-bold">5</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <h3 class="font-semibold text-gray-700 text-sm">5. Observaciones y Registro Fotográfico</h3>
            </div>
        </div>
        <div class="p-5 space-y-5">

            {{-- Observaciones --}}
            <div class="group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Observaciones</label>
                <div class="rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <textarea name="observaciones" rows="3"
                              class="w-full bg-transparent border-none px-3 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0 resize-none rounded-xl"
                              placeholder="Observaciones del muestreo...">{{ old('observaciones', $inst->observaciones ?? '') }}</textarea>
                </div>
            </div>

            {{-- Anexos --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach([
                    ['n'=>1, 'name'=>'an1', 'title_name'=>'an1_titulo', 'title_val'=>$inst->anexo_1_titulo ?? 'Registro Fotográfico', 'file'=>$inst->anexo_1_file ?? null],
                    ['n'=>2, 'name'=>'an2', 'title_name'=>'an2_titulo', 'title_val'=>$inst->anexo_2_titulo ?? 'Cadena de Custodia.', 'file'=>$inst->anexo_2_file ?? null],
                    /* 
                    ['n'=>3, 'name'=>'an3', 'title_name'=>'an3_titulo', 'title_val'=>$inst->anexo_3_titulo ?? 'Declaraciones de Operatividad del Inspector Ambiental.', 'file'=>$inst->anexo_3_file ?? null],
                    ['n'=>4, 'name'=>'an4', 'title_name'=>'an4_titulo', 'title_val'=>$inst->anexo_4_titulo ?? 'Declaraciones de Operatividad de la Entidad Técnica De Fiscalización Ambiental.', 'file'=>$inst->anexo_4_file ?? null],
                     */
                ] as $anexo)
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

                        {{-- Botón de subir imagen (siempre dice "Subir imagen" fijo) --}}
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
                                class="hidden"
                               >
                        </label>

                        {{-- Contenedor para mostrar el nombre del archivo seleccionado (abajo del botón) --}}
                        <div id="anexo_info_{{ $anexo['n'] }}" class="{{ $anexo['file'] ? '' : 'hidden' }}">
                            <p class="text-xs text-gray-600 flex items-center gap-1 mt-1">
                                <svg class="w-3 h-3 flex-shrink-0 text-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                                </svg>
                                <span id="anexo_nombre_{{ $anexo['n'] }}" class="truncate">
                                    {{ $anexo['file'] ? basename($anexo['file']) : '' }}
                                </span>
                            </p>
                        </div>

                        {{-- Mensaje de imagen guardada (solo cuando hay archivo existente) --}}
                        @if($anexo['file'])
                            <p class="text-xs text-green flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Imagen guardada
                            </p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>

        {{-- ══════════════════════════════════════════════
        SECCIÓN 6 — Configuración del PDF
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
                <h3 class="font-semibold text-gray-700 text-sm">6. Configuración del PDF</h3>
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
    
    {{-- Botones --}}
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
/* ─── Suma minutos avanzando día si cruza medianoche ─── */
function addMinutes(timeStr, minutes, fechaStr) {
    const [h, m] = timeStr.split(':').map(Number);
    const total  = h * 60 + m + minutes;
    const hh = String(Math.floor(total / 60) % 24).padStart(2, '0');
    const mm = String(total % 60).padStart(2, '0');
    let nuevaFecha = fechaStr || '';
    if (total >= 1440 && fechaStr) {
        const d = new Date(fechaStr + 'T00:00:00');
        d.setDate(d.getDate() + 1);
        nuevaFecha = d.toISOString().split('T')[0];
    }
    return { hora: `${hh}:${mm}`, fecha: nuevaFecha };
}
 
/* ─── Lee fecha/hora/intervalo de las últimas dos filas ─── */
function getLastValues() {
    const rows = Array.from(document.getElementById('medicionesBody').rows);
    if (!rows.length) return { fecha: '', hora: '', intervalo: 60 };
    const lastRow  = rows[rows.length - 1];
    const prevRow  = rows.length >= 2 ? rows[rows.length - 2] : null;
    const lastFecha = lastRow.querySelector('input[type="date"]')?.value || '';
    const lastHora  = lastRow.querySelector('input[type="time"]')?.value || '';
    let intervalo = 60;
    if (prevRow) {
        const prevHora = prevRow.querySelector('input[type="time"]')?.value || '';
        if (prevHora && lastHora) {
            const [ph, pm] = prevHora.split(':').map(Number);
            const [lh, lm] = lastHora.split(':').map(Number);
            const diff = (lh * 60 + lm) - (ph * 60 + pm);
            if (diff > 0 && diff <= 1440) intervalo = diff;
        }
    }
    return { fecha: lastFecha, hora: lastHora, intervalo };
}
 
/* ─── Renumera todas las filas desde 1 ─── */
function renumber() {
    Array.from(document.getElementById('medicionesBody').rows).forEach((row, i) => {
        const cell   = row.querySelector('td:first-child');
        const nInput = row.querySelector('input[name="lectura_n[]"]');
        if (cell)   cell.textContent = i + 1;
        if (nInput) nInput.value     = i + 1;
    });
}
 
/* ─── Construye una fila <tr> ─── */
function buildRow(fecha, hora, nMuestra, ph, temp) {
    const cell = (type, name, step, val) =>
        `<div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 transition-all duration-150
                     focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)]">
            <input type="${type}" name="${name}" ${step ? `step="${step}"` : ''} value="${val ?? ''}"
                   class="w-full bg-transparent border-none px-2 py-1.5 text-xs text-gray-800 focus:outline-none focus:ring-0">
         </div>`;
    const row = document.createElement('tr');
    row.className = 'hover:bg-gray-50/50 transition-colors';
    row.innerHTML = `
        <td class="px-3 py-2 text-center text-xs text-gray-400 rownum"></td>
        <td class="px-3 py-2">${cell('date',   'lectura_fecha[]', null,   fecha)}</td>
        <td class="px-3 py-2">${cell('time',   'lectura_hora[]',  null,   hora)}</td>
        <td class="px-3 py-2">${cell('number', 'lectura_n[]',     null,   nMuestra ?? '')}</td>
        <td class="px-3 py-2">${cell('number', 'lectura_ph[]',    '0.01', ph)}</td>
        <td class="px-3 py-2">${cell('number', 'lectura_temp[]',  '0.1',  temp)}</td>
        <td class="px-3 py-2 text-center">
            <button type="button" onclick="eliminarFila(this)"
                    class="w-7 h-7 flex items-center justify-center rounded-lg text-gray-400
                           hover:bg-red/10 hover:text-red transition-all mx-auto">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7
                             m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </button>
        </td>`;
    return row;
}
 
/* ─── Agregar fila manual ─── */
function agregarFila() {
    const tbody = document.getElementById('medicionesBody');
    const { fecha, hora, intervalo } = getLastValues();
    let nextFecha = fecha, nextHora = hora;
    if (hora) {
        const r = addMinutes(hora, intervalo, fecha);
        nextHora  = r.hora;
        nextFecha = r.fecha;
    }
    tbody.appendChild(buildRow(nextFecha, nextHora, '', '', ''));
    renumber();
    tbody.lastElementChild.querySelector('input[type="date"]')?.focus();
}
 
/* ─── Eliminar fila ─── */
function eliminarFila(btn) {
    const tbody = document.getElementById('medicionesBody');
    if (tbody.rows.length <= 1) {
        alert('Debe haber al menos una fila de medición.');
        return;
    }
    btn.closest('tr').remove();
    renumber();
}
 
/* ══════════════════════════════════════════════════════
   PARSER EXCEL
   ─────────────────────────────────────────────────────
   Formato esperado (copia desde Excel chileno):
     Date       Time   Temp,[°C]  pH
     4/2/2026   12:58  12,5       7,81
     4/2/2026   13:58  12,1       7,94
     ...
 
   También soporta doble tabla en paralelo:
     ADUCCIÓN              DESCARGA
     Date  Time  Temp  pH  Date  Time  Temp  pH
     ...                   ...
 
   Reglas de parsing:
   - Fecha dd/MM/yyyy  → yyyy-MM-dd  (formato Chile)
   - Fecha d/M/yyyy    → yyyy-MM-dd  (mismo, sin ceros)
   - Hora H:mm         → HH:mm       (0:58 → 00:58)
   - Decimal con coma  → decimal con punto
   - Columnas: [0]=fecha [1]=hora [2]=temp [3]=pH
   - Filas ignoradas: encabezados, PROMEDIO, MIN, MAX, vacías
══════════════════════════════════════════════════════ */
 
/**
 * Convierte fecha chilena "d/M/yyyy" → "yyyy-MM-dd"
 * Si ya está en formato ISO la retorna igual.
 */
function parseFecha(raw) {
    const s = (raw || '').trim();
    if (!s) return '';
 
    // Ya es ISO yyyy-MM-dd
    if (/^\d{4}-\d{2}-\d{2}$/.test(s)) return s;
 
    // Formato con separador / o -
    const sep = s.includes('/') ? '/' : (s.includes('-') ? '-' : null);
    if (!sep) return '';
 
    const parts = s.split(sep).map(p => p.trim());
    if (parts.length !== 3) return '';
 
    let [a, b, c] = parts;
 
    // c tiene 4 dígitos → es el año (formato d/M/yyyy o dd/MM/yyyy)
    if (c.length === 4) {
        const yyyy = c;
        const mm   = b.padStart(2, '0');  // mes
        const dd   = a.padStart(2, '0');  // día
        return `${yyyy}-${mm}-${dd}`;
    }
 
    // a tiene 4 dígitos → es el año (formato yyyy/MM/dd)
    if (a.length === 4) {
        return `${a}-${b.padStart(2,'0')}-${c.padStart(2,'0')}`;
    }
 
    // Año de 2 dígitos en c (ej: 4/2/26) → asumir 2000+
    if (c.length === 2) {
        const yyyy = '20' + c;
        return `${yyyy}-${b.padStart(2,'0')}-${a.padStart(2,'0')}`;
    }
 
    return '';
}
 
/** Normaliza hora → HH:mm */
function parseHora(raw) {
    const s = (raw || '').trim();
    if (!s) return '';
    const parts = s.split(':');
    if (parts.length >= 2) {
        return parts[0].padStart(2, '0') + ':' + parts[1].padStart(2, '0');
    }
    return s;
}
 
/** Coma decimal → punto */
function parseNum(raw) {
    return (raw || '').toString().trim().replace(',', '.');
}
 
/** Palabras que indican fila NO es dato (encabezado o estadística) */
const SKIP_TOKENS = [
    'date', 'time', 'temp', 'ph', 'fecha', 'hora', 'temperatura',
    'promedio', 'min', 'max', 'average', 'mean', 'media',
    'aduccion', 'aducción', 'descarga', 'muestra', 'n°', 'nº'
];
 
function isSkipRow(cols) {
    // Fila completamente vacía
    if (cols.every(c => !c.trim())) return true;
    const first = (cols[0] || '').toLowerCase().trim();
    if (!first) return true;
    // Primera celda es una palabra reservada
    return SKIP_TOKENS.some(t => first === t || first.startsWith(t + ',') || first.startsWith(t + ' '));
}
 
/**
 * Detecta si hay una segunda tabla pegada en paralelo.
 * Busca el primer "bloque vacío" de columnas en la zona central.
 * Retorna el índice de la primera columna de la segunda tabla, o -1.
 */
function detectSplitCol(lines) {
    const maxCols = Math.max(...lines.map(l => l.split('\t').length));
    if (maxCols < 8) return -1;          // No hay suficientes columnas
 
    const dataLines = lines.filter(l => !isSkipRow(l.split('\t')));
    if (!dataLines.length) return -1;
 
    // Contar cuántas filas tienen vacía cada columna
    const emptyCount = Array(maxCols).fill(0);
    dataLines.forEach(line => {
        line.split('\t').forEach((c, i) => {
            if (!c.trim()) emptyCount[i]++;
        });
    });
 
    const threshold = Math.ceil(dataLines.length * 0.5);
    // Buscar entre la col 3 y maxCols-4 una columna mayoritariamente vacía
    for (let i = 3; i < maxCols - 3; i++) {
        if (emptyCount[i] >= threshold) {
            // La segunda tabla empieza después de este bloque vacío
            // Verificar que después haya columnas con datos
            let nextDataCol = i + 1;
            while (nextDataCol < maxCols && emptyCount[nextDataCol] >= threshold) nextDataCol++;
            if (nextDataCol < maxCols) return nextDataCol;
        }
    }
    return -1;
}
 
/**
 * Extrae una fila de datos desde un array de celdas.
 * startIdx: índice de la primera columna del bloque (fecha).
 * Orden esperado: [fecha, hora, temp, pH]
 */
function extractDataRow(cols, startIdx) {
    const fecha = parseFecha(cols[startIdx]     || '');
    const hora  = parseHora( cols[startIdx + 1] || '');
    const temp  = parseNum(  cols[startIdx + 2] || '');
    const ph    = parseNum(  cols[startIdx + 3] || '');
 
    // La fecha debe ser válida para considerar la fila como dato
    if (!fecha || !fecha.match(/^\d{4}-\d{2}-\d{2}$/)) return null;
 
    return { fecha, hora, temp, ph };
}
 
/**
 * Parsea el texto pegado y retorna las filas de datos.
 * Si hay dos tablas en paralelo, retorna la primera (índice 0).
 * tableIndex permite seleccionar cuál tabla usar (0 o 1).
 */
function parseExcelPaste(raw, tableIndex) {
    const lines = raw.trim().split(/\r?\n/);
    const splitCol = detectSplitCol(lines);
 
    const tables = [[], []];
 
    lines.forEach(line => {
        const cols = line.split('\t');
        if (isSkipRow(cols)) return;
 
        const r0 = extractDataRow(cols, 0);
        if (r0) tables[0].push(r0);
 
        if (splitCol > 0) {
            const r1 = extractDataRow(cols, splitCol);
            if (r1) tables[1].push(r1);
        }
    });
 
    const idx = (tableIndex || 0);
    return tables[idx].length ? tables[idx] : tables[0];
}
 
/* ════════════════════════════════════════════════════
   DOM READY
════════════════════════════════════════════════════ */
document.addEventListener('DOMContentLoaded', () => {
 
    /* Quitar required de todos los inputs */
    document.querySelectorAll('input, textarea, select').forEach(el => el.removeAttribute('required'));
    new MutationObserver(() => {
        document.querySelectorAll('[required]').forEach(el => el.removeAttribute('required'));
    }).observe(document.body, { attributes: true, subtree: true, attributeFilter: ['required'] });
 
    /* Renumerar filas iniciales (cargadas desde Blade) */
    renumber();
 
    /* Anexos */
    window.onAnexoFileChange = function(input, n) {
        const cont  = document.getElementById(`anexo_info_${n}`);
        const texto = document.getElementById(`anexo_nombre_${n}`);
        if (input.files.length > 0) {
            if (texto) texto.textContent = input.files[0].name;
            if (cont)  cont.classList.remove('hidden');
        } else {
            if (cont)  cont.classList.add('hidden');
            if (texto) texto.textContent = '';
        }
    };
 
    /* ── Paste desde Excel ── */
    const pasteArea = document.getElementById('pasteExcel');
    if (!pasteArea) return;
 
    pasteArea.addEventListener('paste', e => {
        e.preventDefault();
        const raw = (e.clipboardData || window.clipboardData).getData('text');
        if (!raw.trim()) return;
 
        const rows = parseExcelPaste(raw, 0);
 
        if (!rows.length) {
            pasteArea.value = 'No se encontraron datos válidos. Verifica que el formato sea: Fecha | Hora | Temp | pH';
            setTimeout(() => { pasteArea.value = ''; }, 4000);
            return;
        }
 
        const tbody = document.getElementById('medicionesBody');
 
        // Limpiar fila vacía inicial si es la única fila y está sin datos
        if (tbody.rows.length === 1) {
            const inputs = Array.from(tbody.rows[0].querySelectorAll('input'))
                .filter(inp => inp.name !== 'lectura_n[]');
            if (inputs.every(inp => !inp.value)) tbody.rows[0].remove();
        }
 
        rows.forEach(r => {
            tbody.appendChild(buildRow(r.fecha, r.hora, '', r.ph, r.temp));
        });
 
        renumber();
        pasteArea.value = '';
    });
});
</script>
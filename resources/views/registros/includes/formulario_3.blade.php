{{-- resources/views/registros/includes/formulario_3.blade.php --}}
{{-- Formulario 3: Muestreo Puntual --}}

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
    <input type="hidden" name="tipo_form_id" value="3">

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

    {{-- ══ SECCIÓN 2 — Inspector y Proyecto ══ --}}
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
                           value="{{ old('inspector_nombre', $inst->inspector_nombre ?? '') }}"
                           placeholder="Nombre completo"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            {{-- RUT Inspector (span 3) --}}
            <div class="lg:col-span-3 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">RUT Inspector</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="inspector_rut"
                           value="{{ old('inspector_rut', $inst->inspector_rut ?? '') }}"
                           placeholder="12.345.678-9"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            {{-- Nº RCA (span 2) --}}
            <div class="lg:col-span-2 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Nº RCA</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="n_rca"
                           value="{{ old('n_rca', $reg->n_rca ?? '') }}"
                           placeholder="Nº"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            {{-- Nombre Proyecto (span 9) --}}
            <div class="lg:col-span-9 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Nombre del Proyecto Aprobado</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="nombre_proyecto"
                           value="{{ old('nombre_proyecto', $reg->nombre_proyecto ?? '') }}"
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
                    ['label'=>'Lugar de Muestreo',                  'name'=>'lugar_muestreo',       'value'=>$inst->lugar_muestreo ?? '',       'placeholder'=>'Nombre del lugar'],
                    ['label'=>'Dirección de Muestreo',              'name'=>'direccion_muestreo',   'value'=>$inst->direccion_muestreo ?? '',   'placeholder'=>'Dirección completa'],
                    ['label'=>'Identificación Punto de Muestreo',   'name'=>'punto_muestreo',       'value'=>$inst->punto_muestreo ?? '',       'placeholder'=>'Ej: Punto A, Aducción...'],
                    ['label'=>'Tipo de Muestra',                    'name'=>'tipo_muestra',         'value'=>$inst->tipo_muestra ?? '',         'placeholder'=>'Muestreo automático compuesto'],
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
                                    <div class="group flex items-center rounded-lg border border-gray-200 bg-gray-50 transition-all duration-150 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)]">
                                        <input type="text" name="{{ $row['name_eq'] }}"
                                               value="{{ old($row['name_eq'], $row['eq_val']) }}"
                                               placeholder="Código..."
                                               class="w-full bg-transparent border-none px-2.5 py-1.5 text-xs text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
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

    {{-- ══ SECCIÓN 4 — Mediciones In Situ (tabla fija 2 filas) ══ --}}
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
                        <th class="text-left px-3 py-2.5 text-xs font-semibold text-gray-500 rounded-r-xl">Cloro Libre (mg/l)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach([
                        ['suf'=>'1', 'item_default'=>'RIL', 'item_field'=>'insitu_item_1'],
                        ['suf'=>'2', 'item_default'=>'SST', 'item_field'=>'insitu_item_2'],
                    ] as $row)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-3 py-2.5">
                                <div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)] transition-all">
                                    <input type="text" name="{{ $row['item_field'] }}" value="{{ old($row['item_field'], $inst->{$row['item_field']} ?? $row['item_default']) }}" class="w-full bg-transparent border-none px-2.5 py-1.5 text-xs font-semibold text-gray-800 focus:outline-none focus:ring-0">
                                </div>
                            </td>
                            @foreach([
                                ['type'=>'date',   'name'=>'insitu_fecha_'.$row['suf'],  'step'=>null,  'val'=>$inst?->{'insitu_fecha_'.$row['suf']} ?? ''],
                                ['type'=>'time',   'name'=>'insitu_hora_'.$row['suf'],   'step'=>null,  'val'=>$inst?->{'insitu_hora_'.$row['suf']} ?? ''],
                                ['type'=>'number', 'name'=>'insitu_ph_'.$row['suf'],     'step'=>'0.01','val'=>$inst->{'insitu_ph_'.$row['suf']} ?? ''],
                                ['type'=>'number', 'name'=>'insitu_temp_'.$row['suf'],   'step'=>'0.01', 'val'=>$inst->{'insitu_temp_'.$row['suf']} ?? ''],
                                ['type'=>'number', 'name'=>'insitu_cloro_'.$row['suf'],  'step'=>'0.01','val'=>$inst->{'insitu_cloro_'.$row['suf']} ?? ''],
                            ] as $cell)
                                <td class="px-3 py-2.5">
                                    <div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)] transition-all">
                                        <input type="{{ $cell['type'] }}" name="{{ $cell['name'] }}"
                                               value="{{ old($cell['name'], $cell['val']) }}"
                                               @if($cell['step']) step="{{ $cell['step'] }}" @endif
                                               class="w-full bg-transparent border-none px-2.5 py-1.5 text-xs text-gray-800 focus:outline-none focus:ring-0">
                                    </div>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
                              placeholder="Observaciones del muestreo...">{{ old('observaciones', $inst->observaciones ?? 'Los resultados de análisis y mediciones in situ corresponden al lugar en donde fueron recolectadas las muestras...') }}</textarea>
                </div>
            </div>

            {{-- Anexos --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach([
                    ['n'=>1, 'name'=>'an1', 'title_name'=>'an1_titulo', 'title_val'=>$inst->anexo_1_titulo ?? 'Registro Fotográfico', 'file'=>$inst->anexo_1_file ?? null],
                    ['n'=>2, 'name'=>'an2', 'title_name'=>'an2_titulo', 'title_val'=>$inst->anexo_2_titulo ?? 'Cadena de Custodia.', 'file'=>$inst->anexo_2_file ?? null],
                    ['n'=>3, 'name'=>'an3', 'title_name'=>'an3_titulo', 'title_val'=>$inst->anexo_3_titulo ?? 'Declaraciones de Operatividad del Inspector Ambiental.', 'file'=>$inst->anexo_3_file ?? null],
                    ['n'=>4, 'name'=>'an4', 'title_name'=>'an4_titulo', 'title_val'=>$inst->anexo_4_titulo ?? 'Declaraciones de Operatividad de la Entidad Técnica De Fiscalización Ambiental.', 'file'=>$inst->anexo_4_file ?? null],
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

                        <label class="block cursor-pointer">
                            <div class="flex items-center gap-2 px-3 py-2 rounded-lg border border-dashed border-gray-300 bg-white hover:border-orange/50 hover:bg-orange/3 transition-all text-xs text-gray-500 hover:text-orange">
                                <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="truncate">{{ $anexo['file'] ? 'Reemplazar imagen' : 'Subir imagen' }}</span>
                            </div>
                            <input type="file"
                                   name="{{ $anexo['name'] }}"
                                   accept="image/*"
                                   class="hidden"
                                   onchange="onAnexoFileChange(this, {{ $anexo['n'] }})">
                        </label>

                        <p id="anexo_nombre_{{ $anexo['n'] }}"
                           class="hidden text-xs text-gray-500 flex items-center gap-1 truncate">
                            <svg class="w-3 h-3 flex-shrink-0 text-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                            </svg>
                            <span id="anexo_nombre_texto_{{ $anexo['n'] }}"></span>
                        </p>

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

    {{-- Botones --}}
    <div class="flex items-center justify-end gap-3 pt-2 pb-4">
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-2 px-5 py-2.5 rounded-xl border border-gray-200 text-gray-600 hover:text-blue-dark hover:border-blue-dark/30 text-sm font-medium transition-all duration-150">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            Cancelar
        </a>
        <button type="submit"
                class="flex items-center gap-2 px-6 py-2.5 rounded-xl bg-orange hover:bg-orange-dark text-white text-sm font-semibold shadow-md hover:shadow-lg transition-all duration-150">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
            {{ $inst ? 'Actualizar Informe' : 'Guardar Informe' }}
        </button>
    </div>
</form>
<script>
document.addEventListener('DOMContentLoaded', () => {

    // Eliminar TODOS los required por si acaso otro script los agrega
    document.querySelectorAll('input, textarea, select').forEach(el => {
        el.removeAttribute('required');
    });

    // Solo mantener la función auxiliar de anexos
    window.onAnexoFileChange = function(input, n) {
        const nombreContenedor = document.getElementById(`anexo_nombre_${n}`);
        const nombreTexto      = document.getElementById(`anexo_nombre_texto_${n}`);

        if (input.files.length > 0) {
            nombreTexto.textContent = input.files[0].name;
            nombreContenedor.classList.remove('hidden');
        } else {
            nombreContenedor.classList.add('hidden');
            nombreTexto.textContent = '';
        }
    };

    const observer = new MutationObserver(() => {
        document.querySelectorAll('[required]').forEach(el => el.removeAttribute('required'));
    });
    observer.observe(document.body, { attributes: true, subtree: true, attributeFilter: ['required'] });
});
</script>
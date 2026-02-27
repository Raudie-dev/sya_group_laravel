{{-- resources/views/registros/includes/formulario_4.blade.php --}}
{{-- Formulario 4: Muestreo Quintero --}}

@php
    $inst = $instancia ?? null;
    $fc  = 'w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0';
    $fw  = 'flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60';
    $fcs = 'w-full bg-transparent border-none px-2.5 py-1.5 text-xs text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0';
    $fws = 'flex items-center rounded-lg border border-gray-200 bg-gray-50 transition-all duration-150 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)]';
@endphp

<form method="POST"
      action="{{ $inst ? route('registros.update', $inst->id) : route('registros.store') }}"
      enctype="multipart/form-data"
      id="formMuestreoQuintero"
      class="space-y-5">
    @csrf
    @if($inst) @method('PUT') @endif
    <input type="hidden" name="tipo_form_id" value="4">


    {{-- ══ SECCIÓN 1 — Identificación y Antecedentes ══ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        {{-- Header sección --}}
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
                           value="{{ old('titulo_informe', $inst->titulo_informe ?? '') }}"
                           placeholder="Ej: Informe RIL Puntual Enero 2025"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            {{-- Código (span 3) --}}
            <div class="lg:col-span-3 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Código Informe</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="codigo"
                           value="{{ old('codigo', $inst->codigo_informe ?? '') }}"
                           placeholder="QEN_V4_..."
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            {{-- Fecha Emisión (span 3) --}}
            <div class="lg:col-span-3 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Fecha Emisión</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="date" name="fecha_emision"
                           value="{{ old('fecha_emision', $inst ? $inst->fecha_emision?->format('Y-m-d') : '') }}"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 focus:outline-none focus:ring-0">
                </div>
            </div>

            {{-- Cliente (span 4) --}}
            <div class="lg:col-span-4 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Cliente / Razón Social</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="cliente_nombre"
                           value="{{ old('cliente_nombre', $inst->empresa_nombre ?? '') }}"
                           placeholder="Razón social del cliente"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            {{-- Región (span 4) --}}
            <div class="lg:col-span-4 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Región</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="region"
                           value="{{ old('region', $inst->region ?? '') }}"
                           placeholder="Ej: Región Metropolitana"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            {{-- Comuna (span 4) --}}
            <div class="lg:col-span-4 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Comuna / Ciudad</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="comuna"
                           value="{{ old('comuna', $inst->comuna ?? '') }}"
                           placeholder="Ej: Santiago"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            {{-- Mes y Año (span 4) --}}
            <div class="lg:col-span-4 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Mes y Año del Informe</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="month" name="mes_año"
                           value="{{ old('mes_año', $inst->mes_anio_informe ?? '') }}"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 focus:outline-none focus:ring-0">
                </div>
            </div>

            {{-- Logo Cliente (span 8) --}}
            <div class="lg:col-span-8">
                <label class="block text-xs font-medium text-gray-500 mb-1.5">Logo Empresa Cliente</label>
                <div class="flex items-center gap-2">
                    <div class="flex-1 flex items-center rounded-xl border border-gray-200 bg-gray-50 hover:border-blue-light/60 transition-all duration-200 overflow-hidden">
                        <label class="flex-shrink-0 px-3 py-2 text-xs text-gray-500 bg-gray-100 border-r border-gray-200 cursor-pointer hover:bg-gray-200 transition-colors">
                            Seleccionar
                            <input type="file" name="logo_cliente" accept="image/*" class="hidden"
                                   onchange="document.getElementById('logo_nombre_f1').textContent = this.files[0]?.name ?? 'Sin archivo'">
                        </label>
                        <span id="logo_nombre_f1" class="px-3 text-xs text-gray-400 truncate">
                            {{ $inst?->logo_cliente ? basename($inst->logo_cliente) : 'Sin archivo seleccionado' }}
                        </span>
                    </div>
                    @if($inst?->logo_cliente)
                        <button type="button"
                                onclick="viewImage('{{ asset('storage/' . $inst->logo_cliente) }}', 'Logo Cliente: {{ $inst->empresa_nombre }}')"
                                class="flex-shrink-0 flex items-center gap-1.5 px-3 py-2 rounded-xl bg-blue/10 text-blue hover:bg-blue/20 text-xs font-medium transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Ver
                        </button>
                    @endif
                </div>
                @if($inst?->logo_cliente)
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


    {{-- ══════════════════════════════════════════
         SECCIÓN 2 — Información del Muestreo
    ══════════════════════════════════════════ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="flex items-center gap-3 px-5 py-4 border-b border-orange/10 bg-orange/3">
            <div class="w-7 h-7 rounded-lg bg-orange flex items-center justify-center flex-shrink-0">
                <span class="text-white text-xs font-bold">2</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <h3 class="font-semibold text-orange text-sm">2. Información del Muestreo</h3>
            </div>
        </div>
        <div class="p-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-4">

            <div class="lg:col-span-4 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-orange transition-colors">Lugar de Muestreo</label>
                <div class="{{ $fw }}">
                    <input type="text" name="lugar_muestreo"
                           value="{{ old('lugar_muestreo', $inst->lugar_muestreo ?? 'Unidad 3') }}"
                           class="{{ $fc }}">
                </div>
            </div>

            <div class="lg:col-span-5 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-orange transition-colors">Dirección de Muestreo</label>
                <div class="{{ $fw }}">
                    <input type="text" name="direccion_muestreo"
                           value="{{ old('direccion_muestreo', $inst->direccion_muestreo ?? 'Ruta F- 30 S/N, Puchuncavi, región de Valparaíso') }}"
                           class="{{ $fc }}">
                </div>
            </div>

            <div class="lg:col-span-3 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-orange transition-colors">Punto de Muestreo</label>
                <div class="{{ $fw }}">
                    <input type="text" name="punto_muestreo"
                           value="{{ old('punto_muestreo', $inst->punto_muestreo ?? 'Aducción') }}"
                           class="{{ $fc }}">
                </div>
            </div>

            {{-- Fecha/Hora Inicio — dos inputs en la misma celda (igual que el original) --}}
            <div class="lg:col-span-3">
                <label class="block text-xs font-medium text-gray-500 mb-1.5">Fecha / Hora Inicio</label>
                <div class="flex gap-2">
                    <div class="group flex-1">
                        <div class="{{ $fw }}">
                            <input type="date" name="fecha_inicio"
                                   value="{{ old('fecha_inicio', $inst?->fecha_inicio?->format('Y-m-d') ?? '') }}"
                                   class="{{ $fc }} text-xs">
                        </div>
                    </div>
                    <div class="group flex-1">
                        <div class="{{ $fw }}">
                            <input type="time" name="hora_inicio"
                                   value="{{ old('hora_inicio', $inst?->hora_inicio?->format('H:i') ?? '') }}"
                                   class="{{ $fc }} text-xs">
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-3">
                <label class="block text-xs font-medium text-gray-500 mb-1.5">Fecha / Hora Término</label>
                <div class="flex gap-2">
                    <div class="group flex-1">
                        <div class="{{ $fw }}">
                            <input type="date" name="fecha_termino"
                                   value="{{ old('fecha_termino', $inst?->fecha_termino?->format('Y-m-d') ?? '') }}"
                                   class="{{ $fc }} text-xs">
                        </div>
                    </div>
                    <div class="group flex-1">
                        <div class="{{ $fw }}">
                            <input type="time" name="hora_termino"
                                   value="{{ old('hora_termino', $inst?->hora_termino?->format('H:i') ?? '') }}"
                                   class="{{ $fc }} text-xs">
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-6 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-orange transition-colors">Tipo de Muestra</label>
                <div class="{{ $fw }}">
                    <input type="text" name="tipo_muestra"
                           value="{{ old('tipo_muestra', $inst->tipo_muestra ?? 'Muestreo automático compuesto') }}"
                           class="{{ $fc }}">
                </div>
            </div>

            <div class="lg:col-span-12 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-orange transition-colors">Normativa Aplicada</label>
                <div class="rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <textarea name="normativa_aplicada" rows="2"
                              class="w-full bg-transparent border-none px-3 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-0 resize-none rounded-xl">{{ old('normativa_aplicada', $inst->normativa_aplicada ?? 'NCh411/10. Of2005. Parte 10. Muestreo de aguas residuales - Recolección y manejo de las muestras. 2005. INN') }}</textarea>
                </div>
            </div>
        </div>
    </div>


    {{-- ══════════════════════════════════════════
         SECCIÓN 3 — Equipos / Medición
    ══════════════════════════════════════════ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="flex items-center gap-3 px-5 py-4 border-b border-green/10 bg-green/3">
            <div class="w-7 h-7 rounded-lg bg-green flex items-center justify-center flex-shrink-0">
                <span class="text-white text-xs font-bold">3</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <h3 class="font-semibold text-green text-sm">3. Información de la Medición</h3>
            </div>
        </div>
        <div class="p-5 overflow-x-auto">
            <table class="w-full text-sm min-w-[480px]">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="text-left px-4 py-2.5 text-xs font-semibold text-gray-500 rounded-l-xl">Medición / Norma</th>
                        <th class="text-left px-4 py-2.5 text-xs font-semibold text-gray-500 w-1/4">Código Equipo</th>
                        <th class="text-center px-4 py-2.5 text-xs font-semibold text-gray-500 rounded-r-xl w-1/6">Realizada</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach([
                        ['label' => 'Toma de Muestra (NCh411/10)',          'name_eq' => 'eq_muestreo_cod', 'name_chk' => 'chk_muestreo', 'eq_def' => '6223J02104',   'eq_val' => $inst->eq_muestreo_cod ?? null, 'chk_val' => $inst->chk_muestreo ?? false],
                        ['label' => 'pH (NCh2313/1)',                        'name_eq' => 'eq_ph_cod',       'name_chk' => 'chk_ph',       'eq_def' => '7020010101',   'eq_val' => $inst->eq_ph_cod ?? null,       'chk_val' => $inst->chk_ph ?? false],
                        ['label' => 'Temperatura (NCh2313/2)',               'name_eq' => 'eq_temp_cod',     'name_chk' => 'chk_temp',     'eq_def' => '7020010101',   'eq_val' => $inst->eq_temp_cod ?? null,     'chk_val' => $inst->chk_temp ?? false],
                        ['label' => 'Cloro libre residual (ISO 7393-2)',     'name_eq' => 'eq_cloro_cod',    'name_chk' => 'chk_cloro',    'eq_def' => '10060E151917', 'eq_val' => $inst->eq_cloro_cod ?? null,    'chk_val' => $inst->chk_cloro ?? false],
                    ] as $row)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-4 py-2.5 text-xs font-semibold text-gray-700">{{ $row['label'] }}</td>
                            <td class="px-4 py-2.5">
                                <div class="{{ $fws }}">
                                    <input type="text" name="{{ $row['name_eq'] }}"
                                           value="{{ old($row['name_eq'], $row['eq_val'] ?? $row['eq_def']) }}"
                                           class="{{ $fcs }}">
                                </div>
                            </td>
                            <td class="px-4 py-2.5 text-center">
                                <input type="checkbox" name="{{ $row['name_chk'] }}"
                                       {{ old($row['name_chk'], $row['chk_val']) ? 'checked' : '' }}
                                       class="w-4 h-4 rounded border-gray-300 text-orange focus:ring-orange cursor-pointer">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    {{-- ══════════════════════════════════════════
         SECCIÓN 4 — Resultados In Situ
    ══════════════════════════════════════════ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="flex items-center gap-3 px-5 py-4 border-b border-blue-dark/8 bg-blue-dark/3">
            <div class="w-7 h-7 rounded-lg bg-blue flex items-center justify-center flex-shrink-0">
                <span class="text-white text-xs font-bold">4</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                </svg>
                <h3 class="font-semibold text-blue text-sm">4. Resultados Mediciones In Situ</h3>
            </div>
        </div>
        <div class="p-5 space-y-4">

            <div class="overflow-x-auto">
                <table class="w-full text-sm min-w-[640px]">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="text-left px-3 py-2.5 text-xs font-semibold text-gray-500 rounded-l-xl w-1/6">ÍTEM</th>
                            <th class="text-left px-3 py-2.5 text-xs font-semibold text-gray-500">Fecha</th>
                            <th class="text-left px-3 py-2.5 text-xs font-semibold text-gray-500">Hora</th>
                            <th class="text-left px-3 py-2.5 text-xs font-semibold text-gray-500">pH (Unidades)</th>
                            <th class="text-left px-3 py-2.5 text-xs font-semibold text-gray-500">Temperatura (°C)</th>
                            <th class="text-left px-3 py-2.5 text-xs font-semibold text-gray-500 rounded-r-xl">Cloro Libre (mg/l)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach([
                            ['suf' => '1', 'label' => 'Inicio', 'badge' => 'bg-green/10 text-green',  'ph_def' => 7.74, 'temp_def' => 12.6, 'cloro_def' => 0.15],
                            ['suf' => '2', 'label' => 'Fin',    'badge' => 'bg-blue/10 text-blue',    'ph_def' => 7.77, 'temp_def' => 13.0, 'cloro_def' => 0.10],
                        ] as $row)
                            <tr class="hover:bg-gray-50/50 transition-colors">

                                {{-- ÍTEM editable (igual que el original) --}}
                                <td class="px-3 py-3">
                                    <div class="{{ $fws }}">
                                        <input type="text" name="insitu_item_{{ $row['suf'] }}"
                                               value="{{ old('insitu_item_'.$row['suf'], $inst->{'insitu_item_'.$row['suf']} ?? $row['label']) }}"
                                               class="{{ $fcs }} font-semibold">
                                    </div>
                                </td>

                                <td class="px-3 py-3">
                                    <div class="{{ $fws }}">
                                        <input type="date" name="insitu_fecha_{{ $row['suf'] }}"
                                               value="{{ old('insitu_fecha_'.$row['suf'], $inst?->{'insitu_fecha_'.$row['suf']}?->format('Y-m-d') ?? '') }}"
                                               class="{{ $fcs }}">
                                    </div>
                                </td>

                                <td class="px-3 py-3">
                                    <div class="{{ $fws }}">
                                        <input type="time" name="insitu_hora_{{ $row['suf'] }}"
                                               value="{{ old('insitu_hora_'.$row['suf'], $inst->{'insitu_hora_'.$row['suf']} ?? '') }}"
                                               class="{{ $fcs }}">
                                    </div>
                                </td>

                                <td class="px-3 py-3">
                                    <div class="{{ $fws }}">
                                        <input type="number" step="0.01" name="insitu_ph_{{ $row['suf'] }}"
                                               value="{{ old('insitu_ph_'.$row['suf'], $inst?->pk ? number_format($inst->{'insitu_ph_'.$row['suf']}, 2) : $row['ph_def']) }}"
                                               class="{{ $fcs }}">
                                    </div>
                                </td>

                                <td class="px-3 py-3">
                                    <div class="{{ $fws }}">
                                        <input type="number" step="0.01" name="insitu_temp_{{ $row['suf'] }}"
                                               value="{{ old('insitu_temp_'.$row['suf'], $inst?->pk ? number_format($inst->{'insitu_temp_'.$row['suf']}, 2) : $row['temp_def']) }}"
                                               class="{{ $fcs }}">
                                    </div>
                                </td>

                                <td class="px-3 py-3">
                                    <div class="{{ $fws }}">
                                        <input type="number" step="0.01" name="insitu_cloro_{{ $row['suf'] }}"
                                               value="{{ old('insitu_cloro_'.$row['suf'], $inst?->pk ? number_format($inst->{'insitu_cloro_'.$row['suf']}, 2) : $row['cloro_def']) }}"
                                               class="{{ $fcs }}">
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Temperatura primera muestra --}}
            <div class="flex flex-col sm:flex-row sm:items-center gap-3 bg-blue/5 border border-blue/15 rounded-xl px-4 py-3">
                <label class="text-xs font-semibold text-blue-dark flex-1">
                    Temperatura primera muestra al término del muestreo [ºC]:
                </label>
                <div class="w-full sm:w-40 group">
                    <div class="{{ $fw }}">
                        <input type="number" step="0.01" name="temp_primera_muestra"
                               value="{{ old('temp_primera_muestra', $inst?->pk ? number_format($inst->temp_primera_muestra, 2) : 10.2) }}"
                               placeholder="Ej: 10.20"
                               class="{{ $fc }}">
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- ══════════════════════════════════════════
         SECCIÓN 5 — Observaciones
    ══════════════════════════════════════════ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100">
            <div class="w-7 h-7 rounded-lg bg-gray-500 flex items-center justify-center flex-shrink-0">
                <span class="text-white text-xs font-bold">5</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                </svg>
                <h3 class="font-semibold text-gray-700 text-sm">5. Observaciones</h3>
            </div>
        </div>
        <div class="p-5 group">
            <div class="rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200
                        group-focus-within:border-orange group-focus-within:bg-white
                        group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)]
                        hover:border-blue-light/60">
                <textarea name="observaciones" rows="3"
                          class="w-full bg-transparent border-none px-3 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-0 resize-none rounded-xl">{{ old('observaciones', $inst->observaciones ?? 'Los resultados de análisis y mediciones in situ corresponden al lugar en donde fueron recolectadas las muestras. La composición de la muestra fue en función al tiempo.') }}</textarea>
            </div>
        </div>
    </div>


    {{-- ══════════════════════════════════════════
         SECCIÓN 6 — Registro Fotográfico + Anexo Cadena
         (Exactamente los dos bloques del original)
    ══════════════════════════════════════════ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100">
            <div class="w-7 h-7 rounded-lg bg-gray-600 flex items-center justify-center flex-shrink-0">
                <span class="text-white text-xs font-bold">6</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <h3 class="font-semibold text-gray-700 text-sm">6. Registro Fotográfico y 7. Anexos</h3>
            </div>
        </div>
        <div class="p-5 grid grid-cols-1 md:grid-cols-2 gap-4">

            {{-- 6. Registro Fotográfico (Equipo) --}}
            <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 space-y-3 hover:border-blue-light/40 transition-colors">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-blue">6. Registro Fotográfico (Equipo)</span>
                    @if($inst?->foto_equipo)
                        <button type="button"
                                onclick="viewImage('{{ asset('storage/' . $inst->foto_equipo) }}', 'Registro Fotográfico')"
                                class="flex items-center gap-1 text-xs text-blue hover:text-blue-dark font-medium transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Ver
                        </button>
                    @endif
                </div>
                <label class="block cursor-pointer">
                    <div class="flex items-center gap-2 px-3 py-2.5 rounded-lg border border-dashed border-gray-300 bg-white
                                hover:border-orange/50 hover:bg-orange/3 transition-all text-xs text-gray-500 hover:text-orange">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ $inst?->foto_equipo ? 'Reemplazar imagen' : 'Subir imagen' }}
                    </div>
                    <input type="file" name="foto_equipo" accept="image/*" class="hidden">
                </label>
                @if($inst?->foto_equipo)
                    <p class="text-xs text-green flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Imagen cargada
                    </p>
                @endif
            </div>

            {{-- 7. Cadena de Custodia --}}
            <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 space-y-3 hover:border-blue-light/40 transition-colors">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-green">7. Anexo: Cadena de Custodia</span>
                    @if($inst?->anexo_cadena_file)
                        <button type="button"
                                onclick="viewImage('{{ asset('storage/' . $inst->anexo_cadena_file) }}', 'Cadena de Custodia')"
                                class="flex items-center gap-1 text-xs text-blue hover:text-blue-dark font-medium transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Ver
                        </button>
                    @endif
                </div>
                <label class="block cursor-pointer">
                    <div class="flex items-center gap-2 px-3 py-2.5 rounded-lg border border-dashed border-gray-300 bg-white
                                hover:border-orange/50 hover:bg-orange/3 transition-all text-xs text-gray-500 hover:text-orange">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ $inst?->anexo_cadena_file ? 'Reemplazar archivo' : 'Subir archivo' }}
                    </div>
                    <input type="file" name="anexo_cadena" accept="image/*" class="hidden">
                </label>
                @if($inst?->anexo_cadena_file)
                    <p class="text-xs text-green flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Archivo cargado
                    </p>
                @endif
            </div>

        </div>
    </div>


    {{-- ── Botones ── --}}
    <div class="flex items-center justify-end gap-3 pt-2 pb-4">
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-2 px-5 py-2.5 rounded-xl border border-gray-200 text-gray-600
                  hover:text-blue-dark hover:border-blue-dark/30 text-sm font-medium transition-all duration-150">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
            Cancelar
        </a>
        <button type="submit"
                class="flex items-center gap-2 px-6 py-2.5 rounded-xl bg-orange hover:bg-orange-dark text-white
                       text-sm font-semibold shadow-md hover:shadow-lg transition-all duration-150">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
            </svg>
            Guardar Informe Quintero
        </button>
    </div>

</form>
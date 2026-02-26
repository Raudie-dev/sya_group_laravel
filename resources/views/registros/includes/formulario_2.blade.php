{{-- resources/views/registros/includes/formulario_2.blade.php --}}
{{-- Formulario 2: RIL 24 Horas --}}

@php $inst = $instancia ?? null; @endphp

<form method="POST"
      action="{{ $inst ? route('registros.update', $inst->id) : route('registros.store') }}"
      enctype="multipart/form-data"
      id="formMuestreoCompuesto"
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

    {{-- ══ SECCIÓN 2 — Información del Muestreo ══ --}}
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
                <div class="{{ $wrapClass }}">
                    <input type="text" name="lugar_muestreo" value="{{ old('lugar_muestreo', $inst->lugar_muestreo ?? '') }}" placeholder="Nombre del lugar" class="{{ $fieldClass }}">
                </div>
            </div>
            <div class="lg:col-span-8 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-orange transition-colors">Dirección de Muestreo</label>
                <div class="{{ $wrapClass }}">
                    <input type="text" name="direccion_muestreo" value="{{ old('direccion_muestreo', $inst->direccion ?? '') }}" placeholder="Dirección completa" class="{{ $fieldClass }}">
                </div>
            </div>
            <div class="lg:col-span-4 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-orange transition-colors">Punto de Muestreo</label>
                <div class="{{ $wrapClass }}">
                    <input type="text" name="punto_muestreo" value="{{ old('punto_muestreo', $inst->punto_muestreo ?? '') }}" placeholder="Ej: Aducción" class="{{ $fieldClass }}">
                </div>
            </div>
            <div class="lg:col-span-4 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-orange transition-colors">Fecha/Hora Inicio</label>
                <div class="{{ $wrapClass }}">
                    <input type="datetime-local" name="inicio_muestreo" value="{{ old('inicio_muestreo', $inst?->inicio_muestreo?->format('Y-m-d\TH:i') ?? '') }}" class="{{ $fieldClass }}">
                </div>
            </div>
            <div class="lg:col-span-4 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-orange transition-colors">Fecha/Hora Término</label>
                <div class="{{ $wrapClass }}">
                    <input type="datetime-local" name="fin_muestreo" value="{{ old('fin_muestreo', $inst?->fin_muestreo?->format('Y-m-d\TH:i') ?? '') }}" class="{{ $fieldClass }}">
                </div>
            </div>
            <div class="lg:col-span-12 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-orange transition-colors">Tipo de Muestra</label>
                <div class="{{ $wrapClass }}">
                    <input type="text" name="tipo_muestra" value="{{ old('tipo_muestra', $inst->tipo_muestra ?? 'Muestreo automático compuesto') }}" class="{{ $fieldClass }}">
                </div>
            </div>
        </div>
    </div>

    {{-- ══ SECCIÓN 3 — Equipos ══ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="flex items-center gap-3 px-5 py-4 border-b border-green/10 bg-green/3">
            <div class="w-7 h-7 rounded-lg bg-green flex items-center justify-center flex-shrink-0">
                <span class="text-white text-xs font-bold">3</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                </svg>
                <h3 class="font-semibold text-green text-sm">3. Información de la Medición</h3>
            </div>
        </div>
        <div class="p-5 overflow-x-auto">
            <table class="w-full text-sm min-w-[500px]">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="text-left px-4 py-2.5 text-xs font-semibold text-gray-500 rounded-l-xl w-1/2">Medición / Norma</th>
                        <th class="text-left px-4 py-2.5 text-xs font-semibold text-gray-500 w-1/3">Código Equipo</th>
                        <th class="text-center px-4 py-2.5 text-xs font-semibold text-gray-500 rounded-r-xl w-1/6">Realizada</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach([
                        ['label'=>'Toma de Muestra: NCh411/10.Of2005.',  'name_eq'=>'eq_muestreo',   'name_chk'=>'chk_muestreo',   'eq_val'=>$inst->eq_muestreo_cod ?? ''],
                        ['label'=>'pH: (NCh2313/1.Of95.)',                'name_eq'=>'eq_ph',          'name_chk'=>'chk_ph',          'eq_val'=>$inst->eq_ph_cod ?? ''],
                        ['label'=>'Temperatura: (NCh2313/2.Of95.)',       'name_eq'=>'eq_temperatura', 'name_chk'=>'chk_temperatura', 'eq_val'=>$inst->eq_temp_cod ?? ''],
                    ] as $row)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-4 py-2.5 text-xs text-gray-600">{{ $row['label'] }}</td>
                            <td class="px-4 py-2.5">
                                <div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 transition-all duration-150 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)]">
                                    <input type="text" name="{{ $row['name_eq'] }}" value="{{ old($row['name_eq'], $row['eq_val']) }}" placeholder="Código..." class="w-full bg-transparent border-none px-2.5 py-1.5 text-xs text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                                </div>
                            </td>
                            <td class="px-4 py-2.5 text-center">
                                <input type="checkbox" name="{{ $row['name_chk'] }}" class="w-4 h-4 rounded border-gray-300 text-orange focus:ring-orange cursor-pointer">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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

    {{-- ══ SECCIÓN 5 — Observaciones ══ --}}
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
        <div class="p-5">
            <div class="group">
                <div class="rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <textarea name="obs" rows="3"
                              class="w-full bg-transparent border-none px-3 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0 resize-none rounded-xl"
                              >{{ old('obs', $inst->observaciones ?? 'Los resultados de análisis y mediciones in situ corresponden al lugar en donde fueron recolectadas las muestras. La composición de la muestra fue en función al tiempo.') }}</textarea>
                </div>
            </div>
        </div>
    </div>

    {{-- ══ SECCIÓN 6/7 — Registro fotográfico y Anexos ══ --}}
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
        <div class="p-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

            @php
                $anexosDef = [
                    ['n'=>'foto', 'label'=>'6. Registro Fotográfico', 'file_name'=>'foto_registro', 'titulo_fixed'=>'Imagen 1',                  'file'=>$inst->foto_registro ?? null,  'color'=>'blue'],
                    ['n'=>1,      'label'=>'Anexo 1',                 'file_name'=>'an1',           'titulo_fixed'=>'Cadena de Custodia',         'file'=>$inst->anexo_1_file ?? null,   'color'=>'gray'],
                    ['n'=>2,      'label'=>'Anexo 2',                 'file_name'=>'an2',           'titulo_fixed'=>'Dec. Operatividad Inspector','file'=>$inst->anexo_2_file ?? null,   'color'=>'gray'],
                    ['n'=>3,      'label'=>'Anexo 3',                 'file_name'=>'an3',           'titulo_fixed'=>'Dec. Operatividad ETFA',     'file'=>$inst->anexo_3_file ?? null,   'color'=>'gray'],
                ];
            @endphp

            @foreach($anexosDef as $a)
                <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 space-y-3 hover:border-blue-light/40 transition-colors">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold text-{{ $a['color'] === 'blue' ? 'blue' : 'gray-600' }}">{{ $a['label'] }}</span>
                        @if($a['file'])
                            <button type="button"
                                    onclick="viewImage('{{ asset('storage/'.$a['file']) }}', '{{ $a['label'] }}')"
                                    class="flex items-center gap-1 text-xs text-blue hover:text-blue-dark transition-colors font-medium">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Ver
                            </button>
                        @endif
                    </div>
                    <div class="flex items-center rounded-lg border border-gray-200 bg-white">
                        <input type="text" value="{{ $a['titulo_fixed'] }}" readonly
                               class="w-full bg-transparent border-none px-2.5 py-1.5 text-xs text-gray-500 focus:outline-none focus:ring-0">
                    </div>
                    <label class="block cursor-pointer">
                        <div class="flex items-center gap-2 px-3 py-2 rounded-lg border border-dashed border-gray-300 bg-white hover:border-orange/50 hover:bg-orange/3 transition-all text-xs text-gray-500 hover:text-orange">
                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="truncate">{{ $a['file'] ? 'Reemplazar' : 'Subir imagen' }}</span>
                        </div>
                        <input type="file" name="{{ $a['file_name'] }}" accept="image/*" class="hidden">
                    </label>
                    @if($a['file'])
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
function agregarFila() {
    const tbody = document.getElementById('medicionesBody');
    const rowCount = tbody.rows.length + 1;
    const inputCell = (type, name, step = null, val = '') =>
        `<div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 transition-all duration-150 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)]">
            <input type="${type}" name="${name}" ${step ? `step="${step}"` : ''} value="${val}" class="w-full bg-transparent border-none px-2 py-1.5 text-xs text-gray-800 focus:outline-none focus:ring-0">
        </div>`;
    const row = document.createElement('tr');
    row.className = 'hover:bg-gray-50/50 transition-colors';
    row.innerHTML = `
        <td class="px-3 py-2 text-center text-xs text-gray-400 rownum">${rowCount}</td>
        <td class="px-3 py-2">${inputCell('date', 'lectura_fecha[]')}</td>
        <td class="px-3 py-2">${inputCell('time', 'lectura_hora[]')}</td>
        <td class="px-3 py-2">${inputCell('number', 'lectura_n[]', null, rowCount)}</td>
        <td class="px-3 py-2">${inputCell('number', 'lectura_ph[]', '0.01')}</td>
        <td class="px-3 py-2">${inputCell('number', 'lectura_temp[]', '0.1')}</td>
        <td class="px-3 py-2 text-center">
            <button type="button" onclick="eliminarFila(this)" class="w-7 h-7 flex items-center justify-center rounded-lg text-gray-400 hover:bg-red/10 hover:text-red transition-all mx-auto">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </button>
        </td>`;
    tbody.appendChild(row);
    row.querySelector('input[type="date"]')?.focus();
}

function eliminarFila(btn) {
    const tbody = document.getElementById('medicionesBody');
    if (tbody.rows.length <= 1) {
        alert('Debe haber al menos una fila de medición.');
        return;
    }
    btn.closest('tr').remove();
    Array.from(tbody.rows).forEach((r, i) => {
        r.querySelector('.rownum').textContent = i + 1;
    });
}
</script>
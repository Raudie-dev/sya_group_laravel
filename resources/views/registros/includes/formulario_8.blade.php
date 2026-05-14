{{-- resources/views/registros/includes/formulario_8.blade.php --}}
{{-- Formulario 8: RVMR — Verificación Envases y Equipos en Terreno --}}

@php
    $inst = $instancia ?? null;
    $reg  = $registro  ?? null;

    $env = $inst->envases_externos ?? [];
    $sOp = $inst->sonda_operatividad ?? [];
    $sVr = $inst->sonda_verificacion ?? [];
    $mOp = $inst->muestreador_operatividad ?? [];
    $mVr = $inst->muestreador_verificacion ?? [];
    $pOp = $inst->ph_operatividad ?? [];
    $pVr = $inst->ph_verificacion ?? [];
@endphp

<form method="POST"
      action="{{ $inst ? route('registros.update', $inst->registro_id) : route('registros.store') }}"
      enctype="multipart/form-data"
      class="space-y-5"
      x-data="{
          equiposList: @js($equipos ?? []),
          modelosList: @js($modelos ?? []),
      }"
      x-init="
          window._f8Equipos = equiposList;
          window._f8Modelos = modelosList;
      ">
    @csrf
    @if($inst) @method('PUT') @endif
    <input type="hidden" name="tipo_form_id" value="8">

    {{-- ══════════════════════════════════════════════
         SECCIÓN 1 — Identificación (sin cambios) ... --}}
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
            <!-- ... campos de identificación (se mantienen igual) ... -->
            <div class="lg:col-span-6 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-orange transition-colors">Título del Informe</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="titulo_informe" value="{{ old('titulo_informe', $reg->titulo_informe ?? '') }}"
                           placeholder="Ej: RVMR Muestreo RILES Enero 2025"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            <div class="lg:col-span-3 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-orange transition-colors">Código Informe</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="codigo" value="{{ old('codigo', $reg->codigo_informe ?? '') }}"
                           placeholder="RVMR-2025-001"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            <div class="lg:col-span-3 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-orange transition-colors">Fecha Emisión</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="date" name="fecha_emision" value="{{ old('fecha_emision', $reg?->fecha_emision ?? '') }}"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 focus:outline-none focus:ring-0">
                </div>
            </div>

            <div class="lg:col-span-4 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-orange transition-colors">Cliente / Razón Social</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="cliente_nombre" value="{{ old('cliente_nombre', $reg->empresa_nombre ?? '') }}"
                           placeholder="Razón social del cliente"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            <div class="lg:col-span-3 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-orange transition-colors">RUT Empresa</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="rut_empresa" value="{{ old('rut_empresa', $reg->rut_empresa ?? '') }}"
                           placeholder="76.123.456-7"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            <div class="lg:col-span-5 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-orange transition-colors">Nombre Representante Legal</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="representante_nombre" value="{{ old('representante_nombre', $reg->representante_nombre ?? '') }}"
                           placeholder="Nombre completo"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            <div class="lg:col-span-4 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-orange transition-colors">RUN Representante</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="representante_run" value="{{ old('representante_run', $reg->representante_run ?? '') }}"
                           placeholder="12.345.678-9"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            <div class="lg:col-span-8 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-orange transition-colors">Dirección Cliente</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="cliente_direccion" value="{{ old('cliente_direccion', $reg->cliente_direccion ?? '') }}"
                           placeholder="Dirección completa del cliente"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            <div class="lg:col-span-4">
                <label class="block text-xs font-medium text-gray-500 mb-1.5">Logo Empresa Cliente</label>
                <div class="flex items-center gap-2">
                    <div class="flex-1 flex items-center rounded-xl border border-gray-200 bg-gray-50 hover:border-blue-light/60 transition-all duration-200 overflow-hidden">
                        <label class="flex-shrink-0 px-3 py-2 text-xs text-gray-500 bg-gray-100 border-r border-gray-200 cursor-pointer hover:bg-gray-200 transition-colors">
                            Seleccionar
                            <input type="file" name="logo_cliente" accept="image/*" class="hidden"
                                   onchange="document.getElementById('logo_nombre_f8').textContent = this.files[0]?.name ?? 'Sin archivo'">
                        </label>
                        <span id="logo_nombre_f8" class="px-3 text-xs text-gray-400 truncate">
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
                        {{-- Estado --}}
                        <p class="text-xs text-green flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Imagen Guardada
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════
         SECCIÓN 2 — Datos del Registro (sin cambios relevantes) --}}
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
                <h3 class="font-semibold text-orange text-sm">2. Datos del Registro</h3>
            </div>
        </div>
        <div class="p-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-4">
            <div class="lg:col-span-6 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-orange transition-colors">Proyecto</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="proyecto" value="{{ old('proyecto', $inst->proyecto ?? '') }}"
                           placeholder="Nombre del proyecto"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            <div class="lg:col-span-3 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-orange transition-colors">Fecha</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="date" name="fecha" value="{{ old('fecha', $inst?->fecha ? \Carbon\Carbon::parse($inst->fecha)->format('Y-m-d') : '') }}"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 focus:outline-none focus:ring-0">
                </div>
            </div>

            <div class="lg:col-span-3 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-orange transition-colors">Cadena de Custodia N°</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="cadena_custodia" value="{{ old('cadena_custodia', $inst->cadena_custodia ?? '') }}"
                           placeholder="Ej: 9227 9360 9229"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            <div class="lg:col-span-5 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-orange transition-colors">Responsable Verificación</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="responsable_verificacion" value="{{ old('responsable_verificacion', $inst->responsable_verificacion ?? '') }}"
                           placeholder="Nombre del responsable"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            {{-- Firma --}}
            <div class="lg:col-span-7">
                <label class="block text-xs font-medium text-gray-500 mb-1.5">
                    Firma Responsable Verificación
                </label>

                <div class="flex items-center gap-2">
                    <div class="flex-1 flex items-center rounded-xl border border-gray-200 bg-gray-50 hover:border-orange/60 transition-all duration-200 overflow-hidden">
                        
                        {{-- Botón seleccionar --}}
                        <label class="flex-shrink-0 px-3 py-2 text-xs text-gray-500 bg-gray-100 border-r border-gray-200 cursor-pointer hover:bg-gray-200 transition-colors">
                            Seleccionar
                            <input type="file"
                                name="firma_verificacion"
                                accept="image/*"
                                class="hidden"
                                onchange="document.getElementById('firma_nombre_f8').textContent = this.files[0]?.name ?? 'Sin archivo'">
                        </label>

                        {{-- Nombre del archivo --}}
                        <span id="firma_nombre_f8" class="px-3 text-xs text-gray-400 truncate">
                            {{ $inst?->firma_verificacion_file ? basename($inst->firma_verificacion_file) : 'Sin archivo seleccionado' }}
                        </span>
                    </div>

                    {{-- Botón ver --}}
                    @if($inst?->firma_verificacion_file)
                        <button type="button"
                                onclick="viewImage('{{ asset('storage/' . $inst->firma_verificacion_file) }}', 'Firma Responsable')"
                                class="flex-shrink-0 flex items-center gap-1.5 px-3 py-2 rounded-xl bg-blue/10 text-blue hover:bg-blue/20 text-xs font-medium transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Ver
                        </button>

                        {{-- Estado --}}
                        <p class="text-xs text-green flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Imagen Guardada
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════
         SECCIÓN 3 — Verificación de Envases Externos (sin cambios) --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="flex items-center gap-3 px-5 py-4 border-b border-green/10 bg-green/3">
            <div class="w-7 h-7 rounded-lg bg-green flex items-center justify-center flex-shrink-0">
                <span class="text-white text-xs font-bold">3</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                <h3 class="font-semibold text-green text-sm">3. Verificación de Envases Externos (Proporcionados por Laboratorio)</h3>
            </div>
        </div>
        <div class="p-5">
            @php
                $envCols = [
                    ['key' => 'sin_preservante',  'label' => 'Envases sin preservante'],
                    ['key' => 'con_preservante',  'label' => 'Envases con preservante'],
                    ['key' => 'limpieza',         'label' => 'Limpieza (Lote Lavado)'],
                    ['key' => 'identificacion',   'label' => 'Identificación y Rótulo'],
                    ['key' => 'gelpack',          'label' => 'Gelpack o refrig. en cantidad suficiente'],
                ];
            @endphp
            <div class="overflow-hidden rounded-xl border border-gray-200">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="text-left px-4 py-2.5 text-xs font-semibold text-gray-500 w-28">Verificación</th>
                            @foreach($envCols as $col)
                                <th class="text-center px-2 py-2.5 text-xs font-semibold text-gray-500">{{ $col['label'] }}</th>
                            @endforeach
                            <th class="text-left px-4 py-2.5 text-xs font-semibold text-gray-500 w-36">Observaciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach(['cumple' => 'Cumple', 'no_cumple' => 'No Cumple'] as $fila => $label)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-4 py-2.5 text-sm font-medium {{ $fila === 'no_cumple' ? 'text-red-500' : 'text-gray-700' }}">
                                    {{ $label }}
                                </td>
                                @foreach($envCols as $col)
                                    <td class="px-2 py-2.5 text-center">
                                        <input type="checkbox"
                                               name="envases_externos[{{ $fila }}][{{ $col['key'] }}]"
                                               value="1"
                                               {{ !empty($env[$fila][$col['key']]) ? 'checked' : '' }}
                                               class="w-4 h-4 rounded border-gray-300 text-orange focus:ring-orange cursor-pointer">
                                    </td>
                                @endforeach
                                @if($fila === 'cumple')
                                    <td class="px-4 py-2.5" rowspan="2">
                                        <div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 transition-all duration-150 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)]">
                                            <input type="text"
                                                   name="envases_externos[observaciones]"
                                                   value="{{ old('envases_externos.observaciones', $env['observaciones'] ?? '') }}"
                                                   placeholder="Observación..."
                                                   class="w-full bg-transparent border-none px-2.5 py-1.5 text-xs text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-0">
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

{{-- ══════════════════════════════════════════════
         SECCIÓN 4 — Sonda Multiparámetros
    ══════════════════════════════════════════════ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden" id="section-4">
        <div class="flex items-center gap-3 px-5 py-4 border-b border-blue-dark/8 bg-blue-dark/3">
            <div class="w-7 h-7 rounded-lg bg-blue flex items-center justify-center flex-shrink-0">
                <span class="text-white text-xs font-bold">4</span>
            </div>
            <div class="flex items-center justify-between flex-1">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    <h3 class="font-semibold text-blue text-sm">4. Sondas Multiparámetros</h3>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-xs text-gray-500">Aplica</span>
                    <label class="relative cursor-pointer">
                        <input type="hidden"   name="sonda_aplica" value="0">
                        <input type="checkbox" id="sonda_aplica_checkbox" name="sonda_aplica" value="1"
                               {{ old('sonda_aplica', $inst->sonda_aplica ?? false) ? 'checked' : '' }}
                               @change="toggleSection4()"
                               class="sr-only peer">
                        <div class="w-10 h-5 rounded-full transition-colors duration-200 peer-checked:bg-blue bg-gray-200"></div>
                        <div class="absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full shadow transition-transform duration-200 peer-checked:translate-x-5"></div>
                    </label>
                </div>
            </div>
        </div>
        <div class="p-5 space-y-4" id="section-4-content">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                {{-- Marca --}}
                <div class="group">
                    <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-orange transition-colors">Marca</label>
                    <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                        <input type="text" name="sonda_marca" value="{{ old('sonda_marca', $inst->sonda_marca ?? '') }}"
                               placeholder="Ej: YSI"
                               class="sonda-field w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                    </div>
                </div>

                {{-- Modelo dropdown --}}
                <div class="group" x-data="{
                        open: false,
                        search: '',
                        selected: '{{ old('sonda_modelo', $inst->sonda_modelo ?? '') }}',
                        dropdownStyle: '',
                        _sh: null,
                        get filtered() {
                            const q = this.search.toLowerCase();
                            return modelosList.filter(m =>
                                m.nombre.toLowerCase().includes(q) ||
                                (m.descripcion && m.descripcion.toLowerCase().includes(q))
                            );
                        },
                        select(val) { this.selected = val; this.search = ''; this.close(); },
                        calcPos() {
                            const rect = this.$refs.trigger.getBoundingClientRect();
                            this.dropdownStyle = `position:fixed;z-index:9999;top:${rect.bottom+4}px;left:${rect.left}px;width:${Math.max(rect.width, 240)}px;`;
                        },
                        open_dd() {
                            this.calcPos(); this.open = true;
                            this._sh = () => { if (this.open) this.calcPos(); };
                            window.addEventListener('scroll', this._sh, true);
                            this.$nextTick(() => this.$refs.searchInput?.focus());
                        },
                        close() {
                            this.open = false;
                            if (this._sh) { window.removeEventListener('scroll', this._sh, true); this._sh = null; }
                        },
                        toggle() { this.open ? this.close() : this.open_dd(); }
                    }">
                    <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Modelo</label>
                    <input type="hidden" name="sonda_modelo" class="sonda-field" x-model="selected">
                    <button type="button" x-ref="trigger" @click="toggle()"
                            class="w-full flex items-center justify-between rounded-xl border border-gray-200 bg-gray-50 px-3 py-2 text-sm transition-all duration-150 focus:border-orange focus:bg-white focus:outline-none sonda-field"
                            :class="selected ? 'text-gray-800' : 'text-gray-400'">
                        <span class="truncate" x-text="selected
                            ? (modelosList.find(m => m.nombre === selected)?.descripcion
                                ? selected + ' — ' + modelosList.find(m => m.nombre === selected).descripcion
                                : selected)
                            : '— Seleccionar Modelo —'"></span>
                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0 ml-1 transition-transform duration-150" :class="open && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                             style="display:none" class="z-50">
                            <div class="rounded-xl border border-gray-200 bg-white shadow-lg w-full">
                                <div class="p-2 border-b border-gray-100">
                                    <div class="flex items-center gap-2 rounded-lg border border-gray-200 bg-gray-50 px-2 py-1.5 focus-within:border-orange focus-within:bg-white">
                                        <svg class="w-3.5 h-3.5 text-gray-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                                        </svg>
                                        <input type="text" x-model="search"
                                               x-ref="searchInput"
                                               @click.stop
                                               @keydown.escape="close()"
                                               placeholder="Buscar modelo..."
                                               class="w-full bg-transparent border-none p-0 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                                        <button x-show="search" @click.stop="search = ''" type="button" class="text-gray-400 hover:text-gray-600">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <ul class="max-h-48 overflow-y-auto py-1">
                                    <li @click.stop="select('')"
                                        class="px-3 py-2 text-sm text-gray-400 cursor-pointer hover:bg-orange/10 hover:text-orange"
                                        :class="selected === '' && 'bg-orange/5 font-medium text-orange'">— Ninguno —</li>
                                    <template x-for="modelo in filtered" :key="modelo.nombre">
                                        <li @click.stop="select(modelo.nombre)"
                                            class="px-3 py-2 cursor-pointer hover:bg-orange/10 transition-colors"
                                            :class="selected === modelo.nombre && 'bg-orange/10'">
                                            <p class="text-sm font-semibold"
                                               :class="selected === modelo.nombre ? 'text-orange' : 'text-blue-dark'"
                                               x-text="modelo.nombre"></p>
                                            <p x-show="modelo.descripcion" class="text-xs text-gray-400 mt-0.5 truncate" x-text="modelo.descripcion"></p>
                                        </li>
                                    </template>
                                    <li x-show="filtered.length === 0" class="px-3 py-2 text-sm text-gray-400 text-center">Sin resultados</li>
                                </ul>
                            </div>
                        </div>
                    </template>
                </div>

                {{-- N° Serie dropdown --}}
                <div class="group" x-data="{
                        open: false,
                        search: '',
                        selected: '{{ old('sonda_serie', $inst->sonda_serie ?? '') }}',
                        dropdownStyle: '',
                        _sh: null,
                        get filtered() {
                            const q = this.search.toLowerCase();
                            return equiposList.filter(e =>
                                e.codigo.toLowerCase().includes(q) ||
                                (e.descripcion && e.descripcion.toLowerCase().includes(q)) ||
                                (e.modelos && e.modelos.some(m => m.toLowerCase().includes(q)))
                            );
                        },
                        select(val) { this.selected = val; this.search = ''; this.close(); },
                        calcPos() {
                            const rect = this.$refs.trigger.getBoundingClientRect();
                            this.dropdownStyle = `position:fixed;z-index:9999;top:${rect.bottom+4}px;left:${rect.left}px;width:${Math.max(rect.width, 240)}px;`;
                        },
                        open_dd() {
                            this.calcPos(); this.open = true;
                            this._sh = () => { if (this.open) this.calcPos(); };
                            window.addEventListener('scroll', this._sh, true);
                            this.$nextTick(() => this.$refs.searchInput?.focus());
                        },
                        close() {
                            this.open = false;
                            if (this._sh) { window.removeEventListener('scroll', this._sh, true); this._sh = null; }
                        },
                        toggle() { this.open ? this.close() : this.open_dd(); }
                    }">
                    <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">N° Serie</label>
                    <input type="hidden" name="sonda_serie" class="sonda-field" x-model="selected">
                    <button type="button" x-ref="trigger" @click="toggle()"
                            class="w-full flex items-center justify-between rounded-xl border border-gray-200 bg-gray-50 px-3 py-2 text-sm transition-all duration-150 focus:border-orange focus:bg-white focus:outline-none sonda-field"
                            :class="selected ? 'text-gray-800' : 'text-gray-400'">
                        <span class="truncate" x-text="selected
                            ? (equiposList.find(e => e.codigo === selected)?.descripcion
                                ? selected + ' — ' + equiposList.find(e => e.codigo === selected).descripcion
                                : selected)
                            : '— Seleccionar Serie —'"></span>
                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0 ml-1 transition-transform duration-150" :class="open && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                             style="display:none" class="z-50">
                            <div class="rounded-xl border border-gray-200 bg-white shadow-lg w-full">
                                <div class="p-2 border-b border-gray-100">
                                    <div class="flex items-center gap-2 rounded-lg border border-gray-200 bg-gray-50 px-2 py-1.5 focus-within:border-orange focus-within:bg-white">
                                        <svg class="w-3.5 h-3.5 text-gray-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                                        </svg>
                                        <input type="text" x-model="search"
                                               x-ref="searchInput"
                                               @click.stop
                                               @keydown.escape="close()"
                                               placeholder="Buscar serie o descripción..."
                                               class="w-full bg-transparent border-none p-0 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                                        <button x-show="search" @click.stop="search = ''" type="button" class="text-gray-400 hover:text-gray-600">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <ul class="max-h-48 overflow-y-auto py-1">
                                    <li @click.stop="select('')"
                                        class="px-3 py-2 text-sm text-gray-400 cursor-pointer hover:bg-orange/10 hover:text-orange"
                                        :class="selected === '' && 'bg-orange/5 font-medium text-orange'">— Ninguno —</li>
                                    <template x-for="equipo in filtered" :key="equipo.codigo">
                                        <li @click.stop="select(equipo.codigo)"
                                            class="px-3 py-2 cursor-pointer hover:bg-orange/10 transition-colors"
                                            :class="selected === equipo.codigo && 'bg-orange/10'">
                                            <p class="text-sm font-semibold"
                                               :class="selected === equipo.codigo ? 'text-orange' : 'text-blue-dark'"
                                               x-text="equipo.codigo"></p>
                                            <p x-show="equipo.descripcion" class="text-xs text-gray-400 mt-0.5 truncate" x-text="equipo.descripcion"></p>
                                            <div x-show="equipo.modelos && equipo.modelos.length" class="flex flex-wrap gap-1 mt-1">
                                                <template x-for="mod in equipo.modelos" :key="mod">
                                                    <span class="inline-flex items-center px-1.5 py-0.5 rounded bg-blue/10 text-blue text-[10px] font-medium" x-text="mod"></span>
                                                </template>
                                            </div>
                                        </li>
                                    </template>
                                    <li x-show="filtered.length === 0" class="px-3 py-2 text-sm text-gray-400 text-center">Sin resultados</li>
                                </ul>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            {{-- Operatividad Sonda --}}
            @php
                $sondaOpCols = [
                    'envase_exterior'    => 'Envase exterior',
                    'apreciacion_visual' => 'Apreciación visual sonda y componentes (cables, buffer, conectores)',
                    'prueba_encendido'   => 'Prueba de Encendido',
                    'prueba_conexion_pc' => 'Prueba de conexión a PC, si aplica',
                ];
            @endphp
            <div class="overflow-hidden rounded-xl border border-gray-200">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="text-left px-4 py-2.5 text-xs font-semibold text-gray-500 w-28">Operatividad</th>
                            @foreach($sondaOpCols as $label)
                                <th class="text-center px-2 py-2.5 text-xs font-semibold text-gray-500">{{ $label }}</th>
                            @endforeach
                            <th class="text-left px-4 py-2.5 text-xs font-semibold text-gray-500">Observaciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach(['cumple' => 'Cumple', 'no_cumple' => 'No Cumple'] as $fila => $label)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-4 py-2.5 text-sm font-medium {{ $fila === 'no_cumple' ? 'text-red-500' : 'text-gray-700' }}">{{ $label }}</td>
                                @foreach(array_keys($sondaOpCols) as $col)
                                    <td class="px-2 py-2.5 text-center">
                                        <input type="checkbox"
                                               name="sonda_operatividad[{{ $fila }}][{{ $col }}]"
                                               value="1"
                                               {{ !empty($sOp[$fila][$col]) ? 'checked' : '' }}
                                               class="sonda-field w-4 h-4 rounded border-gray-300 text-orange focus:ring-orange cursor-pointer">
                                    </td>
                                @endforeach
                                @if($fila === 'cumple')
                                    <td class="px-4 py-2.5" rowspan="2">
                                        <div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 transition-all duration-150 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)]">
                                            <input type="text" name="sonda_observaciones"
                                                   value="{{ old('sonda_observaciones', $inst->sonda_observaciones ?? '') }}"
                                                   placeholder="Observaciones..."
                                                   class="sonda-field w-full bg-transparent border-none px-2.5 py-1.5 text-xs text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-0">
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Verificación Rápida Sonda --}}
            @php
                $sondaVrCols = ['ph' => 'pH', 'temperatura' => 'Temperatura', 'od' => 'OD', 'ce_salinidad' => 'CE/Salinidad'];
            @endphp
            <div class="overflow-hidden rounded-xl border border-gray-200">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="text-left px-4 py-2.5 text-xs font-semibold text-gray-500 w-36">Verificación Rápida</th>
                            @foreach($sondaVrCols as $label)
                                <th class="text-center px-4 py-2.5 text-xs font-semibold text-gray-500">{{ $label }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach(['cumple' => 'Cumple', 'no_cumple' => 'No Cumple'] as $fila => $label)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-4 py-2.5 text-sm font-medium {{ $fila === 'no_cumple' ? 'text-red-500' : 'text-gray-700' }}">{{ $label }}</td>
                                @foreach(array_keys($sondaVrCols) as $col)
                                    <td class="px-4 py-2.5 text-center">
                                        <input type="checkbox"
                                               name="sonda_verificacion[{{ $fila }}][{{ $col }}]"
                                               value="1"
                                               {{ !empty($sVr[$fila][$col]) ? 'checked' : '' }}
                                               class="sonda-field w-4 h-4 rounded border-gray-300 text-orange focus:ring-orange cursor-pointer">
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                        <tr class="bg-gray-50/50">
                            <td class="px-4 py-2.5 text-xs font-semibold text-gray-600">N° Lote Buffer pH</td>
                            <td colspan="4" class="px-4 py-2.5">
                                <div class="flex items-center gap-2">
                                    <div class="flex items-center rounded-lg border border-gray-200 bg-white transition-all duration-150 focus-within:border-orange focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)] max-w-xs">
                                        <input type="text" name="sonda_lote_buffer"
                                               value="{{ old('sonda_lote_buffer', $inst->sonda_lote_buffer ?? '') }}"
                                               placeholder="N° Lote"
                                               class="sonda-field w-full bg-transparent border-none px-2.5 py-1.5 text-xs text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-0">
                                    </div>
                                    <span class="text-xs text-gray-400 italic">Criterio aceptación Buffer ± 0,1 pH</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════
         SECCIÓN 5 — Muestreador Automático
    ══════════════════════════════════════════════ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden" id="section-5">
        <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100">
            <div class="w-7 h-7 rounded-lg bg-gray-600 flex items-center justify-center flex-shrink-0">
                <span class="text-white text-xs font-bold">5</span>
            </div>
            <div class="flex items-center justify-between flex-1">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                    </svg>
                    <h3 class="font-semibold text-gray-700 text-sm">5. Muestreador Automático</h3>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-xs text-gray-500">Aplica</span>
                    <label class="relative cursor-pointer">
                        <input type="hidden"   name="muestreador_aplica" value="0">
                        <input type="checkbox" id="muestreador_aplica_checkbox" name="muestreador_aplica" value="1"
                               {{ old('muestreador_aplica', $inst->muestreador_aplica ?? false) ? 'checked' : '' }}
                               @change="toggleSection5()"
                               class="sr-only peer">
                        <div class="w-10 h-5 rounded-full transition-colors duration-200 peer-checked:bg-gray-600 bg-gray-200"></div>
                        <div class="absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full shadow transition-transform duration-200 peer-checked:translate-x-5"></div>
                    </label>
                </div>
            </div>
        </div>
        <div class="p-5 space-y-4" id="section-5-content">
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">

                {{-- Marca --}}
                <div class="group">
                    <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-orange transition-colors">Marca</label>
                    <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                        <input type="text" name="muestreador_marca" value="{{ old('muestreador_marca', $inst->muestreador_marca ?? '') }}"
                               placeholder="Ej: ISCO"
                               class="muestreador-field w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                    </div>
                </div>

                {{-- Modelo dropdown --}}
                <div class="group" x-data="{
                        open: false,
                        search: '',
                        selected: '{{ old('muestreador_modelo', $inst->muestreador_modelo ?? '') }}',
                        dropdownStyle: '',
                        _sh: null,
                        get filtered() {
                            const q = this.search.toLowerCase();
                            return modelosList.filter(m =>
                                m.nombre.toLowerCase().includes(q) ||
                                (m.descripcion && m.descripcion.toLowerCase().includes(q))
                            );
                        },
                        select(val) { this.selected = val; this.search = ''; this.close(); },
                        calcPos() {
                            const rect = this.$refs.trigger.getBoundingClientRect();
                            this.dropdownStyle = `position:fixed;z-index:9999;top:${rect.bottom+4}px;left:${rect.left}px;width:${Math.max(rect.width, 240)}px;`;
                        },
                        open_dd() {
                            this.calcPos(); this.open = true;
                            this._sh = () => { if (this.open) this.calcPos(); };
                            window.addEventListener('scroll', this._sh, true);
                            this.$nextTick(() => this.$refs.searchInput?.focus());
                        },
                        close() {
                            this.open = false;
                            if (this._sh) { window.removeEventListener('scroll', this._sh, true); this._sh = null; }
                        },
                        toggle() { this.open ? this.close() : this.open_dd(); }
                    }">
                    <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Modelo</label>
                    <input type="hidden" name="muestreador_modelo" class="muestreador-field" x-model="selected">
                    <button type="button" x-ref="trigger" @click="toggle()"
                            class="w-full flex items-center justify-between rounded-xl border border-gray-200 bg-gray-50 px-3 py-2 text-sm transition-all duration-150 focus:border-orange focus:bg-white focus:outline-none muestreador-field"
                            :class="selected ? 'text-gray-800' : 'text-gray-400'">
                        <span class="truncate" x-text="selected
                            ? (modelosList.find(m => m.nombre === selected)?.descripcion
                                ? selected + ' — ' + modelosList.find(m => m.nombre === selected).descripcion
                                : selected)
                            : '— Seleccionar Modelo —'"></span>
                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0 ml-1 transition-transform duration-150" :class="open && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                             style="display:none" class="z-50">
                            <div class="rounded-xl border border-gray-200 bg-white shadow-lg w-full">
                                <div class="p-2 border-b border-gray-100">
                                    <div class="flex items-center gap-2 rounded-lg border border-gray-200 bg-gray-50 px-2 py-1.5 focus-within:border-orange focus-within:bg-white">
                                        <svg class="w-3.5 h-3.5 text-gray-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                                        </svg>
                                        <input type="text" x-model="search"
                                               x-ref="searchInput"
                                               @click.stop
                                               @keydown.escape="close()"
                                               placeholder="Buscar modelo..."
                                               class="w-full bg-transparent border-none p-0 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                                        <button x-show="search" @click.stop="search = ''" type="button" class="text-gray-400 hover:text-gray-600">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <ul class="max-h-48 overflow-y-auto py-1">
                                    <li @click.stop="select('')"
                                        class="px-3 py-2 text-sm text-gray-400 cursor-pointer hover:bg-orange/10 hover:text-orange"
                                        :class="selected === '' && 'bg-orange/5 font-medium text-orange'">— Ninguno —</li>
                                    <template x-for="modelo in filtered" :key="modelo.nombre">
                                        <li @click.stop="select(modelo.nombre)"
                                            class="px-3 py-2 cursor-pointer hover:bg-orange/10 transition-colors"
                                            :class="selected === modelo.nombre && 'bg-orange/10'">
                                            <p class="text-sm font-semibold"
                                               :class="selected === modelo.nombre ? 'text-orange' : 'text-blue-dark'"
                                               x-text="modelo.nombre"></p>
                                            <p x-show="modelo.descripcion" class="text-xs text-gray-400 mt-0.5 truncate" x-text="modelo.descripcion"></p>
                                        </li>
                                    </template>
                                    <li x-show="filtered.length === 0" class="px-3 py-2 text-sm text-gray-400 text-center">Sin resultados</li>
                                </ul>
                            </div>
                        </div>
                    </template>
                </div>

                {{-- N° Serie (input texto — puede ser múltiple, no dropdown) --}}
                <div class="sm:col-span-2 group">
                    <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-orange transition-colors">N° Serie (puede ser múltiple)</label>
                    <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                        <input type="text" name="muestreador_serie" value="{{ old('muestreador_serie', $inst->muestreador_serie ?? '') }}"
                               placeholder="Ej: 218M03023 222B01984"
                               class="muestreador-field w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                    </div>
                </div>
            </div>

            {{-- Operatividad Muestreador --}}
            @php
                $muestOpCols = [
                    'estado_envases'     => 'Estado adecuado envases',
                    'apreciacion_visual' => 'Apreciación visual de equipo y sus componentes (cables, mangueras, conectores)',
                    'prueba_encendido'   => 'Prueba de Encendido',
                    'estado_bateria'     => 'Estado de Batería',
                    'gelpack'            => 'Gel pack o Refrig.',
                ];
            @endphp
            <div class="overflow-hidden rounded-xl border border-gray-200">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="text-left px-4 py-2.5 text-xs font-semibold text-gray-500 w-28">Operatividad</th>
                            @foreach($muestOpCols as $label)
                                <th class="text-center px-2 py-2.5 text-xs font-semibold text-gray-500">{{ $label }}</th>
                            @endforeach
                            <th class="text-left px-4 py-2.5 text-xs font-semibold text-gray-500">Observaciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach(['cumple' => 'Cumple', 'no_cumple' => 'No Cumple'] as $fila => $label)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-4 py-2.5 text-sm font-medium {{ $fila === 'no_cumple' ? 'text-red-500' : 'text-gray-700' }}">{{ $label }}</td>
                                @foreach(array_keys($muestOpCols) as $col)
                                    <td class="px-2 py-2.5 text-center">
                                        <input type="checkbox"
                                               name="muestreador_operatividad[{{ $fila }}][{{ $col }}]"
                                               value="1"
                                               {{ !empty($mOp[$fila][$col]) ? 'checked' : '' }}
                                               class="muestreador-field w-4 h-4 rounded border-gray-300 text-orange focus:ring-orange cursor-pointer">
                                    </td>
                                @endforeach
                                @if($fila === 'cumple')
                                    <td class="px-4 py-2.5" rowspan="2">
                                        <div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 transition-all duration-150 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)]">
                                            <input type="text" name="muestreador_observaciones"
                                                   value="{{ old('muestreador_observaciones', $inst->muestreador_observaciones ?? '') }}"
                                                   placeholder="Observaciones..."
                                                   class="muestreador-field w-full bg-transparent border-none px-2.5 py-1.5 text-xs text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-0">
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Verificación Muestreador --}}
            @php
                $muestVrCols = [
                    'ph4'           => 'pH 4',
                    'ph7'           => 'pH 7',
                    'ph10'          => 'pH 10',
                    'temperatura'   => 'Temperatura',
                    'od'            => 'OD',
                    'conductividad' => 'Conductividad',
                    'sonda_caudal'  => 'Sonda Caudal',
                ];
            @endphp
            <div class="overflow-hidden rounded-xl border border-gray-200">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="text-left px-4 py-2.5 text-xs font-semibold text-gray-500 w-28">Verificación</th>
                            @foreach($muestVrCols as $label)
                                <th class="text-center px-2 py-2.5 text-xs font-semibold text-gray-500">{{ $label }}</th>
                            @endforeach
                            <th class="text-left px-4 py-2.5 text-xs font-semibold text-gray-500">Observaciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach(['cumple' => 'Cumple', 'no_cumple' => 'No Cumple'] as $fila => $label)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-4 py-2.5 text-sm font-medium {{ $fila === 'no_cumple' ? 'text-red-500' : 'text-gray-700' }}">{{ $label }}</td>
                                @foreach(array_keys($muestVrCols) as $col)
                                    <td class="px-2 py-2.5 text-center">
                                        <input type="checkbox"
                                               name="muestreador_verificacion[{{ $fila }}][{{ $col }}]"
                                               value="1"
                                               {{ !empty($mVr[$fila][$col]) ? 'checked' : '' }}
                                               class="muestreador-field w-4 h-4 rounded border-gray-300 text-orange focus:ring-orange cursor-pointer">
                                    </td>
                                @endforeach
                                @if($fila === 'cumple')
                                    <td class="px-4 py-2.5" rowspan="2">
                                        <div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 transition-all duration-150 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)]">
                                            <input type="text" name="muestreador_verificacion[observaciones]"
                                                   value="{{ old('muestreador_verificacion.observaciones', $mVr['observaciones'] ?? '') }}"
                                                   placeholder="Observaciones..."
                                                   class="muestreador-field w-full bg-transparent border-none px-2.5 py-1.5 text-xs text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-0">
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        <tr class="bg-gray-50/50">
                            <td class="px-4 py-2.5 text-xs font-semibold text-gray-600">N° Lote Buffer pH</td>
                            <td colspan="7" class="px-4 py-2.5">
                                <div class="flex items-center gap-2">
                                    <div class="flex items-center rounded-lg border border-gray-200 bg-white transition-all duration-150 focus-within:border-orange focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)] max-w-xs">
                                        <input type="text" name="muestreador_lote_buffer"
                                               value="{{ old('muestreador_lote_buffer', $inst->muestreador_lote_buffer ?? '') }}"
                                               placeholder="N° Lote"
                                               class="muestreador-field w-full bg-transparent border-none px-2.5 py-1.5 text-xs text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-0">
                                    </div>
                                    <span class="text-xs text-gray-400 italic">Criterio aceptación Buffer ± 0,1 pH</span>
                                </div>
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════
         SECCIÓN 6 — pH Portátil
    ══════════════════════════════════════════════ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden" id="section-6">
        <div class="flex items-center gap-3 px-5 py-4 border-b border-orange/10 bg-orange/3">
            <div class="w-7 h-7 rounded-lg bg-orange flex items-center justify-center flex-shrink-0">
                <span class="text-white text-xs font-bold">6</span>
            </div>
            <div class="flex items-center justify-between flex-1">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                    </svg>
                    <h3 class="font-semibold text-orange text-sm">6. pH Portátil</h3>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-xs text-gray-500">Aplica</span>
                    <label class="relative cursor-pointer">
                        <input type="hidden"   name="ph_aplica" value="0">
                        <input type="checkbox" id="ph_aplica_checkbox" name="ph_aplica" value="1"
                               {{ old('ph_aplica', $inst->ph_aplica ?? false) ? 'checked' : '' }}
                               @change="toggleSection6()"
                               class="sr-only peer">
                        <div class="w-10 h-5 rounded-full transition-colors duration-200 peer-checked:bg-orange bg-gray-200"></div>
                        <div class="absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full shadow transition-transform duration-200 peer-checked:translate-x-5"></div>
                    </label>
                </div>
            </div>
        </div>
        <div class="p-5 space-y-4" id="section-6-content">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                {{-- Modelo dropdown --}}
                <div class="group" x-data="{
                        open: false,
                        search: '',
                        selected: '{{ old('ph_modelo', $inst->ph_modelo ?? '') }}',
                        dropdownStyle: '',
                        _sh: null,
                        get filtered() {
                            const q = this.search.toLowerCase();
                            return modelosList.filter(m =>
                                m.nombre.toLowerCase().includes(q) ||
                                (m.descripcion && m.descripcion.toLowerCase().includes(q))
                            );
                        },
                        select(val) { this.selected = val; this.search = ''; this.close(); },
                        calcPos() {
                            const rect = this.$refs.trigger.getBoundingClientRect();
                            this.dropdownStyle = `position:fixed;z-index:9999;top:${rect.bottom+4}px;left:${rect.left}px;width:${Math.max(rect.width, 240)}px;`;
                        },
                        open_dd() {
                            this.calcPos(); this.open = true;
                            this._sh = () => { if (this.open) this.calcPos(); };
                            window.addEventListener('scroll', this._sh, true);
                            this.$nextTick(() => this.$refs.searchInput?.focus());
                        },
                        close() {
                            this.open = false;
                            if (this._sh) { window.removeEventListener('scroll', this._sh, true); this._sh = null; }
                        },
                        toggle() { this.open ? this.close() : this.open_dd(); }
                    }">
                    <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">Modelo</label>
                    <input type="hidden" name="ph_modelo" class="ph-field" x-model="selected">
                    <button type="button" x-ref="trigger" @click="toggle()"
                            class="w-full flex items-center justify-between rounded-xl border border-gray-200 bg-gray-50 px-3 py-2 text-sm transition-all duration-150 focus:border-orange focus:bg-white focus:outline-none ph-field"
                            :class="selected ? 'text-gray-800' : 'text-gray-400'">
                        <span class="truncate" x-text="selected
                            ? (modelosList.find(m => m.nombre === selected)?.descripcion
                                ? selected + ' — ' + modelosList.find(m => m.nombre === selected).descripcion
                                : selected)
                            : '— Seleccionar Modelo —'"></span>
                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0 ml-1 transition-transform duration-150" :class="open && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                             style="display:none" class="z-50">
                            <div class="rounded-xl border border-gray-200 bg-white shadow-lg w-full">
                                <div class="p-2 border-b border-gray-100">
                                    <div class="flex items-center gap-2 rounded-lg border border-gray-200 bg-gray-50 px-2 py-1.5 focus-within:border-orange focus-within:bg-white">
                                        <svg class="w-3.5 h-3.5 text-gray-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                                        </svg>
                                        <input type="text" x-model="search"
                                               x-ref="searchInput"
                                               @click.stop
                                               @keydown.escape="close()"
                                               placeholder="Buscar modelo..."
                                               class="w-full bg-transparent border-none p-0 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                                        <button x-show="search" @click.stop="search = ''" type="button" class="text-gray-400 hover:text-gray-600">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <ul class="max-h-48 overflow-y-auto py-1">
                                    <li @click.stop="select('')"
                                        class="px-3 py-2 text-sm text-gray-400 cursor-pointer hover:bg-orange/10 hover:text-orange"
                                        :class="selected === '' && 'bg-orange/5 font-medium text-orange'">— Ninguno —</li>
                                    <template x-for="modelo in filtered" :key="modelo.nombre">
                                        <li @click.stop="select(modelo.nombre)"
                                            class="px-3 py-2 cursor-pointer hover:bg-orange/10 transition-colors"
                                            :class="selected === modelo.nombre && 'bg-orange/10'">
                                            <p class="text-sm font-semibold"
                                               :class="selected === modelo.nombre ? 'text-orange' : 'text-blue-dark'"
                                               x-text="modelo.nombre"></p>
                                            <p x-show="modelo.descripcion" class="text-xs text-gray-400 mt-0.5 truncate" x-text="modelo.descripcion"></p>
                                        </li>
                                    </template>
                                    <li x-show="filtered.length === 0" class="px-3 py-2 text-sm text-gray-400 text-center">Sin resultados</li>
                                </ul>
                            </div>
                        </div>
                    </template>
                </div>

                {{-- N° Serie dropdown --}}
                <div class="group" x-data="{
                        open: false,
                        search: '',
                        selected: '{{ old('ph_serie', $inst->ph_serie ?? '') }}',
                        dropdownStyle: '',
                        _sh: null,
                        get filtered() {
                            const q = this.search.toLowerCase();
                            return equiposList.filter(e =>
                                e.codigo.toLowerCase().includes(q) ||
                                (e.descripcion && e.descripcion.toLowerCase().includes(q)) ||
                                (e.modelos && e.modelos.some(m => m.toLowerCase().includes(q)))
                            );
                        },
                        select(val) { this.selected = val; this.search = ''; this.close(); },
                        calcPos() {
                            const rect = this.$refs.trigger.getBoundingClientRect();
                            this.dropdownStyle = `position:fixed;z-index:9999;top:${rect.bottom+4}px;left:${rect.left}px;width:${Math.max(rect.width, 240)}px;`;
                        },
                        open_dd() {
                            this.calcPos(); this.open = true;
                            this._sh = () => { if (this.open) this.calcPos(); };
                            window.addEventListener('scroll', this._sh, true);
                            this.$nextTick(() => this.$refs.searchInput?.focus());
                        },
                        close() {
                            this.open = false;
                            if (this._sh) { window.removeEventListener('scroll', this._sh, true); this._sh = null; }
                        },
                        toggle() { this.open ? this.close() : this.open_dd(); }
                    }">
                    <label class="block text-xs font-medium text-gray-500 mb-1.5 transition-colors group-focus-within:text-orange">N° Serie</label>
                    <input type="hidden" name="ph_serie" class="ph-field" x-model="selected">
                    <button type="button" x-ref="trigger" @click="toggle()"
                            class="w-full flex items-center justify-between rounded-xl border border-gray-200 bg-gray-50 px-3 py-2 text-sm transition-all duration-150 focus:border-orange focus:bg-white focus:outline-none ph-field"
                            :class="selected ? 'text-gray-800' : 'text-gray-400'">
                        <span class="truncate" x-text="selected
                            ? (equiposList.find(e => e.codigo === selected)?.descripcion
                                ? selected + ' — ' + equiposList.find(e => e.codigo === selected).descripcion
                                : selected)
                            : '— Seleccionar Serie —'"></span>
                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0 ml-1 transition-transform duration-150" :class="open && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                             style="display:none" class="z-50">
                            <div class="rounded-xl border border-gray-200 bg-white shadow-lg w-full">
                                <div class="p-2 border-b border-gray-100">
                                    <div class="flex items-center gap-2 rounded-lg border border-gray-200 bg-gray-50 px-2 py-1.5 focus-within:border-orange focus-within:bg-white">
                                        <svg class="w-3.5 h-3.5 text-gray-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                                        </svg>
                                        <input type="text" x-model="search"
                                               x-ref="searchInput"
                                               @click.stop
                                               @keydown.escape="close()"
                                               placeholder="Buscar serie o descripción..."
                                               class="w-full bg-transparent border-none p-0 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                                        <button x-show="search" @click.stop="search = ''" type="button" class="text-gray-400 hover:text-gray-600">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <ul class="max-h-48 overflow-y-auto py-1">
                                    <li @click.stop="select('')"
                                        class="px-3 py-2 text-sm text-gray-400 cursor-pointer hover:bg-orange/10 hover:text-orange"
                                        :class="selected === '' && 'bg-orange/5 font-medium text-orange'">— Ninguno —</li>
                                    <template x-for="equipo in filtered" :key="equipo.codigo">
                                        <li @click.stop="select(equipo.codigo)"
                                            class="px-3 py-2 cursor-pointer hover:bg-orange/10 transition-colors"
                                            :class="selected === equipo.codigo && 'bg-orange/10'">
                                            <p class="text-sm font-semibold"
                                               :class="selected === equipo.codigo ? 'text-orange' : 'text-blue-dark'"
                                               x-text="equipo.codigo"></p>
                                            <p x-show="equipo.descripcion" class="text-xs text-gray-400 mt-0.5 truncate" x-text="equipo.descripcion"></p>
                                            <div x-show="equipo.modelos && equipo.modelos.length" class="flex flex-wrap gap-1 mt-1">
                                                <template x-for="mod in equipo.modelos" :key="mod">
                                                    <span class="inline-flex items-center px-1.5 py-0.5 rounded bg-blue/10 text-blue text-[10px] font-medium" x-text="mod"></span>
                                                </template>
                                            </div>
                                        </li>
                                    </template>
                                    <li x-show="filtered.length === 0" class="px-3 py-2 text-sm text-gray-400 text-center">Sin resultados</li>
                                </ul>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            {{-- Operatividad pH --}}
            @php
                $phOpCols = [
                    'estado_envase_exterior' => 'Estado adecuado envase exterior',
                    'apreciacion_visual'     => 'Apreciación visual (cables, buffer)',
                    'prueba_encendido'       => 'Prueba de Encendido',
                    'prueba_conexion_pc'     => 'Prueba de conexión a PC, si aplica',
                ];
            @endphp
            <div class="overflow-hidden rounded-xl border border-gray-200">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="text-left px-4 py-2.5 text-xs font-semibold text-gray-500 w-28">Operatividad</th>
                            @foreach($phOpCols as $label)
                                <th class="text-center px-2 py-2.5 text-xs font-semibold text-gray-500">{{ $label }}</th>
                            @endforeach
                            <th class="text-left px-4 py-2.5 text-xs font-semibold text-gray-500">Observaciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach(['cumple' => 'Cumple', 'no_cumple' => 'No Cumple'] as $fila => $label)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-4 py-2.5 text-sm font-medium {{ $fila === 'no_cumple' ? 'text-red-500' : 'text-gray-700' }}">{{ $label }}</td>
                                @foreach(array_keys($phOpCols) as $col)
                                    <td class="px-2 py-2.5 text-center">
                                        <input type="checkbox"
                                               name="ph_operatividad[{{ $fila }}][{{ $col }}]"
                                               value="1"
                                               {{ !empty($pOp[$fila][$col]) ? 'checked' : '' }}
                                               class="ph-field w-4 h-4 rounded border-gray-300 text-orange focus:ring-orange cursor-pointer">
                                    </td>
                                @endforeach
                                @if($fila === 'cumple')
                                    <td class="px-4 py-2.5" rowspan="2">
                                        <div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 transition-all duration-150 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)]">
                                            <input type="text" name="ph_observaciones"
                                                   value="{{ old('ph_observaciones', $inst->ph_observaciones ?? '') }}"
                                                   placeholder="Observaciones..."
                                                   class="ph-field w-full bg-transparent border-none px-2.5 py-1.5 text-xs text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-0">
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Verificación pH --}}
            @php
                $phVrCols = [
                    'ph4'         => ['label' => 'pH 4',        'val_key' => 'ph4_val'],
                    'ph7'         => ['label' => 'pH 7',        'val_key' => 'ph7_val'],
                    'ph10'        => ['label' => 'pH 10',       'val_key' => 'ph10_val'],
                    'temperatura' => ['label' => 'Temperatura', 'val_key' => 'temp_val'],
                ];
            @endphp
            <div class="overflow-hidden rounded-xl border border-gray-200">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="text-left px-4 py-2.5 text-xs font-semibold text-gray-500 w-28">Verificación</th>
                            @foreach($phVrCols as $col)
                                <th class="text-center px-4 py-2.5 text-xs font-semibold text-gray-500">{{ $col['label'] }}</th>
                            @endforeach
                            <th class="text-left px-4 py-2.5 text-xs font-semibold text-gray-500">Observaciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach(['cumple' => 'Cumple', 'no_cumple' => 'No Cumple'] as $fila => $label)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-4 py-2.5 text-sm font-medium {{ $fila === 'no_cumple' ? 'text-red-500' : 'text-gray-700' }}">{{ $label }}</td>
                                @foreach($phVrCols as $key => $col)
                                    <td class="px-4 py-2.5 text-center">
                                        <div class="flex flex-col items-center gap-1">
                                            <input type="checkbox"
                                                   name="ph_verificacion[{{ $fila }}][{{ $key }}]"
                                                   value="1"
                                                   {{ !empty($pVr[$fila][$key]) ? 'checked' : '' }}
                                                   class="ph-field w-4 h-4 rounded border-gray-300 text-orange focus:ring-orange cursor-pointer">
                                            @if($fila === 'cumple')
                                                <div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 transition-all duration-150 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)] w-20">
                                                    <input type="text"
                                                           name="ph_verificacion[valores][{{ $key }}]"
                                                           value="{{ old('ph_verificacion.valores.'.$key, $pVr['valores'][$key] ?? '') }}"
                                                           placeholder="Valor"
                                                           class="ph-field w-full bg-transparent border-none px-2 py-1 text-xs text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-0 text-center">
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                @endforeach
                                @if($fila === 'cumple')
                                    <td class="px-4 py-2.5" rowspan="2">
                                        <div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 transition-all duration-150 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)]">
                                            <input type="text" name="ph_verificacion[observaciones]"
                                                   value="{{ old('ph_verificacion.observaciones', $pVr['observaciones'] ?? '') }}"
                                                   placeholder="Observaciones..."
                                                   class="ph-field w-full bg-transparent border-none px-2.5 py-1.5 text-xs text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-0">
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        <tr class="bg-gray-50/50">
                            <td class="px-4 py-2.5 text-xs font-semibold text-gray-600">N° Lote Buffer pH</td>
                            @foreach(['ph_lote_buffer_4' => 'pH 4', 'ph_lote_buffer_7' => 'pH 7', 'ph_lote_buffer_10' => 'pH 10'] as $field => $label)
                                <td class="px-4 py-2.5 text-center">
                                    <div class="flex items-center rounded-lg border border-gray-200 bg-white transition-all duration-150 focus-within:border-orange focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)]">
                                        <input type="text" name="{{ $field }}"
                                               value="{{ old($field, $inst->$field ?? '') }}"
                                               placeholder="{{ $label }}"
                                               class="ph-field w-full bg-transparent border-none px-2.5 py-1.5 text-xs text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-0 text-center">
                                    </div>
                                </td>
                            @endforeach
                            <td class="px-4 py-2.5 text-xs text-gray-400 italic">Criterio aceptación Buffer ± 0,1 pH</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
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
function toggleSectionContent(fieldPrefix, isEnabled) {
    const sectionId = fieldPrefix === 'sonda' ? '4' : (fieldPrefix === 'muestreador' ? '5' : '6');
    const contentDiv = document.getElementById(`section-${sectionId}`);
    if (!contentDiv) return;
    
    const fields = contentDiv.querySelectorAll(`.${fieldPrefix}-field`);
    
    if (isEnabled) {
        // Habilitar campos y eliminar hidden fields duplicados
        fields.forEach(field => {
            field.disabled = false;
            field.classList.remove('opacity-50', 'cursor-not-allowed');
            // Eliminar el hidden asociado si existe
            const hiddenId = field.id ? `hidden_${field.id}` : null;
            if (hiddenId && document.getElementById(hiddenId)) {
                document.getElementById(hiddenId).remove();
            } else {
                // Buscar por name (más robusto)
                const hidden = contentDiv.querySelector(`input[type="hidden"][data-original-name="${field.name}"]`);
                if (hidden) hidden.remove();
            }
        });
    } else {
        // Deshabilitar campos, limpiar valores y añadir hidden fields vacíos
        fields.forEach(field => {
            field.disabled = true;
            field.classList.add('opacity-50', 'cursor-not-allowed');
            
            // Guardar valor original y limpiar
            let emptyValue = '';
            if (field.type === 'checkbox') {
                emptyValue = '0';
                field.checked = false;
            } else {
                field.value = '';
            }
            
            // Crear hidden field con el mismo name y valor vacío
            const hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = field.name;
            hidden.value = emptyValue;
            hidden.setAttribute('data-original-name', field.name);
            // Insertar después del campo (o al final del contenedor)
            field.parentNode.insertBefore(hidden, field.nextSibling);
        });
        
        // Limpiar dropdowns Alpine
        const clearEvent = new CustomEvent(`clear-${fieldPrefix}`);
        contentDiv.dispatchEvent(clearEvent);
    }
}

function toggleSection4() {
    const isEnabled = document.getElementById('sonda_aplica_checkbox').checked;
    toggleSectionContent('sonda', isEnabled);
}

function toggleSection5() {
    const isEnabled = document.getElementById('muestreador_aplica_checkbox').checked;
    toggleSectionContent('muestreador', isEnabled);
}

function toggleSection6() {
    const isEnabled = document.getElementById('ph_aplica_checkbox').checked;
    toggleSectionContent('ph', isEnabled);
}

function initializeAllSections() {
    toggleSection4();
    toggleSection5();
    toggleSection6();
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('input, textarea, select').forEach(el => el.removeAttribute('required'));
    initializeAllSections();
});
</script>
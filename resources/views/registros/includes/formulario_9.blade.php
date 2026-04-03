{{-- resources/views/registros/includes/formulario_9.blade.php --}}
{{-- Formulario 9: CMCL — Control equipo medidor de cloro libre residual --}}

@php
    $inst = $instancia ?? null;
    $reg  = $registro  ?? null;
    $rows = $inst->registros ?? [];
    /* Asegurar al menos 6 filas visibles */
    while (count($rows) < 6) {
        $rows[] = [
            'fecha' => '', 'responsable' => '', 'conc_estandar' => '',
            'aprobado' => false, 'rechazado' => false,
            'estado_celdas' => '', 'estado_equipo' => '', 'observaciones' => '',
        ];
    }
@endphp

<form method="POST"
      action="{{ $inst ? route('registros.update', $inst->registro_id) : route('registros.store') }}"
      enctype="multipart/form-data"
      class="space-y-5">
    @csrf
    @if($inst) @method('PUT') @endif
    <input type="hidden" name="tipo_form_id" value="9">

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
                <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-orange transition-colors">Título del Informe</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="titulo_informe"
                           value="{{ old('titulo_informe', $reg->titulo_informe ?? '') }}"
                           placeholder="Ej: Control Medidor Cloro Libre Residual"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            <div class="lg:col-span-3 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-orange transition-colors">Código Informe</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="codigo"
                           value="{{ old('codigo', $reg->codigo_informe ?? '') }}"
                           placeholder="CMCL-2025-001"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            <div class="lg:col-span-3 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-orange transition-colors">Fecha Emisión</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="date" name="fecha_emision"
                           value="{{ old('fecha_emision', $reg?->fecha_emision ?? '') }}"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 focus:outline-none focus:ring-0">
                </div>
            </div>

            <div class="lg:col-span-4 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-orange transition-colors">Cliente / Razón Social</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="cliente_nombre"
                           value="{{ old('cliente_nombre', $reg->empresa_nombre ?? '') }}"
                           placeholder="Razón social del cliente"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            <div class="lg:col-span-3 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-orange transition-colors">RUT Empresa</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="rut_empresa"
                           value="{{ old('rut_empresa', $reg->rut_empresa ?? '') }}"
                           placeholder="76.123.456-7"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            <div class="lg:col-span-5 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-orange transition-colors">Nombre Representante Legal</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="representante_nombre"
                           value="{{ old('representante_nombre', $reg->representante_nombre ?? '') }}"
                           placeholder="Nombre completo"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            <div class="lg:col-span-4 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-orange transition-colors">RUN Representante</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="representante_run"
                           value="{{ old('representante_run', $reg->representante_run ?? '') }}"
                           placeholder="12.345.678-9"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            <div class="lg:col-span-8 group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-orange transition-colors">Dirección Cliente</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="cliente_direccion"
                           value="{{ old('cliente_direccion', $reg->cliente_direccion ?? '') }}"
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
                                   onchange="document.getElementById('logo_nombre_f9').textContent = this.files[0]?.name ?? 'Sin archivo'">
                        </label>
                        <span id="logo_nombre_f9" class="px-3 text-xs text-gray-400 truncate">
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
            </div>

        </div>
    </div>

    {{-- ══════════════════════════════════════════════
         SECCIÓN 2 — Datos del Formulario
    ══════════════════════════════════════════════ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="flex items-center gap-3 px-5 py-4 border-b border-orange/10 bg-orange/3">
            <div class="w-7 h-7 rounded-lg bg-orange flex items-center justify-center flex-shrink-0">
                <span class="text-white text-xs font-bold">2</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                </svg>
                <h3 class="font-semibold text-orange text-sm">2. Datos del Equipo</h3>
            </div>
        </div>
        <div class="p-5 grid grid-cols-1 sm:grid-cols-2 gap-4">

            <div class="group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-orange transition-colors">Frecuencia de Control</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <input type="text" name="frecuencia_control"
                           value="{{ old('frecuencia_control', $inst->frecuencia_control ?? 'cada uso') }}"
                           placeholder="Ej: cada uso"
                           class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
            </div>

            <div class="group">
                <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-orange transition-colors">Equipo (código)</label>
                <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 transition-all duration-200 group-focus-within:border-orange group-focus-within:bg-white group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)] hover:border-blue-light/60">
                    <select name="equipo_codigo"
                            class="w-full bg-transparent border-none px-3 py-2 text-sm text-gray-800 focus:outline-none focus:ring-0">
                        <option value="">— Seleccionar código —</option>
                        @foreach($equipos as $cod)
                            <option value="{{ $cod }}"
                                {{ old('equipo_codigo', $inst->equipo_codigo ?? '') === $cod ? 'selected' : '' }}>
                                {{ $cod }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>
    </div>

    {{-- ══════════════════════════════════════════════
         SECCIÓN 3 — Registros de Control (tabla dinámica)
    ══════════════════════════════════════════════ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden"
         x-data="{
             rows: @js($rows),
             addRow() {
                 this.rows.push({
                     fecha: '', responsable: '', conc_estandar: '',
                     aprobado: false, rechazado: false,
                     estado_celdas: '', estado_equipo: '', observaciones: ''
                 });
             },
             removeRow(idx) {
                 if (this.rows.length > 1) this.rows.splice(idx, 1);
             }
         }">
        <div class="flex items-center gap-3 px-5 py-4 border-b border-green/10 bg-green/3">
            <div class="w-7 h-7 rounded-lg bg-green flex items-center justify-center flex-shrink-0">
                <span class="text-white text-xs font-bold">3</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <h3 class="font-semibold text-green text-sm">3. Registros de Control</h3>
            </div>
        </div>

        <div class="p-5">
            <div class="overflow-x-auto">
                <div class="overflow-hidden rounded-xl border border-gray-200">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200">
                                <th class="px-3 py-2.5 text-xs font-semibold text-gray-500 text-center w-28">Fecha</th>
                                <th class="px-3 py-2.5 text-xs font-semibold text-gray-500 text-center w-32">Responsable</th>
                                <th class="px-3 py-2.5 text-xs font-semibold text-gray-500 text-center w-28">Conc. estándar (mg/l)</th>
                                <th class="px-3 py-2.5 text-xs font-semibold text-gray-500 text-center w-28">Criterio</th>
                                <th class="px-3 py-2.5 text-xs font-semibold text-gray-500 text-center w-24">Estado de las celdas</th>
                                <th class="px-3 py-2.5 text-xs font-semibold text-gray-500 text-center w-24">Estado del equipo</th>
                                <th class="px-3 py-2.5 text-xs font-semibold text-gray-500 text-left">Observaciones</th>
                                <th class="w-8"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <template x-for="(row, idx) in rows" :key="idx">
                                <tr class="hover:bg-gray-50/50 transition-colors">

                                    {{-- Fecha --}}
                                    <td class="px-3 py-2">
                                        <div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 transition-all duration-150 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)]">
                                            <input type="date"
                                                   :name="`registros[${idx}][fecha]`"
                                                   x-model="row.fecha"
                                                   class="w-full bg-transparent border-none px-2 py-1.5 text-xs text-gray-700 focus:outline-none focus:ring-0">
                                        </div>
                                    </td>

                                    {{-- Responsable --}}
                                    <td class="px-3 py-2">
                                        <div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 transition-all duration-150 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)]">
                                            <input type="text"
                                                   :name="`registros[${idx}][responsable]`"
                                                   x-model="row.responsable"
                                                   placeholder="Nombre"
                                                   class="w-full bg-transparent border-none px-2 py-1.5 text-xs text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-0">
                                        </div>
                                    </td>

                                    {{-- Concentración estándar --}}
                                    <td class="px-3 py-2">
                                        <div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 transition-all duration-150 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)]">
                                            <input type="number"
                                                   step="0.01"
                                                   :name="`registros[${idx}][conc_estandar]`"
                                                   x-model="row.conc_estandar"
                                                   placeholder="mg/l"
                                                   class="w-full bg-transparent border-none px-2 py-1.5 text-xs text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-0">
                                        </div>
                                    </td>

                                    {{-- Criterio: Aprobado / Rechazado --}}
                                    <td class="px-3 py-2">
                                        <div class="flex flex-col gap-1.5">
                                            <label class="flex items-center gap-1.5 cursor-pointer group/chk">
                                                <input type="checkbox"
                                                       :name="`registros[${idx}][aprobado]`"
                                                       value="1"
                                                       x-model="row.aprobado"
                                                       class="w-3.5 h-3.5 rounded border-gray-300 text-green focus:ring-green cursor-pointer">
                                                <span class="text-xs text-gray-600 group-hover/chk:text-green transition-colors">Aprobado</span>
                                            </label>
                                            <label class="flex items-center gap-1.5 cursor-pointer group/chk">
                                                <input type="checkbox"
                                                       :name="`registros[${idx}][rechazado]`"
                                                       value="1"
                                                       x-model="row.rechazado"
                                                       class="w-3.5 h-3.5 rounded border-gray-300 text-red focus:ring-red cursor-pointer">
                                                <span class="text-xs text-gray-600 group-hover/chk:text-red transition-colors">Rechazado</span>
                                            </label>
                                        </div>
                                    </td>

                                    {{-- Estado de las celdas --}}
                                    <td class="px-3 py-2">
                                        <div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 transition-all duration-150 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)]">
                                            <input type="number"
                                                   min="1" max="4"
                                                   :name="`registros[${idx}][estado_celdas]`"
                                                   x-model="row.estado_celdas"
                                                   placeholder="1-4"
                                                   class="w-full bg-transparent border-none px-2 py-1.5 text-xs text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-0">
                                        </div>
                                    </td>

                                    {{-- Estado del equipo --}}
                                    <td class="px-3 py-2">
                                        <div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 transition-all duration-150 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)]">
                                            <input type="number"
                                                   min="1" max="4"
                                                   :name="`registros[${idx}][estado_equipo]`"
                                                   x-model="row.estado_equipo"
                                                   placeholder="1-4"
                                                   class="w-full bg-transparent border-none px-2 py-1.5 text-xs text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-0">
                                        </div>
                                    </td>

                                    {{-- Observaciones --}}
                                    <td class="px-3 py-2">
                                        <div class="flex items-center rounded-lg border border-gray-200 bg-gray-50 transition-all duration-150 focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)]">
                                            <input type="text"
                                                   :name="`registros[${idx}][observaciones]`"
                                                   x-model="row.observaciones"
                                                   placeholder="Observaciones..."
                                                   class="w-full bg-transparent border-none px-2 py-1.5 text-xs text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-0">
                                        </div>
                                    </td>

                                    {{-- Eliminar fila --}}
                                    <td class="pr-3 text-center">
                                        <button type="button"
                                                @click="removeRow(idx)"
                                                x-show="rows.length > 1"
                                                class="w-6 h-6 flex items-center justify-center rounded-md text-gray-300 hover:text-red-500 hover:bg-red-50 transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Agregar fila --}}
            <div class="mt-3 flex items-center justify-between">
                <button type="button" @click="addRow()"
                        class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-dashed border-gray-300 text-gray-500
                               hover:border-green hover:text-green hover:bg-green/5 text-xs font-semibold transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Agregar fila
                </button>

                {{-- Leyenda estados --}}
                <div class="flex items-center gap-4 text-xs text-gray-400">
                    <span class="font-semibold text-gray-500">Estado:</span>
                    <span>1.- Buen estado</span>
                    <span>2.- Sucio</span>
                    <span>3.- Roto</span>
                    <span>4.- Rayado</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Botones ── --}}
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
    document.querySelectorAll('input, textarea, select').forEach(el => el.removeAttribute('required'));
});
</script>
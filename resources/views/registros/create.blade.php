<x-app-layout>
@php
    $tipoForm = old('tipo_form_id', $registro->tipo_form_id ?? 1);
@endphp

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-orange/15 flex items-center justify-center">
                    <svg class="w-5 h-5 text-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-blue-dark leading-tight">
                        {{ isset($instancia) ? 'Editar Registro' : 'Nuevo Registro' }}
                    </h2>
                    <p class="text-gray-400 text-sm mt-0.5">
                        {{ isset($instancia) ? 'Modificando registro #' . $instancia->id : 'Completa el formulario correspondiente' }}
                    </p>
                </div>
            </div>
            @if(isset($instancia))
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue/10 text-blue text-xs font-semibold rounded-lg border border-blue/20">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Modo Edición
                </span>
            @endif
        </div>
    </x-slot>

    <div class="p-4 sm:p-6 lg:p-8 space-y-5">

        {{-- ── SELECTOR DE FORMULARIO ── --}}
        <div class="group max-w-md">
            <label class="block text-sm font-medium text-blue-dark mb-1.5">
                Tipo de Formulario
            </label>

            @php
            $opciones = [
                1 => 'Formulario 1: RLI Puntual',
                2 => 'Formulario 2: QEN_V4_INF',
                3 => 'Formulario 3: Informe de Terreno',
                4 => 'Formulario 4: QEN_SST',
                5 => 'Formulario 5: QEN DS90',
                6 => 'Formulario 6: DBO 5 - IDE',
            ];
            @endphp

            <div x-data="{
                    open: false,
                    selected: {{ $tipoForm }},
                    search: '',
                    opciones: @js($opciones),
                    get label() { return this.opciones[this.selected] ?? 'Seleccionar...' },
                    get filtradas() {
                        if (!this.search) return this.opciones;
                        const q = this.search.toLowerCase();
                        return Object.fromEntries(
                            Object.entries(this.opciones).filter(([k, v]) =>
                                v.toLowerCase().includes(q)
                            )
                        );
                    },
                    elegir(val) {
                        if ({{ isset($instancia) ? 'true' : 'false' }}) return;
                        this.selected = val;
                        this.search = '';
                        this.open = false;
                        document.getElementById('tipo_form_id_hidden').value = val;
                        window.cambiarFormulario(val);
                    },
                    abrir() {
                        if ({{ isset($instancia) ? 'true' : 'false' }}) return;
                        this.open = !this.open;
                        if (this.open) this.$nextTick(() => this.$refs.busqueda.focus());
                    }
                }"
                @click.outside="open = false; search = ''"
                class="relative {{ isset($instancia) ? 'opacity-60' : '' }}"
            >
                <input type="hidden" name="tipo_form_id" id="tipo_form_id_hidden" value="{{ $tipoForm }}">

                {{-- Trigger --}}
                <button type="button"
                        @click="abrir()"
                        class="w-full flex items-center gap-2 rounded-xl border border-gray-200 bg-gray-50 px-3 py-2.5
                            text-sm text-gray-800 font-medium transition-all duration-200
                            hover:border-blue-light/60
                            focus:outline-none focus:border-orange focus:bg-white focus:shadow-[0_0_0_3px_rgba(255,140,66,0.15)]"
                        :class="open && 'border-orange bg-white shadow-[0_0_0_3px_rgba(255,140,66,0.15)]'"
                >
                    <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span class="flex-1 text-left" x-text="label"></span>
                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-200 flex-shrink-0"
                        :class="open && 'rotate-180'"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                {{-- Dropdown con buscador --}}
                <div x-show="open"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute z-30 mt-1.5 w-full rounded-xl border border-gray-200 bg-white shadow-lg overflow-hidden"
                    style="display:none"
                >
                    {{-- Input de búsqueda --}}
                    <div class="p-2 border-b border-gray-100">
                        <div class="flex items-center gap-2 rounded-lg border border-gray-200 bg-gray-50 px-2.5 py-1.5
                                    focus-within:border-orange focus-within:bg-white focus-within:shadow-[0_0_0_2px_rgba(255,140,66,0.15)]
                                    transition-all duration-150">
                            <svg class="w-3.5 h-3.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                            </svg>
                            <input type="text"
                                x-ref="busqueda"
                                x-model="search"
                                @keydown.escape="open = false; search = ''"
                                placeholder="Buscar formulario..."
                                class="w-full bg-transparent border-none p-0 text-xs text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                            <button x-show="search"
                                    @click="search = ''"
                                    type="button"
                                    class="text-gray-400 hover:text-gray-600 transition-colors">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Opciones filtradas --}}
                    <div class="max-h-52 overflow-y-auto py-1">
                        <template x-for="(label, val) in filtradas" :key="val">
                            <button type="button"
                                    @click="elegir(Number(val))"
                                    class="w-full flex items-center gap-2.5 px-4 py-2.5 text-sm text-left transition-colors duration-100
                                        hover:bg-orange/8 hover:text-orange"
                                    :class="selected == val
                                        ? 'bg-orange/10 text-orange font-semibold'
                                        : 'text-gray-700'"
                            >
                                <span class="w-5 h-5 rounded-md flex items-center justify-center text-xs font-bold flex-shrink-0"
                                    :class="selected == val ? 'bg-orange text-white' : 'bg-gray-100 text-gray-500'"
                                    x-text="val">
                                </span>
                                <span x-text="label"></span>
                                <svg x-show="selected == val"
                                    class="w-4 h-4 text-orange ml-auto flex-shrink-0"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </button>
                        </template>

                        {{-- Sin resultados --}}
                        <div x-show="Object.keys(filtradas).length === 0"
                            class="px-4 py-3 text-xs text-gray-400 text-center">
                            Sin resultados para "<span x-text="search"></span>"
                        </div>
                    </div>
                </div>
            </div>

            @if(isset($instancia))
                <p class="mt-1.5 text-xs text-gray-400 flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    El tipo de formulario no puede cambiarse en modo edición.
                </p>
            @endif
        </div>

        {{-- ── CONTENEDOR DE FORMULARIOS ── --}}
        <div id="contenedor-formularios" class="space-y-5">
            <div id="seccion_1" class="seccion-modulo {{ $tipoForm != 1 ? 'hidden' : '' }}">
                @include('registros.includes.formulario_1')
            </div>
            <div id="seccion_2" class="seccion-modulo {{ $tipoForm != 2 ? 'hidden' : '' }}">
                @include('registros.includes.formulario_2')
            </div>
            <div id="seccion_3" class="seccion-modulo {{ $tipoForm != 3 ? 'hidden' : '' }}">
                @include('registros.includes.formulario_3')
            </div>
            <div id="seccion_4" class="seccion-modulo {{ $tipoForm != 4 ? 'hidden' : '' }}">
                @include('registros.includes.formulario_4')
            </div>
            <div id="seccion_5" class="seccion-modulo {{ $tipoForm != 5 ? 'hidden' : '' }}">
                @include('registros.includes.formulario_5')
            </div>
            <div id="seccion_6" class="seccion-modulo {{ $tipoForm != 6 ? 'hidden' : '' }}">
                @include('registros.includes.formulario_6')
            </div>
        </div>
    </div>

    {{-- ── MODAL PREVIEW IMAGEN (Alpine) ── --}}
    <div
        x-data="{ open: false, title: '', src: '' }"
        @preview.window="title = $event.detail.title; src = $event.detail.url; open = true"
        x-show="open"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center p-4"
    >
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="open = false"></div>
        <div class="relative bg-white rounded-2xl shadow-2xl max-w-4xl w-full z-10 overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <h3 class="text-sm font-semibold text-blue-dark" x-text="title"></h3>
                <button @click="open = false"
                        class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="p-4 flex justify-center bg-gray-50">
                <img :src="src" alt="Preview" class="max-h-[70vh] object-contain w-full rounded-lg">
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        window.cambiarFormulario = function(valor) {
            // 1. Limpiar todos los formularios ocultos antes de cambiar
            document.querySelectorAll('.seccion-modulo').forEach(seccion => {
                if (!seccion.classList.contains('hidden')) return; // no limpiar el activo

                // Limpiar inputs de texto, number, date, datetime, time, email, tel
                seccion.querySelectorAll('input:not([type="hidden"]):not([type="file"])').forEach(el => {
                    if (el.type === 'checkbox' || el.type === 'radio') {
                        el.checked = false;
                    } else {
                        el.value = '';
                    }
                });

                // Limpiar selects
                seccion.querySelectorAll('select').forEach(el => {
                    el.selectedIndex = 0;
                });

                // Limpiar textareas
                seccion.querySelectorAll('textarea').forEach(el => {
                    el.value = '';
                });

                // Limpiar nombres de archivos visibles
                seccion.querySelectorAll('span[id^="logo_nombre"], span[id^="anexo_nombre"]').forEach(el => {
                    el.textContent = 'Sin archivo seleccionado';
                });
            });

            // 2. Ocultar todas las secciones
            document.querySelectorAll('.seccion-modulo').forEach(el => el.classList.add('hidden'));

            // 3. Mostrar la sección elegida
            const seccion = document.getElementById('seccion_' + valor);
            if (seccion) seccion.classList.remove('hidden');

            window.scrollTo({ top: 0, behavior: 'smooth' });
        };
    });

    function viewImage(url, title = '') {
        window.dispatchEvent(new CustomEvent('preview', { detail: { url, title } }));
    }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Manejador genérico para todos los inputs file
            document.addEventListener('change', function(e) {
                if (e.target.matches('input[type="file"]')) {
                    const fileInput = e.target;
                    const fileName = fileInput.files[0]?.name || 'Sin archivo seleccionado';
                    
                    // Buscar el span más cercano que debe mostrar el nombre
                    // Estrategia 1: Buscar por data-atributo
                    const nameDisplay = fileInput.closest('.file-input-wrapper, .bg-gray-50, .flex-1')
                                            ?.querySelector('.file-name-display, span[class*="truncate"]');
                    
                    if (nameDisplay) {
                        nameDisplay.textContent = fileName;
                    }
                    
                    // Mostrar/ocultar el contenedor del nombre del anexo
                    const anexoContainer = fileInput.closest('.bg-gray-50');
                    if (anexoContainer && fileInput.name.startsWith('an')) {
                        let nombreSpan = anexoContainer.querySelector('.anexo-file-name');
                        
                        if (fileInput.files.length > 0) {
                            if (!nombreSpan) {
                                // Crear el span si no existe
                                nombreSpan = document.createElement('p');
                                nombreSpan.className = 'anexo-file-name text-xs text-gray-500 flex items-center gap-1 truncate mt-2';
                                nombreSpan.innerHTML = `
                                    <svg class="w-3 h-3 flex-shrink-0 text-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                                    </svg>
                                    <span>${fileName}</span>
                                `;
                                anexoContainer.appendChild(nombreSpan);
                            } else {
                                nombreSpan.querySelector('span').textContent = fileName;
                                nombreSpan.classList.remove('hidden');
                            }
                        } else if (nombreSpan) {
                            nombreSpan.classList.add('hidden');
                        }
                    }
                    
                    // Para logos de cliente
                    if (fileInput.name === 'logo_cliente') {
                        const logoDisplay = fileInput.closest('.flex-1, .bg-gray-50, div[class*="col-span"]')
                                                ?.querySelector('span[id^="logo_nombre"]');
                        if (logoDisplay) {
                            logoDisplay.textContent = fileName;
                        }
                    }
                }
            });

        });
    </script>
</x-app-layout>
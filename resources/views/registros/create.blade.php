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
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100 bg-blue-dark/3">
                <div class="w-8 h-8 rounded-lg bg-blue-dark/10 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-blue-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 10h16M4 14h16M4 18h7"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-blue-dark text-sm">Selección de Formulario</h3>
            </div>
            <div class="p-5">
                <div class="group max-w-md">
                    <label class="block text-sm font-medium text-blue-dark mb-1.5 transition-colors duration-200 group-focus-within:text-orange">
                        Tipo de Formulario
                    </label>
                    <div class="relative flex items-center rounded-xl border border-gray-200 bg-gray-50
                                transition-all duration-200
                                group-focus-within:border-orange group-focus-within:bg-white
                                group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)]
                                {{ isset($instancia) ? 'opacity-60' : 'hover:border-blue-light/60' }}">
                        <div class="pl-3 flex-shrink-0">
                            <svg class="w-4 h-4 text-gray-400 transition-colors duration-200 group-focus-within:text-orange"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <select id="tipoFormularioSelector"
                                {{ isset($instancia) ? 'disabled' : '' }}
                                class="w-full bg-transparent border-none px-3 py-2.5 text-sm text-gray-800 font-medium focus:outline-none focus:ring-0 cursor-pointer">
                            <option value="1" {{ $tipoForm == 1 ? 'selected' : '' }}>Formulario 1: DBO 5 -IDE</option>
                            <option value="2" {{ $tipoForm == 2 ? 'selected' : '' }}>Formulario 2: QEN_V4_INF</option>
                            <option value="3" {{ $tipoForm == 3 ? 'selected' : '' }}>Formulario 3: Informe de Terrero </option>
                            <option value="4" {{ $tipoForm == 4 ? 'selected' : '' }}>Formulario 4: QEN_SST</option>
                            <option value="5" {{ $tipoForm == 5 ? 'selected' : '' }}>Formulario 5: QEN DS90</option>
                        </select>
                        <div class="pr-3 flex-shrink-0">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
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
                <input type="hidden" name="tipo_form_id" id="tipo_form_id_hidden" value="{{ $tipoForm }}">
            </div>
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
        const selector = document.getElementById('tipoFormularioSelector');
        const hiddenInput = document.getElementById('tipo_form_id_hidden');

        if (selector) {
            selector.addEventListener('change', function () {
                if (hiddenInput) hiddenInput.value = this.value;
                document.querySelectorAll('.seccion-modulo').forEach(el => el.classList.add('hidden'));
                const seccion = document.getElementById('seccion_' + this.value);
                if (seccion) seccion.classList.remove('hidden');
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }
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
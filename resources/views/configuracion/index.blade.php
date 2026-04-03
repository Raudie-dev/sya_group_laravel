<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-orange/15 flex items-center justify-center">
                    <svg class="w-5 h-5 text-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-blue-dark leading-tight">Configuración</h2>
                    <p class="text-gray-400 text-sm mt-0.5">Gestión de equipos y modelos</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="p-4 sm:p-6 lg:p-8 space-y-8">

        {{-- ── FLASH ── --}}
        @if(session('success'))
            <div x-data="{ show: true }"
                 x-show="show"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-2"
                 class="flex items-center gap-3 px-4 py-3 bg-green/10 border border-green/30 rounded-xl text-sm text-green">
                <svg class="w-4 h-4 text-green flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ session('success') }}
                <button @click="show = false" class="ml-auto text-green hover:text-green-dark transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        @endif

        {{-- ════════════════════════════════════════════
             BLOQUE: EQUIPOS (N° Serie / Códigos)
        ════════════════════════════════════════════ --}}
        <div x-data="equiposManager()" x-init="init()" class="space-y-5">

            <div class="flex items-center gap-2">
                <div class="w-1 h-6 bg-gradient-to-b from-orange to-orange-dark rounded-full"></div>
                <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider">Equipos — N° Serie</h3>
            </div>

            {{-- Stats --}}
            @php
                $totalEq   = $equipos->count();
                $activosEq = $equipos->where('activo', true)->count();
            @endphp
            <div class="grid grid-cols-3 gap-3">
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm px-4 py-3.5 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-orange/10 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-blue-dark leading-none">{{ $totalEq }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">Total equipos</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm px-4 py-3.5 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-green/10 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-blue-dark leading-none">{{ $activosEq }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">Activos</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm px-4 py-3.5 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-red/10 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-blue-dark leading-none">{{ $totalEq - $activosEq }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">Inactivos</p>
                    </div>
                </div>
            </div>

            {{-- Agregar equipo --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden"
                 x-data="{ abierto: {{ $errors->has('codigo') ? 'true' : 'false' }} }">
                <button type="button" @click="abierto = !abierto"
                        class="w-full flex items-center justify-between px-5 py-4 border-b border-gray-100 bg-gray-50/50 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-orange/10 flex items-center justify-center">
                            <svg class="w-4 h-4 text-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                        <h3 class="text-sm font-semibold text-blue-dark">Agregar Nuevo Equipo</h3>
                    </div>
                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="abierto && 'rotate-180'"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="abierto"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-1">
                    <form method="POST" action="{{ route('configuracion.equipos.store') }}" class="px-5 py-4">
                        @csrf
                        <div class="flex flex-col sm:flex-row gap-3">
                            <div class="flex-1">
                                <label class="block text-xs font-medium text-gray-500 mb-1.5">
                                    N° Serie / Código <span class="text-orange">*</span>
                                </label>
                                <input type="text" name="codigo" value="{{ old('codigo') }}"
                                       placeholder="Ej: 218M03023" autocomplete="off"
                                       class="w-full rounded-xl border @error('codigo') border-red bg-red/10 @else border-gray-200 bg-gray-50 @enderror
                                              px-3 py-2.5 text-sm text-gray-800 placeholder-gray-400 transition-all duration-200
                                              focus:outline-none focus:border-orange focus:bg-white focus:shadow-[0_0_0_3px_rgba(255,140,66,0.15)]">
                                @error('codigo')
                                    <p class="mt-1 text-xs text-red flex items-center gap-1">
                                        <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="flex-[2]">
                                <label class="block text-xs font-medium text-gray-500 mb-1.5">
                                    Descripción <span class="text-gray-400">(opcional)</span>
                                </label>
                                <input type="text" name="descripcion" value="{{ old('descripcion') }}"
                                       placeholder="Ej: Medidor de pH portátil Hach"
                                       class="w-full rounded-xl border border-gray-200 bg-gray-50 px-3 py-2.5 text-sm text-gray-800 placeholder-gray-400
                                              transition-all duration-200 focus:outline-none focus:border-orange focus:bg-white focus:shadow-[0_0_0_3px_rgba(255,140,66,0.15)]">
                            </div>
                            <div class="flex items-end">
                                <button type="submit"
                                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-orange text-white text-sm font-semibold rounded-xl
                                               shadow-sm hover:bg-orange-dark active:scale-95 transition-all duration-150 whitespace-nowrap">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    Agregar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Tabla equipos --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 px-5 py-4 border-b border-gray-100 bg-gray-50/50">
                    <div class="flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-blue/10 flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"/>
                            </svg>
                        </div>
                        <h3 class="text-sm font-semibold text-blue-dark">Equipos Registrados</h3>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="flex items-center rounded-xl border border-gray-200 bg-white overflow-hidden divide-x divide-gray-200 text-xs font-medium">
                            <button type="button" @click="filtroEstado = 'todos'"
                                    class="px-3 py-2 transition-colors"
                                    :class="filtroEstado === 'todos' ? 'bg-orange text-white' : 'text-gray-500 hover:bg-gray-50'">Todos</button>
                            <button type="button" @click="filtroEstado = 'activos'"
                                    class="px-3 py-2 transition-colors"
                                    :class="filtroEstado === 'activos' ? 'bg-green text-white' : 'text-gray-500 hover:bg-gray-50'">Activos</button>
                            <button type="button" @click="filtroEstado = 'inactivos'"
                                    class="px-3 py-2 transition-colors"
                                    :class="filtroEstado === 'inactivos' ? 'bg-red text-white' : 'text-gray-500 hover:bg-gray-50'">Inactivos</button>
                        </div>
                        <div class="flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-3 py-2 w-full sm:w-52
                                    focus-within:border-orange focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.12)] transition-all duration-200">
                            <svg class="w-3.5 h-3.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                            </svg>
                            <input type="text" x-model="busqueda" placeholder="Filtrar equipos..."
                                   class="w-full bg-transparent border-none p-0 text-xs text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                            <button x-show="busqueda" @click="busqueda = ''" type="button" class="text-gray-400 hover:text-gray-600 transition-colors">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm table-fixed">
                        <colgroup>
                            <col style="width:40px">
                            <col style="width:160px">
                            <col>
                            <col style="width:110px">
                            <col style="width:148px">
                        </colgroup>
                        <thead>
                            <tr class="border-b border-gray-100">
                                <th class="text-left px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">#</th>
                                <th class="text-left px-4 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Código</th>
                                <th class="text-left px-4 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Descripción</th>
                                <th class="text-center px-4 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Estado</th>
                                <th class="text-center px-4 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($equipos as $equipo)
                                <tr class="equipo-fila transition-colors"
                                    x-show="filtraFila('{{ strtolower($equipo->codigo) }}', '{{ strtolower($equipo->descripcion ?? '') }}', {{ $equipo->activo ? 'true' : 'false' }})"
                                    :class="editandoId === {{ $equipo->id }} ? 'bg-orange/[0.04] ring-1 ring-inset ring-orange/20' : 'hover:bg-gray-50/70'">
                                    <td class="px-5 text-xs text-gray-300 font-mono h-[52px] align-middle">{{ $loop->iteration }}</td>
                                    <td class="px-4 h-[52px] align-middle">
                                        <div class="relative h-[28px]">
                                            <span class="absolute inset-0 flex items-center transition-opacity duration-150"
                                                  :class="editandoId === {{ $equipo->id }} ? 'opacity-0 pointer-events-none' : 'opacity-100'">
                                                <span class="inline-flex items-center font-mono text-xs font-semibold text-blue-dark bg-gray-100 px-2.5 py-1 rounded-lg">
                                                    {{ $equipo->codigo }}
                                                </span>
                                            </span>
                                            <input type="text" x-model="editCodigo"
                                                   class="absolute inset-0 w-full rounded-lg border border-orange bg-white px-2.5 text-xs font-mono font-semibold text-blue-dark transition-opacity duration-150 focus:outline-none focus:shadow-[0_0_0_2px_rgba(255,140,66,0.25)]"
                                                   :class="editandoId === {{ $equipo->id }} ? 'opacity-100' : 'opacity-0 pointer-events-none'">
                                        </div>
                                    </td>
                                    <td class="px-4 h-[52px] align-middle">
                                        <div class="relative h-[28px]">
                                            <span class="absolute inset-0 flex items-center text-xs truncate transition-opacity duration-150 {{ $equipo->descripcion ? 'text-gray-500' : 'text-gray-300 italic' }}"
                                                  :class="editandoId === {{ $equipo->id }} ? 'opacity-0 pointer-events-none' : 'opacity-100'">
                                                {{ $equipo->descripcion ?? 'Sin descripción' }}
                                            </span>
                                            <input type="text" x-model="editDescripcion" placeholder="Descripción opcional"
                                                   class="absolute inset-0 w-full rounded-lg border border-orange/60 bg-white px-2.5 text-xs text-gray-700 transition-opacity duration-150 focus:outline-none focus:border-orange focus:shadow-[0_0_0_2px_rgba(255,140,66,0.25)]"
                                                   :class="editandoId === {{ $equipo->id }} ? 'opacity-100' : 'opacity-0 pointer-events-none'">
                                        </div>
                                    </td>
                                    <td class="px-4 h-[52px] align-middle">
                                        <div class="relative h-[28px] flex items-center justify-center">
                                            <span class="absolute inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-medium border transition-opacity duration-150
                                                         {{ $equipo->activo ? 'bg-green/10 text-green border-green/30' : 'bg-red/10 text-red border-red/30' }}"
                                                  :class="editandoId === {{ $equipo->id }} ? 'opacity-0 pointer-events-none' : 'opacity-100'">
                                                <span class="w-1.5 h-1.5 rounded-full {{ $equipo->activo ? 'bg-green' : 'bg-red' }}"></span>
                                                {{ $equipo->activo ? 'Activo' : 'Inactivo' }}
                                            </span>
                                            <div class="absolute transition-opacity duration-150"
                                                 :class="editandoId === {{ $equipo->id }} ? 'opacity-100' : 'opacity-0 pointer-events-none'">
                                                <label class="inline-flex items-center cursor-pointer gap-2">
                                                    <input type="checkbox" x-model="editActivo" class="sr-only peer">
                                                    <div class="relative w-8 h-4 bg-gray-200 rounded-full transition-colors peer-checked:bg-orange
                                                                after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-3 after:w-3 after:transition-all peer-checked:after:translate-x-4"></div>
                                                    <span class="text-xs text-gray-600 whitespace-nowrap" x-text="editActivo ? 'Activo' : 'Inactivo'"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 h-[52px] align-middle">
                                        <div class="relative h-[28px] flex items-center justify-center">
                                            <div class="absolute flex items-center gap-1 transition-opacity duration-150"
                                                 :class="editandoId === {{ $equipo->id }} ? 'opacity-0 pointer-events-none' : 'opacity-100'">
                                                <button type="button"
                                                        @click="iniciarEdicion({{ $equipo->id }}, '{{ addslashes($equipo->codigo) }}', '{{ addslashes($equipo->descripcion ?? '') }}', {{ $equipo->activo ? 'true' : 'false' }})"
                                                        class="w-7 h-7 flex items-center justify-center rounded-lg text-gray-400 hover:text-blue hover:bg-blue/10 transition-all duration-150">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                </button>
                                                <button type="button"
                                                        @click="confirmarEliminar({{ $equipo->id }}, '{{ addslashes($equipo->codigo) }}')"
                                                        class="w-7 h-7 flex items-center justify-center rounded-lg text-gray-400 hover:text-red hover:bg-red/10 transition-all duration-150">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="absolute flex items-center gap-1.5 transition-opacity duration-150"
                                                 :class="editandoId === {{ $equipo->id }} ? 'opacity-100' : 'opacity-0 pointer-events-none'">
                                                <button type="button" @click="guardarEdicion({{ $equipo->id }})"
                                                        class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg text-xs font-semibold text-white bg-green hover:bg-green-dark active:scale-95 transition-all duration-150">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                                    </svg>
                                                    Guardar
                                                </button>
                                                <button type="button" @click="cancelarEdicion()"
                                                        class="w-7 h-7 flex items-center justify-center rounded-lg text-gray-400 hover:bg-gray-100 transition-colors">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                </button>
                                            </div>
                                            <form id="form-update-eq-{{ $equipo->id }}" method="POST"
                                                  action="{{ route('configuracion.equipos.update', $equipo) }}" class="hidden">
                                                @csrf @method('PUT')
                                                <input type="text"   name="codigo"      x-bind:value="editCodigo">
                                                <input type="text"   name="descripcion" x-bind:value="editDescripcion">
                                                <input type="hidden" name="activo"      x-bind:value="editActivo ? '1' : '0'">
                                            </form>
                                            <form id="form-delete-eq-{{ $equipo->id }}" method="POST"
                                                  action="{{ route('configuracion.equipos.destroy', $equipo) }}" class="hidden">
                                                @csrf @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-5 py-12 text-center">
                                        <p class="text-sm font-semibold text-gray-400">No hay equipos registrados</p>
                                        <p class="text-xs text-gray-300 mt-1">Usa el formulario de arriba para agregar el primero.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($equipos->count() > 0)
                    <div class="px-5 py-3 border-t border-gray-50 bg-gray-50/30 flex items-center justify-between min-h-[42px]">
                        <p class="text-xs text-gray-400">
                            Mostrando <span class="font-semibold text-gray-600" x-text="resultadosFiltro"></span>
                            de {{ $equipos->count() }} equipos
                        </p>
                        <p x-show="editandoId !== null" class="text-xs text-orange flex items-center gap-1.5">
                            <kbd class="px-1 py-0.5 bg-white border border-gray-200 rounded text-gray-500 font-mono text-[10px]">Enter</kbd> guardar ·
                            <kbd class="px-1 py-0.5 bg-white border border-gray-200 rounded text-gray-500 font-mono text-[10px]">Esc</kbd> cancelar
                        </p>
                    </div>
                @endif
            </div>

        </div>{{-- /equiposManager --}}


        {{-- ════════════════════════════════════════════
             BLOQUE: MODELOS
        ════════════════════════════════════════════ --}}
        <div x-data="modelosManager()" x-init="init()" class="space-y-5">

            <div class="flex items-center gap-2">
                <div class="w-1 h-6 bg-gradient-to-b from-blue to-blue-dark rounded-full"></div>
                <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider">Modelos de Equipo</h3>
            </div>

            {{-- Stats --}}
            @php
                $totalMod   = $modelos->count();
                $activosMod = $modelos->where('activo', true)->count();
            @endphp
            <div class="grid grid-cols-3 gap-3">
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm px-4 py-3.5 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-blue/10 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-blue-dark leading-none">{{ $totalMod }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">Total modelos</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm px-4 py-3.5 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-green/10 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-blue-dark leading-none">{{ $activosMod }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">Activos</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm px-4 py-3.5 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-red/10 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-blue-dark leading-none">{{ $totalMod - $activosMod }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">Inactivos</p>
                    </div>
                </div>
            </div>

            {{-- Agregar modelo --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden"
                 x-data="{ abierto: {{ $errors->has('nombre') ? 'true' : 'false' }} }">
                <button type="button" @click="abierto = !abierto"
                        class="w-full flex items-center justify-between px-5 py-4 border-b border-gray-100 bg-gray-50/50 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-blue/10 flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                        <h3 class="text-sm font-semibold text-blue-dark">Agregar Nuevo Modelo</h3>
                    </div>
                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="abierto && 'rotate-180'"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="abierto"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-1">
                    <form method="POST" action="{{ route('configuracion.modelos.store') }}" class="px-5 py-4">
                        @csrf
                        <div class="flex flex-col sm:flex-row gap-3">
                            <div class="flex-1">
                                <label class="block text-xs font-medium text-gray-500 mb-1.5">
                                    Nombre del Modelo <span class="text-orange">*</span>
                                </label>
                                <input type="text" name="nombre" value="{{ old('nombre') }}"
                                       placeholder="Ej: YSI Pro30" autocomplete="off"
                                       class="w-full rounded-xl border @error('nombre') border-red bg-red/10 @else border-gray-200 bg-gray-50 @enderror
                                              px-3 py-2.5 text-sm text-gray-800 placeholder-gray-400 transition-all duration-200
                                              focus:outline-none focus:border-orange focus:bg-white focus:shadow-[0_0_0_3px_rgba(255,140,66,0.15)]">
                                @error('nombre')
                                    <p class="mt-1 text-xs text-red flex items-center gap-1">
                                        <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="flex-[2]">
                                <label class="block text-xs font-medium text-gray-500 mb-1.5">
                                    Descripción <span class="text-gray-400">(opcional)</span>
                                </label>
                                <input type="text" name="descripcion" value="{{ old('descripcion') }}"
                                       placeholder="Ej: Sonda multiparamétrica YSI"
                                       class="w-full rounded-xl border border-gray-200 bg-gray-50 px-3 py-2.5 text-sm text-gray-800 placeholder-gray-400
                                              transition-all duration-200 focus:outline-none focus:border-orange focus:bg-white focus:shadow-[0_0_0_3px_rgba(255,140,66,0.15)]">
                            </div>
                            <div class="flex items-end">
                                <button type="submit"
                                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue text-white text-sm font-semibold rounded-xl
                                               shadow-sm hover:bg-blue-dark active:scale-95 transition-all duration-150 whitespace-nowrap">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    Agregar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Tabla modelos --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 px-5 py-4 border-b border-gray-100 bg-gray-50/50">
                    <div class="flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-blue/10 flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                            </svg>
                        </div>
                        <h3 class="text-sm font-semibold text-blue-dark">Modelos Registrados</h3>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="flex items-center rounded-xl border border-gray-200 bg-white overflow-hidden divide-x divide-gray-200 text-xs font-medium">
                            <button type="button" @click="filtroEstado = 'todos'"
                                    class="px-3 py-2 transition-colors"
                                    :class="filtroEstado === 'todos' ? 'bg-orange text-white' : 'text-gray-500 hover:bg-gray-50'">Todos</button>
                            <button type="button" @click="filtroEstado = 'activos'"
                                    class="px-3 py-2 transition-colors"
                                    :class="filtroEstado === 'activos' ? 'bg-green text-white' : 'text-gray-500 hover:bg-gray-50'">Activos</button>
                            <button type="button" @click="filtroEstado = 'inactivos'"
                                    class="px-3 py-2 transition-colors"
                                    :class="filtroEstado === 'inactivos' ? 'bg-red text-white' : 'text-gray-500 hover:bg-gray-50'">Inactivos</button>
                        </div>
                        <div class="flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-3 py-2 w-full sm:w-52
                                    focus-within:border-orange focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.12)] transition-all duration-200">
                            <svg class="w-3.5 h-3.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                            </svg>
                            <input type="text" x-model="busqueda" placeholder="Filtrar modelos..."
                                   class="w-full bg-transparent border-none p-0 text-xs text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0">
                            <button x-show="busqueda" @click="busqueda = ''" type="button" class="text-gray-400 hover:text-gray-600 transition-colors">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm table-fixed">
                        <colgroup>
                            <col style="width:40px">
                            <col style="width:180px">
                            <col>
                            <col style="width:110px">
                            <col style="width:148px">
                        </colgroup>
                        <thead>
                            <tr class="border-b border-gray-100">
                                <th class="text-left px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">#</th>
                                <th class="text-left px-4 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Nombre</th>
                                <th class="text-left px-4 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Descripción</th>
                                <th class="text-center px-4 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Estado</th>
                                <th class="text-center px-4 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($modelos as $modelo)
                                <tr class="modelo-fila transition-colors"
                                    x-show="filtraFila('{{ strtolower($modelo->nombre) }}', '{{ strtolower($modelo->descripcion ?? '') }}', {{ $modelo->activo ? 'true' : 'false' }})"
                                    :class="editandoId === {{ $modelo->id }} ? 'bg-blue/[0.04] ring-1 ring-inset ring-blue/20' : 'hover:bg-gray-50/70'">
                                    <td class="px-5 text-xs text-gray-300 font-mono h-[52px] align-middle">{{ $loop->iteration }}</td>
                                    <td class="px-4 h-[52px] align-middle">
                                        <div class="relative h-[28px]">
                                            <span class="absolute inset-0 flex items-center transition-opacity duration-150"
                                                  :class="editandoId === {{ $modelo->id }} ? 'opacity-0 pointer-events-none' : 'opacity-100'">
                                                <span class="text-xs font-semibold text-blue-dark">{{ $modelo->nombre }}</span>
                                            </span>
                                            <input type="text" x-model="editNombre"
                                                   class="absolute inset-0 w-full rounded-lg border border-blue bg-white px-2.5 text-xs font-semibold text-blue-dark transition-opacity duration-150 focus:outline-none focus:shadow-[0_0_0_2px_rgba(59,130,246,0.25)]"
                                                   :class="editandoId === {{ $modelo->id }} ? 'opacity-100' : 'opacity-0 pointer-events-none'">
                                        </div>
                                    </td>
                                    <td class="px-4 h-[52px] align-middle">
                                        <div class="relative h-[28px]">
                                            <span class="absolute inset-0 flex items-center text-xs truncate transition-opacity duration-150 {{ $modelo->descripcion ? 'text-gray-500' : 'text-gray-300 italic' }}"
                                                  :class="editandoId === {{ $modelo->id }} ? 'opacity-0 pointer-events-none' : 'opacity-100'">
                                                {{ $modelo->descripcion ?? 'Sin descripción' }}
                                            </span>
                                            <input type="text" x-model="editDescripcion" placeholder="Descripción opcional"
                                                   class="absolute inset-0 w-full rounded-lg border border-blue/60 bg-white px-2.5 text-xs text-gray-700 transition-opacity duration-150 focus:outline-none focus:border-blue focus:shadow-[0_0_0_2px_rgba(59,130,246,0.25)]"
                                                   :class="editandoId === {{ $modelo->id }} ? 'opacity-100' : 'opacity-0 pointer-events-none'">
                                        </div>
                                    </td>
                                    <td class="px-4 h-[52px] align-middle">
                                        <div class="relative h-[28px] flex items-center justify-center">
                                            <span class="absolute inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-medium border transition-opacity duration-150
                                                         {{ $modelo->activo ? 'bg-green/10 text-green border-green/30' : 'bg-red/10 text-red border-red/30' }}"
                                                  :class="editandoId === {{ $modelo->id }} ? 'opacity-0 pointer-events-none' : 'opacity-100'">
                                                <span class="w-1.5 h-1.5 rounded-full {{ $modelo->activo ? 'bg-green' : 'bg-red' }}"></span>
                                                {{ $modelo->activo ? 'Activo' : 'Inactivo' }}
                                            </span>
                                            <div class="absolute transition-opacity duration-150"
                                                 :class="editandoId === {{ $modelo->id }} ? 'opacity-100' : 'opacity-0 pointer-events-none'">
                                                <label class="inline-flex items-center cursor-pointer gap-2">
                                                    <input type="checkbox" x-model="editActivo" class="sr-only peer">
                                                    <div class="relative w-8 h-4 bg-gray-200 rounded-full transition-colors peer-checked:bg-blue
                                                                after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-3 after:w-3 after:transition-all peer-checked:after:translate-x-4"></div>
                                                    <span class="text-xs text-gray-600 whitespace-nowrap" x-text="editActivo ? 'Activo' : 'Inactivo'"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 h-[52px] align-middle">
                                        <div class="relative h-[28px] flex items-center justify-center">
                                            <div class="absolute flex items-center gap-1 transition-opacity duration-150"
                                                 :class="editandoId === {{ $modelo->id }} ? 'opacity-0 pointer-events-none' : 'opacity-100'">
                                                <button type="button"
                                                        @click="iniciarEdicion({{ $modelo->id }}, '{{ addslashes($modelo->nombre) }}', '{{ addslashes($modelo->descripcion ?? '') }}', {{ $modelo->activo ? 'true' : 'false' }})"
                                                        class="w-7 h-7 flex items-center justify-center rounded-lg text-gray-400 hover:text-blue hover:bg-blue/10 transition-all duration-150">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                </button>
                                                <button type="button"
                                                        @click="confirmarEliminar({{ $modelo->id }}, '{{ addslashes($modelo->nombre) }}')"
                                                        class="w-7 h-7 flex items-center justify-center rounded-lg text-gray-400 hover:text-red hover:bg-red/10 transition-all duration-150">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="absolute flex items-center gap-1.5 transition-opacity duration-150"
                                                 :class="editandoId === {{ $modelo->id }} ? 'opacity-100' : 'opacity-0 pointer-events-none'">
                                                <button type="button" @click="guardarEdicion({{ $modelo->id }})"
                                                        class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg text-xs font-semibold text-white bg-green hover:bg-green-dark active:scale-95 transition-all duration-150">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                                    </svg>
                                                    Guardar
                                                </button>
                                                <button type="button" @click="cancelarEdicion()"
                                                        class="w-7 h-7 flex items-center justify-center rounded-lg text-gray-400 hover:bg-gray-100 transition-colors">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                </button>
                                            </div>
                                            <form id="form-update-mod-{{ $modelo->id }}" method="POST"
                                                  action="{{ route('configuracion.modelos.update', $modelo) }}" class="hidden">
                                                @csrf @method('PUT')
                                                <input type="text"   name="nombre"      x-bind:value="editNombre">
                                                <input type="text"   name="descripcion" x-bind:value="editDescripcion">
                                                <input type="hidden" name="activo"      x-bind:value="editActivo ? '1' : '0'">
                                            </form>
                                            <form id="form-delete-mod-{{ $modelo->id }}" method="POST"
                                                  action="{{ route('configuracion.modelos.destroy', $modelo) }}" class="hidden">
                                                @csrf @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-5 py-12 text-center">
                                        <p class="text-sm font-semibold text-gray-400">No hay modelos registrados</p>
                                        <p class="text-xs text-gray-300 mt-1">Usa el formulario de arriba para agregar el primero.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($modelos->count() > 0)
                    <div class="px-5 py-3 border-t border-gray-50 bg-gray-50/30 flex items-center justify-between min-h-[42px]">
                        <p class="text-xs text-gray-400">
                            Mostrando <span class="font-semibold text-gray-600" x-text="resultadosFiltro"></span>
                            de {{ $modelos->count() }} modelos
                        </p>
                        <p x-show="editandoId !== null" class="text-xs text-blue flex items-center gap-1.5">
                            <kbd class="px-1 py-0.5 bg-white border border-gray-200 rounded text-gray-500 font-mono text-[10px]">Enter</kbd> guardar ·
                            <kbd class="px-1 py-0.5 bg-white border border-gray-200 rounded text-gray-500 font-mono text-[10px]">Esc</kbd> cancelar
                        </p>
                    </div>
                @endif
            </div>

        </div>{{-- /modelosManager --}}

    </div>{{-- /p-4 --}}


    {{-- ── MODAL ELIMINACIÓN (compartido) ── --}}
    <div x-data="{ open: false, id: null, nombre: '', tipo: '' }"
         @confirmar-eliminar.window="id = $event.detail.id; nombre = $event.detail.nombre; tipo = $event.detail.tipo; open = true"
         x-show="open" x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" @click="open = false"></div>
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm z-10 overflow-hidden"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95">
            <div class="p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-red/10 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-blue-dark" x-text="'Eliminar ' + tipo"></h3>
                        <p class="text-xs text-gray-400 mt-0.5">Esta acción no se puede deshacer</p>
                    </div>
                </div>
                <p class="text-sm text-gray-600 mb-5">
                    ¿Seguro que deseas eliminar
                    <span class="font-mono font-semibold text-blue-dark" x-text="'«' + nombre + '»'"></span>?
                </p>
                <div class="flex gap-2.5">
                    <button @click="open = false"
                            class="flex-1 px-4 py-2.5 text-sm font-medium text-gray-600 bg-gray-100 rounded-xl hover:bg-gray-200 transition-colors">
                        Cancelar
                    </button>
                    <button @click="document.getElementById('form-delete-' + (tipo === 'Equipo' ? 'eq' : 'mod') + '-' + id).submit()"
                            class="flex-1 px-4 py-2.5 text-sm font-semibold text-white bg-red rounded-xl hover:bg-red-dark active:scale-95 transition-all">
                        Sí, eliminar
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Safelist --}}
    <div class="hidden">
        <div class="bg-orange text-orange bg-orange/10 hover:bg-orange-dark border-orange/20 ring-orange/20 bg-orange/[0.04] peer-checked:bg-orange peer-checked:after:translate-x-4"></div>
        <div class="bg-green text-green bg-green/10 hover:bg-green-dark border-green/30"></div>
        <div class="bg-red text-red bg-red/10 hover:bg-red-dark border-red/30"></div>
        <div class="bg-blue text-blue bg-blue/10 text-blue-dark bg-blue/[0.04] ring-blue/20 peer-checked:bg-blue"></div>
    </div>

    <script>
    function equiposManager() {
        return {
            busqueda: '',
            filtroEstado: 'todos',
            editandoId: null,
            editCodigo: '',
            editDescripcion: '',
            editActivo: true,
            resultadosFiltro: {{ $equipos->count() }},

            init() {
                this.$watch('busqueda',     () => this.contarResultados());
                this.$watch('filtroEstado', () => this.contarResultados());
                document.addEventListener('keydown', (e) => {
                    if (this.editandoId === null) return;
                    if (e.key === 'Enter')  { e.preventDefault(); this.guardarEdicion(this.editandoId); }
                    if (e.key === 'Escape') { e.preventDefault(); this.cancelarEdicion(); }
                });
            },
            filtraFila(codigo, descripcion, activo) {
                if (this.busqueda) {
                    const q = this.busqueda.toLowerCase().trim();
                    if (!codigo.includes(q) && !descripcion.includes(q)) return false;
                }
                if (this.filtroEstado === 'activos'   && !activo) return false;
                if (this.filtroEstado === 'inactivos' &&  activo) return false;
                return true;
            },
            contarResultados() {
                this.$nextTick(() => {
                    this.resultadosFiltro = document.querySelectorAll('.equipo-fila:not([style*="display: none"])').length;
                });
            },
            iniciarEdicion(id, codigo, descripcion, activo) {
                this.editandoId = id; this.editCodigo = codigo;
                this.editDescripcion = descripcion; this.editActivo = activo;
            },
            cancelarEdicion() {
                this.editandoId = null; this.editCodigo = this.editDescripcion = ''; this.editActivo = true;
            },
            guardarEdicion(id) { document.getElementById('form-update-eq-' + id)?.submit(); },
            confirmarEliminar(id, codigo) {
                window.dispatchEvent(new CustomEvent('confirmar-eliminar', { detail: { id, nombre: codigo, tipo: 'Equipo' } }));
            },
        };
    }

    function modelosManager() {
        return {
            busqueda: '',
            filtroEstado: 'todos',
            editandoId: null,
            editNombre: '',
            editDescripcion: '',
            editActivo: true,
            resultadosFiltro: {{ $modelos->count() }},

            init() {
                this.$watch('busqueda',     () => this.contarResultados());
                this.$watch('filtroEstado', () => this.contarResultados());
                document.addEventListener('keydown', (e) => {
                    if (this.editandoId === null) return;
                    if (e.key === 'Enter')  { e.preventDefault(); this.guardarEdicion(this.editandoId); }
                    if (e.key === 'Escape') { e.preventDefault(); this.cancelarEdicion(); }
                });
            },
            filtraFila(nombre, descripcion, activo) {
                if (this.busqueda) {
                    const q = this.busqueda.toLowerCase().trim();
                    if (!nombre.includes(q) && !descripcion.includes(q)) return false;
                }
                if (this.filtroEstado === 'activos'   && !activo) return false;
                if (this.filtroEstado === 'inactivos' &&  activo) return false;
                return true;
            },
            contarResultados() {
                this.$nextTick(() => {
                    this.resultadosFiltro = document.querySelectorAll('.modelo-fila:not([style*="display: none"])').length;
                });
            },
            iniciarEdicion(id, nombre, descripcion, activo) {
                this.editandoId = id; this.editNombre = nombre;
                this.editDescripcion = descripcion; this.editActivo = activo;
            },
            cancelarEdicion() {
                this.editandoId = null; this.editNombre = this.editDescripcion = ''; this.editActivo = true;
            },
            guardarEdicion(id) { document.getElementById('form-update-mod-' + id)?.submit(); },
            confirmarEliminar(id, nombre) {
                window.dispatchEvent(new CustomEvent('confirmar-eliminar', { detail: { id, nombre, tipo: 'Modelo' } }));
            },
        };
    }
    </script>
</x-app-layout>
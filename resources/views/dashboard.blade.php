<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-bold text-blue-dark leading-tight">Dashboard</h2>
                <p class="text-gray-400 text-sm mt-0.5">Bienvenido de nuevo, {{ Auth::user()->name }}</p>
            </div>
            @if(Auth::user()->isAdmin())
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-orange/10 text-orange text-xs font-semibold rounded-lg border border-orange/20">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    Administrador
                </span>
            @elseif(Auth::user()->isTecnico())
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-blue/10 text-blue text-xs font-semibold rounded-lg border border-blue/20">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Técnico
                </span>
            @endif
        </div>
    </x-slot>

    <div class="p-4 sm:p-6 lg:p-8 space-y-6">

        {{-- Acciones rápidas --}}
        @if(Auth::user()->isAdmin() || Auth::user()->isTecnico())
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-3">Acciones rápidas</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 {{ Auth::user()->isAdmin() ? 'lg:grid-cols-3' : '' }} gap-3 sm:gap-4">

                    {{-- Agregar Registro --}}
                    <a href="{{ route('registros.create') }}"
                       class="group relative bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg hover:border-orange/40 hover:-translate-y-0.5 transition-all duration-200 p-5 flex items-center gap-4 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-orange/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                        <div class="w-11 h-11 rounded-xl bg-orange/10 group-hover:bg-orange/20 flex items-center justify-center flex-shrink-0 transition-colors duration-200 shadow-sm">
                            <svg class="w-5 h-5 text-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0 relative z-10">
                            <p class="font-semibold text-blue-dark text-sm">Agregar Registro</p>
                            <p class="text-xs text-gray-400 mt-0.5">Crear un nuevo registro</p>
                        </div>
                        <div class="w-7 h-7 rounded-lg bg-gray-50 group-hover:bg-orange/10 flex items-center justify-center transition-colors duration-150 flex-shrink-0 relative z-10">
                            <svg class="w-3.5 h-3.5 text-gray-300 group-hover:text-orange group-hover:translate-x-0.5 transition-all duration-150"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>

                    @if(Auth::user()->isAdmin())
                        {{-- Gestión de Usuarios --}}
                        <a href="{{ route('usuarios.index') }}"
                           class="group relative bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg hover:border-green/40 hover:-translate-y-0.5 transition-all duration-200 p-5 flex items-center gap-4 overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-br from-green/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                            <div class="w-11 h-11 rounded-xl bg-green/10 group-hover:bg-green/20 flex items-center justify-center flex-shrink-0 transition-colors duration-200 shadow-sm">
                                <svg class="w-5 h-5 text-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0 relative z-10">
                                <p class="font-semibold text-blue-dark text-sm">Gestión de Usuarios</p>
                                <p class="text-xs text-gray-400 mt-0.5">Administrar cuentas y permisos</p>
                            </div>
                            <div class="w-7 h-7 rounded-lg bg-gray-50 group-hover:bg-green/10 flex items-center justify-center transition-colors duration-150 flex-shrink-0 relative z-10">
                                <svg class="w-3.5 h-3.5 text-gray-300 group-hover:text-green group-hover:translate-x-0.5 transition-all duration-150"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </a>
                    @endif

                    {{-- Mi Perfil --}}
                    <a href="{{ route('profile.edit') }}"
                       class="group relative bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg hover:border-blue/40 hover:-translate-y-0.5 transition-all duration-200 p-5 flex items-center gap-4 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                        <div class="w-11 h-11 rounded-xl bg-blue/10 group-hover:bg-blue/20 flex items-center justify-center flex-shrink-0 transition-colors duration-200 shadow-sm">
                            <svg class="w-5 h-5 text-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0 relative z-10">
                            <p class="font-semibold text-blue-dark text-sm">Mi Perfil</p>
                            <p class="text-xs text-gray-400 mt-0.5">Editar información personal</p>
                        </div>
                        <div class="w-7 h-7 rounded-lg bg-gray-50 group-hover:bg-blue/10 flex items-center justify-center transition-colors duration-150 flex-shrink-0 relative z-10">
                            <svg class="w-3.5 h-3.5 text-gray-300 group-hover:text-blue group-hover:translate-x-0.5 transition-all duration-150"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                </div>
            </div>
        @endif

        {{-- Filtros --}}
        <div class="p-5 border-b border-gray-100 bg-white rounded-2xl">
            <form method="GET" action="{{ route('registros.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">
                <!-- Título -->
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Título</label>
                    <input type="text" name="titulo" value="{{ request('titulo') }}" 
                        placeholder="Buscar por título..." 
                        class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-dark/20 focus:border-blue-dark">
                </div>
                
                <!-- Código -->
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Código</label>
                    <input type="text" name="codigo" value="{{ request('codigo') }}" 
                        placeholder="Ej: INF-001..." 
                        class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-dark/20 focus:border-blue-dark">
                </div>
                
                <!-- Empresa -->
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Empresa</label>
                    <input type="text" name="empresa" value="{{ request('empresa') }}" 
                        placeholder="Nombre de empresa..." 
                        class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-dark/20 focus:border-blue-dark">
                </div>
                
                <!-- Proyecto -->
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Proyecto</label>
                    <input type="text" name="proyecto" value="{{ request('proyecto') }}" 
                        placeholder="Nombre del proyecto..." 
                        class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-dark/20 focus:border-blue-dark">
                </div>
                
                <!-- Fecha desde - hasta (en dos columnas) -->
                <div class="sm:col-span-2 lg:col-span-1 grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Desde</label>
                        <input type="date" name="fecha_desde" value="{{ request('fecha_desde') }}" 
                            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-dark/20 focus:border-blue-dark">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Hasta</label>
                        <input type="date" name="fecha_hasta" value="{{ request('fecha_hasta') }}" 
                            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-dark/20 focus:border-blue-dark">
                    </div>
                </div>
                
                <!-- Botones de acción -->
                <div class="sm:col-span-2 lg:col-span-1 flex items-end gap-2">
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-dark text-white text-sm font-semibold rounded-lg hover:bg-blue transition-colors duration-150 shadow-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Filtrar
                    </button>
                    
                    @if(request()->anyFilled(['titulo', 'codigo', 'empresa', 'proyecto', 'fecha_desde', 'fecha_hasta']))
                        <a href="{{ route('registros.index') }}" 
                        class="px-4 py-2 bg-gray-200 text-gray-700 text-sm font-semibold rounded-lg hover:bg-gray-300 transition-colors duration-150 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Limpiar
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Tabla de registros --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

            {{-- Header de la sección --}}
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-blue-dark/5 flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-blue-dark">Registros recientes</h3>
                        <p class="text-xs text-gray-400">Últimos informes registrados</p>
                    </div>
                </div>
                @if(Auth::user()->isAdmin() || Auth::user()->isTecnico())
                    <a href="{{ route('registros.create') }}"
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-dark text-white text-xs font-semibold rounded-lg hover:bg-blue transition-colors duration-150 shadow-sm">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                        </svg>
                        Nuevo
                    </a>
                @endif
            </div>

            {{-- Tabla --}}
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50/70">
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">#</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Título</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Código</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Empresa</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Fecha emisión</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Proyecto</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($registros as $registro)
                            <tr class="hover:bg-gray-50/50 transition-colors duration-100 group">
                                <td class="px-5 py-3.5">
                                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-md bg-gray-100 text-gray-500 text-xs font-semibold">
                                        {{ $registro->id }}
                                    </span>
                                </td>
                                <td class="px-5 py-3.5">
                                    <span class="font-medium text-blue-dark text-sm">{{ $registro->titulo_informe }}</span>
                                </td>
                                <td class="px-5 py-3.5">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-blue-dark/5 text-blue-dark text-xs font-mono font-semibold">
                                        {{ $registro->codigo_informe }}
                                    </span>
                                </td>
                                <td class="px-5 py-3.5 text-gray-600 text-sm">{{ $registro->empresa_nombre }}</td>
                                <td class="px-5 py-3.5">
                                    <span class="inline-flex items-center gap-1 text-gray-500 text-xs">
                                        <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ \Carbon\Carbon::parse($registro->fecha_emision)->format('d/m/Y') }}
                                    </span>
                                </td>
                                <td class="px-5 py-3.5 text-gray-600 text-sm max-w-[180px] truncate">{{ $registro->nombre_proyecto }}</td>

                                {{-- Acciones --}}
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center gap-1.5 flex-wrap">

                                        @if(Auth::user()->isAdmin())
                                        {{-- PDF --}}
                                        <a href="{{ route('registros.pdf', $registro->id) }}" target="_blank"
                                           class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold
                                                  bg-blue/10 text-blue border border-blue/20
                                                  hover:bg-blue hover:text-white hover:border-blue
                                                  transition-all duration-200 shadow-sm">
                                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>
                                            </svg>
                                            PDF
                                        </a>
                                        @endif

                                        {{-- Editar --}}
                                        <a href="{{ route('registros.edit', $registro->id) }}"
                                           class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold
                                                  bg-green/10 text-green border border-green/20
                                                  hover:bg-green hover:text-white hover:border-green
                                                  transition-all duration-200 shadow-sm">
                                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Editar
                                        </a>

                                        {{-- Eliminar --}}
                                        <form action="{{ route('registros.destroy', $registro->id) }}" method="POST"
                                              onsubmit="return confirm('¿Estás seguro de eliminar este registro?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold
                                                           bg-red/10 text-red border border-red/20
                                                           hover:bg-red hover:text-white hover:border-red
                                                           transition-all duration-200 shadow-sm cursor-pointer">
                                                <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Eliminar
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-5 py-16 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-14 h-14 rounded-2xl bg-gray-50 flex items-center justify-center">
                                            <svg class="w-7 h-7 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-400 text-sm">Sin registros aún</p>
                                            <p class="text-xs text-gray-300 mt-0.5">Crea el primer registro para comenzar</p>
                                        </div>
                                        @if(Auth::user()->isAdmin() || Auth::user()->isTecnico())
                                            <a href="{{ route('registros.create') }}"
                                               class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-dark text-white text-xs font-semibold rounded-xl hover:bg-blue transition-colors duration-150 shadow-sm mt-1">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                                                </svg>
                                                Agregar primer registro
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Paginación --}}
            @if($registros->hasPages())
                <div class="px-5 py-4 border-t border-gray-50">
                    {{ $registros->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
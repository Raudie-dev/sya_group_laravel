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
        <div class="relative">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2">
                    <div class="w-1 h-6 bg-gradient-to-b from-orange to-orange-dark rounded-full"></div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Acciones rápidas</p>
                </div>
                @if(Auth::user()->isAdmin())
                    <span class="text-[10px] text-gray-400 bg-gray-100 px-2 py-1 rounded-full">Administrador</span>
                @endif
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 {{ Auth::user()->isAdmin() ? 'lg:grid-cols-4' : 'lg:grid-cols-3' }} gap-4">
                
                {{-- Agregar Registro --}}
                <a href="{{ route('registros.create') }}" 
                class="group relative bg-gradient-to-br from-white to-gray-50/50 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:border-orange/30 hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                    
                    {{-- Fondo animado --}}
                    <div class="absolute inset-0 bg-gradient-to-br from-orange/5 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    
                    {{-- Contenido --}}
                    <div class="relative p-5">
                        <div class="flex items-start justify-between mb-3">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-orange/20 to-orange/5 group-hover:from-orange/30 group-hover:to-orange/10 flex items-center justify-center transition-all duration-300 shadow-sm">
                                <svg class="w-6 h-6 text-orange group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                            </div>
                            <div class="w-8 h-8 rounded-full bg-orange/5 group-hover:bg-orange/10 flex items-center justify-center transition-all duration-300">
                                <svg class="w-4 h-4 text-orange/60 group-hover:text-orange group-hover:translate-x-0.5 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800 text-base mb-1 group-hover:text-orange transition-colors duration-300">Agregar Registro</h3>
                            <p class="text-xs text-gray-400 leading-relaxed">Crear un nuevo registro de monitoreo ambiental</p>
                        </div>
                    </div>
                    
                    {{-- Barra de progreso inferior --}}
                    <div class="h-0.5 bg-gradient-to-r from-orange to-orange-dark scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
                </a>

                @if(Auth::user()->isAdmin())
                    {{-- Gestión de Usuarios --}}
                    <a href="{{ route('usuarios.index') }}"
                    class="group relative bg-gradient-to-br from-white to-gray-50/50 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:border-green/30 hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                        
                        <div class="absolute inset-0 bg-gradient-to-br from-green/5 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        
                        <div class="relative p-5">
                            <div class="flex items-start justify-between mb-3">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green/20 to-green/5 group-hover:from-green/30 group-hover:to-green/10 flex items-center justify-center transition-all duration-300 shadow-sm">
                                    <svg class="w-6 h-6 text-green group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-green/5 group-hover:bg-green/10 flex items-center justify-center transition-all duration-300">
                                    <svg class="w-4 h-4 text-green/60 group-hover:text-green group-hover:translate-x-0.5 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 text-base mb-1 group-hover:text-green transition-colors duration-300">Gestión de Usuarios</h3>
                                <p class="text-xs text-gray-400 leading-relaxed">Administrar cuentas, roles y permisos</p>
                            </div>
                        </div>
                        
                        <div class="h-0.5 bg-gradient-to-r from-green to-green-dark scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
                    </a>

                    {{-- Configuración --}}
                    <a href="{{ route('configuracion.index') }}"
                    class="group relative bg-gradient-to-br from-white to-gray-50/50 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:border-teal-400/30 hover:-translate-y-1 transition-all duration-300 overflow-hidden
                            {{ request()->routeIs('configuracion.*') ? 'ring-2 ring-teal-400/30 shadow-lg' : '' }}">
                        
                        <div class="absolute inset-0 bg-gradient-to-br from-teal-400/5 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        
                        <div class="relative p-5">
                            <div class="flex items-start justify-between mb-3">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-teal-400/20 to-teal-400/5 group-hover:from-teal-400/30 group-hover:to-teal-400/10 flex items-center justify-center transition-all duration-300 shadow-sm
                                            {{ request()->routeIs('configuracion.*') ? 'bg-teal-400/30' : '' }}">
                                    <svg class="w-6 h-6 text-teal-500 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-teal-400/5 group-hover:bg-teal-400/10 flex items-center justify-center transition-all duration-300
                                            {{ request()->routeIs('configuracion.*') ? 'bg-teal-400/20' : '' }}">
                                    <svg class="w-4 h-4 text-teal-500/60 group-hover:text-teal-500 group-hover:translate-x-0.5 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 text-base mb-1 group-hover:text-teal-500 transition-colors duration-300 
                                        {{ request()->routeIs('configuracion.*') ? 'text-teal-500' : '' }}">
                                    Configuración
                                </h3>
                                <p class="text-xs text-gray-400 leading-relaxed">Configurar equipos y parámetros del sistema</p>
                            </div>
                        </div>
                        
                        <div class="h-0.5 bg-gradient-to-r from-teal-400 to-teal-500 scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left
                                {{ request()->routeIs('configuracion.*') ? 'scale-x-100' : '' }}"></div>
                    </a>
                @endif

                {{-- Mi Perfil --}}
                <a href="{{ route('profile.edit') }}"
                class="group relative bg-gradient-to-br from-white to-gray-50/50 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:border-blue/30 hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                    
                    <div class="absolute inset-0 bg-gradient-to-br from-blue/5 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    
                    <div class="relative p-5">
                        <div class="flex items-start justify-between mb-3">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue/20 to-blue/5 group-hover:from-blue/30 group-hover:to-blue/10 flex items-center justify-center transition-all duration-300 shadow-sm">
                                <svg class="w-6 h-6 text-blue group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div class="w-8 h-8 rounded-full bg-blue/5 group-hover:bg-blue/10 flex items-center justify-center transition-all duration-300">
                                <svg class="w-4 h-4 text-blue/60 group-hover:text-blue group-hover:translate-x-0.5 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800 text-base mb-1 group-hover:text-blue transition-colors duration-300">Mi Perfil</h3>
                            <p class="text-xs text-gray-400 leading-relaxed">Editar información personal y contraseña</p>
                        </div>
                    </div>
                    
                    <div class="h-0.5 bg-gradient-to-r from-blue to-blue-dark scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
                </a>
            </div>
        </div>
        @endif

        {{-- Filtros --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            {{-- Header del filtro --}}
            <div class="px-5 py-4 border-b border-gray-100 bg-gradient-to-r from-gray-50/50 to-white flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-1 h-5 bg-gradient-to-b from-blue-dark to-blue rounded-full"></div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                        </svg>
                        <h3 class="text-sm font-semibold text-gray-700">Filtros de búsqueda</h3>
                    </div>
                </div>
                
                @if(request()->anyFilled(['titulo', 'codigo', 'empresa', 'proyecto', 'fecha_desde', 'fecha_hasta']))
                    <div class="flex items-center gap-2">
                        <span class="text-[10px] text-orange bg-orange/10 px-2 py-1 rounded-full font-medium">
                            Filtros activos
                        </span>
                    </div>
                @endif
            </div>

            <div class="p-5">
                <form method="GET" action="{{ route('registros.index') }}" class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                        
                        <!-- Título -->
                        <div class="group">
                            <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-blue-dark transition-colors duration-200">
                                Título del Informe
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400 group-focus-within:text-blue-dark transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <input type="text" 
                                    name="titulo" 
                                    value="{{ request('titulo') }}"
                                    placeholder="Buscar por título..."
                                    class="w-full pl-9 pr-3 py-2 text-sm border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white focus:border-blue-dark focus:ring-2 focus:ring-blue-dark/20 transition-all duration-200 outline-none">
                            </div>
                        </div>

                        <!-- Código -->
                        <div class="group">
                            <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-blue-dark transition-colors duration-200">
                                Código Informe
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400 group-focus-within:text-blue-dark transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                    </svg>
                                </div>
                                <input type="text" 
                                    name="codigo" 
                                    value="{{ request('codigo') }}"
                                    placeholder="Ej: INF-2024-001"
                                    class="w-full pl-9 pr-3 py-2 text-sm border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white focus:border-blue-dark focus:ring-2 focus:ring-blue-dark/20 transition-all duration-200 outline-none">
                            </div>
                        </div>

                        <!-- Empresa -->
                        <div class="group">
                            <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-blue-dark transition-colors duration-200">
                                Empresa / Cliente
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400 group-focus-within:text-blue-dark transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <input type="text" 
                                    name="empresa" 
                                    value="{{ request('empresa') }}"
                                    placeholder="Nombre de empresa..."
                                    class="w-full pl-9 pr-3 py-2 text-sm border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white focus:border-blue-dark focus:ring-2 focus:ring-blue-dark/20 transition-all duration-200 outline-none">
                            </div>
                        </div>

                        <!-- Proyecto -->
                        <div class="group">
                            <label class="block text-xs font-medium text-gray-500 mb-1.5 group-focus-within:text-blue-dark transition-colors duration-200">
                                Nombre del Proyecto
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400 group-focus-within:text-blue-dark transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                </div>
                                <input type="text" 
                                    name="proyecto" 
                                    value="{{ request('proyecto') }}"
                                    placeholder="Nombre del proyecto..."
                                    class="w-full pl-9 pr-3 py-2 text-sm border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white focus:border-blue-dark focus:ring-2 focus:ring-blue-dark/20 transition-all duration-200 outline-none">
                            </div>
                        </div>

                        <!-- Rango de fechas -->
                        <div class="space-y-1.5">
                            <label class="block text-xs font-medium text-gray-500 mb-1.5">
                                Rango de fechas
                            </label>
                            <div class="grid grid-cols-2 gap-2">
                                <div class="relative group/date">
                                    <div class="absolute inset-y-0 left-0 pl-2 flex items-center pointer-events-none">
                                        <svg class="w-3.5 h-3.5 text-gray-400 group-focus-within/date:text-blue-dark transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <input type="date" 
                                        name="fecha_desde" 
                                        value="{{ request('fecha_desde') }}"
                                        class="w-full pl-7 pr-2 py-2 text-xs border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white focus:border-blue-dark focus:ring-2 focus:ring-blue-dark/20 transition-all duration-200 outline-none">
                                </div>
                                <div class="relative group/date">
                                    <div class="absolute inset-y-0 left-0 pl-2 flex items-center pointer-events-none">
                                        <svg class="w-3.5 h-3.5 text-gray-400 group-focus-within/date:text-blue-dark transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <input type="date" 
                                        name="fecha_hasta" 
                                        value="{{ request('fecha_hasta') }}"
                                        class="w-full pl-7 pr-2 py-2 text-xs border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white focus:border-blue-dark focus:ring-2 focus:ring-blue-dark/20 transition-all duration-200 outline-none">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="flex flex-wrap items-center gap-3 pt-2 border-t border-gray-100 mt-2">
                        <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-blue-dark to-blue text-white text-sm font-semibold rounded-xl hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Aplicar filtros
                        </button>

                        @if(request()->anyFilled(['titulo', 'codigo', 'empresa', 'proyecto', 'fecha_desde', 'fecha_hasta']))
                            <a href="{{ route('registros.index') }}"
                            class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-100 text-gray-700 text-sm font-semibold rounded-xl hover:bg-gray-200 hover:shadow-md transition-all duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Limpiar filtros
                            </a>
                        @endif

                        <!-- Indicador de resultados -->
                        @if(isset($registros) && $registros->total() > 0)
                            <div class="ml-auto flex items-center gap-2 text-xs text-gray-500 bg-gray-50 px-3 py-1.5 rounded-full">
                                <svg class="w-3.5 h-3.5 text-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>{{ $registros->total() }} resultado(s) encontrado(s)</span>
                            </div>
                        @endif
                    </div>
                </form>
            </div>
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
                        <p class="text-xs text-gray-400">
                            {{ $registros->total() }} registro{{ $registros->total() !== 1 ? 's' : '' }} encontrado{{ $registros->total() !== 1 ? 's' : '' }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3">

                    {{-- Selector por página --}}
                    <form method="GET" action="{{ route('registros.index') }}">
                        @foreach(request()->only(['titulo', 'codigo', 'empresa', 'proyecto', 'fecha_desde', 'fecha_hasta']) as $key => $value)
                            @if($value)
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endif
                        @endforeach
                        <div class="flex items-center gap-2">
                            <span class="text-xs text-gray-400 whitespace-nowrap">Mostrar</span>
                            <select name="per_page"
                                    onchange="this.form.submit()"
                                    class="px-2 py-1.5 text-xs border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-dark/20 focus:border-blue-dark bg-white text-gray-600 font-medium cursor-pointer">
                                @foreach([10, 25, 50, 100] as $n)
                                    <option value="{{ $n }}" {{ request('per_page', 10) == $n ? 'selected' : '' }}>
                                        {{ $n }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="text-xs text-gray-400 whitespace-nowrap">por página</span>
                        </div>
                    </form>

                    {{-- Botón Nuevo --}}
                    @if(Auth::user()->isAdmin() || Auth::user()->isTecnico())
                        <a href="{{ route('registros.create') }}"
                           class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-dark text-white text-xs font-semibold rounded-lg hover:bg-blue transition-colors duration-150 shadow-sm">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                            </svg>
                            Agregar Registro
                        </a>
                    @endif

                </div>
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
                                        <button type="button"
                                                @click="$dispatch('confirmar-eliminar', { 
                                                    action: '{{ route('registros.destroy', $registro->id) }}',
                                                    nombre: '{{ addslashes($registro->titulo_informe) }}'
                                                })"
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
{{-- ══ MODAL CONFIRMACIÓN ELIMINAR ══ --}}
<div x-data="{
        show: false,
        action: '',
        nombre: '',
        init() {
            window.addEventListener('confirmar-eliminar', e => {
                this.action = e.detail.action;
                this.nombre = e.detail.nombre;
                this.show = true;
            });
        }
     }"
     x-show="show"
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-150"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @keydown.escape.window="show = false"
     class="fixed inset-0 z-50 flex items-center justify-center p-4"
     style="display: none;">

    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="show = false"></div>

    {{-- Panel --}}
    <div x-show="show"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95 translate-y-2"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
         x-transition:leave-end="opacity-0 scale-95 translate-y-2"
         class="relative bg-white rounded-2xl shadow-xl border border-gray-100 w-full max-w-md p-6">

        {{-- Ícono --}}
        <div class="flex items-center justify-center w-14 h-14 rounded-2xl bg-red/10 mx-auto mb-4">
            <svg class="w-7 h-7 text-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
        </div>

        {{-- Texto --}}
        <div class="text-center mb-6">
            <h3 class="text-base font-bold text-blue-dark mb-1">¿Eliminar registro?</h3>
            <p class="text-sm text-gray-500">Estás a punto de eliminar</p>
            <p class="text-sm font-semibold text-blue-dark mt-1 px-4 truncate" x-text="nombre"></p>
            <p class="text-xs text-gray-400 mt-2">Esta acción no se puede deshacer.</p>
        </div>

        {{-- Botones --}}
        <div class="flex items-center gap-3">
            <button type="button"
                    @click="show = false"
                    class="flex-1 px-4 py-2.5 rounded-xl border border-gray-200 text-gray-600 text-sm font-semibold hover:bg-gray-50 transition-colors duration-150">
                Cancelar
            </button>

            {{-- Form oculto que hace el DELETE --}}
            <form :action="action" method="POST" class="flex-1" id="form-eliminar">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="w-full px-4 py-2.5 rounded-xl bg-red text-white text-sm font-semibold hover:bg-red/90 transition-colors duration-150 shadow-sm">
                    Sí, eliminar
                </button>
            </form>
        </div>

    </div>
</div>
</x-app-layout>
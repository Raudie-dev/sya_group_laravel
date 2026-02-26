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

        {{-- Bienvenida --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-dark to-blue flex items-center justify-center flex-shrink-0 shadow-md">
                <span class="text-white text-xl font-bold uppercase">{{ substr(Auth::user()->name, 0, 1) }}</span>
            </div>
            <div class="flex-1 min-w-0">
                <h3 class="font-bold text-blue-dark">¡Hola, {{ Auth::user()->name }}! 👋</h3>
                <p class="text-sm text-gray-400 mt-0.5 truncate">Aquí tienes un resumen de tus acciones disponibles.</p>
            </div>
            <div class="hidden sm:flex items-center gap-1.5 text-xs text-gray-400 bg-green/5 border border-green/20 px-3 py-1.5 rounded-lg flex-shrink-0">
                <span class="w-2 h-2 rounded-full bg-green animate-pulse"></span>
                Sesión activa
            </div>
        </div>

        {{-- Acciones rápidas --}}
        @if(Auth::user()->isAdmin() || Auth::user()->isTecnico())
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-3">Acciones rápidas</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 {{ Auth::user()->isAdmin() ? 'lg:grid-cols-3' : '' }} gap-3 sm:gap-4">

                    {{-- Agregar Registro --}}
                    <a href="{{ route('registros.create') }}"
                       class="group relative bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-orange/30 transition-all duration-200 p-5 flex items-center gap-4 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-orange/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                        <div class="w-11 h-11 rounded-xl bg-orange/10 group-hover:bg-orange/20 flex items-center justify-center flex-shrink-0 transition-colors duration-200">
                            <svg class="w-5 h-5 text-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0 relative z-10">
                            <p class="font-semibold text-blue-dark text-sm">Agregar Registro</p>
                            <p class="text-xs text-gray-400 mt-0.5">Crear un nuevo registro</p>
                        </div>
                        <svg class="w-4 h-4 text-gray-200 group-hover:text-orange group-hover:translate-x-0.5 transition-all duration-150 flex-shrink-0 relative z-10"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>

                    @if(Auth::user()->isAdmin())
                        {{-- Gestión de Usuarios --}}
                        <a href="{{ route('usuarios.index') }}"
                           class="group relative bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-green/30 transition-all duration-200 p-5 flex items-center gap-4 overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-br from-green/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                            <div class="w-11 h-11 rounded-xl bg-green/10 group-hover:bg-green/20 flex items-center justify-center flex-shrink-0 transition-colors duration-200">
                                <svg class="w-5 h-5 text-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0 relative z-10">
                                <p class="font-semibold text-blue-dark text-sm">Gestión de Usuarios</p>
                                <p class="text-xs text-gray-400 mt-0.5">Administrar cuentas y permisos</p>
                            </div>
                            <svg class="w-4 h-4 text-gray-200 group-hover:text-green group-hover:translate-x-0.5 transition-all duration-150 flex-shrink-0 relative z-10"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    @endif

                    {{-- Mi Perfil --}}
                    <a href="{{ route('profile.edit') }}"
                       class="group relative bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-blue/30 transition-all duration-200 p-5 flex items-center gap-4 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                        <div class="w-11 h-11 rounded-xl bg-blue/10 group-hover:bg-blue/20 flex items-center justify-center flex-shrink-0 transition-colors duration-200">
                            <svg class="w-5 h-5 text-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0 relative z-10">
                            <p class="font-semibold text-blue-dark text-sm">Mi Perfil</p>
                            <p class="text-xs text-gray-400 mt-0.5">Editar información personal</p>
                        </div>
                        <svg class="w-4 h-4 text-gray-200 group-hover:text-blue group-hover:translate-x-0.5 transition-all duration-150 flex-shrink-0 relative z-10"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        @endif

    </div>
</x-app-layout>
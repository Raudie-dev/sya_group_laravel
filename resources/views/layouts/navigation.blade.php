{{-- navigation.blade.php --}}
{{-- Sidebar: oculto en móvil, visible en lg+ --}}
<aside
    x-data="{ open: $store.sidebar.open }"
    x-bind:class="$store.sidebar.open ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-40 w-64 flex flex-col bg-blue-dark transition-transform duration-300 ease-in-out
           lg:translate-x-0 lg:static lg:inset-auto lg:z-auto"
>
    {{-- Logo --}}
    <div class="flex items-center gap-3 px-5 py-5 border-b border-white/10 flex-shrink-0">
        <div class="w-9 h-9 bg-orange rounded-xl flex items-center justify-center shadow-lg flex-shrink-0">
            <span class="text-white font-bold text-base">S</span>
        </div>
        <div class="leading-tight">
            <span class="text-white font-bold text-lg">SyA</span>
            <span class="text-white/50 font-light text-lg"> Group</span>
        </div>
        {{-- Botón cerrar en móvil --}}
        <button
            @click="$store.sidebar.close()"
            class="ml-auto lg:hidden text-white/40 hover:text-white transition-colors focus:outline-none"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    {{-- Nav links --}}
    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
        <p class="px-3 mb-2 text-xs font-semibold uppercase tracking-widest text-white/30">Menú</p>

        {{-- Inicio --}}
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-150 group
                  {{ request()->routeIs('dashboard')
                      ? 'bg-white/15 text-white shadow-sm'
                      : 'text-white/60 hover:bg-white/8 hover:text-white' }}">
            <span class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-lg transition-colors
                         {{ request()->routeIs('dashboard') ? 'bg-white/15' : 'bg-white/5 group-hover:bg-white/10' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
            </span>
            Inicio
            @if(request()->routeIs('dashboard'))
                <span class="ml-auto w-1.5 h-1.5 bg-orange rounded-full"></span>
            @endif
        </a>

        @if(Auth::user()->isAdmin() || Auth::user()->isTecnico())
            {{-- Agregar Registro --}}
            <a href="{{ route('registros.create') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-150 group
                      {{ request()->routeIs('registros.create')
                          ? 'bg-orange/20 text-orange'
                          : 'text-white/60 hover:bg-white/8 hover:text-white' }}">
                <span class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-lg transition-colors
                             {{ request()->routeIs('registros.create') ? 'bg-orange/20' : 'bg-white/5 group-hover:bg-white/10' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </span>
                Agregar Registro
                @if(request()->routeIs('registros.create'))
                    <span class="ml-auto w-1.5 h-1.5 bg-orange rounded-full"></span>
                @endif
            </a>
        @endif

        @if(Auth::user()->isAdmin())
            {{-- Gestión de Usuarios --}}
            <a href="{{ route('usuarios.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-150 group
                      {{ request()->routeIs('usuarios.index')
                          ? 'bg-green/20 text-green'
                          : 'text-white/60 hover:bg-white/8 hover:text-white' }}">
                <span class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-lg transition-colors
                             {{ request()->routeIs('usuarios.index') ? 'bg-green/20' : 'bg-white/5 group-hover:bg-white/10' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </span>
                Gestión de Usuarios
                @if(request()->routeIs('usuarios.index'))
                    <span class="ml-auto w-1.5 h-1.5 bg-green rounded-full"></span>
                @endif
            </a>
        @endif
    </nav>

    {{-- Usuario + acciones abajo --}}
    <div class="flex-shrink-0 border-t border-white/10 p-3">
        {{-- Perfil --}}
        <a href="{{ route('profile.edit') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-white/8 transition-colors group mb-1">
            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue to-blue-light flex items-center justify-center flex-shrink-0 shadow">
                <span class="text-white text-xs font-bold uppercase">{{ substr(Auth::user()->name, 0, 1) }}</span>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-white/40 truncate">
                    @if(Auth::user()->isAdmin()) Administrador
                    @elseif(Auth::user()->isTecnico()) Técnico
                    @else Usuario
                    @endif
                </p>
            </div>
            <svg class="w-3.5 h-3.5 text-white/30 group-hover:text-white/60 transition-colors flex-shrink-0"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>

        {{-- Cerrar sesión --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/50 hover:bg-red/10 hover:text-red transition-all duration-150 text-sm font-medium">
                <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-white/5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </span>
                Cerrar sesión
            </button>
        </form>
    </div>
</aside>

{{-- Overlay oscuro en móvil al abrir sidebar --}}
<div
    x-data
    x-show="$store.sidebar.open"
    x-transition:enter="transition-opacity duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    @click="$store.sidebar.close()"
    class="fixed inset-0 z-30 bg-black/50 backdrop-blur-sm lg:hidden"
    style="display: none;"
></div>
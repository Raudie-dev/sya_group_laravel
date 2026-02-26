<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SyA Group') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">

<div
    x-data
    x-init="
        Alpine.store('sidebar', {
            open: false,
            toggle() { this.open = !this.open },
            close() { this.open = false }
        })
    "
    class="flex h-screen overflow-hidden"
>
    {{-- ===== SIDEBAR ===== --}}
    @include('layouts.navigation')

    {{-- ===== CONTENIDO PRINCIPAL ===== --}}
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

        {{-- Topbar móvil --}}
        <header class="lg:hidden flex items-center gap-3 px-4 py-3 bg-blue-dark border-b border-white/10 flex-shrink-0">
            {{-- Botón hamburguesa --}}
            <button
                @click="$store.sidebar.toggle()"
                class="w-9 h-9 flex items-center justify-center rounded-xl bg-white/10 hover:bg-white/20 text-white transition-colors focus:outline-none"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            {{-- Logo centrado en móvil --}}
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                <div class="w-7 h-7 bg-orange rounded-lg flex items-center justify-center shadow">
                    <span class="text-white font-bold text-xs">S</span>
                </div>
                <span class="text-white font-bold text-base">SyA <span class="font-light opacity-60">Group</span></span>
            </a>

            {{-- Avatar rápido a la derecha en móvil --}}
            <a href="{{ route('profile.edit') }}" class="ml-auto">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue to-blue-light flex items-center justify-center shadow">
                    <span class="text-white text-sm font-bold uppercase">{{ substr(Auth::user()->name, 0, 1) }}</span>
                </div>
            </a>
        </header>

        {{-- Topbar desktop: solo si hay header de página --}}
        @isset($header)
            <div class="hidden lg:block flex-shrink-0 bg-white border-b border-gray-100 shadow-sm">
                <div class="px-6 lg:px-8 py-4">
                    {{ $header }}
                </div>
            </div>
            {{-- Versión móvil del header de página --}}
            <div class="lg:hidden flex-shrink-0 bg-white border-b border-gray-100 px-4 py-4">
                {{ $header }}
            </div>
        @endisset

        {{-- Contenido --}}
        <main class="flex-1 overflow-y-auto">
            {{ $slot }}
        </main>

        {{-- Footer --}}
        <footer class="flex-shrink-0 bg-white border-t border-gray-100 py-3 px-6">
            <p class="text-center text-xs text-gray-400">
                &copy; {{ date('Y') }} SyA Group. Todos los derechos reservados.
            </p>
        </footer>
    </div>
</div>
<!-- Toast -->
<div
    x-data="toastHandler()"
    x-init="init()"
    @notify.window="showMessage($event.detail)"
    class="fixed top-5 right-5 z-50 space-y-2 w-80 max-w-full"
>
    <template x-for="(toast, index) in toasts" :key="toast.id">
        <div
            x-show="toast.show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-x-8 scale-95"
            x-transition:enter-end="opacity-100 translate-x-0 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-x-0 scale-100"
            x-transition:leave-end="opacity-0 translate-x-8 scale-95"
            class="px-4 py-3 rounded-lg shadow-lg text-white cursor-pointer flex items-start gap-2 backdrop-blur-sm"
            :class="{
                'bg-success/90': toast.type === 'success',
                'bg-error/90': toast.type === 'error',
                'bg-warning/90': toast.type === 'warning',
                'bg-info/90': toast.type === 'info'
            }"
            @click="removeToast(toast.id)"
        >
            <!-- Iconos según el tipo de mensaje -->
            <template x-if="toast.type === 'success'">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </template>
            
            <template x-if="toast.type === 'error'">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </template>
            
            <template x-if="toast.type === 'warning'">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </template>
            
            <template x-if="toast.type === 'info'">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </template>
            
            <span class="flex-1 text-sm" x-text="toast.message"></span>
            
            <!-- Botón de cierre con animación hover -->
            <button class="opacity-70 hover:opacity-100 transition-opacity duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </template>
</div>

<script>
    function toastHandler() {
        return {
            toasts: [],
            init() {
                setTimeout(() => {
                    @if(session('success'))
                        this.showMessage({ message: '{{ session('success') }}', type: 'success' });
                    @endif
                    @if(session('error'))
                        this.showMessage({ message: '{{ session('error') }}', type: 'error' });
                    @endif
                    @if(session('warning'))
                        this.showMessage({ message: '{{ session('warning') }}', type: 'warning' });
                    @endif
                    @if(session('info'))
                        this.showMessage({ message: '{{ session('info') }}', type: 'info' });
                    @endif
                }, 100);
            },
            showMessage(detail) {
                // Evitar duplicados
                const existing = this.toasts.find(t => t.message === detail.message && t.type === detail.type);
                if (existing) return;
                
                const id = Date.now() + Math.random();
                this.toasts.push({
                    id: id,
                    message: detail.message,
                    type: detail.type || 'info',
                    show: true
                });
                
                // Auto-cerrar después de 4 segundos
                setTimeout(() => {
                    this.removeToast(id);
                }, 4000);
            },
            removeToast(id) {
                // Encontrar el toast y animar su salida
                const toast = this.toasts.find(t => t.id === id);
                if (toast) {
                    toast.show = false;
                    // Eliminar del array después de la animación
                    setTimeout(() => {
                        this.toasts = this.toasts.filter(t => t.id !== id);
                    }, 200); // Coincide con la duración de la animación de salida
                }
            }
        }
    }
</script>
</body>
</html>
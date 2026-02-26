<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="SyA Group - Soluciones profesionales">

    <title>{{ config('app.name', 'SyA Group') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen flex bg-gradient-to-br from-blue-dark via-blue to-blue-light">

        <!-- Panel izquierdo (solo visible en pantallas medianas+) -->
        <div class="hidden lg:flex lg:w-1/2 flex-col justify-between p-12 relative overflow-hidden">
            <!-- Círculos decorativos de fondo -->
            <div class="absolute -top-20 -left-20 w-96 h-96 bg-white/5 rounded-full"></div>
            <div class="absolute bottom-10 -right-20 w-80 h-80 bg-orange/10 rounded-full"></div>
            <div class="absolute top-1/2 left-1/3 w-48 h-48 bg-white/5 rounded-full"></div>

            <!-- Logo -->
            <div class="relative z-10">
                <a href="/" class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-orange rounded-xl flex items-center justify-center shadow-lg">
                        <span class="text-white font-bold text-lg">S</span>
                    </div>
                    <div>
                        <span class="text-2xl font-bold text-white">SyA</span>
                        <span class="text-2xl font-light text-white/70"> Group</span>
                    </div>
                </a>
            </div>

            <!-- Texto central -->
            <div class="relative z-10 space-y-6">
                <h1 class="text-4xl font-bold text-white leading-tight">
                    Bienvenido a tu<br>
                    <span class="text-orange">plataforma</span> de gestión
                </h1>
                <p class="text-white/70 text-lg leading-relaxed max-w-sm">
                    Accede a todas las herramientas y recursos que SyA Group tiene para ti de forma rápida y segura.
                </p>

                <!-- Badges de características -->
                <div class="flex flex-col space-y-3 pt-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-green/20 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span class="text-white/80 text-sm">Acceso seguro y cifrado</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-orange/20 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <span class="text-white/80 text-sm">Gestión rápida e intuitiva</span>
                    </div>
                    {{--  
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-blue-light/20 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <span class="text-white/80 text-sm">Soporte dedicado 24/7</span>
                    </div>
                    --}}
                </div>
            </div>

            <!-- Footer panel izquierdo -->
            <div class="relative z-10">
                <p class="text-white/40 text-sm">&copy; {{ date('Y') }} SyA Group. Todos los derechos reservados.</p>
            </div>
        </div>

        <!-- Panel derecho — formulario -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-6 sm:p-10">
            <!-- Logo mobile -->
            <div class="lg:hidden mb-8">
                <a href="/" class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-orange rounded-xl flex items-center justify-center shadow-lg">
                        <span class="text-white font-bold text-lg">S</span>
                    </div>
                    <div>
                        <span class="text-2xl font-bold text-white">SyA</span>
                        <span class="text-2xl font-light text-white/70"> Group</span>
                    </div>
                </a>
            </div>

            <!-- Card -->
            <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl p-8">
                {{ $slot }}
            </div>

            <!-- Footer mobile -->
            <p class="lg:hidden text-white/40 text-xs mt-6 text-center">
                &copy; {{ date('Y') }} SyA Group. Todos los derechos reservados.
            </p>
        </div>

    </div>
</body>
</html>
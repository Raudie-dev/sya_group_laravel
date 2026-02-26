<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SyA Group - Innovación y Tecnología</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-800">

    <!-- Navbar -->
    <nav class="bg-blue text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-2">
                    <!-- Logo placeholder -->
                    <span class="text-2xl font-bold text-orange">SyA</span>
                    <span class="text-xl font-light">Group</span>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="#" class="hover:text-orange transition">Inicio</a>
                    <a href="#" class="hover:text-orange transition">Servicios</a>
                    <a href="#" class="hover:text-orange transition">Nosotros</a>
                    <a href="#" class="hover:text-orange transition">Contacto</a>
                </div>
                <div class="flex space-x-3">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="bg-orange hover:bg-orange-dark text-white px-4 py-2 rounded-lg text-sm font-medium transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-white hover:text-orange transition">Iniciar sesión</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-orange hover:bg-orange-dark text-white px-4 py-2 rounded-lg text-sm font-medium transition">Registrarse</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-dark to-blue text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-28">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">
                        Bienvenido a <span class="text-orange">SyA Group</span>
                    </h1>
                    <p class="text-xl mb-8 text-blue-light">
                        Soluciones tecnológicas innovadoras para impulsar tu negocio al siguiente nivel.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="#" class="bg-orange hover:bg-orange-dark text-white px-6 py-3 rounded-lg font-semibold transition shadow-lg">
                            Descubre nuestros servicios
                        </a>
                        <a href="#" class="border-2 border-white hover:bg-white hover:text-blue-dark text-white px-6 py-3 rounded-lg font-semibold transition">
                            Contactar
                        </a>
                    </div>
                </div>
                <div class="hidden md:block">
                    <!-- Ilustración o imagen representativa -->
                    <div class="bg-blue-light p-8 rounded-lg text-center">
                        <svg class="w-32 h-32 mx-auto text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9V8h2v8zm4 0h-2V8h2v8z"/>
                        </svg>
                        <p class="mt-4 text-white font-medium">Innovación + Tecnología</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Servicios -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12 text-blue-dark">Nuestros Servicios</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Servicio 1 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition border-t-4 border-orange">
                    <div class="text-orange text-4xl mb-4">🚀</div>
                    <h3 class="text-xl font-bold mb-2 text-blue-dark">Desarrollo Web</h3>
                    <p class="text-gray-600">Creamos sitios web y aplicaciones a medida, adaptadas a tus necesidades.</p>
                </div>
                <!-- Servicio 2 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition border-t-4 border-green">
                    <div class="text-green text-4xl mb-4">📱</div>
                    <h3 class="text-xl font-bold mb-2 text-blue-dark">Aplicaciones Móviles</h3>
                    <p class="text-gray-600">Desarrollamos apps nativas e híbridas para iOS y Android.</p>
                </div>
                <!-- Servicio 3 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition border-t-4 border-blue">
                    <div class="text-blue text-4xl mb-4">☁️</div>
                    <h3 class="text-xl font-bold mb-2 text-blue-dark">Cloud & Infraestructura</h3>
                    <p class="text-gray-600">Soluciones en la nube, escalables y seguras para tu empresa.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Acerca de -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold mb-4 text-blue-dark">Sobre SyA Group</h2>
                    <p class="text-gray-600 mb-4">
                        En <strong class="text-orange">SyA Group</strong> somos un equipo apasionado por la tecnología y la innovación. Desde 2015, ayudamos a empresas de todos los tamaños a transformar digitalmente sus procesos y alcanzar sus objetivos.
                    </p>
                    <p class="text-gray-600 mb-6">
                        Nuestra filosofía se basa en la cercanía con el cliente, la calidad del código y la creatividad en cada proyecto.
                    </p>
                    <div class="flex items-center space-x-4">
                        <span class="bg-blue-light text-white px-3 py-1 rounded-full text-sm">+50 proyectos</span>
                        <span class="bg-green-light text-white px-3 py-1 rounded-full text-sm">10 expertos</span>
                        <span class="bg-orange text-white px-3 py-1 rounded-full text-sm">100% satisfacción</span>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-blue p-4 rounded-lg text-white text-center">
                        <div class="text-3xl font-bold">+5</div>
                        <div class="text-sm">años de experiencia</div>
                    </div>
                    <div class="bg-orange p-4 rounded-lg text-white text-center">
                        <div class="text-3xl font-bold">+80</div>
                        <div class="text-sm">clientes felices</div>
                    </div>
                    <div class="bg-green p-4 rounded-lg text-white text-center">
                        <div class="text-3xl font-bold">+120</div>
                        <div class="text-sm">proyectos entregados</div>
                    </div>
                    <div class="bg-blue-dark p-4 rounded-lg text-white text-center">
                        <div class="text-3xl font-bold">24/7</div>
                        <div class="text-sm">soporte técnico</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Llamada a la acción (CTA) -->
    <section class="bg-blue-dark text-white py-16">
        <div class="max-w-4xl mx-auto text-center px-4">
            <h2 class="text-3xl font-bold mb-4">¿Listo para comenzar tu proyecto?</h2>
            <p class="text-xl mb-8 text-blue-light">Contacta con nosotros hoy mismo y te asesoraremos sin compromiso.</p>
            <a href="#" class="bg-orange hover:bg-orange-dark text-white px-8 py-4 rounded-lg font-bold text-lg transition shadow-xl inline-block">
                Solicitar información
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center space-x-2 mb-4 md:mb-0">
                    <span class="text-2xl font-bold text-orange">SyA</span>
                    <span class="text-xl font-light">Group</span>
                </div>
                <div class="flex space-x-6">
                    <a href="#" class="hover:text-orange transition">Aviso legal</a>
                    <a href="#" class="hover:text-orange transition">Política de privacidad</a>
                    <a href="#" class="hover:text-orange transition">Contacto</a>
                </div>
            </div>
            <div class="text-center text-sm mt-4 border-t border-gray-800 pt-4">
                &copy; {{ date('Y') }} SyA Group. Todos los derechos reservados.
            </div>
        </div>
    </footer>

</body>
</html>
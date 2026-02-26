<x-guest-layout>
    <!-- Encabezado -->
    <div class="mb-8 text-center">
        <div class="inline-flex items-center justify-center w-14 h-14 bg-orange/10 rounded-2xl mb-4">
            <svg class="w-7 h-7 text-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
            </svg>
        </div>
        <h2 class="text-2xl font-bold text-blue-dark">Crear cuenta</h2>
        <p class="text-sm text-blue mt-1">Regístrate para acceder a todas las funciones</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Nombre -->
        <div class="group">
            <label for="name" class="block text-sm font-medium text-blue-dark mb-1.5 transition-colors duration-200 group-focus-within:text-orange">
                Nombre completo
            </label>
            <div class="relative flex items-center rounded-xl border border-gray-200 bg-gray-50
                        transition-all duration-200
                        group-focus-within:border-orange
                        group-focus-within:bg-white
                        group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)]
                        hover:border-blue-light/60">
                <div class="pl-3 flex-shrink-0">
                    <svg class="w-4 h-4 text-gray-400 transition-colors duration-200 group-focus-within:text-orange"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <input
                    id="name" type="text" name="name"
                    value="{{ old('name') }}"
                    required autofocus autocomplete="name"
                    placeholder="Ej. Juan Pérez"
                    class="w-full bg-transparent border-none px-3 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0"
                />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-1.5 text-xs text-red" />
        </div>

        <!-- Email -->
        <div class="group">
            <label for="email" class="block text-sm font-medium text-blue-dark mb-1.5 transition-colors duration-200 group-focus-within:text-orange">
                Correo electrónico
            </label>
            <div class="relative flex items-center rounded-xl border border-gray-200 bg-gray-50
                        transition-all duration-200
                        group-focus-within:border-orange
                        group-focus-within:bg-white
                        group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)]
                        hover:border-blue-light/60">
                <div class="pl-3 flex-shrink-0">
                    <svg class="w-4 h-4 text-gray-400 transition-colors duration-200 group-focus-within:text-orange"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <input
                    id="email" type="email" name="email"
                    value="{{ old('email') }}"
                    required autocomplete="username"
                    placeholder="tu@ejemplo.com"
                    class="w-full bg-transparent border-none px-3 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0"
                />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs text-red" />
        </div>

        <!-- Contraseña -->
        <div class="group">
            <label for="password" class="block text-sm font-medium text-blue-dark mb-1.5 transition-colors duration-200 group-focus-within:text-orange">
                Contraseña
            </label>
            <div class="relative flex items-center rounded-xl border border-gray-200 bg-gray-50
                        transition-all duration-200
                        group-focus-within:border-orange
                        group-focus-within:bg-white
                        group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)]
                        hover:border-blue-light/60">
                <div class="pl-3 flex-shrink-0">
                    <svg class="w-4 h-4 text-gray-400 transition-colors duration-200 group-focus-within:text-orange"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <input
                    id="password" type="password" name="password"
                    required autocomplete="new-password"
                    placeholder="Mínimo 8 caracteres"
                    class="w-full bg-transparent border-none px-3 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0"
                />
                <button type="button" onclick="togglePassword('password', this)"
                        class="pr-3 flex-shrink-0 text-gray-400 hover:text-orange transition-colors focus:outline-none"
                        tabindex="-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-xs text-red" />
        </div>

        <!-- Confirmar contraseña -->
        <div class="group">
            <label for="password_confirmation" class="block text-sm font-medium text-blue-dark mb-1.5 transition-colors duration-200 group-focus-within:text-orange">
                Confirmar contraseña
            </label>
            <div class="relative flex items-center rounded-xl border border-gray-200 bg-gray-50
                        transition-all duration-200
                        group-focus-within:border-orange
                        group-focus-within:bg-white
                        group-focus-within:shadow-[0_0_0_3px_rgba(255,140,66,0.15)]
                        hover:border-blue-light/60">
                <div class="pl-3 flex-shrink-0">
                    <svg class="w-4 h-4 text-gray-400 transition-colors duration-200 group-focus-within:text-orange"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <input
                    id="password_confirmation" type="password" name="password_confirmation"
                    required autocomplete="new-password"
                    placeholder="Repite tu contraseña"
                    class="w-full bg-transparent border-none px-3 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0"
                />
                <button type="button" onclick="togglePassword('password_confirmation', this)"
                        class="pr-3 flex-shrink-0 text-gray-400 hover:text-orange transition-colors focus:outline-none"
                        tabindex="-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5 text-xs text-red" />
        </div>

        <!-- Submit -->
        <button type="submit"
                class="w-full flex items-center justify-center px-4 py-3 bg-orange hover:bg-orange-dark text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all duration-200 text-sm mt-2">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
            </svg>
            Crear mi cuenta
        </button>
    </form>

    <!-- Divisor -->
    <div class="relative my-6">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-100"></div>
        </div>
        <div class="relative flex justify-center">
            <span class="px-3 bg-white text-xs text-gray-400">¿Ya tienes cuenta?</span>
        </div>
    </div>

    <a href="{{ route('login') }}"
       class="w-full flex items-center justify-center px-4 py-3 border-2 border-blue-dark/20 hover:border-orange text-blue-dark hover:text-orange font-semibold rounded-xl transition-all duration-200 text-sm">
        Iniciar sesión
    </a>

    <script>
        function togglePassword(fieldId, btn) {
            const input = document.getElementById(fieldId);
            input.type = input.type === 'password' ? 'text' : 'password';
            btn.classList.toggle('text-orange');
        }
    </script>
</x-guest-layout>
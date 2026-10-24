<div class="min-h-screen flex flex-col justify-center items-center bg-[#d99b00]">
    <script src="https://cdn.tailwindcss.com"></script>
    <div class="relative w-full max-w-sm px-6 pt-10 pb-8 bg-white shadow-md rounded-3xl mt-12">
        
        <!-- Ícono superior circular -->
        <div class="absolute -top-16 left-1/2 transform -translate-x-1/2 bg-white rounded-full p-4 border-4 border-[#d99b00]">
            <svg class="w-16 h-16 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
        </div>

        <!-- Título -->
        <h2 class="text-center text-xl font-medium text-gray-700 mt-4 mb-6">
            Inicio de sesión
        </h2>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Usuario / Email -->
            <div class="mb-4">
                <x-input id="email" 
                         class="block w-full bg-gray-200 border-none rounded-xl py-3 px-4 text-gray-700 placeholder-gray-500 focus:ring-0 focus:bg-gray-300" 
                         type="email" 
                         name="email" 
                         :value="old('email')" 
                         required 
                         autofocus 
                         autocomplete="username" 
                         placeholder="Usuario" />
            </div>

            <!-- Contraseña -->
            <div class="mb-4">
                <x-input id="password" 
                         class="block w-full bg-gray-200 border-none rounded-xl py-3 px-4 text-gray-700 placeholder-gray-500 focus:ring-0 focus:bg-gray-300" 
                         type="password" 
                         name="password" 
                         required 
                         autocomplete="current-password" 
                         placeholder="Contraseña" />
            </div>

            <!-- Recuérdame y Recuperar Contraseña -->
            <div class="flex items-center justify-between mb-6 text-sm">
                <label for="remember_me" class="flex items-center cursor-pointer">
                    <x-checkbox id="remember_me" name="remember" class="w-5 h-5 bg-gray-300 border-none rounded text-yellow-500 focus:ring-0" />
                    <span class="ms-2 text-gray-600 font-medium">{{ __('Recuérdame') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="underline text-xs text-gray-500 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('¿Olvidaste tu contraseña?') }}
                    </a>
                @endif
            </div>

            <!-- Botones de Acción -->
            <div class="flex items-center justify-between gap-4">
                <button type="submit" class="w-1/2 bg-[#ffcc00] hover:bg-yellow-500 text-gray-800 font-medium py-2.5 px-4 rounded-xl text-center transition">
                    Entrar
                </button>

                <!-- Botón Cancelar (redirecciona a inicio) -->
                <a href="{{ url('/') }}" class="w-1/2 bg-[#ff2626] hover:bg-red-600 text-white font-medium py-2.5 px-4 rounded-xl text-center transition text-sm flex items-center justify-center">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
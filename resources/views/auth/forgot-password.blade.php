<div class="min-h-screen flex flex-col justify-center items-center bg-[#d99b00] py-12">
    <script src="https://cdn.tailwindcss.com"></script>
    <div class="relative w-full max-w-sm px-6 pt-10 pb-8 bg-white shadow-md rounded-3xl mt-12">
        
        <!-- Ícono superior circular -->
        <div class="absolute -top-16 left-1/2 transform -translate-x-1/2 bg-white rounded-full p-4 border-4 border-[#d99b00]">
            <svg class="w-16 h-16 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 0121 9z"></path>
            </svg>
        </div>

        <!-- Título -->
        <h2 class="text-center text-xl font-medium text-gray-700 mt-4 mb-4">
            Recuperar contraseña
        </h2>

        <!-- Mensaje explicativo -->
        <div class="mb-6 text-xs text-center text-gray-600 leading-relaxed px-2">
            {{ __('¿Olvidaste tu contraseña? No hay problema. Ingresa tu correo electrónico y te enviaremos un enlace para restablecerla.') }}
        </div>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600 text-center">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email -->
            <div class="mb-6">
                <input id="email" 
                       class="block w-full bg-gray-200 border-none rounded-xl py-3 px-4 text-gray-700 placeholder-gray-500 focus:ring-2 focus:ring-yellow-500 focus:bg-gray-100 transition" 
                       type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required 
                       autofocus 
                       autocomplete="username" 
                       placeholder="Correo electrónico" />
            </div>

            <!-- Botones de Acción -->
            <div class="flex items-center justify-between gap-4">
                <button type="submit" class="w-1/2 bg-[#ffcc00] hover:bg-yellow-500 text-gray-800 font-medium py-2.5 px-2 rounded-xl text-center transition text-xs sm:text-sm">
                    Enviar enlace
                </button>

                <a href="{{ route('login') }}" class="w-1/2 bg-[#ff2626] hover:bg-red-600 text-white font-medium py-2.5 px-2 rounded-xl text-center transition text-xs sm:text-sm flex items-center justify-center">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
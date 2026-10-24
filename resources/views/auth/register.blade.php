<div class="min-h-screen flex flex-col justify-center items-center bg-[#d99b00] py-12">
    <script src="https://cdn.tailwindcss.com"></script>
    <div class="relative w-full max-w-sm px-6 pt-10 pb-8 bg-white shadow-md rounded-3xl mt-12">
        
        <!-- Ícono superior circular -->
        <div class="absolute -top-16 left-1/2 transform -translate-x-1/2 bg-white rounded-full p-4 border-4 border-[#d99b00]">
            <svg class="w-16 h-16 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
            </svg>
        </div>

        <!-- Título -->
        <h2 class="text-center text-xl font-medium text-gray-700 mt-4 mb-6">
            Registro
        </h2>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nombre -->
            <div class="mb-4">
                <input id="name" 
                       class="block w-full bg-gray-200 border-none rounded-xl py-3 px-4 text-gray-700 placeholder-gray-500 focus:ring-2 focus:ring-yellow-500 focus:bg-gray-100 transition" 
                       type="text" 
                       name="name" 
                       value="{{ old('name') }}" 
                       required 
                       autofocus 
                       autocomplete="name" 
                       placeholder="Nombre completo" />
            </div>

            <!-- Email -->
            <div class="mb-4">
                <input id="email" 
                       class="block w-full bg-gray-200 border-none rounded-xl py-3 px-4 text-gray-700 placeholder-gray-500 focus:ring-2 focus:ring-yellow-500 focus:bg-gray-100 transition" 
                       type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required 
                       autocomplete="username" 
                       placeholder="Correo electrónico" />
            </div>

            <!-- Contraseña -->
            <div class="mb-4 relative" x-data="{ showPassword: false }">
                <input id="password" 
                       :type="showPassword ? 'text' : 'password'" 
                       name="password" 
                       required 
                       autocomplete="new-password" 
                       placeholder="Contraseña" 
                       class="block w-full bg-gray-200 border-none rounded-xl py-3 pl-4 pr-12 text-gray-700 placeholder-gray-500 focus:ring-2 focus:ring-yellow-500 focus:bg-gray-100 transition" />

                <button type="button" 
                        @click="showPassword = !showPassword" 
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700 focus:outline-none">
                    <template x-if="!showPassword">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-7 0-10-7-10-7a19.16 19.16 0 014.13-5.225m3.75-2.222A9.97 9.97 0 0112 4c7 0 10 7 10 7a19.26 19.26 0 01-2.923 3.821M15 12a3 3 0 11-6 0 3 3 0 016 0zM3 3l18 18"></path>
                        </svg>
                    </template>
                    <template x-if="showPassword">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </template>
                </button>
            </div>

            <!-- Confirmar Contraseña -->
            <div class="mb-4 relative" x-data="{ showConfirmPassword: false }">
                <input id="password_confirmation" 
                       :type="showConfirmPassword ? 'text' : 'password'" 
                       name="password_confirmation" 
                       required 
                       autocomplete="new-password" 
                       placeholder="Confirmar contraseña" 
                       class="block w-full bg-gray-200 border-none rounded-xl py-3 pl-4 pr-12 text-gray-700 placeholder-gray-500 focus:ring-2 focus:ring-yellow-500 focus:bg-gray-100 transition" />

                <button type="button" 
                        @click="showConfirmPassword = !showConfirmPassword" 
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700 focus:outline-none">
                    <template x-if="!showConfirmPassword">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-7 0-10-7-10-7a19.16 19.16 0 014.13-5.225m3.75-2.222A9.97 9.97 0 0112 4c7 0 10 7 10 7a19.26 19.26 0 01-2.923 3.821M15 12a3 3 0 11-6 0 3 3 0 016 0zM3 3l18 18"></path>
                        </svg>
                    </template>
                    <template x-if="showConfirmPassword">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </template>
                </button>
            </div>

            <!-- Términos y Condiciones (si aplica) -->
            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mb-4">
                    <label for="terms" class="flex items-center cursor-pointer">
                        <x-checkbox name="terms" id="terms" required class="w-5 h-5 bg-gray-300 border-none rounded text-yellow-500 focus:ring-0" />
                        <div class="ms-2 text-xs text-gray-600">
                            {!! __('Acepto los :terms_of_service y la :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline hover:text-gray-900">'.__('Términos del Servicio').'</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline hover:text-gray-900">'.__('Política de Privacidad').'</a>',
                            ]) !!}
                        </div>
                    </label>
                </div>
            @endif

            <!-- Enlace "¿Ya tienes cuenta?" -->
            <div class="mb-6 text-center">
                <a class="underline text-xs text-gray-500 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('¿Ya estás registrado?') }}
                </a>
            </div>

            <!-- Botones de Acción -->
            <div class="flex items-center justify-between gap-4">
                <button type="submit" class="w-1/2 bg-[#ffcc00] hover:bg-yellow-500 text-gray-800 font-medium py-2.5 px-4 rounded-xl text-center transition">
                    Registrar
                </button>

                <a href="{{ url('/') }}" class="w-1/2 bg-[#ff2626] hover:bg-red-600 text-white font-medium py-2.5 px-4 rounded-xl text-center transition text-sm flex items-center justify-center">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
<x-guest-layout>
    <div class="min-h-screen bg-gray-50 flex flex-col items-center justify-center px-4 py-10">
        <div class="w-full max-w-md">
            {{-- Tarjeta principal centrada --}}
            <div class="bg-white border border-gray-300 rounded-3xl px-8 py-9 shadow-xs">

                {{-- Logo + Encabezado integrados --}}
                <div class="flex flex-col items-center text-center mb-7">
                    <img src="{{ asset('Images/Guantes.png') }}" alt="Logo Guantes Mena Tapia"
                        class="h-20 w-auto object-contain mb-4 rounded-xl">
                    <h1 class="text-xl font-bold text-gray-900 tracking-tight">
                        Configura tu contraseña
                    </h1>
                    <p class="text-xs text-gray-500 mt-1">
                        Activa tu cuenta o establece una nueva clave de acceso
                    </p>
                </div>

                <x-validation-errors class="mb-5 rounded-2xl bg-red-50 border border-red-200 p-4 text-xs text-red-700" />

                <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
                    @csrf

                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    {{-- Correo electrónico --}}
                    <div>
                        <label for="email" class="block text-sm font-bold text-gray-900 mb-1.5">
                            Correo electrónico:
                        </label>
                        <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}"
                            required autocomplete="username" readonly
                            class="w-full rounded-full border border-gray-300 bg-gray-100 px-5 py-2.5 text-sm text-gray-600 cursor-not-allowed focus:outline-none">
                    </div>

                    {{-- Nueva contraseña --}}
                    <div>
                        <label for="password" class="block text-sm font-bold text-gray-900 mb-1.5">
                            Nueva contraseña:
                        </label>
                        <input id="password" type="password" name="password" placeholder="Mínimo 8 caracteres" required
                            autofocus autocomplete="new-password"
                            class="w-full rounded-full border border-gray-400 bg-white px-5 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-amber-500 focus:ring-amber-500">
                    </div>

                    {{-- Confirmar contraseña --}}
                    <div>
                        <label for="password_confirmation" class="block text-sm font-bold text-gray-900 mb-1.5">
                            Confirmar contraseña:
                        </label>
                        <input id="password_confirmation" type="password" name="password_confirmation"
                            placeholder="Repite tu contraseña" required autocomplete="new-password"
                            class="w-full rounded-full border border-gray-400 bg-white px-5 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-amber-500 focus:ring-amber-500">
                    </div>

                    {{-- Botones simétricos al ancho del formulario --}}
                    <div class="pt-3 grid grid-cols-2 gap-3">
                        <a href="{{ route('login') }}"
                            class="w-full text-center py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white text-sm font-semibold transition">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="w-full py-2.5 rounded-xl bg-yellow-400 hover:bg-yellow-500 border border-gray-900 text-gray-950 text-sm font-bold transition cursor-pointer">
                            Guardar contraseña
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>

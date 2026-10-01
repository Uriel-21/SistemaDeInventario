<div class="min-h-screen bg-white font-['Raleway'] text-slate-950">
    <!-- Carga de Fuentes / CDN si aplica -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Nuevo header refactoizado --}}
    <livewire:layouts.header title="Edición de usuarios" subtitle="Modificación o correción de usuarios" />

    {{-- Nuevo menu refactorizado --}}
    <livewire:layouts.menu />

    <!-- Contenido Principal -->
    <main class="mx-3 my-5 sm:mx-6 sm:my-8 md:mx-10 lg:mx-12">
        <form wire:submit="save" class="mx-auto max-w-4xl space-y-6">

            <div class="rounded-3xl border border-slate-400 bg-white p-6 sm:p-10 shadow-sm">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                    <!-- Nombre (s) -->
                    <div class="space-y-1.5">
                        <label for="nombre" class="block text-sm font-bold text-slate-800">Nombre (s):</label>
                        <input type="text" id="nombre" wire:model="form.first_name" placeholder="José Jesús"
                            class="w-full rounded-2xl border border-slate-400 bg-white px-4 py-2 text-sm text-slate-900 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.4)] focus:border-amber-600 focus:outline-none focus:ring-1 focus:ring-amber-600">
                        @error('form.first_name')
                            <span class="text-xs text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Apellidos -->
                    <div class="space-y-1.5">
                        <label for="apellidos" class="block text-sm font-bold text-slate-800">Apellidos:</label>
                        <input type="text" id="apellidos" wire:model="form.last_name" placeholder="Gómez Pérez"
                            class="w-full rounded-2xl border border-slate-400 bg-white px-4 py-2 text-sm text-slate-900 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.4)] focus:border-amber-600 focus:outline-none focus:ring-1 focus:ring-amber-600">
                        @error('form.last_name')
                            <span class="text-xs text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Número celular -->
                    <div class="space-y-1.5">
                        <label for="celular" class="block text-sm font-bold text-slate-800">Numero celular:</label>
                        <input type="text" id="celular" wire:model="form.telefono" placeholder="4741469315"
                            maxlength="10" inputmode="numeric"
                            class="w-full rounded-2xl border border-slate-400 bg-white px-4 py-2 text-sm text-slate-900 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.4)] focus:border-amber-600 focus:outline-none focus:ring-1 focus:ring-amber-600">
                        @error('form.telefono')
                            <span class="text-xs text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Correo electrónico -->
                    <div class="space-y-1.5">
                        <label for="email" class="block text-sm font-bold text-slate-800">Correo electrónico:</label>
                        <input type="email" id="email" wire:model="form.email" placeholder="ejemplo@gmail.com"
                            class="w-full rounded-2xl border border-slate-400 bg-white px-4 py-2 text-sm text-slate-900 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.4)] focus:border-amber-600 focus:outline-none focus:ring-1 focus:ring-amber-600">
                        @error('form.email')
                            <span class="text-xs text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Contraseña (opcional al editar) -->
                    <div class="space-y-1.5">
                        <label for="password" class="block text-sm font-bold text-slate-800">Contraseña:</label>
                        <input type="password" id="password" wire:model="form.password"
                            placeholder="Dejar vacío para no cambiarla"
                            class="w-full rounded-2xl border border-slate-400 bg-white px-4 py-2 text-sm text-slate-900 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.4)] focus:border-amber-600 focus:outline-none focus:ring-1 focus:ring-amber-600">
                        @error('form.password')
                            <span class="text-xs text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Rol -->
                    <div class="space-y-1.5">
                        <label for="rol" class="block text-sm font-bold text-slate-800">Rol:</label>
                        <div class="relative">
                            <select id="rol"
                                class="w-full appearance-none rounded-2xl border border-slate-400 bg-white px-4 py-2 pr-10 text-sm text-slate-900 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.4)] focus:border-amber-600 focus:outline-none focus:ring-1 focus:ring-amber-600">
                                <option value="">Selecciona un rol</option>
                                <option value="Cortador">Cortador</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Almacenista">Almacenista</option>
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-700">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="flex items-center justify-end gap-4 pt-2">
                <button type="submit"
                    class="rounded-xl border border-amber-900 bg-[#FFD600] px-8 py-2.5 text-sm font-bold text-slate-950 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)] hover:bg-amber-400 transition-all active:translate-y-0.5">
                    Modificar
                </button>

                <a href="{{ route('usuarios') }}"
                    class="rounded-xl border border-red-900 bg-[#FF2222] px-8 py-2.5 text-center text-sm font-bold text-white shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)] hover:bg-red-700 transition-all active:translate-y-0.5">
                    Cancelar
                </a>
            </div>

        </form>
    </main>

    <!-- JS para controlar el Menú Lateral -->
    <script src="{{ asset('js/Menu.js') }}"></script>
</div>

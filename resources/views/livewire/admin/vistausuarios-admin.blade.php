<div class="min-h-screen bg-white font-['Raleway'] text-slate-950">
    <!-- Carga de Fuentes / CDN si aplica -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Nuevo header refactoizado --}}
    <livewire:layouts.header title="Control de usuarios" subtitle="Datos generales de los usuarios" />

    {{-- Nuevo menu refactorizado --}}
    <livewire:layouts.menu />

    <!-- Contenido Principal -->
    <main
        class="mx-3 my-5 rounded-2xl border border-amber-900 bg-white p-4 sm:mx-6 sm:my-8 sm:p-6 md:mx-10 md:p-8 lg:mx-12 shadow-sm">

        <!-- Controles Superiores: Buscador y Botón Nuevo -->
        <div class="mb-6 flex flex-col items-stretch justify-between gap-4 sm:flex-row sm:items-center">

            <!-- Buscador -->
            <div class="flex items-center gap-3">
                <label for="search" class="text-sm font-bold text-slate-900 whitespace-nowrap sm:text-base">
                    Buscador de usuarios:
                </label>
                <!-- wire:model.live envía los datos en tiempo real al escribir -->
                <input type="text" id="search" wire:model.live="search" placeholder="Buscar por nombre, correo..."
                    class="w-full sm:w-72 rounded-full border border-amber-900 bg-white px-4 py-1.5 text-sm text-slate-900 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] focus:outline-none focus:ring-2 focus:ring-amber-500">
            </div>

            <!-- Botón Nuevo -->
            <a href="{{ route('crearusuarios') }}" type="button"
                class="self-end sm:self-auto rounded-xl border border-amber-900 bg-[#FFD600] px-8 py-2 font-bold text-slate-950 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)] hover:bg-amber-400 transition-all active:translate-y-0.5">
                Nuevo
            </a>
        </div>

        <!-- Tabla Estilizada Maquetada -->
        <div class="overflow-x-auto rounded-lg border border-amber-900 bg-[#F5D477]">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr
                        class="border-b border-amber-900 bg-[#D99B00] text-slate-950 text-xs sm:text-sm font-bold divide-x divide-amber-900">
                        <th class="p-2 sm:p-3">Nombre (s)</th>
                        <th class="p-2 sm:p-3">Apellidos</th>
                        <th class="p-2 sm:p-3">Número celular</th>
                        <th class="p-2 sm:p-3">Correo electrónico</th>
                        <th class="p-2 sm:p-3">Rol</th>
                        <th class="p-2 sm:p-3 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-amber-900">

                    @forelse ($usuarios as $usuario)
                        @php
                            // Separar el nombre completo en 2 partes
                            $partes = explode(' ', $usuario->name, 2);
                            $nombreVista = $partes[0] ?? '';
                            $apellidosVista = $partes[1] ?? '';
                        @endphp

                        <tr
                            class="divide-x divide-amber-900 h-12 text-xs sm:text-sm font-medium text-slate-900 bg-[#F5D477] hover:bg-[#ebd083] transition-colors">
                            <td class="p-2">{{ $nombreVista }}</td>
                            <td class="p-2">{{ $apellidosVista }}</td>
                            <td class="p-2">{{ $usuario->telefono }}</td>
                            <td class="p-2">{{ $usuario->email }}</td>
                            <td class="p-2">
                                <!-- Placeholder del rol por el momento -->
                                Cortador
                            </td>
                            <td class="p-2 sm:p-3 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('EditarUsuario', $usuario->id) }}"
                                        class="rounded-md border border-slate-900 bg-[#00FF00] px-3 py-1 text-xs font-bold text-slate-950 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] hover:bg-green-400 transition-all text-center inline-block">
                                        Editar
                                    </a>

                                    <!-- Botón Desactivar conectado al componente -->
                                    <button type="button" wire:click="desactivar({{ $usuario->id }})"
                                        wire:confirm="¿Estás seguro de que deseas desactivar a este usuario?"
                                        class="rounded-md border border-slate-900 bg-[#FF0000] px-3 py-1 text-xs font-bold text-white shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] hover:bg-red-600 transition-all">
                                        Borrar
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-4 text-center text-sm font-bold text-slate-900 bg-[#F5D477]">
                                No se encontraron usuarios.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        <!-- Paginación de Laravel Livewire -->
        @if ($usuarios->hasPages())
            <div class="mt-6 flex justify-center items-center gap-2">

                <!-- Botón Anterior -->
                @if ($usuarios->onFirstPage())
                    <span
                        class="px-4 py-2 text-sm font-bold text-slate-400 bg-slate-100 border border-amber-900 rounded-xl shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)] cursor-not-allowed">
                        &laquo; Ant
                    </span>
                @else
                    <button wire:click="previousPage"
                        class="px-4 py-2 text-sm font-bold text-slate-900 bg-white border border-amber-900 rounded-xl hover:bg-[#FFD600] shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)] transition-colors">
                        &laquo; Ant
                    </button>
                @endif

                <!-- Números de Página -->
                @for ($i = 1; $i <= $usuarios->lastPage(); $i++)
                    @if ($i == $usuarios->currentPage())
                        <!-- Página Actual (Amarillo) -->
                        <span
                            class="px-4 py-2 text-sm font-black text-slate-950 bg-[#D99B00] border border-amber-900 rounded-xl shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)]">
                            {{ $i }}
                        </span>
                    @else
                        <!-- Otras Páginas (Blancas) -->
                        <button wire:click="gotoPage({{ $i }})"
                            class="px-4 py-2 text-sm font-bold text-slate-900 bg-white border border-amber-900 rounded-xl hover:bg-[#FFD600] shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)] transition-colors">
                            {{ $i }}
                        </button>
                    @endif
                @endfor

                <!-- Botón Siguiente -->
                @if ($usuarios->hasMorePages())
                    <button wire:click="nextPage"
                        class="px-4 py-2 text-sm font-bold text-slate-900 bg-white border border-amber-900 rounded-xl hover:bg-[#FFD600] shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)] transition-colors">
                        Sig &raquo;
                    </button>
                @else
                    <span
                        class="px-4 py-2 text-sm font-bold text-slate-400 bg-slate-100 border border-amber-900 rounded-xl shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)] cursor-not-allowed">
                        Sig &raquo;
                    </span>
                @endif

            </div>
        @endif

        <!-- JS para controlar el Menú Lateral -->
        <script src="{{ asset('js/Menu.js') }}"></script>
</div>

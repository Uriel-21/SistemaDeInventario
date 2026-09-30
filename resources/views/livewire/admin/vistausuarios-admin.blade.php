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
                <input type="text" id="search" placeholder=""
                    class="w-full sm:w-72 rounded-full border border-amber-900 bg-white px-4 py-1.5 text-sm text-slate-900 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] focus:outline-none focus:ring-2 focus:ring-amber-500">
            </div>

            <!-- Botón Nuevo -->
            <a href="{{ route('crearusuarios') }}" type="button"
                class="self-end sm:self-auto rounded-xl border border-amber-900 bg-[#FFD600] px-8 py-2 font-bold text-slate-950 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)] hover:bg-amber-400 transition-all active:translate-y-0.5">
                Nuevo
            </a>
        </div>

        <!-- Tabla Estilizada Maquetada (Sin Dirección) -->
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
                    <!-- Fila 1 con Botones de Muestra Visual -->
                    <tr class="divide-x divide-amber-900 h-12 text-xs sm:text-sm font-medium text-slate-900">
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                        <td class="p-2 sm:p-3 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button"
                                    class="rounded-md border border-slate-900 bg-[#00FF00] px-3 py-1 text-xs font-bold text-slate-950 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] hover:bg-green-400 transition-all">
                                    Editar
                                </button>
                                <button type="button"
                                    class="rounded-md border border-slate-900 bg-[#FF0000] px-3 py-1 text-xs font-bold text-white shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] hover:bg-red-600 transition-all">
                                    Borrar
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Filas vacías adicionales para rellenar la estructura visual de la tabla (6 columnas en total) -->
                    <tr class="divide-x divide-amber-900 h-12">
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                    </tr>
                    <tr class="divide-x divide-amber-900 h-12">
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                    </tr>
                    <tr class="divide-x divide-amber-900 h-12">
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                    </tr>
                    <tr class="divide-x divide-amber-900 h-12">
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                    </tr>
                    <tr class="divide-x divide-amber-900 h-12">
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Paginación estilo vintage/minimalista -->
        <div class="mt-4 flex justify-center text-slate-950 font-mono text-sm tracking-widest">
            <span>&lt;1 2 3 4 5 6&gt;</span>
        </div>
    </main>

    <!-- JS para controlar el Menú Lateral -->
    <script src="{{ asset('js/Menu.js') }}"></script>
</div>

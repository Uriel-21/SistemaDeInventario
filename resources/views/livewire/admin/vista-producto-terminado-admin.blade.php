<div class="font-['Raleway'] text-slate-950">
    {{-- Carga de fuentes/CDN si aún no están incluidas en el layout --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <livewire:layouts.header
        title="Historial de asignaciones y rendimiento"
        subtitle="Datos generales del historial"
    />

    <livewire:layouts.menu />

    <main class="mx-2 my-2 overflow-hidden border border-gray-600 bg-white font-['Raleway'] text-slate-950 sm:mx-4 sm:my-4">

        <div class="p-3 sm:px-7 sm:py-5">
            {{-- Buscador y botón --}}
            <div class="mb-2 flex items-center gap-3 sm:gap-5">
                <div class="relative min-w-0 flex-1">
                    <input
                        type="search"
                        placeholder="Buscar modelo..."
                        class="h-8 w-full border-2 border-gray-700 bg-gray-200 px-3 pr-9 text-sm text-slate-900 placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-500"
                    >

                    <svg
                        class="pointer-events-none absolute right-2 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-800"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <circle cx="11" cy="11" r="7" stroke-width="2" />
                        <path stroke-linecap="round" stroke-width="2" d="m16 16 4 4" />
                    </svg>
                </div>

                <button
                    type="button"
                    class="shrink-0 rounded-md border-2 border-slate-900 bg-[#FFD600] px-4 py-1.5 text-xs font-medium text-slate-950 shadow-sm transition hover:bg-amber-400 sm:px-6 sm:py-2"
                >
                    Agregar nuevo
                </button>
            </div>

            {{-- Tabla --}}
            <div class="overflow-x-auto rounded border border-gray-700">
                <table class="w-full min-w-[700px] border-collapse text-left">
                    <thead>
                        <tr class="divide-x divide-gray-500 border-b border-gray-700 bg-gray-200 text-center text-xs text-slate-800 sm:text-sm">
                            <th class="px-2 py-2 font-medium">Código</th>
                            <th class="px-2 py-2 font-medium">Nombre del modelo</th>
                            <th class="px-2 py-2 font-medium">Talla</th>
                            <th class="px-2 py-2 font-medium">Stock total</th>
                            <th class="px-2 py-2 font-medium">Stock mínimo</th>
                            <th class="px-2 py-2 font-medium">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr class="h-56 divide-x divide-gray-500 bg-gray-100 align-top text-sm text-slate-900 sm:h-64">
                            <td class="p-2"></td>
                            <td class="p-2"></td>
                            <td class="p-2"></td>
                            <td class="p-2"></td>
                            <td class="p-2"></td>
                            <td class="p-2">
                                <div class="flex items-center justify-center gap-1.5">
                                    <button
                                        type="button"
                                        class="rounded-md border border-slate-900 bg-[#8BD044] px-2.5 py-1.5 text-[10px] font-medium text-slate-950 shadow-sm transition hover:bg-green-400 sm:px-3 sm:text-xs"
                                    >
                                        Modificar
                                    </button>

                                    <button
                                        type="button"
                                        class="rounded-md border border-slate-900 bg-[#E34B4B] px-2.5 py-1.5 text-[10px] font-medium text-slate-950 shadow-sm transition hover:bg-red-400 sm:px-3 sm:text-xs"
                                    >
                                        Eliminar
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Paginación visual --}}
            <nav aria-label="Paginación" class="mt-6 flex items-center justify-center gap-0.5 text-xs text-gray-600">
                <button type="button" class="px-0.5 hover:text-slate-950">&lt;</button>
                <button type="button" class="px-0.5">1</button>
                <button type="button" class="px-0.5">2</button>
                <button type="button" class="px-0.5">3</button>
                <button type="button" class="px-0.5">4</button>
                <button type="button" class="px-0.5">5</button>
                <button type="button" class="px-0.5">6</button>
                <button type="button" class="px-0.5 hover:text-slate-950">&gt;</button>
            </nav>
        </div>
    </main>
</div>
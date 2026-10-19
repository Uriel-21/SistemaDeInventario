<div>
    {{-- Carga de fuentes/CDN si aún no están incluidas en el layout --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <livewire:layouts.header
        title="Historial de lotes"
        subtitle="Vista del historial de los lotes agregados"
    />

    <livewire:layouts.menu />

    <main class="mx-2 my-2 overflow-hidden bg-white font-['Raleway'] text-slate-950 sm:mx-4 sm:my-4">

    <div class="p-3 sm:px-5 sm:py-5">
        {{-- Búsqueda y filtros --}}
        <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div class="relative w-full sm:max-w-[52%]">
                <input
                    type="search"
                    placeholder="Buscar registro..."
                    class="h-8 w-full border-2 border-gray-700 bg-gray-200 px-2 pr-8 text-sm text-slate-900 placeholder:text-gray-500 focus:outline-none focus:ring-1 focus:ring-amber-500"
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

            <div class="grid grid-cols-3 overflow-hidden border-2 border-gray-700 sm:w-[42%]">
                <button type="button" class="border-r border-gray-500 bg-gray-200 px-3 py-1 text-sm transition hover:bg-[#FFD600]">
                    Día
                </button>
                <button type="button" class="border-r border-gray-500 bg-gray-200 px-3 py-1 text-sm transition hover:bg-[#FFD600]">
                    Semana
                </button>
                <button type="button" class="bg-gray-200 px-3 py-1 text-sm transition hover:bg-[#FFD600]">
                    Mes
                </button>
            </div>
        </div>

        {{-- Tabla --}}
        <div class="overflow-x-auto border-2 border-gray-700">
            <table class="w-full min-w-[650px] border-collapse text-left">
                <thead>
                    <tr class="divide-x divide-gray-400 border-b border-gray-500 bg-gray-200 text-center text-xs text-slate-800 sm:text-sm">
                        <th class="px-2 py-2 font-medium">Código de modelo</th>
                        <th class="px-2 py-2 font-medium">Nombre de modelo</th>
                        <th class="px-2 py-2 font-medium">Talla</th>
                        <th class="px-2 py-2 font-medium">Stock mínimo</th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="h-48 divide-x divide-gray-400 bg-gray-100 align-top text-sm text-slate-900 sm:h-52">
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Acciones y paginación --}}
        <div class="mt-6 grid grid-cols-1 items-center gap-4 sm:grid-cols-3">
            <div class="flex flex-wrap justify-center gap-3 sm:justify-start">
                <button
                    type="button"
                    class="rounded-md border-2 border-slate-900 bg-[#F87171] px-3 py-1.5 text-[10px] font-medium text-slate-950 shadow-sm transition hover:bg-red-400 sm:text-xs"
                >
                    Exportar a PDF
                </button>

                <button
                    type="button"
                    class="rounded-md border-2 border-slate-900 bg-[#8BD044] px-3 py-1.5 text-[10px] font-medium text-slate-950 shadow-sm transition hover:bg-green-400 sm:text-xs"
                >
                    Exportar a Excel
                </button>
            </div>

            <nav aria-label="Paginación" class="flex items-center justify-center gap-0.5 text-xs text-gray-600">
                <button type="button" class="px-0.5 hover:text-slate-950">&lt;</button>
                <button type="button" class="px-0.5">1</button>
                <button type="button" class="px-0.5">2</button>
                <button type="button" class="px-0.5">3</button>
                <button type="button" class="px-0.5">4</button>
                <button type="button" class="px-0.5">5</button>
                <button type="button" class="px-0.5">6</button>
                <button type="button" class="px-0.5 hover:text-slate-950">&gt;</button>
            </nav>

            <div class="flex justify-center sm:justify-end">
                <button
                    type="button"
                    class="rounded-md border-2 border-slate-900 bg-[#8BD044] px-5 py-1.5 text-[10px] font-medium text-slate-950 shadow-sm transition hover:bg-green-400 sm:text-xs"
                >
                    Nuevo lote
                </button>
            </div>
        </div>
    </div>
</main>
</div>

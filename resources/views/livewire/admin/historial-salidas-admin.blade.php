<div>
    {{-- Carga de fuentes/CDN si aún no están incluidas en el layout --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <livewire:layouts.header title="Historial de salidas" subtitle="Vista del historial de los lotes que salieron" />

    <livewire:layouts.menu />

    <main class="mx-2 my-2 overflow-hidden bg-white font-['Raleway'] text-slate-950 sm:mx-4 sm:my-4">

        <div class="p-3 sm:px-5 sm:py-5">
            {{-- Búsqueda y filtros --}}
            <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                {{-- Input de Búsqueda Reactivo --}}
                <div class="relative w-full sm:max-w-[52%]">
                    <input type="search" wire:model.live.debounce.300ms="search"
                        placeholder="Buscar registro por cliente, producto o lote..."
                        class="h-8 w-full border-2 border-gray-700 bg-gray-200 px-2 pr-8 text-sm text-slate-900 placeholder:text-gray-500 focus:outline-none focus:ring-1 focus:ring-amber-500">

                    <svg class="pointer-events-none absolute right-2 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-800"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        aria-hidden="true">
                        <circle cx="11" cy="11" r="7" stroke-width="2" />
                        <path stroke-linecap="round" stroke-width="2" d="m16 16 4 4" />
                    </svg>
                </div>

                {{-- Botones de Filtro de Tiempo --}}
                <div class="grid grid-cols-3 overflow-hidden border-2 border-gray-700 sm:w-[42%]">
                    <button type="button" wire:click="$set('filtroTiempo', 'dia')"
                        class="border-r border-gray-500 px-3 py-1 text-sm transition hover:bg-[#FFD600] {{ $filtroTiempo === 'dia' ? 'bg-[#FFD600] font-bold' : 'bg-gray-200' }}">
                        Día
                    </button>
                    <button type="button" wire:click="$set('filtroTiempo', 'semana')"
                        class="border-r border-gray-500 px-3 py-1 text-sm transition hover:bg-[#FFD600] {{ $filtroTiempo === 'semana' ? 'bg-[#FFD600] font-bold' : 'bg-gray-200' }}">
                        Semana
                    </button>
                    <button type="button" wire:click="$set('filtroTiempo', 'mes')"
                        class="px-3 py-1 text-sm transition hover:bg-[#FFD600] {{ $filtroTiempo === 'mes' ? 'bg-[#FFD600] font-bold' : 'bg-gray-200' }}">
                        Mes
                    </button>
                </div>
            </div>

            {{-- Tabla de Resultados --}}
            <div class="overflow-x-auto border-2 border-gray-700">
                <table class="w-full min-w-[600px] border-collapse text-left">
                    <thead>
                        <tr
                            class="divide-x divide-gray-400 border-b border-gray-500 bg-gray-300 text-center text-xs text-slate-900 sm:text-sm">
                            <th class="px-2 py-2 font-bold"> Registrado por: </th>
                            <th class="px-2 py-2 font-bold">Producto</th>
                            <th class="px-2 py-2 font-bold">Número de lote</th>
                            <th class="px-2 py-2 font-bold">Cliente</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-400 bg-gray-100 text-sm text-slate-900">
                        @forelse ($salidas as $salida)
                            <tr class="divide-x divide-gray-400 align-top transition hover:bg-gray-200">
                                <td class="p-2 text-center">{{ $salida->user->name ?? 'N/A' }}</td>
                                <td class="p-2 text-center">{{ $salida->producto->nombre_modelo ?? 'N/A' }}</td>
                                <td class="p-2 text-center">{{ $salida->lote->codigo_barras ?? 'N/A' }}</td>
                                <td class="p-2 text-center">{{ $salida->cliente }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-6 text-center font-medium text-gray-500">
                                    No se encontraron registros de salidas con los filtros actuales.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Acciones y paginación --}}
            <div class="mt-6 grid grid-cols-1 items-center gap-4 sm:grid-cols-3">

                {{-- Botones de Exportación --}}
                <div class="flex flex-wrap justify-center gap-3 sm:justify-start">
                    <button type="button" wire:click="exportarPdf"
                        class="rounded-md border-2 border-slate-900 bg-[#F87171] px-3 py-1.5 text-[10px] font-medium text-slate-950 shadow-sm transition hover:bg-red-400 sm:text-xs">
                        Exportar a PDF
                    </button>

                    <button type="button" wire:click="exportarExcel"
                        class="rounded-md border-2 border-slate-900 bg-[#8BD044] px-3 py-1.5 text-[10px] font-medium text-slate-950 shadow-sm transition hover:bg-green-400 sm:text-xs">
                        Exportar a Excel
                    </button>
                </div>

                {{-- Paginación nativa de Livewire/Laravel --}}
                <div class="flex items-center justify-center text-xs">
                    {{ $salidas->links() }}
                </div>

                {{-- Botón de Nueva Salida --}}
                <div class="flex justify-center sm:justify-end">
                    <!-- Ajusta el href a la ruta donde tengas tu formulario de escáner -->
                    <a href="{{ route('registrarsalida') }}" wire:navigate
                        class="rounded-md border-2 border-slate-900 bg-[#8BD044] px-5 py-1.5 text-[10px] font-medium text-slate-950 shadow-sm transition hover:bg-green-400 sm:text-xs">
                        Nueva salida
                    </a>
                </div>
            </div>
        </div>
    </main>
</div>

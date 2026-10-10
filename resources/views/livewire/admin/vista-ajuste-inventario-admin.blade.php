<div x-data="{ modalDetalles: false }" @keydown.escape.window="modalDetalles = false">
    <!-- Carga de Fuentes / CDN si aplica -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <livewire:layouts.header title="Ajuste de inventario" subtitle="Datos generales del inventario" />

    <livewire:layouts.menu />

    <main
        class="mx-3 my-5 overflow-hidden rounded-2xl border border-amber-900 bg-white shadow-sm sm:mx-6 sm:my-8 md:mx-10 lg:mx-12">
        <div class="p-4 sm:p-6">

            {{-- Búsqueda y filtros --}}
            <div class="mb-4 flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
                <div class="relative w-full lg:max-w-lg">
                    <input type="search" placeholder="Buscar registro..." wire:model.live.bounce.300ms="search"
                        class="w-full border border-slate-900 bg-gray-200 px-3 py-2 pr-10 text-sm text-slate-900 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-500">

                    <svg class="pointer-events-none absolute right-3 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-700"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m21 21-4.35-4.35M19 10.5a8.5 8.5 0 1 1-17 0 8.5 8.5 0 0 1 17 0Z" />
                    </svg>
                </div>

                <div
                    class="grid grid-cols-3 overflow-hidden border border-slate-900 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)]">
                    <button type="button" wire:click="setFiltroTiempo('dia')"
                        class="border-r border-slate-900 px-5 py-2 text-sm font-medium text-slate-900 transition hover:bg-[#FFD600] {{ $filtroTiempo === 'dia' ? 'bg-[#FFD600]' : 'bg-gray-200' }}">
                        Día
                    </button>
                    <button type="button" wire:click="setFiltroTiempo('semana')"
                        class="border-r border-slate-900 px-5 py-2 text-sm font-medium text-slate-900 transition hover:bg-[#FFD600] {{ $filtroTiempo === 'semana' ? 'bg-[#FFD600]' : 'bg-gray-200' }}">
                        Semana
                    </button>
                    <button type="button" wire:click="setFiltroTiempo('mes')"
                        class="px-5 py-2 text-sm font-medium text-slate-900 transition hover:bg-[#FFD600] {{ $filtroTiempo === 'mes' ? 'bg-[#FFD600]' : 'bg-gray-200' }}">
                        Mes
                    </button>
                </div>
            </div>

            {{-- Tabla --}}
            <div class="overflow-x-auto border border-slate-900">
                <table class="w-full min-w-[650px] border-collapse text-left">
                    <thead>
                        <tr
                            class="divide-x divide-slate-900 border-b border-slate-900 bg-gray-200 text-center text-sm font-medium text-slate-900">
                            <th class="p-2">Material</th>
                            <th class="p-2">Cantidad</th>
                            <th class="p-2">Fecha</th>
                            <th class="p-2">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($ajustes as $ajuste)
                            <tr
                                class="divide-x divide-slate-900 bg-gray-100 align-middle text-sm text-slate-900 border-b border-slate-900 last:border-0 hover:bg-white transition">
                                <td class="p-2 font-medium">{{ $ajuste->materiaPrima->nombre ?? 'Desconocido' }}
                                </td>
                                <td class="p-2 text-center">{{ number_format($ajuste->cantidad_dm, 2) }}</td>
                                <td class="p-2 text-center">{{ $ajuste->created_at->format('d/m/Y H:i') }}</td>
                                <td class="p-3 text-center">
                                    <button type="button" @click="modalDetalles = true"
                                        wire:click="$dispatch('cargarDetalles', { id: {{ $ajuste->id }} })"
                                        class="rounded-md border border-slate-900 bg-sky-400 px-4 py-1.5 text-xs font-bold text-slate-950 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] transition hover:bg-sky-300">
                                        Ver detalles
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-6 text-center text-gray-500 font-medium">
                                    No se encontraron registros de ajustes de inventario.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Exportaciones y paginación --}}
            <div class="mt-3 flex flex-col items-center justify-between gap-4 sm:flex-row">
                <div class="flex gap-3">
                    <button type="button" wire:click="exportarPdf"
                        class="rounded-md border border-slate-900 bg-[#F87171] px-4 py-2 text-xs font-bold text-slate-950 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] transition hover:bg-red-400 active:translate-y-0.5 flex items-center justify-center min-w-[120px]">

                        {{-- Texto normal --}}
                        <span wire:loading.remove wire:target="exportarPdf">Exportar a PDF</span>

                        {{-- Texto mientras procesa --}}
                        <span wire:loading wire:target="exportarPdf" class="animate-pulse">Generando...</span>
                    </button>

                    <button type="button" wire:click="exportarExcel"
                        class="rounded-md border border-slate-900 bg-[#8BD044] px-4 py-2 text-xs font-bold text-slate-950 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] transition hover:bg-green-400 active:translate-y-0.5 flex items-center justify-center min-w-[120px]">

                        {{-- Texto normal --}}
                        <span wire:loading.remove wire:target="exportarExcel">Exportar a Excel</span>

                        {{-- Texto mientras procesa --}}
                        <span wire:loading wire:target="exportarExcel" class="animate-pulse">Generando...</span>
                    </button>
                    <a href=" {{ route('ajusteinventario') }} " wire:navigate
                        class="inline-flex items-center justify-center rounded-md border border-slate-900 bg-[#FFD600] px-4 py-2 text-xs font-bold text-slate-950 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] transition hover:bg-amber-400 active:translate-y-0.5">
                        <svg class="mr-1.5 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Nuevo ajuste
                    </a>
                </div>

                <div class="w-full sm:w-auto">
                    {{ $ajustes->links(data: ['scrollTo' => false]) }}
                </div>
            </div>
        </div>
    </main>
    <livewire:layouts.modal-ajustes-admin />
</div>

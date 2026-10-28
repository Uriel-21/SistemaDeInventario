<div>
    {{-- Carga de fuentes/CDN si aún no están incluidas en el layout --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <livewire:layouts.header title="Historial de lotes" subtitle="Vista del historial de los lotes agregados" />

    <livewire:layouts.menu />

    <main class="mx-2 my-2 overflow-hidden bg-white font-['Raleway'] text-slate-950 sm:mx-4 sm:my-4">

        <div class="p-3 sm:px-5 sm:py-5">
            <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                <div class="relative w-full sm:max-w-[52%]">
                    <input type="search" wire:model.live.debounce.300ms="search" placeholder="Buscar registro..."
                        class="h-8 w-full border-2 border-gray-700 bg-gray-200 px-2 pr-8 text-sm text-slate-900 placeholder:text-gray-500 focus:outline-none focus:ring-1 focus:ring-amber-500">

                    <svg class="pointer-events-none absolute right-2 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-800"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        aria-hidden="true">
                        <circle cx="11" cy="11" r="7" stroke-width="2" />
                        <path stroke-linecap="round" stroke-width="2" d="m16 16 4 4" />
                    </svg>
                </div>
            </div>

            <div class="overflow-x-auto border-2 border-gray-700">
                <table class="w-full min-w-[650px] border-collapse text-left">
                    <thead>
                        <tr
                            class="divide-x divide-gray-400 border-b border-gray-500 bg-gray-200 text-center text-xs text-slate-800 sm:text-sm">
                            <th class="px-2 py-2 font-medium">Código de modelo</th>
                            <th class="px-2 py-2 font-medium">Nombre de modelo</th>
                            <th class="px-2 py-2 font-medium">Talla</th>
                            <th class="px-2 py-2 font-medium">Cantidad (Lote)</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($lotes as $lote)
                            <tr
                                class="divide-x divide-gray-400 bg-gray-100 text-sm text-slate-900 transition hover:bg-gray-200">
                                {{-- Extraemos los datos de la relación producto --}}
                                <td class="p-2">{{ $lote->productos->codigo ?? 'N/D' }}</td>
                                <td class="p-2">{{ $lote->productos->nombre_modelo ?? 'N/D' }}</td>
                                <td class="p-2">{{ $lote->productos->talla ?? 'N/D' }}</td>
                                <td class="p-2 text-center">{{ $lote->cantidad }}</td>
                            </tr>
                        @empty
                            <tr class="divide-x divide-gray-400 bg-gray-100">
                                <td colspan="4" class="p-4 text-center text-sm text-slate-600 font-medium">
                                    No se encontraron lotes registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6 grid grid-cols-1 items-center gap-4 sm:grid-cols-3">
                <div class="flex flex-wrap justify-center gap-3 sm:justify-start">
                    <button type="button" wire:click="exportarPdf"
                        class="rounded-md border-2 border-slate-900 bg-[#F87171] px-3 py-1.5 text-[10px] font-medium text-slate-950 shadow-sm transition hover:bg-red-400 sm:text-xs">
                        Exportar a PDF
                    </button>

                    <button type="button"
                        class="rounded-md border-2 border-slate-900 bg-[#8BD044] px-3 py-1.5 text-[10px] font-medium text-slate-950 shadow-sm transition hover:bg-green-400 sm:text-xs">
                        Exportar a Excel
                    </button>
                </div>

                <div class="flex items-center justify-center text-xs text-gray-600">
                    {{ $lotes->links() }}
                </div>

                <div class="flex justify-center sm:justify-end">
                    <a href="{{ route('agregarlote') }}" type="button"
                        class="rounded-md border-2 border-slate-900 bg-[#8BD044] px-5 py-1.5 text-[10px] font-medium text-slate-950 shadow-sm transition hover:bg-green-400 sm:text-xs">
                        Nuevo lote
                    </a>
                </div>
            </div>
        </div>
    </main>
</div>

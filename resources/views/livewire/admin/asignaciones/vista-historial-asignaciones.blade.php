<div>
    <div>
        <!-- Carga de Fuentes / CDN si aplica -->
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap"
            rel="stylesheet">

        <livewire:layouts.header title="Historial de asignaciones y rendimiento"
            subtitle="Datos generales del historial" />

        <livewire:layouts.menu />

        <main
            class="mx-3 my-5 overflow-hidden rounded-2xl border border-amber-900 bg-white font-['Raleway'] text-slate-950 shadow-sm sm:mx-6 sm:my-8 md:mx-10 lg:mx-12">
            <div class="p-4 sm:p-6">
                {{-- Búsqueda y filtros conectados a Livewire --}}
                <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div class="relative w-full sm:max-w-md">
                        <input type="search" placeholder="Buscar por cortador o material..."
                            wire:model.live.debounce.500ms="search"
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
                        <button type="button" wire:click="$set('filtroTiempo', 'dia')"
                            class="border-r border-slate-900 px-5 py-2 text-sm font-medium transition {{ $filtroTiempo === 'dia' ? 'bg-[#FFD600]' : 'bg-gray-200 hover:bg-[#FFD600]' }}">
                            Día
                        </button>
                        <button type="button" wire:click="$set('filtroTiempo', 'semana')"
                            class="border-r border-slate-900 px-5 py-2 text-sm font-medium transition {{ $filtroTiempo === 'semana' ? 'bg-[#FFD600]' : 'bg-gray-200 hover:bg-[#FFD600]' }}">
                            Semana
                        </button>
                        <button type="button" wire:click="$set('filtroTiempo', 'mes')"
                            class="px-5 py-2 text-sm font-medium transition {{ $filtroTiempo === 'mes' ? 'bg-[#FFD600]' : 'bg-gray-200 hover:bg-[#FFD600]' }}">
                            Mes
                        </button>
                    </div>
                </div>

                {{-- Tabla de Auditoría --}}
                <div class="overflow-x-auto border border-slate-900">
                    <table class="w-full min-w-[800px] border-collapse text-left">
                        <thead>
                            <tr
                                class="divide-x divide-gray-400 border-b border-slate-900 bg-gray-200 text-center text-xs font-bold text-slate-800 sm:text-sm uppercase tracking-wide">
                                <th class="p-2 sm:p-3">Fecha</th>
                                <th class="p-2 sm:p-3">Cortador</th>
                                <th class="p-2 sm:p-3">Material Utilizado</th>
                                <th class="p-2 sm:p-3">Tareas Entregadas</th>
                                <th class="p-2 sm:p-3">Rendimiento (dm/tarea)</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-900">
                            @forelse ($asignaciones as $asignacion)
                                <tr
                                    class="divide-x divide-gray-400 bg-gray-50 text-center text-sm text-slate-900 transition hover:bg-white">
                                    <td class="p-2 sm:p-3 font-medium">
                                        {{ $asignacion->updated_at->format('d/m/Y H:i') }}</td>
                                    <td class="p-2 sm:p-3">{{ $asignacion->user->name }}</td>

                                    {{-- Desglose del material en caso de que haya devoluciones o extras --}}
                                    <td class="p-2 sm:p-3">
                                        <span class="block font-bold">{{ $asignacion->materiaPrima->nombre }}</span>
                                        <span class="text-xs text-gray-500">Total mesa:
                                            {{ number_format($asignacion->dm_iniciales + ($asignacion->dm_adicionales ?? 0), 2) }}
                                            dm</span>
                                        @if ($asignacion->dm_sobrantes > 0)
                                            <span class="block text-xs font-semibold text-amber-600">Devolvió:
                                                {{ number_format($asignacion->dm_sobrantes, 2) }} dm</span>
                                        @endif
                                    </td>

                                    <td class="p-2 sm:p-3">
                                        <span
                                            class="text-lg font-bold text-slate-800">{{ $asignacion->cortes_reales }}</span>
                                        <span class="block text-xs text-gray-500">Meta:
                                            {{ number_format($asignacion->cortes_estimados, 2) }}</span>
                                    </td>

                                    <td class="p-2 sm:p-3">
                                        @php
                                            $esBuenRendimiento =
                                                $asignacion->rendimiento_real <= $asignacion->consumo_estimado;
                                        @endphp
                                        <div class="flex flex-col items-center">
                                            <span
                                                class="rounded px-2 py-1 text-sm font-bold shadow-sm border border-slate-900 {{ $esBuenRendimiento ? 'bg-[#8BD044] text-slate-900' : 'bg-[#F87171] text-white' }}">
                                                {{ number_format($asignacion->rendimiento_real, 2) }} dm
                                            </span>
                                            <span class="mt-1 text-[10px] text-gray-500 uppercase font-semibold">Est:
                                                {{ number_format($asignacion->consumo_estimado, 2) }} dm</span>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-6 text-center text-gray-500 font-medium bg-gray-50">
                                        No se encontraron registros finalizados con los filtros actuales.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Paginación (Si la usas en tu componente PHP) --}}
                <div class="mt-4">
                    {{ $asignaciones->links() }}
                </div>

                {{-- Acciones --}}
                <div class="mt-5 flex flex-col items-center gap-4 sm:flex-row sm:justify-between">
                    <button type="button" wire:click="exportarPdf"
                        class="rounded-md border border-slate-900 bg-[#F87171] px-4 py-2 text-xs font-bold text-slate-950 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] transition hover:bg-red-400 active:translate-y-0.5 flex items-center justify-center min-w-[120px]">

                        {{-- Texto normal --}}
                        <span wire:loading.remove wire:target="exportarPdf">Exportar a PDF</span>

                        {{-- Texto mientras procesa --}}
                        <span wire:loading wire:target="exportarPdf" class="animate-pulse">Generando...</span>
                    </button>

                    <a href="{{ route('asignaciones.index') }}" wire:navigate
                        class="rounded-md border border-slate-900 bg-[#F3D06B] px-5 py-2 text-xs font-bold text-slate-950 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] transition hover:bg-[#FFD600]">
                        &larr; Regresar a Asignaciones Activas
                    </a>
                </div>
            </div>
        </main>
    </div>
</div>

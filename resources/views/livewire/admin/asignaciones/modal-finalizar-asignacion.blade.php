<div x-data="{ open: false }" @mostrar-modal-finalizar.window="open = true" @ocultar-modal-finalizar.window="open = false">

    <div x-show="open" style="display: none;"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4 backdrop-blur-sm"
        x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

        <div class="w-full max-w-4xl overflow-hidden rounded-xl border border-amber-900 bg-white shadow-xl"
            @click.away="open = false" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

            <div class="flex items-center justify-between bg-[#D99B00] px-6 py-4 text-white">
                <div>
                    <h2 class="text-lg font-bold">Finalizar asignación</h2>
                    <p class="text-sm opacity-90">Registro de finalización y cálculo de rendimiento</p>
                </div>
                <button type="button" @click="open = false" class="text-white transition hover:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form wire:submit.prevent="save">
                <div class="p-6">
                    @if ($asignacion)
                        <div class="mb-6 overflow-x-auto">
                            <table class="w-full min-w-[500px] border-collapse text-sm">
                                <thead>
                                    <tr
                                        class="divide-x divide-gray-400 border border-slate-900 bg-gray-200 text-center">
                                        <th class="p-2 font-semibold">Nombre del cortador</th>
                                        <th class="p-2 font-semibold">Material</th>
                                        <th class="p-2 font-semibold">Cantidad Total (dm)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        class="divide-x divide-gray-400 border-x border-b border-slate-900 bg-gray-50 text-center">
                                        <td class="p-3">{{ $asignacion->user->name }}</td>
                                        <td class="p-3">{{ $asignacion->materiaPrima->nombre }}</td>
                                        <td class="p-3 font-bold text-slate-700">
                                            {{ number_format($asignacion->dm_iniciales + ($asignacion->dm_adicionales ?? 0), 2) }}
                                            dm
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div class="space-y-4">
                                <div
                                    class="flex items-center justify-between rounded-lg border border-gray-300 bg-gray-100 p-3 text-sm">
                                    <span class="font-medium text-slate-700">Consumo estimado por tarea:</span>
                                    <span class="text-base font-bold text-slate-900">
                                        {{ number_format($asignacion->consumo_estimado, 2) }} dm
                                    </span>
                                </div>

                                <div class="rounded-lg border border-gray-300 bg-white p-4 shadow-sm"
                                    x-data="{ sobroMaterial: $wire.entangle('form.sobro_material') }">
                                    <label
                                        class="flex items-center gap-2 cursor-pointer text-sm font-semibold text-slate-800">
                                        <input type="checkbox" x-model="sobroMaterial"
                                            class="h-4 w-4 rounded border-gray-400 text-amber-600 focus:ring-amber-500">
                                        ¿Sobró material?
                                    </label>

                                    <div x-show="sobroMaterial" x-transition class="mt-3">
                                        <div class="flex items-center gap-3">
                                            <input type="number" step="0.01" min="0" placeholder="Ej: 15.5"
                                                wire:model.live.debounce.500ms="form.dm_sobrantes"
                                                class="w-full max-w-[120px] rounded-md border border-slate-900 bg-white px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-amber-500">
                                            <span class="text-sm font-medium text-gray-600">dm sobrantes</span>
                                        </div>
                                        @error('form.dm_sobrantes')
                                            <span
                                                class="mt-1 block text-xs font-semibold text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <label for="tareas-realizadas"
                                        class="mb-1 block text-sm font-semibold text-slate-800">
                                        Cantidad de cortes / piezas realizadas (25 por tarea):
                                    </label>
                                    <input id="tareas-realizadas" type="number" step="1" min="0"
                                        placeholder="Ej: 65" wire:model.live.debounce.500ms="form.tareas_realizadas"
                                        class="w-full max-w-xs rounded-md border border-slate-900 bg-gray-50 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500">

                                    @error('form.tareas_realizadas')
                                        <span
                                            class="mt-1 block text-xs font-semibold text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            @php
                                $piezasReales = is_numeric($form->tareas_realizadas)
                                    ? (float) $form->tareas_realizadas
                                    : 0;
                                $tareasCalculadas = $piezasReales / 25;

                                $sobrante =
                                    $form->sobro_material && is_numeric($form->dm_sobrantes)
                                        ? (float) $form->dm_sobrantes
                                        : 0;

                                $totalDisponible = $asignacion->dm_iniciales + ($asignacion->dm_adicionales ?? 0);
                                $gastado = max(0, $totalDisponible - $sobrante);
                                $rendimientoVivo = $tareasCalculadas > 0 ? round($gastado / $tareasCalculadas, 2) : 0;
                            @endphp

                            <div
                                class="flex min-h-[200px] flex-col items-center justify-center rounded-lg border-2 border-dashed border-gray-400 bg-gray-50 p-6 text-center shadow-inner">
                                <span class="text-base font-semibold text-gray-500 uppercase tracking-wide">
                                    Tareas Reales
                                </span>
                                <span class="mt-2 text-5xl font-bold text-green-600">
                                    {{ round($tareasCalculadas, 2) }}
                                </span>
                                <span class="mt-1 text-xs font-semibold text-slate-600">
                                    ({{ $piezasReales }} piezas realizadas /
                                    {{ number_format($asignacion->cortes_estimados, 2) }} tareas est.)
                                </span>

                                @if ($tareasCalculadas > 0)
                                    <div class="mt-3 rounded bg-slate-200 px-3 py-1 text-xs text-slate-800">
                                        Gasto real por tarea:
                                        <strong
                                            class="{{ $rendimientoVivo <= $asignacion->consumo_estimado ? 'text-green-700' : 'text-red-600' }}">
                                            {{ number_format($rendimientoVivo, 2) }} dm
                                        </strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                <div class="flex justify-end gap-3 border-t border-gray-200 bg-gray-50 px-6 py-4">
                    <button type="button" @click="open = false"
                        class="rounded-md border border-slate-900 bg-[#F87171] px-5 py-2 text-sm font-bold shadow-sm transition hover:bg-red-400">
                        Cancelar
                    </button>

                    <button type="submit"
                        class="rounded-md border border-slate-900 bg-[#36C6C8] px-5 py-2 text-sm font-bold shadow-sm transition hover:bg-[#25b3b5]">
                        Concluir Asignación
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

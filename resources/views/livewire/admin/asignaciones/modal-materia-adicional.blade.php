<div x-data="{ modalMaterialAdicional: false }" @mostrar-modal-adicional.window="modalMaterialAdicional = true"
    @ocultar-modal-adicional.window="modalMaterialAdicional = false">

    <div x-show="modalMaterialAdicional" style="display: none;"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4 backdrop-blur-sm"
        x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

        {{-- Contenedor blanco del Modal --}}
        <div class="w-full max-w-3xl overflow-hidden rounded-xl border border-amber-900 bg-white shadow-xl"
            @click.away="modalMaterialAdicional = false" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

            <div class="flex items-center justify-between bg-[#D99B00] px-6 py-4 text-white">
                <div>
                    <h2 class="text-lg font-bold">Asignar material adicional</h2>
                    <p class="text-sm opacity-90">Agregue material extra a la asignación en curso</p>
                </div>
                <button type="button" @click="modalMaterialAdicional = false"
                    class="text-white transition hover:text-gray-200">
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
                                        <th class="p-2 font-semibold">Cortador</th>
                                        <th class="p-2 font-semibold">Material</th>
                                        <th class="p-2 font-semibold">Cantidad actual asignada</th>
                                        <th class="p-2 font-semibold">Inventario disponible</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        class="divide-x divide-gray-400 border-x border-b border-slate-900 bg-gray-50 text-center">
                                        <td class="p-3">{{ $asignacion->user->name }}</td>
                                        <td class="p-3">{{ $asignacion->materiaPrima->nombre }}</td>
                                        <td class="p-3 font-bold text-slate-700">
                                            {{ number_format($asignacion->dm_iniciales, 2) }}
                                            @if ($asignacion->dm_adicionales > 0)
                                                <span class="text-amber-600">+
                                                    {{ number_format($asignacion->dm_adicionales, 2) }}</span>
                                            @endif
                                            dm
                                        </td>
                                        <td class="p-3 font-bold text-green-700">
                                            {{ number_format($asignacion->materiaPrima->stock_real_dm, 2) }} dm
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="rounded-md border border-gray-300 bg-gray-100 p-4">
                            <label for="material-extra" class="mb-2 block text-sm font-semibold text-slate-800">
                                Ingrese la cantidad de material adicional:
                            </label>
                            <div class="flex items-center gap-3">
                                <input id="material-extra" type="number" step="0.01" min="0.01"
                                    wire:model="form.dm_adicionales"
                                    class="w-full max-w-xs rounded-md border border-slate-900 bg-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500"
                                    placeholder="Ej: 150">
                                <span class="text-sm font-medium text-gray-600">dm</span>
                            </div>
                            @error('form.dm_adicionales')
                                <span class="mt-1 block text-xs font-semibold text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif
                </div>

                <div class="flex justify-end gap-3 border-t border-gray-200 bg-gray-50 px-6 py-4">
                    <button type="button" @click="modalMaterialAdicional = false"
                        class="rounded-md border border-slate-900 bg-[#F87171] px-5 py-2 text-sm font-bold shadow-sm transition hover:bg-red-400">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="rounded-md border border-slate-900 bg-[#8BD044] px-5 py-2 text-sm font-bold shadow-sm transition hover:bg-green-400">
                        Guardar Adicional
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

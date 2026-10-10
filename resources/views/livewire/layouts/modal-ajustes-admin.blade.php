<div>
    <div x-data="{ modalDetalles: false }" @abrir-modal-detalles.window="modalDetalles = true">
        <div x-show="modalDetalles" x-transition.opacity style="display: none;"
            class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto bg-black/60 p-4 font-['Raleway']"
            role="dialog" aria-modal="true" aria-labelledby="modal-title" @click.self="modalDetalles = false">
            <div class="my-auto w-full max-w-xl overflow-hidden rounded-2xl border border-amber-900 bg-white shadow-2xl">

                <div class="bg-[#D99B00] px-5 py-4 text-center text-slate-950 sm:py-5">
                    <h2 id="modal-title" class="text-xl font-bold sm:text-2xl"> Ajustes de Inventario </h2>
                    <p class="mt-1 text-sm font-medium sm:text-base">Detalles del ajuste de inventario </p>
                </div>

                <div class="p-4 sm:p-6">
                    <div class="space-y-3 rounded-xl border-2 border-slate-900 bg-gray-50 p-4 sm:p-5">

                        @if ($detalle)
                            <div class="grid grid-cols-1 items-center gap-2 sm:grid-cols-[8rem_1fr] sm:gap-4">
                                <label class="text-sm font-medium text-slate-800 sm:text-right">Usuario</label>
                                <input type="text" value="{{ $detalle->user->name ?? 'Usuario desconocido' }}"
                                    readonly
                                    class="w-full rounded-lg border border-slate-900 bg-gray-100 px-3 py-2 text-sm text-slate-800 cursor-not-allowed">
                            </div>

                            <div class="grid grid-cols-1 items-center gap-2 sm:grid-cols-[8rem_1fr] sm:gap-4">
                                <label class="text-sm font-medium text-slate-800 sm:text-right">Materia Prima</label>
                                <input type="text" value="{{ $detalle->materiaPrima->nombre ?? 'N/A' }}" readonly
                                    class="w-full rounded-lg border border-slate-900 bg-gray-100 px-3 py-2 text-sm text-slate-800 cursor-not-allowed">
                            </div>

                            <div class="grid grid-cols-1 items-center gap-2 sm:grid-cols-[8rem_1fr] sm:gap-4">
                                <label class="text-sm font-medium text-slate-800 sm:text-right">Cantidad</label>
                                <input type="text" value="{{ number_format($detalle->cantidad_dm, 2) }} dm" readonly
                                    class="w-full rounded-lg border border-slate-900 bg-gray-100 px-3 py-2 text-sm text-slate-800 cursor-not-allowed">
                            </div>
                            <div class="grid grid-cols-1 items-center gap-2 sm:grid-cols-[8rem_1fr] sm:gap-4">
                                <label class="text-sm font-medium text-slate-800 sm:text-right"> Tipo de ajuste </label>
                                <input type="text" value="{{ $detalle->tipo_ajuste }}" readonly
                                    class="w-full rounded-lg border border-slate-900 bg-gray-100 px-3 py-2 text-sm text-slate-800 cursor-not-allowed">
                            </div>
                            <div class="grid grid-cols-1 items-center gap-2 sm:grid-cols-[8rem_1fr] sm:gap-4">
                                <label class="text-sm font-medium text-slate-800 sm:text-right">Motivo</label>
                                <input type="text" value="{{ $detalle->motivo }}" readonly
                                    class="w-full rounded-lg border border-slate-900 bg-gray-100 px-3 py-2 text-sm text-slate-800 cursor-not-allowed">
                            </div>
                        @else
                            <div
                                class="flex h-40 items-center justify-center text-sm font-bold text-slate-500 animate-pulse">
                                Cargando información...
                            </div>
                        @endif

                        <div class="flex justify-center pt-3">
                            <button type="button" @click="modalDetalles = false"
                                class="rounded-lg border-2 border-slate-900 bg-[#D94B4B] px-8 py-2 text-sm font-bold text-slate-950 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] transition hover:bg-red-500 active:translate-y-0.5">
                                Cerrar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

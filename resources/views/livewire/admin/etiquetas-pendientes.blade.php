<div>
    <div>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap"
            rel="stylesheet">

        <livewire:layouts.header title="Cola de impresión" subtitle="Etiquetas pendientes de imprimir" />
        <livewire:layouts.menu />

        <main class="mx-2 my-2 overflow-hidden bg-white font-['Raleway'] text-slate-950 sm:mx-4 sm:my-4">
            <div class="p-3 sm:px-5 sm:py-5">

                @if (session()->has('error'))
                    <div
                        class="mb-4 rounded-md border-2 border-slate-900 bg-[#E34B4B]/80 p-3 text-sm font-semibold text-slate-900 shadow-sm">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-slate-700">
                            Total de etiquetas pendientes: <span class="text-amber-600">{{ $etiquetas->count() }}</span>
                        </p>
                    </div>

                    <div class="flex justify-end">
                        <button type="button" wire:click="imprimir"
                            class="rounded-md border-2 border-slate-900 bg-[#8BD044] px-5 py-2 text-xs font-bold text-slate-950 shadow-sm transition hover:bg-green-400">
                            Imprimir pendientes
                        </button>
                    </div>
                </div>

                {{-- Tabla funcional --}}
                <div class="overflow-x-auto border-2 border-gray-700">
                    <table class="w-full min-w-[650px] border-collapse text-left">
                        <thead>
                            <tr
                                class="divide-x divide-gray-400 border-b border-gray-500 bg-gray-200 text-center text-xs text-slate-800 sm:text-sm">
                                <th class="px-2 py-2 font-medium">Código Barras</th>
                                <th class="px-2 py-2 font-medium">Modelo</th>
                                <th class="px-2 py-2 font-medium">Talla</th>
                                <th class="px-2 py-2 font-medium">Cantidad del Lote</th>
                                <th class="px-2 py-2 font-medium">Estado</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($etiquetas as $etiqueta)
                                <tr
                                    class="divide-x divide-gray-400 bg-gray-100 text-sm text-slate-900 transition hover:bg-gray-200">
                                    <td class="p-2 text-center font-semibold">
                                        {{ $etiqueta->loteEmpaquetado->codigo_barras ?? 'N/D' }}</td>

                                    <td class="p-2">
                                        {{ $etiqueta->loteEmpaquetado->productos->nombre_modelo ?? 'N/D' }}</td>
                                    <td class="p-2 text-center">
                                        {{ $etiqueta->loteEmpaquetado->productos->talla ?? 'N/D' }}</td>

                                    <td class="p-2 text-center">{{ $etiqueta->loteEmpaquetado->cantidad ?? 'N/D' }}</td>

                                    <td class="p-2 text-center">
                                        <span
                                            class="rounded bg-amber-200 px-2 py-1 text-xs font-bold text-amber-800">Pendiente</span>
                                    </td>
                                </tr>
                            @empty
                                <tr class="divide-x divide-gray-400 bg-gray-100">
                                    <td colspan="5" class="p-4 text-center text-sm font-medium text-slate-600">
                                        No hay etiquetas pendientes en la cola de impresión.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>

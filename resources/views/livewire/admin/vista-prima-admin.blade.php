<div class="space-y-6">
    <!-- Carga de Fuentes / CDN si aplica -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Nuevo header refactoizado --}}
    <livewire:layouts.header title="Control de Materia Prima" subtitle="Datos generales del lote" />

    {{-- Nuevo menu refactorizado --}}
    <livewire:layouts.menu />

    <main
        class="mx-3 my-5 rounded-2xl border border-amber-900 bg-white p-4 shadow-sm sm:mx-6 sm:my-8 sm:p-6 md:mx-10 md:p-8 lg:mx-12">

        {{-- Buscador y botón --}}
        <div class="mb-6 flex flex-col items-stretch justify-between gap-4 sm:flex-row sm:items-center">
            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:gap-3">
                <label for="search" class="whitespace-nowrap text-sm font-bold text-slate-900 sm:text-base">
                    Buscar registro:
                </label>

                <input type="text" id="search" placeholder="Buscar registro..." wire:model.live="search"
                    class="w-full rounded-full border border-amber-900 bg-white px-4 py-1.5 text-sm text-slate-900 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 sm:w-72">
            </div>

            <a href="{{ route('registroprima') }}"
                class="self-end rounded-xl border border-amber-900 bg-[#FFD600] px-8 py-2 font-bold text-slate-950 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)] transition-all hover:bg-amber-400 active:translate-y-0.5 sm:self-auto">
                Agregar nuevo
            </a>
        </div>

        {{-- Tabla de materia prima --}}
        <div class="overflow-x-auto rounded-lg border border-amber-900 bg-[#F5D477]">
            <table class="w-full min-w-[700px] border-collapse text-left">
                <thead>
                    <tr
                        class="divide-x divide-amber-900 border-b border-amber-900 bg-[#D99B00] text-xs font-bold text-slate-950 sm:text-sm">
                        <th class="p-2 sm:p-3">Folio</th>
                        <th class="p-2 sm:p-3">Nombre</th>
                        <th class="p-2 sm:p-3">Stock (dm)</th>
                        <th class="p-2 sm:p-3">Stock mínimo</th>
                        <th class="p-2 sm:p-3">Ubicación</th>
                        <th class="p-2 text-center sm:p-3">Acciones</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-amber-900">
                    @forelse ($materiaPrima as $dato)
                        <tr
                            class="h-12 divide-x divide-amber-900 bg-[#F5D477] text-xs font-medium text-slate-900 transition-colors hover:bg-[#ebd083] sm:text-sm">
                            <td class="p-2"> {{ $dato->folio }} </td>
                            <td class="p-2"> {{ $dato->nombre }} </td>
                            <td class="p-2">
                                <div class="flex items-center gap-2">
                                    <span
                                        class="{{ $dato->stock_real_dm <= $dato->stock_minimo ? 'text-red-700 font-extrabold' : 'text-slate-900' }}">
                                        {{ $dato->stock_real_dm }}
                                    </span>

                                    @if ($dato->stock_real_dm <= $dato->stock_minimo)
                                        <span
                                            class="inline-flex items-center gap-1 rounded-full bg-red-600 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider text-white shadow-sm animate-pulse">
                                            <svg class="h-3 w-3 text-white" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Stock Bajo
                                        </span>
                                    @endif

                                </div>
                            </td>
                            <td class="p-2"> {{ $dato->stock_minimo }} </td>
                            <td class="p-2"> {{ $dato->ubicacion }} </td>
                            <td class="p-2 sm:p-3">
                                <div class="flex items-center justify-center gap-2">
                                    <a href=" {{ route('EditarMateriaPrima', $dato->id) }} "
                                        class="inline-block rounded-md border border-slate-900 bg-[#00FF00] px-3 py-1 text-center text-xs font-bold text-slate-950 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] transition-all hover:bg-green-400">
                                        Modificar
                                    </a>

                                    <button type="button" wire:click="desactivar({{ $dato->id }})"
                                        wire:confirm="¿Estás seguro de que deseas eliminar este registro?"
                                        class="rounded-md border border-slate-900 bg-[#FF0000] px-3 py-1 text-xs font-bold text-white shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] transition-all hover:bg-red-600">
                                        Eliminar
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-4 text-center text-sm font-bold text-slate-900 bg-[#F5D477]">
                                No se encontraron registros.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $materiaPrima->links() }}
        </div>
    </main>
</div>

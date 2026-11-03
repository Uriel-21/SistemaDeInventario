<div class="font-['Raleway'] text-slate-950">
    {{-- Carga de fuentes/CDN si aún no están incluidas en el layout --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <livewire:layouts.header title="Producto terminado" subtitle="Datos generales del producto terminado" />

    <livewire:layouts.menu />

    <main
        class="mx-2 my-2 overflow-hidden border border-gray-600 bg-white font-['Raleway'] text-slate-950 sm:mx-4 sm:my-4">

        <div class="p-3 sm:px-7 sm:py-5">
            {{-- Buscador y botón --}}
            <div class="flex items-center justify-between mb-4">

                <div class="relative w-full max-w-sm">
                    <input type="text" placeholder="Buscar modelo..." wire:model.live="search"
                        class="w-full rounded border border-slate-900 bg-gray-200 py-2 pl-3 pr-10 text-sm focus:outline-none">

                    <svg class="absolute right-3 top-2.5 h-4 w-4 text-slate-800" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                <!-- Botón Agregar nuevo -->
                <a href="{{ route('agregarmodelo') }}" type="button"
                    class="rounded border border-slate-900 bg-[#FFD700] px-4 py-2 text-sm font-medium text-slate-900 shadow-sm transition hover:bg-yellow-400">
                    Agregar nuevo
                </a>
            </div>

            {{-- Tabla --}}
            <div class="overflow-x-auto rounded border border-gray-700">
                <table class="w-full min-w-[700px] border-collapse text-left">
                    <thead>
                        <tr
                            class="divide-x divide-gray-500 border-b border-gray-700 bg-gray-200 text-center text-xs text-slate-800 sm:text-sm">
                            <th class="px-2 py-2 font-medium">Código</th>
                            <th class="px-2 py-2 font-medium">Nombre del modelo</th>
                            <th class="px-2 py-2 font-medium">Talla</th>
                            <th class="px-2 py-2 font-medium">Stock total</th>
                            <th class="px-2 py-2 font-medium">Stock mínimo</th>
                            <th class="px-2 py-2 font-medium">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($productosTerminados as $productoTerminado)
                            <tr
                                class="divide-x divide-gray-500 border-b border-gray-500 bg-gray-100 text-sm text-slate-900">
                                <td class="p-2"> {{ $productoTerminado->codigo }} </td>
                                <td class="p-2"> {{ $productoTerminado->nombre_modelo }} </td>
                                <td class="p-2"> {{ $productoTerminado->talla }} </td>
                                <td class="p-2">
                                    <div class="flex items-center gap-2">
                                        <span
                                            class="{{ $productoTerminado->stock_total <= $productoTerminado->stock_minimo ? 'text-red-700 font-extrabold' : 'text-slate-900' }}">
                                            {{ $productoTerminado->stock_total }}
                                        </span>

                                        @if ($productoTerminado->stock_total <= $productoTerminado->stock_minimo)
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
                                <td class="p-2"> {{ $productoTerminado->stock_minimo }} </td>
                                <td class="p-2">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <a href=" {{ route('modelo.edit', $productoTerminado->id) }} " type="button"
                                            class="rounded-md border border-slate-900 bg-[#8BD044] px-2.5 py-1.5 text-[10px] font-medium text-slate-950 shadow-sm transition hover:bg-green-400 sm:px-3 sm:text-xs">
                                            Modificar
                                        </a>

                                        <button type="button" wire:click="desactivar({{ $productoTerminado->id }})"
                                            wire:confirm="¿Estás seguro de que deseas eliminar este registro?"
                                            class="rounded-md border border-slate-900 bg-[#E34B4B] px-2.5 py-1.5 text-[10px] font-medium text-slate-950 shadow-sm transition hover:bg-red-400 sm:px-3 sm:text-xs">
                                            Eliminar
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="bg-white py-8 text-center text-sm text-slate-500">
                                    No se encontraron registros.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $productosTerminados->links() }}
            </div>
    </main>
</div>
</main>
</div>

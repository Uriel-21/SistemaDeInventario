<div>
    {{-- Carga de fuentes/CDN si aún no están incluidas en el layout --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <livewire:layouts.header title="Registrar nuevo lote" subtitle="Registro de un nuevo lote de producto terminado" />

    <livewire:layouts.menu />
    <main class="mx-2 my-2 overflow-hidden bg-white font-['Raleway'] text-slate-950 sm:mx-4 sm:my-4">
        <div class="p-4 sm:p-10">
            <form wire:submit.prevent="save"
                class="mx-auto w-full max-w-md rounded-lg border-2 border-gray-700 bg-gray-100 p-4 sm:p-5">
                @if (session()->has('success'))
                    <div
                        class="mb-4 rounded-md border-2 border-slate-900 bg-[#8BD044]/80 p-3 text-sm font-semibold text-slate-900 shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session()->has('error'))
                    <div
                        class="mb-4 rounded-md border-2 border-slate-900 bg-[#E34B4B]/80 p-3 text-sm font-semibold text-slate-900 shadow-sm">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="space-y-3">

                    <div x-data="{ open: false }" class="relative">
                        <label for="buscar_modelo" class="mb-1 block text-sm font-medium sm:text-base">
                            Buscar modelo:
                        </label>
                        <input type="search" id="buscar_modelo" autocomplete="off"
                            wire:model.live.debounce.300ms="search" @focus="open = true" @input="open = true"
                            class="h-8 w-full rounded-lg border-2 border-gray-700 bg-white px-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500">

                        @if (strlen($search) > 1 && $search !== $codigoSelect)
                            <div x-show="open" @click.outside="open = false" x-transition
                                class="absolute z-50 mt-1 w-full rounded-lg border-2 border-gray-700 bg-white shadow-lg">
                                <ul class="max-h-60 overflow-y-auto py-1">
                                    @forelse($modelos as $modelo)
                                        <li>
                                            <button type="button"
                                                wire:click="seleccionarModelo({{ $modelo->id }}, '{{ $modelo->nombre_modelo }}', '{{ $modelo->codigo }}', '{{ $modelo->talla }}')"
                                                @click="open = false"
                                                class="flex w-full items-center justify-between border-b border-gray-300 px-3 py-2 text-left transition last:border-0 hover:bg-gray-200">

                                                <div class="flex flex-col">
                                                    <span
                                                        class="text-sm font-bold text-slate-800">{{ $modelo->codigo }}</span>
                                                    <span class="text-xs text-slate-600">{{ $modelo->nombre_modelo }} -
                                                        Talla: {{ $modelo->talla }}</span>
                                                </div>

                                                <span
                                                    class="rounded-md border border-slate-900 bg-sky-500 px-2 py-1 text-[10px] font-bold text-slate-950 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)]">
                                                    Seleccionar
                                                </span>
                                            </button>
                                        </li>
                                    @empty
                                        <li class="px-3 py-2 text-center text-sm text-gray-500">
                                            No se encontraron modelos.
                                        </li>
                                    @endforelse
                                </ul>
                            </div>
                        @endif
                    </div>

                    <div>
                        <label for="nombre_modelo" class="mb-1 block text-sm font-medium sm:text-base">
                            Nombre modelo:
                        </label>
                        <input type="text" id="nombre_modelo" wire:model="nombreModeloSeleccionado" readonly
                            class="h-8 w-full cursor-not-allowed rounded-lg border-2 border-gray-700 bg-gray-200 px-3 text-sm text-slate-600 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>

                    <div>
                        <label for="talla" class="mb-1 block text-sm font-medium sm:text-base">
                            Talla:
                        </label>
                        <input type="text" id="talla" wire:model="tallaSelect" readonly
                            class="h-8 w-full max-w-28 cursor-not-allowed rounded-lg border-2 border-gray-700 bg-gray-200 px-3 text-sm text-slate-600 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>

                    <div>
                        <label for="cantidad" class="mb-1 block text-sm font-medium sm:text-base">
                            Cantidad:
                        </label>
                        <input type="number" id="cantidad" min="1" wire:model="form.cantidad"
                            class="h-8 w-full rounded-lg border-2 border-gray-700 bg-white px-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500">
                        @error('form.cantidad')
                            <span class="mt-1 block text-xs font-semibold text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mt-5 flex flex-col justify-center gap-3 sm:flex-row sm:gap-5">
                    <button type="button" wire:click="cancelarRegresar"
                        class="w-full rounded-md border-2 border-slate-900 bg-[#E34B4B] px-6 py-2 text-xs font-medium text-slate-950 shadow-sm transition hover:bg-red-400 sm:w-auto">
                        Cancelar
                    </button>

                    <button type="submit"
                        class="w-full rounded-md border-2 border-slate-900 bg-[#8BD044] px-6 py-2 text-xs font-medium text-slate-950 shadow-sm transition hover:bg-green-400 sm:w-auto">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>

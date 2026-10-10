<div>
    <!-- Carga de Fuentes / CDN si aplica -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <main
        class="mx-3 my-5 overflow-hidden rounded-2xl border border-amber-900 bg-white shadow-sm sm:mx-6 sm:my-8 md:mx-10 lg:mx-12">

        {{-- Encabezado --}}
        {{-- <div class="bg-[#D99B00] px-5 py-5 text-slate-950 sm:px-6">
        <h1 class="text-xl font-bold sm:text-2xl">Ajuste de inventario</h1>
        <p class="mt-1 text-base font-medium sm:text-lg">
            Datos generales para ajustar el inventario
        </p>
    </div> --}}

        {{-- Hice esta corrección we por que no tenía el header y menu  --}}
        {{-- Nuevo header refactoizado --}}
        <livewire:layouts.header title="Ajuste de inventario" subtitle="Datos generales para ajustar el inventario" />

        {{-- Nuevo menu refactorizado --}}
        <livewire:layouts.menu />

        <div class="p-4 sm:p-8">
            @if (session()->has('success'))
                <div
                    class="mb-6 rounded-2xl border border-green-800 bg-green-100 p-4 text-sm font-bold text-green-900 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)]">
                    {{ session('success') }}
                </div>
            @endif
            @if (session()->has('error'))
                <div
                    class="mb-6 rounded-2xl border border-red-800 bg-red-100 p-4 text-sm font-bold text-red-900 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)]">
                    {{ session('error') }}
                </div>
            @endif
            {{-- Formulario visual --}}
            <form wire:submit.prevent="save"
                class="mx-auto max-w-md rounded-2xl border border-gray-500 bg-white p-5 sm:p-7">

                <div class="space-y-5">
                    {{-- Búsqueda de materia prima --}}
                    <div x-data="{ open: false }" class="relative">
                        <label for="buscar_material" class="mb-1 block text-sm font-medium text-slate-800">
                            Buscar material y seleccionar
                        </label>

                        <div class="relative">
                            <input type="search" id="buscar_material" wire:model.live.debounce.300ms="search"
                                @focus="open = true" @input="open = true" placeholder="Buscar material..."
                                {{-- Cambiamos el placeholder si ya hay algo seleccionado --}}
                                x-bind:placeholder="$wire.nombreMaterialSeleccionado ? $wire.nombreMaterialSeleccionado :
                                    'Buscar material...'"
                                class="w-full rounded-md border border-gray-400 bg-white px-3 py-2 pr-10 text-sm text-slate-900 shadow-inner placeholder:text-gray-500 focus:border-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-200">

                            <svg class="pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-600"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m21 21-4.35-4.35M19 10.5a8.5 8.5 0 1 1-17 0 8.5 8.5 0 0 1 17 0Z" />
                            </svg>
                        </div>

                        {{-- Resultados de búsqueda flotantes --}}
                        @if (strlen($search) > 1)
                            <div x-show="open" @click.outside="open = false"
                                class="absolute z-50 w-full mt-1 rounded-md border border-gray-400 bg-white shadow-lg"
                                x-transition>
                                <ul class="max-h-60 overflow-y-auto py-1">
                                    @forelse($materiaPrima as $material)
                                        <li>
                                            <button type="button"
                                                wire:click="seleccionarMaterial({{ $material->id }}, '{{ $material->nombre }}')"
                                                @click="open = false"
                                                class="flex w-full items-center justify-between gap-3 px-3 py-2 text-left transition hover:bg-amber-100">
                                                <span class="text-sm text-slate-800">{{ $material->nombre }}</span>
                                                <span
                                                    class="rounded-md border border-slate-900 bg-sky-500 px-3 py-1 text-xs font-bold text-slate-950 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)]">
                                                    Seleccionar
                                                </span>
                                            </button>
                                        </li>
                                    @empty
                                        <li class="px-3 py-2 text-sm text-gray-500 text-center">
                                            No se encontró ningún material.
                                        </li>
                                    @endforelse
                                </ul>
                            </div>
                        @endif

                        {{-- Indicador visual de que el material ya fue seleccionado --}}
                        @if ($nombreMaterialSeleccionado)
                            <div class="mt-2 flex items-center gap-2 text-sm font-semibold text-green-700">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                Seleccionado: {{ $nombreMaterialSeleccionado }}
                            </div>
                        @endif
                    </div>

                    {{-- Tipo de ajuste --}}
                    <div>
                        <label for="tipo_ajuste" class="mb-2 block text-base font-medium text-slate-800">
                            Tipo de ajuste
                        </label>
                        <select id="tipo_ajuste" name="tipo_ajuste" wire:model='form.tipo_ajuste'
                            class="w-full rounded-xl border border-gray-500 bg-white px-3 py-2 text-sm text-slate-800 shadow-inner focus:border-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-200">
                            <option value="" disabled selected>Seleccione un tipo...</option>
                            <option value="aumentar">Aumento</option>
                            <option value="disminuir">Disminución</option>
                        </select>
                    </div>

                    {{-- Cantidad --}}
                    <div>
                        <label for="cantidad" class="mb-2 block text-base font-medium text-slate-800">
                            Cantidad (dm)
                        </label>
                        <input type="number" id="cantidad" name="cantidad" min="0"
                            wire:model='form.cantidad_dm'
                            class="w-full rounded-xl border border-gray-500 bg-white px-3 py-2 text-sm text-slate-900 shadow-inner focus:border-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-200">
                        @error('form.cantidad_dm')
                            <span class="mt-1 block text-sm font-semibold text-red-500">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    {{-- Motivo --}}
                    <div>
                        <label for="motivo" class="mb-2 block text-base font-medium text-slate-800">
                            Motivo
                        </label>
                        <textarea id="motivo" name="motivo" rows="4" wire:model='form.motivo'
                            class="w-full resize-y rounded-xl border border-gray-500 bg-white px-3 py-2 text-sm text-slate-900 shadow-inner focus:border-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-200"></textarea>
                    </div>
                </div>
                {{-- Botones visuales --}}
                <div class="mx-auto mt-4 flex max-w-md flex-col justify-center gap-3 sm:flex-row sm:gap-5">
                    <button type="submit"
                        class="rounded-lg border border-amber-900 bg-[#FFD600] px-6 py-3 font-bold text-slate-950 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)] transition hover:bg-amber-400 active:translate-y-0.5">
                        Subir al sistema
                    </button>

                    <button type=" {{ route('vistaajusteinventario') }} "
                        class="rounded-lg border border-red-800 bg-[#FF0000] px-8 py-3 font-bold text-white shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)] transition hover:bg-red-600 active:translate-y-0.5">
                        Cancelar
                    </button>
                </div>
                <hr>
            </form>
        </div>
    </main>
</div>

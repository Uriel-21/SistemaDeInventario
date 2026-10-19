<div>
    {{-- Carga de fuentes/CDN si aún no están incluidas en el layout --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <livewire:layouts.header title="Agregar nuevo modelo" subtitle="Creación de un nuevo modelo" />

    <livewire:layouts.menu />

    <main class="mx-2 my-2 overflow-hidden bg-white font-['Raleway'] text-slate-950 sm:mx-4 sm:my-4">

        {{-- Formulario --}}
        <div class="p-4 sm:p-6">
            <form wire:submit.prevent="save"
                class="mx-auto w-full max-w-md rounded-lg border-2 border-gray-700 bg-gray-100 p-4 sm:p-5">
                <div class="space-y-3">
                    <div>
                        <label for="codigo" class="mb-1 block text-sm font-medium sm:text-base">
                            Código:
                        </label>
                        <input type="text" id="codigo" name="codigo" wire:model="form.codigo"
                            class="h-8 w-full rounded-lg border-2 border-gray-700 bg-white px-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500">
                        @error('form.codigo')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="nombre_modelo" class="mb-1 block text-sm font-medium sm:text-base">
                            Nombre modelo:
                        </label>
                        <input type="text" id="nombre_modelo" name="nombre_modelo" wire:model="form.nombre_modelo"
                            class="h-8 w-full rounded-lg border-2 border-gray-700 bg-white px-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500">
                        @error('form.nombre_modelo')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="talla" class="mb-1 block text-sm font-medium sm:text-base">
                            Talla:
                        </label>
                        <input type="text" id="talla" name="talla" wire:model="form.talla"
                            class="h-8 w-full max-w-28 rounded-lg border-2 border-gray-700 bg-white px-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500">
                        @error('form.talla')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="stock_minimo" class="mb-1 block text-sm font-medium sm:text-base">
                            Stock mínimo:
                        </label>
                        <input type="number" id="stock_minimo" name="stock_minimo" min="0"
                            wire:model="form.stock_minimo"
                            class="h-8 w-full rounded-lg border-2 border-gray-700 bg-white px-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500">
                        @error('form.stock_minimo')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Botones --}}
                <div class="mt-5 flex flex-col justify-center gap-3 sm:flex-row sm:gap-5">
                    <button type="button"
                        class="w-full rounded-md border-2 border-slate-900 bg-[#E34B4B] px-6 py-2 text-xs font-semibold text-slate-950 shadow-sm transition hover:bg-red-400 sm:w-auto">
                        Cancelar
                    </button>

                    <button type="submit"
                        class="w-full rounded-md border-2 border-slate-900 bg-[#8BD044] px-6 py-2 text-xs font-semibold text-slate-950 shadow-sm transition hover:bg-green-400 sm:w-auto">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>

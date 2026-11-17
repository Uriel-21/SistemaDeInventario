<div>
    <!-- Carga de Fuentes / CDN si aplica -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Header y Menú afuera del main para abarcar todo el ancho --}}
    <livewire:layouts.header title="Ajuste de inventario de producto terminado"
        subtitle="Ingrese o escanee el código de barras del lote para ajustar sus existencias" />

    <livewire:layouts.menu />

    <main class="mx-2 my-2 overflow-hidden bg-white font-['Raleway'] text-slate-950 sm:mx-4 sm:my-4">
        <div class="p-4 sm:p-8">

            {{-- Alertas con auto-cierre de 2-4 segundos --}}
            <div class="mx-auto w-full max-w-md">
                @if (session()->has('success'))
                    <div wire:key="success-{{ now()->timestamp }}" x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)"
                        x-show="show" x-transition.opacity.duration.300ms
                        class="mb-4 rounded-lg border-2 border-green-700 bg-green-100 p-3 text-sm font-bold text-green-800">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session()->has('error'))
                    <div wire:key="error-{{ now()->timestamp }}" x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)"
                        x-show="show" x-transition.opacity.duration.300ms
                        class="mb-4 rounded-lg border-2 border-red-700 bg-red-100 p-3 text-sm font-bold text-red-800">
                        {{ session('error') }}
                    </div>
                @endif
            </div>

            {{-- Formulario estilo imagen 2 --}}
            <form wire:submit.prevent="save"
                class="mx-auto w-full max-w-md rounded-lg border-2 border-gray-700 bg-gray-100 p-4 sm:p-6">

                <div class="space-y-4">
                    {{-- Código de Barras del Lote --}}
                    <div>
                        <label for="codigo_barras" class="mb-1 block text-sm font-medium text-slate-900">
                            Código de barras del lote:
                        </label>
                        <div class="relative">
                            <input type="text" id="codigo_barras" wire:model="form.codigo_barras" autofocus
                                placeholder="Escanee con la pistola o escriba el código..."
                                class="h-10 w-full rounded-lg border-2 border-gray-700 bg-white px-3 pr-10 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-amber-500">

                            <svg class="pointer-events-none absolute right-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-600"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 7V5a2 2 0 012-2h2m10 0h2a2 2 0 012 2v2m0 10v2a2 2 0 01-2 2h-2M7 21H5a2 2 0 01-2-2v-2M7 9h10M7 12h10M7 15h10" />
                            </svg>
                        </div>
                        @error('form.codigo_barras')
                            <span class="mt-1 block text-xs font-semibold text-red-600">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    {{-- Tipo de ajuste --}}
                    <div>
                        <label for="tipo_ajuste" class="mb-1 block text-sm font-medium text-slate-900">
                            Tipo de ajuste:
                        </label>
                        <select id="tipo_ajuste" name="tipo_ajuste" wire:model="form.tipo_ajuste"
                            class="h-10 w-full rounded-lg border-2 border-gray-700 bg-white px-3 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-amber-500">
                            <option value="" disabled selected>Seleccione un tipo...</option>
                            <option value="aumentar">Aumento (+)</option>
                            <option value="disminuir">Disminución (-)</option>
                        </select>
                        @error('form.tipo_ajuste')
                            <span class="mt-1 block text-xs font-semibold text-red-600">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    {{-- Cantidad (piezas) --}}
                    <div>
                        <label for="cantidad" class="mb-1 block text-sm font-medium text-slate-900">
                            Cantidad (piezas):
                        </label>
                        <input type="number" id="cantidad" name="cantidad" min="1" wire:model="form.cantidad"
                            class="h-10 w-full rounded-lg border-2 border-gray-700 bg-white px-3 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-amber-500">
                        @error('form.cantidad')
                            <span class="mt-1 block text-xs font-semibold text-red-600">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    {{-- Motivo --}}
                    <div>
                        <label for="motivo" class="mb-1 block text-sm font-medium text-slate-900">
                            Motivo:
                        </label>
                        <textarea id="motivo" name="motivo" rows="3" wire:model="form.motivo"
                            placeholder="Escriba la razón del ajuste (ej. Merma, empaque dañado, recuento)..."
                            class="w-full resize-y rounded-lg border-2 border-gray-700 bg-white px-3 py-2 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-amber-500"></textarea>
                        @error('form.motivo')
                            <span class="mt-1 block text-xs font-semibold text-red-600">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- Botones estilo imagen 2 --}}
                <div class="mt-6 flex flex-col justify-center gap-3 sm:flex-row sm:gap-5">
                    <a href="{{ route('historialAjusteProductoTerminado.show') }}" wire:navigate
                        class="inline-flex w-full items-center justify-center rounded-md border-2 border-slate-900 bg-[#E34B4B] px-6 py-2 text-xs font-bold text-slate-950 shadow-sm transition hover:bg-red-400 sm:w-auto">
                        Cancelar
                    </a>

                    <button type="submit"
                        class="w-full rounded-md border-2 border-slate-900 bg-[#8BD044] px-6 py-2 text-xs font-bold text-slate-950 shadow-sm transition hover:bg-green-400 sm:w-auto">
                        Subir al sistema
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>

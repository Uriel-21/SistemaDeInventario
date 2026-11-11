<div>
    <div>
        <!-- Carga de Fuentes / CDN si aplica -->
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap"
            rel="stylesheet">

        <main
            class="mx-3 my-5 overflow-hidden rounded-2xl border border-amber-900 bg-white shadow-sm sm:mx-6 sm:my-8 md:mx-10 lg:mx-12">

            {{-- Header y Menú refactorizados --}}
            <livewire:layouts.header title="Ajuste de inventario de producto terminado"
                subtitle="Ingrese o escanee el código de barras del lote para ajustar sus existencias" />

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
                        {{-- Código de Barras del Lote --}}
                        <div>
                            <label for="codigo_barras" class="mb-2 block text-base font-medium text-slate-800">
                                Código de barras del lote
                            </label>
                            <div class="relative">
                                <input type="text" id="codigo_barras" wire:model="form.codigo_barras" autofocus
                                    placeholder="Escanee con la pistola o escriba el código..."
                                    class="w-full rounded-xl border border-gray-500 bg-white px-3 py-2 pr-10 text-sm text-slate-900 shadow-inner placeholder:text-gray-400 focus:border-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-200">

                                <svg class="pointer-events-none absolute right-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-500"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 7V5a2 2 0 012-2h2m10 0h2a2 2 0 012 2v2m0 10v2a2 2 0 01-2 2h-2M7 21H5a2 2 0 01-2-2v-2M7 9h10M7 12h10M7 15h10" />
                                </svg>
                            </div>
                            @error('form.codigo_barras')
                                <span class="mt-1 block text-sm font-semibold text-red-500">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        {{-- Tipo de ajuste --}}
                        <div>
                            <label for="tipo_ajuste" class="mb-2 block text-base font-medium text-slate-800">
                                Tipo de ajuste
                            </label>
                            <select id="tipo_ajuste" name="tipo_ajuste" wire:model="form.tipo_ajuste"
                                class="w-full rounded-xl border border-gray-500 bg-white px-3 py-2 text-sm text-slate-800 shadow-inner focus:border-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-200">
                                <option value="" disabled selected>Seleccione un tipo...</option>
                                <option value="aumentar">Aumento (+)</option>
                                <option value="disminuir">Disminución (-)</option>
                            </select>
                            @error('form.tipo_ajuste')
                                <span class="mt-1 block text-sm font-semibold text-red-500">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        {{-- Cantidad (piezas) --}}
                        <div>
                            <label for="cantidad" class="mb-2 block text-base font-medium text-slate-800">
                                Cantidad (piezas)
                            </label>
                            <input type="number" id="cantidad" name="cantidad" min="1"
                                wire:model="form.cantidad"
                                class="w-full rounded-xl border border-gray-500 bg-white px-3 py-2 text-sm text-slate-900 shadow-inner focus:border-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-200">
                            @error('form.cantidad')
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
                            <textarea id="motivo" name="motivo" rows="4" wire:model="form.motivo"
                                placeholder="Escriba la razón del ajuste (ej. Merma, empaque dañado, recuento)..."
                                class="w-full resize-y rounded-xl border border-gray-500 bg-white px-3 py-2 text-sm text-slate-900 shadow-inner focus:border-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-200"></textarea>
                            @error('form.motivo')
                                <span class="mt-1 block text-sm font-semibold text-red-500">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Botones visuales --}}
                    <div class="mx-auto mt-6 flex max-w-md flex-col justify-center gap-3 sm:flex-row sm:gap-5">
                        <button type="submit"
                            class="rounded-lg border border-amber-900 bg-[#FFD600] px-6 py-3 font-bold text-slate-950 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)] transition hover:bg-amber-400 active:translate-y-0.5">
                            Subir al sistema
                        </button>

                        <a href="{{ route('historialAjusteProductoTerminado.show') }}" wire:navigate
                            class="inline-flex justify-center items-center rounded-lg border border-red-800 bg-[#FF0000] px-8 py-3 font-bold text-white shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)] transition hover:bg-red-600 active:translate-y-0.5">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>

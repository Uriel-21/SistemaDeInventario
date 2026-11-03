<div>
    {{-- Carga de fuentes/CDN si aún no están incluidas en el layout --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <livewire:layouts.header title="Registrar nueva salida" subtitle="Registro de una nueva salida de producto" />

    <livewire:layouts.menu />

    <main class="mx-2 my-2 overflow-hidden bg-white font-['Raleway'] text-slate-950 sm:mx-4 sm:my-4">

        {{-- Alertas de éxito y error --}}
        <div class="mx-auto w-full max-w-md px-4 sm:px-0">
            @if (session()->has('success'))
                <div
                    class="mb-4 rounded-lg border-2 border-green-700 bg-green-100 p-3 text-sm font-bold text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="mb-4 rounded-lg border-2 border-red-700 bg-red-100 p-3 text-sm font-bold text-red-800">
                    {{ session('error') }}
                </div>
            @endif
        </div>

        {{-- Formulario --}}
        <div class="p-4 sm:p-8">
            <form wire:submit.prevent="save"
                class="mx-auto w-full max-w-md rounded-lg border-2 border-gray-700 bg-gray-100 p-4 sm:p-5">
                <div class="space-y-4">

                    {{-- Campo para la pistola de escáner --}}
                    <div>
                        <label for="codigo_barras" class="mb-1 block text-sm font-bold">
                            Código de barras del lote:
                        </label>
                        <input type="text" id="codigo_barras" wire:model="form.codigo_barras" autofocus
                            placeholder="Escanea el código aquí..."
                            class="h-10 w-full rounded-lg border-2 border-gray-700 bg-white px-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500">
                        @error('form.codigo_barras')
                            <span class="mt-1 block text-xs font-semibold text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Campo del cliente --}}
                    <div>
                        <label for="cliente" class="mb-1 block text-sm font-bold">
                            Cliente destino:
                        </label>
                        <input type="text" id="cliente" wire:model="form.cliente"
                            placeholder="Nombre del cliente o empresa"
                            class="h-10 w-full rounded-lg border-2 border-gray-700 bg-white px-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500">
                        @error('form.cliente')
                            <span class="mt-1 block text-xs font-semibold text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Botones --}}
                <div class="mt-6 flex flex-col justify-center gap-3 sm:flex-row sm:gap-5">
                    <!-- CORRECCIÓN AQUÍ: Usamos form.reset() -->
                    <button type="button" wire:click="form.reset()"
                        class="w-full rounded-md border-2 border-slate-900 bg-[#E34B4B] px-6 py-2 text-xs font-bold text-slate-950 shadow-sm transition hover:bg-red-400 sm:w-auto">
                        Limpiar
                    </button>

                    <button type="submit"
                        class="w-full rounded-md border-2 border-slate-900 bg-[#8BD044] px-6 py-2 text-xs font-bold text-slate-950 shadow-sm transition hover:bg-green-400 sm:w-auto">
                        Registrar Salida
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>

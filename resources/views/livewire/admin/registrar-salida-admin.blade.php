<div>
    {{-- Carga de fuentes/CDN si aún no están incluidas en el layout --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <livewire:layouts.header
        title="Registrar nueva salida"
        subtitle="Registro de una nueva salida de producto"
    />

    <livewire:layouts.menu />

    <main class="mx-2 my-2 overflow-hidden bg-white font-['Raleway'] text-slate-950 sm:mx-4 sm:my-4">

    {{-- Formulario --}}
    <div class="p-4 sm:p-8">
        <form class="mx-auto w-full max-w-md rounded-lg border-2 border-gray-700 bg-gray-100 p-4 sm:p-5">
            <div class="space-y-3">
                <div>
                    <label for="buscar_usuario" class="mb-1 block text-sm font-medium">
                        Buscar usuario:
                    </label>
                    <input
                        type="search"
                        id="buscar_usuario"
                        name="buscar_usuario"
                        class="h-8 w-full rounded-lg border-2 border-gray-700 bg-white px-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500"
                    >
                </div>

                <div>
                    <label for="buscar_producto" class="mb-1 block text-sm font-medium">
                        Buscar producto:
                    </label>
                    <input
                        type="search"
                        id="buscar_producto"
                        name="buscar_producto"
                        class="h-8 w-full rounded-lg border-2 border-gray-700 bg-white px-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500"
                    >
                </div>

                <div>
                    <label for="numero_lote" class="mb-1 block text-sm font-medium">
                        Buscar número de lote:
                    </label>
                    <input
                        type="search"
                        id="numero_lote"
                        name="numero_lote"
                        class="h-8 w-full rounded-lg border-2 border-gray-700 bg-white px-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500"
                    >
                </div>

                <div>
                    <label for="cliente" class="mb-1 block text-sm font-medium">
                        Cliente:
                    </label>
                    <input
                        type="text"
                        id="cliente"
                        name="cliente"
                        class="h-8 w-full rounded-lg border-2 border-gray-700 bg-white px-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500"
                    >
                </div>
            </div>

            {{-- Botones --}}
            <div class="mt-5 flex flex-col justify-center gap-3 sm:flex-row sm:gap-5">
                <button
                    type="button"
                    class="w-full rounded-md border-2 border-slate-900 bg-[#E34B4B] px-6 py-2 text-xs font-medium text-slate-950 shadow-sm transition hover:bg-red-400 sm:w-auto"
                >
                    Cancelar
                </button>

                <button
                    type="button"
                    class="w-full rounded-md border-2 border-slate-900 bg-[#8BD044] px-6 py-2 text-xs font-medium text-slate-950 shadow-sm transition hover:bg-green-400 sm:w-auto"
                >
                    Guardar
                </button>
            </div>
        </form>
    </div>
</main>
</div>

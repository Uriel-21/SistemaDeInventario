<div>
    <!-- Carga de Fuentes / CDN si aplica -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Nuevo header refactoizado --}}
    <livewire:layouts.header title="Control de Matria Prima" subtitle="Datos generales del lote" />

    {{-- Nuevo menu refactorizado --}}
    <livewire:layouts.menu />

    <main class="mx-3 my-5 rounded-2xl border border-amber-900 bg-white p-4 shadow-sm sm:mx-6 sm:my-8 sm:p-6 md:mx-10 md:p-8 lg:mx-12">

    {{-- Formulario visual --}}
    <form class="rounded-xl border border-gray-400 bg-white p-4 sm:p-6">
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 md:gap-10">

            {{-- Columna izquierda --}}
            <div class="space-y-4">
                <div>
                    <label for="buscar_material" class="mb-1 block text-sm font-medium text-slate-800">
                        Buscar material y seleccionar
                    </label>

                    <div class="relative">
                        <input
                            type="search"
                            id="buscar_material"
                            placeholder="Buscar material..."
                            class="w-full rounded-md border border-gray-400 bg-white px-3 py-2 pr-10 text-sm text-slate-900 shadow-inner placeholder:text-gray-500 focus:border-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-200"
                        >

                        <svg
                            class="pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-600"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            aria-hidden="true"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m21 21-4.35-4.35M19 10.5a8.5 8.5 0 1 1-17 0 8.5 8.5 0 0 1 17 0Z" />
                        </svg>
                    </div>

                    {{-- Resultados de búsqueda: se mostrarán al conectar la búsqueda --}}
                    <div class="mt-2 hidden rounded-md border border-gray-400 bg-white shadow-sm">
                        <button
                            type="button"
                            class="flex w-full items-center justify-between gap-3 rounded-md px-3 py-2 text-left transition hover:bg-amber-100"
                        >
                            <span class="text-sm text-slate-800">Carnaza XXX</span>
                            <span class="rounded-md border border-slate-900 bg-sky-500 px-3 py-1 text-xs font-bold text-slate-950 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)]">
                                Seleccionar
                            </span>
                        </button>
                    </div>
                </div>

                <div>
                    <label for="cantidad" class="mb-1 block text-sm font-medium text-slate-800">
                        Cantidad (dm)
                    </label>
                    <input
                        type="number"
                        id="cantidad"
                        name="cantidad"
                        min="0"
                        class="w-full rounded-md border border-gray-400 bg-white px-3 py-2 text-sm text-slate-900 shadow-inner focus:border-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-200"
                    >
                </div>

                <div>
                    <label for="proveedor" class="mb-1 block text-sm font-medium text-slate-800">
                        Proveedor
                    </label>
                    <input
                        type="text"
                        id="proveedor"
                        name="proveedor"
                        class="w-full rounded-md border border-gray-400 bg-white px-3 py-2 text-sm text-slate-900 shadow-inner focus:border-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-200"
                    >
                </div>
            </div>

            {{-- Columna derecha --}}
            <div class="space-y-4">
                <div>
                    <label for="evidencia" class="mb-1 block text-sm font-medium text-slate-800">
                        Evidencia / Foto
                    </label>

                    <label
                        for="evidencia"
                        class="flex h-36 cursor-pointer items-center justify-center rounded-md border-2 border-dashed border-gray-400 bg-gray-200 transition hover:bg-gray-300"
                    >
                        <div class="flex flex-col items-center text-gray-700">
                            <svg
                                class="h-12 w-12"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <rect x="3" y="4" width="18" height="16" rx="2" stroke-width="2" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="m5 17 5-5 3 3 2-2 4 4M8 9h.01" />
                            </svg>
                            <span class="mt-1 text-xs">Seleccionar imagen</span>
                        </div>
                    </label>

                    <input
                        type="file"
                        id="evidencia"
                        name="evidencia"
                        accept="image/*"
                        class="sr-only"
                    >
                </div>

                <div>
                    <label for="motivo" class="mb-1 block text-sm font-medium text-slate-800">
                        Motivo
                    </label>
                    <textarea
                        id="motivo"
                        name="motivo"
                        rows="4"
                        class="w-full resize-y rounded-md border border-gray-400 bg-white px-3 py-2 text-sm text-slate-900 shadow-inner focus:border-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-200"
                    ></textarea>
                </div>
            </div>
        </div>

        {{-- Botones visuales --}}
        <div class="mt-6 flex flex-col-reverse justify-end gap-3 sm:flex-row">
            <button
                type="button"
                class="rounded-md border border-amber-900 bg-[#FFD600] px-5 py-2 text-sm font-bold text-slate-950 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] transition hover:bg-amber-400 active:translate-y-0.5"
            >
                Subir al sistema
            </button>

            <button
                type="button"
                class="rounded-md border border-red-800 bg-[#FF0000] px-5 py-2 text-sm font-bold text-white shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] transition hover:bg-red-600 active:translate-y-0.5"
            >
                Cancelar
            </button>
        </div>
    </form>
    </main>
</div>

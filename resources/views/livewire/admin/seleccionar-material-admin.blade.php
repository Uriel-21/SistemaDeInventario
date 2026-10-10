<div>
    <!-- Carga de Fuentes / CDN si aplica -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Nuevo header refactoizado --}}
    <livewire:layouts.header title="Seleccionar el material" subtitle="Buscar, seleccionar y elegir la cantidad de material" />

    {{-- Nuevo menu refactorizado --}}
    <livewire:layouts.menu />

    <main class="mx-3 my-5 overflow-hidden rounded-2xl border border-amber-900 bg-white font-['Raleway'] text-slate-950 shadow-sm sm:mx-6 sm:my-8 md:mx-10 lg:mx-12">

    <div class="p-4 sm:p-6">
        {{-- Búsqueda --}}
        <div class="mb-4">
            <div class="relative w-full sm:max-w-md">
                <input
                    type="search"
                    placeholder="Buscar material..."
                    class="w-full border border-slate-900 bg-gray-200 px-3 py-2 pr-10 text-sm text-slate-900 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-500"
                >

                <svg
                    class="pointer-events-none absolute right-3 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-700"
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
        </div>

        {{-- Tabla de materiales --}}
        <div class="overflow-x-auto">
            <table class="w-full min-w-[600px] border-collapse text-left">
                <thead>
                    <tr class="divide-x divide-gray-400 border border-slate-900 bg-gray-200 text-center text-xs font-medium text-slate-800 sm:text-sm">
                        <th class="p-2 sm:p-3">Nombre del material</th>
                        <th class="p-2 sm:p-3">Cantidad disponible</th>
                        <th class="w-32 p-2 sm:p-3">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="h-40 divide-x divide-gray-400 border-x border-b border-slate-900 bg-gray-100 align-top text-sm text-slate-900 sm:h-52">
                        <td class="p-2 sm:p-3"></td>
                        <td class="p-2 sm:p-3"></td>
                        <td class="p-2 text-center sm:p-3">
                            <button
                                type="button"
                                class="rounded-md border border-slate-900 bg-sky-400 px-4 py-1.5 text-xs font-bold text-slate-950 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] transition hover:bg-sky-300"
                            >
                                Seleccionar
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Cantidades y estimado --}}
        <div class="mt-5 grid grid-cols-1 items-start gap-5 sm:grid-cols-2 sm:gap-8">
            <div class="space-y-4">
                <div>
                    <label for="cantidad_dm" class="mb-1 block text-sm font-medium text-slate-800">
                        Cantidad (dm):
                    </label>
                    <input
                        type="number"
                        id="cantidad_dm"
                        name="cantidad_dm"
                        min="0"
                        class="w-full max-w-48 rounded-md border border-slate-900 bg-gray-100 px-3 py-2 text-sm text-slate-900 shadow-inner focus:outline-none focus:ring-2 focus:ring-amber-500"
                    >
                </div>

                <div>
                    <label for="cantidad_unidad" class="mb-1 block text-sm font-medium text-slate-800">
                        Cantidad estimada por unidad:
                    </label>
                    <input
                        type="number"
                        id="cantidad_unidad"
                        name="cantidad_unidad"
                        min="0"
                        class="w-full max-w-48 rounded-md border border-slate-900 bg-gray-100 px-3 py-2 text-sm text-slate-900 shadow-inner focus:outline-none focus:ring-2 focus:ring-amber-500"
                    >
                </div>
            </div>

            <div class="mx-auto flex min-h-32 w-full max-w-xs flex-col items-center justify-center rounded-lg border-2 border-slate-700 bg-gray-200 p-4 text-center sm:min-h-36">
                <p class="text-base font-medium text-slate-800">Piezas estimadas</p>
                <p class="mt-3 text-4xl font-normal text-slate-950">XX</p>
            </div>
        </div>

        {{-- Acciones --}}
        <div class="mt-5 flex flex-col-reverse justify-end gap-3 sm:flex-row">
            <button
                type="button"
                class="rounded-md border border-slate-900 bg-[#F87171] px-6 py-2 text-sm font-bold text-slate-950 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] transition hover:bg-red-400"
            >
                Cancelar
            </button>

            <button
                type="button"
                class="rounded-md border border-slate-900 bg-[#8BD044] px-6 py-2 text-sm font-bold text-slate-950 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] transition hover:bg-green-400"
            >
                Guardar
            </button>
        </div>
    </div>
</main>
</div>

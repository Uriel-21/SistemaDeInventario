<div class="space-y-6">
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

        {{-- Buscador y botón --}}
        <div class="mb-6 flex flex-col items-stretch justify-between gap-4 sm:flex-row sm:items-center">
            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:gap-3">
                <label for="search" class="whitespace-nowrap text-sm font-bold text-slate-900 sm:text-base">
                    Buscar registro:
                </label>

                <input
                    type="text"
                    id="search"
                    placeholder="Buscar registro..."
                    class="w-full rounded-full border border-amber-900 bg-white px-4 py-1.5 text-sm text-slate-900 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 sm:w-72"
                >
            </div>

            <button
                type="button"
                class="self-end rounded-xl border border-amber-900 bg-[#FFD600] px-8 py-2 font-bold text-slate-950 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)] transition-all hover:bg-amber-400 active:translate-y-0.5 sm:self-auto"
            >
                Agregar nuevo
            </button>
        </div>

        {{-- Tabla de materia prima --}}
        <div class="overflow-x-auto rounded-lg border border-amber-900 bg-[#F5D477]">
            <table class="w-full min-w-[700px] border-collapse text-left">
                <thead>
                    <tr class="divide-x divide-amber-900 border-b border-amber-900 bg-[#D99B00] text-xs font-bold text-slate-950 sm:text-sm">
                        <th class="p-2 sm:p-3">Folio</th>
                        <th class="p-2 sm:p-3">Nombre</th>
                        <th class="p-2 sm:p-3">Stock (dm)</th>
                        <th class="p-2 sm:p-3">Stock mínimo</th>
                        <th class="p-2 sm:p-3">Ubicación</th>
                        <th class="p-2 text-center sm:p-3">Acciones</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-amber-900">
                    <tr class="h-12 divide-x divide-amber-900 bg-[#F5D477] text-xs font-medium text-slate-900 transition-colors hover:bg-[#ebd083] sm:text-sm">
                        <td class="p-2">MP-001</td>
                        <td class="p-2">Ejemplo de materia prima</td>
                        <td class="p-2">120</td>
                        <td class="p-2">20</td>
                        <td class="p-2">Almacén A</td>
                        <td class="p-2 sm:p-3">
                            <div class="flex items-center justify-center gap-2">
                                <button
                                    type="button"
                                    class="inline-block rounded-md border border-slate-900 bg-[#00FF00] px-3 py-1 text-center text-xs font-bold text-slate-950 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] transition-all hover:bg-green-400"
                                >
                                    Modificar
                                </button>

                                <button
                                    type="button"
                                    class="rounded-md border border-slate-900 bg-[#FF0000] px-3 py-1 text-xs font-bold text-white shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] transition-all hover:bg-red-600"
                                >
                                    Eliminar
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr class="h-12 divide-x divide-amber-900 bg-[#F5D477] text-xs font-medium text-slate-900 transition-colors hover:bg-[#ebd083] sm:text-sm">
                        <td class="p-2">MP-002</td>
                        <td class="p-2">Otro ejemplo</td>
                        <td class="p-2">80</td>
                        <td class="p-2">15</td>
                        <td class="p-2">Almacén B</td>
                        <td class="p-2 sm:p-3">
                            <div class="flex items-center justify-center gap-2">
                                <button
                                    type="button"
                                    class="inline-block rounded-md border border-slate-900 bg-[#00FF00] px-3 py-1 text-center text-xs font-bold text-slate-950 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] transition-all hover:bg-green-400"
                                >
                                    Modificar
                                </button>

                                <button
                                    type="button"
                                    class="rounded-md border border-slate-900 bg-[#FF0000] px-3 py-1 text-xs font-bold text-white shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] transition-all hover:bg-red-600"
                                >
                                    Eliminar
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Paginación visual --}}
        <div class="mt-6 flex items-center justify-center gap-2">
            <button type="button" class="rounded-xl border border-amber-900 bg-white px-4 py-2 text-sm font-bold text-slate-900 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)] transition-colors hover:bg-[#FFD600]">
                &laquo; Ant
            </button>

            <button type="button" class="rounded-xl border border-amber-900 bg-[#D99B00] px-4 py-2 text-sm font-black text-slate-950 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)]">
                1
            </button>

            <button type="button" class="rounded-xl border border-amber-900 bg-white px-4 py-2 text-sm font-bold text-slate-900 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)] transition-colors hover:bg-[#FFD600]">
                2
            </button>

            <button type="button" class="rounded-xl border border-amber-900 bg-white px-4 py-2 text-sm font-bold text-slate-900 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)] transition-colors hover:bg-[#FFD600]">
                Sig &raquo;
            </button>
        </div>
    </main>
</div>
<div>
    <!-- Carga de Fuentes / CDN si aplica -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Nuevo header refactoizado --}}
    <livewire:layouts.header title="Material adicional" subtitle="Agregue material si así lo requiere" />

    {{-- Nuevo menu refactorizado --}}
    <livewire:layouts.menu />

    <main class="mx-3 my-5 overflow-hidden rounded-2xl border border-amber-900 bg-white font-['Raleway'] text-slate-950 shadow-sm sm:mx-6 sm:my-8 md:mx-10 lg:mx-12">

    <div class="p-4 sm:p-6">
        {{-- Tabla --}}
        <div class="overflow-x-auto">
            <table class="w-full min-w-[650px] border-collapse text-left">
                <thead>
                    <tr class="divide-x divide-gray-400 border border-slate-900 bg-gray-200 text-center text-xs font-medium text-slate-800 sm:text-sm">
                        <th class="p-2 sm:p-3">Nombre completo</th>
                        <th class="p-2 sm:p-3">Material</th>
                        <th class="p-2 sm:p-3">Cantidad actual</th>
                        <th class="p-2 sm:p-3">Cantidad disponible</th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="h-40 divide-x divide-gray-400 border-x border-b border-slate-900 bg-gray-100 align-top text-sm text-slate-900 sm:h-52">
                        <td class="p-2 sm:p-3"></td>
                        <td class="p-2 sm:p-3"></td>
                        <td class="p-2 sm:p-3"></td>
                        <td class="p-2 sm:p-3"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Cantidad adicional --}}
        <div class="mt-5">
            <label for="cantidad_adicional" class="mb-2 block max-w-xs text-sm font-medium leading-tight text-slate-800">
                Ingrese la cantidad de<br class="hidden sm:block">
                material adicional:
            </label>
            <input
                type="number"
                id="cantidad_adicional"
                name="cantidad_adicional"
                min="0"
                class="w-full max-w-48 rounded-md border border-slate-900 bg-gray-100 px-3 py-2 text-sm text-slate-900 shadow-inner focus:outline-none focus:ring-2 focus:ring-amber-500"
            >
        </div>

        {{-- Acciones --}}
        <div class="mt-6 flex flex-col-reverse justify-end gap-3 sm:flex-row">
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

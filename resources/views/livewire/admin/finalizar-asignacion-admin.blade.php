<div>
    <!-- Carga de Fuentes / CDN si aplica -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Nuevo header refactoizado --}}
    <livewire:layouts.header title="Finalizar asignación" subtitle="Registro de finalización de asignación" />

    {{-- Nuevo menu refactorizado --}}
    <livewire:layouts.menu />

    <main class="mx-3 my-5 overflow-hidden rounded-2xl border border-amber-900 bg-white font-['Raleway'] text-slate-950 shadow-sm sm:mx-6 sm:my-8 md:mx-10 lg:mx-12">

    <div class="p-4 sm:p-6">
        {{-- Resumen del material --}}
        <div class="mb-4 overflow-x-auto">
            <table class="w-full min-w-[500px] border-collapse text-left">
                <thead>
                    <tr class="divide-x divide-gray-400 border border-slate-900 bg-gray-200 text-center text-xs font-medium text-slate-800 sm:text-sm">
                        <th class="p-2 sm:p-3">Nombre completo</th>
                        <th class="p-2 sm:p-3">Material</th>
                        <th class="p-2 sm:p-3">Cantidad (dm)</th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="h-16 divide-x divide-gray-400 border-x border-b border-slate-900 bg-gray-100 text-sm text-slate-900 sm:h-20">
                        <td class="p-2 sm:p-3"></td>
                        <td class="p-2 sm:p-3"></td>
                        <td class="p-2 sm:p-3"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Datos de finalización --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-6">

            {{-- Columna izquierda --}}
            <div class="space-y-3">
                <div class="flex max-w-sm items-center gap-4 rounded-lg border border-gray-500 bg-gray-100 px-3 py-2">
                    <span class="text-sm font-medium leading-tight text-slate-800">
                        Cantidad estimada por unidad:
                    </span>
                    <span class="text-sm font-bold text-slate-900">XX</span>
                </div>

                <div class="rounded-lg border border-gray-500 bg-gray-50 p-3">
                    <div class="flex flex-wrap items-center gap-2">
                        <input
                            type="checkbox"
                            id="sobro_material"
                            name="sobro_material"
                            class="h-4 w-4 rounded border-gray-500 text-amber-600 focus:ring-amber-500"
                        >
                        <label for="sobro_material" class="text-sm text-slate-800">
                            ¿Sobró material?
                        </label>

                        <input
                            type="number"
                            id="cantidad_sobrante"
                            name="cantidad_sobrante"
                            min="0"
                            placeholder="Cantidad"
                            aria-label="Cantidad de material sobrante"
                            class="ml-auto w-24 rounded-md border border-slate-900 bg-gray-100 px-2 py-1.5 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-amber-500"
                        >
                    </div>

                    <p class="mt-2 text-sm text-slate-800">Ingrese la cantidad (dm):</p>
                </div>

                <div>
                    <label for="tareas_realizadas" class="mb-1 block text-sm leading-tight text-slate-800">
                        Cantidad de tareas realizadas<br>
                        (25 unidades):
                    </label>
                    <input
                        type="number"
                        id="tareas_realizadas"
                        name="tareas_realizadas"
                        min="0"
                        class="w-full max-w-48 rounded-md border border-slate-900 bg-gray-100 px-3 py-2 text-sm text-slate-900 shadow-inner focus:outline-none focus:ring-2 focus:ring-amber-500"
                    >
                </div>
            </div>

            {{-- Rendimiento total --}}
            <div class="flex min-h-48 flex-col items-center justify-center rounded-lg border-2 border-slate-700 bg-gray-200 p-4 text-center sm:min-h-56">
                <p class="text-base font-medium text-slate-800 sm:text-lg">Rendimiento total</p>
                <p class="mt-3 text-4xl font-normal text-slate-950 sm:text-5xl">XX</p>
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
                Finalizar
            </button>
        </div>
    </div>
    </main>
</div>

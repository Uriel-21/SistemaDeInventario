<div
    x-data="{ crearAsignacion: false, paso: 1 }"
    @keydown.escape.window="crearAsignacion = false"
>
    {{-- Carga de fuentes/CDN si aún no están incluidas en el layout --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <livewire:layouts.header
        title="Asignaciones activas de material"
        subtitle="Datos generales de la asignación de material"
    />

    <livewire:layouts.menu />

    <main class="mx-3 my-5 overflow-hidden rounded-2xl border border-amber-900 bg-white font-['Raleway'] text-slate-950 shadow-sm sm:mx-6 sm:my-8 md:mx-10 lg:mx-12">

        {{-- Vista de asignaciones activas --}}
        <section x-show="!crearAsignacion" class="p-4 sm:p-6">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[650px] border-collapse text-left">
                    <thead>
                        <tr class="divide-x divide-gray-400 border-b border-gray-500 bg-gray-200 text-center text-xs font-semibold text-slate-800 sm:text-sm">
                            <th class="p-3">Nombre del cortador</th>
                            <th class="p-3">Material</th>
                            <th class="p-3">Cantidad (dm)</th>
                            <th class="p-3">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr class="h-48 divide-x divide-gray-400 bg-gray-300 align-top text-sm text-slate-900 sm:h-56">
                            <td class="p-3"></td>
                            <td class="p-3"></td>
                            <td class="p-3"></td>
                            <td class="p-3">
                                <div class="flex flex-col items-center justify-center gap-2 sm:flex-row">
                                    <button
                                        type="button"
                                        @click="crearAsignacion = true; paso = 3"
                                        class="rounded-md border border-slate-900 bg-[#F29B83] px-3 py-1.5 text-xs font-bold shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] transition hover:bg-[#ef866a]"
                                    >
                                        Material adicional
                                    </button>

                                    <button
                                        type="button"
                                        @click="crearAsignacion = true; paso = 4"
                                        class="rounded-md border border-slate-900 bg-[#36C6C8] px-3 py-1.5 text-xs font-bold shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] transition hover:bg-[#25b3b5]"
                                    >
                                        Finalizar asignación
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex flex-col-reverse justify-end gap-3 sm:flex-row">
                <button
                    type="button"
                    class="rounded-md border border-slate-900 bg-[#F87171] px-5 py-2 text-sm font-bold shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] transition hover:bg-red-400"
                >
                    Cancelar
                </button>

                <button
                    type="button"
                    @click="crearAsignacion = true; paso = 1"
                    class="rounded-md border border-slate-900 bg-[#8BD044] px-5 py-2 text-sm font-bold shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] transition hover:bg-green-400"
                >
                    Nueva asignación
                </button>
            </div>
        </section>

        {{-- Asistente de nueva asignación --}}
        <section x-show="crearAsignacion" style="display: none;" class="p-4 sm:p-6">
            <div class="mb-6">
                <h1 class="text-xl font-bold sm:text-2xl">Nueva asignación</h1>
                <p class="mt-1 text-sm text-slate-600">Sigue los pasos para completar la asignación.</p>
            </div>

            {{-- Indicador de los cuatro pasos --}}
            <div class="mb-8">
                <div class="relative mx-auto flex max-w-3xl items-start justify-between">
                    <div class="absolute left-0 right-0 top-4 h-0.5 bg-gray-300"></div>
                    <div
                        class="absolute left-0 top-4 h-0.5 bg-green-600 transition-all"
                        :style="`width: ${(paso - 1) / 3 * 100}%`"
                    ></div>

                    <div class="relative z-10 flex w-1/4 flex-col items-center text-center">
                        <span class="flex h-8 w-8 items-center justify-center rounded-full border-2 text-sm font-bold sm:h-9 sm:w-9"
                              :class="paso >= 1 ? 'border-green-700 bg-green-600 text-white' : 'border-gray-300 bg-white text-gray-500'">1</span>
                        <span class="mt-2 text-[10px] font-medium sm:text-xs">Cortador</span>
                    </div>

                    <div class="relative z-10 flex w-1/4 flex-col items-center text-center">
                        <span class="flex h-8 w-8 items-center justify-center rounded-full border-2 text-sm font-bold sm:h-9 sm:w-9"
                              :class="paso >= 2 ? 'border-green-700 bg-green-600 text-white' : 'border-gray-300 bg-white text-gray-500'">2</span>
                        <span class="mt-2 text-[10px] font-medium sm:text-xs">Material</span>
                    </div>

                    <div class="relative z-10 flex w-1/4 flex-col items-center text-center">
                        <span class="flex h-8 w-8 items-center justify-center rounded-full border-2 text-sm font-bold sm:h-9 sm:w-9"
                              :class="paso >= 3 ? 'border-green-700 bg-green-600 text-white' : 'border-gray-300 bg-white text-gray-500'">3</span>
                        <span class="mt-2 text-[10px] font-medium sm:text-xs">Material adicional</span>
                    </div>

                    <div class="relative z-10 flex w-1/4 flex-col items-center text-center">
                        <span class="flex h-8 w-8 items-center justify-center rounded-full border-2 text-sm font-bold sm:h-9 sm:w-9"
                              :class="paso >= 4 ? 'border-green-700 bg-green-600 text-white' : 'border-gray-300 bg-white text-gray-500'">4</span>
                        <span class="mt-2 text-[10px] font-medium sm:text-xs">Finalizar</span>
                    </div>
                </div>
            </div>

            {{-- Paso 1: seleccionar cortador --}}
            <div x-show="paso === 1" class="min-h-64">
                <div class="mb-4 bg-[#D99B00] px-4 py-3">
                    <h2 class="font-bold">Seleccionar cortador</h2>
                    <p class="text-sm">Buscar y seleccionar el cortador</p>
                </div>

                <input
                    type="search"
                    placeholder="Buscar cortador..."
                    class="mb-4 w-full border border-slate-900 bg-gray-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 sm:max-w-md"
                >

                <div class="overflow-x-auto">
                    <table class="w-full min-w-[450px] border-collapse">
                        <thead>
                            <tr class="divide-x divide-gray-400 border border-slate-900 bg-gray-200 text-center text-sm">
                                <th class="p-2">Nombre completo</th>
                                <th class="p-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="h-36 divide-x divide-gray-400 border-x border-b border-slate-900 bg-gray-100 align-top">
                                <td class="p-3"></td>
                                <td class="p-3 text-center">
                                    <button type="button" class="rounded-md border border-slate-900 bg-sky-400 px-4 py-1.5 text-xs font-bold shadow-sm hover:bg-sky-300">
                                        Seleccionar
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Paso 2: seleccionar material --}}
            <div x-show="paso === 2" style="display: none;" class="min-h-64">
                <div class="mb-4 bg-[#D99B00] px-4 py-3">
                    <h2 class="font-bold">Seleccionar el material</h2>
                    <p class="text-sm">Buscar, seleccionar y elegir la cantidad de material</p>
                </div>

                <input
                    type="search"
                    placeholder="Buscar material..."
                    class="mb-4 w-full border border-slate-900 bg-gray-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 sm:max-w-md"
                >

                <div class="overflow-x-auto">
                    <table class="w-full min-w-[550px] border-collapse">
                        <thead>
                            <tr class="divide-x divide-gray-400 border border-slate-900 bg-gray-200 text-center text-sm">
                                <th class="p-2">Nombre del material</th>
                                <th class="p-2">Cantidad disponible</th>
                                <th class="p-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="h-28 divide-x divide-gray-400 border-x border-b border-slate-900 bg-gray-100 align-top">
                                <td class="p-3"></td>
                                <td class="p-3"></td>
                                <td class="p-3 text-center">
                                    <button type="button" class="rounded-md border border-slate-900 bg-sky-400 px-4 py-1.5 text-xs font-bold shadow-sm hover:bg-sky-300">
                                        Seleccionar
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div class="space-y-3">
                        <div>
                            <label for="cantidad-material" class="mb-1 block text-sm">Cantidad (dm):</label>
                            <input id="cantidad-material" type="number" min="0" class="w-full max-w-48 rounded-md border border-slate-900 bg-gray-100 px-3 py-2">
                        </div>
                        <div>
                            <label for="cantidad-estimada" class="mb-1 block text-sm">Cantidad estimada por unidad:</label>
                            <input id="cantidad-estimada" type="number" min="0" class="w-full max-w-48 rounded-md border border-slate-900 bg-gray-100 px-3 py-2">
                        </div>
                    </div>

                    <div class="flex min-h-32 flex-col items-center justify-center rounded-lg border-2 border-gray-500 bg-gray-200 text-center">
                        <span class="text-sm">Piezas estimadas</span>
                        <span class="mt-2 text-3xl">XX</span>
                    </div>
                </div>
            </div>

            {{-- Paso 3: material adicional --}}
            <div x-show="paso === 3" style="display: none;" class="min-h-64">
                <div class="mb-4 bg-[#D99B00] px-4 py-3">
                    <h2 class="font-bold">Material adicional</h2>
                    <p class="text-sm">Agregue material si así lo requiere</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full min-w-[600px] border-collapse">
                        <thead>
                            <tr class="divide-x divide-gray-400 border border-slate-900 bg-gray-200 text-center text-xs sm:text-sm">
                                <th class="p-2">Nombre completo</th>
                                <th class="p-2">Material</th>
                                <th class="p-2">Cantidad actual</th>
                                <th class="p-2">Cantidad disponible</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="h-36 divide-x divide-gray-400 border-x border-b border-slate-900 bg-gray-100 align-top">
                                <td class="p-3"></td>
                                <td class="p-3"></td>
                                <td class="p-3"></td>
                                <td class="p-3"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    <label for="material-extra" class="mb-2 block max-w-xs text-sm leading-tight">
                        Ingrese la cantidad de material adicional:
                    </label>
                    <input
                        id="material-extra"
                        type="number"
                        min="0"
                        class="w-full max-w-48 rounded-md border border-slate-900 bg-gray-100 px-3 py-2"
                    >
                </div>
            </div>

            {{-- Paso 4: finalizar asignación --}}
            <div x-show="paso === 4" style="display: none;" class="min-h-64">
                <div class="mb-4 bg-[#D99B00] px-4 py-3">
                    <h2 class="font-bold">Finalizar asignación</h2>
                    <p class="text-sm">Registro de finalización de asignación</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full min-w-[500px] border-collapse">
                        <thead>
                            <tr class="divide-x divide-gray-400 border border-slate-900 bg-gray-200 text-center text-sm">
                                <th class="p-2">Nombre completo</th>
                                <th class="p-2">Material</th>
                                <th class="p-2">Cantidad (dm)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="h-16 divide-x divide-gray-400 border-x border-b border-slate-900 bg-gray-100">
                                <td class="p-3"></td>
                                <td class="p-3"></td>
                                <td class="p-3"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div class="space-y-3">
                        <div class="rounded-lg border border-gray-500 bg-gray-100 p-3 text-sm">
                            Cantidad estimada por unidad:
                            <span class="ml-2 font-bold">XX</span>
                        </div>

                        <div class="rounded-lg border border-gray-500 bg-gray-50 p-3">
                            <label class="flex items-center gap-2 text-sm">
                                <input type="checkbox" class="rounded border-gray-400">
                                ¿Sobró material?
                                <input
                                    type="number"
                                    min="0"
                                    placeholder="Cantidad"
                                    aria-label="Cantidad de material sobrante"
                                    class="ml-auto w-24 rounded-md border border-slate-900 bg-white px-2 py-1"
                                >
                            </label>
                            <p class="mt-2 text-xs">Ingrese la cantidad (dm):</p>
                        </div>

                        <div>
                            <label for="tareas-realizadas" class="mb-1 block text-sm">
                                Cantidad de tareas realizadas (25 unidades):
                            </label>
                            <input
                                id="tareas-realizadas"
                                type="number"
                                min="0"
                                class="w-full max-w-48 rounded-md border border-slate-900 bg-gray-100 px-3 py-2"
                            >
                        </div>
                    </div>

                    <div class="flex min-h-44 flex-col items-center justify-center rounded-lg border-2 border-gray-500 bg-gray-200 text-center">
                        <span class="text-base">Rendimiento total</span>
                        <span class="mt-3 text-4xl">XX</span>
                    </div>
                </div>
            </div>

            {{-- Navegación entre pasos --}}
            <div class="mt-6 flex flex-col-reverse justify-between gap-3 border-t border-gray-200 pt-4 sm:flex-row">
                <button
                    type="button"
                    @click="crearAsignacion = false; paso = 1"
                    class="rounded-md border border-slate-900 bg-[#F87171] px-5 py-2 text-sm font-bold shadow-sm transition hover:bg-red-400"
                >
                    Cancelar
                </button>

                <div class="flex flex-col-reverse gap-3 sm:flex-row">
                    <button
                        type="button"
                        x-show="paso > 1"
                        @click="paso--"
                        class="rounded-md border border-gray-500 bg-white px-5 py-2 text-sm font-bold transition hover:bg-gray-100"
                    >
                        Anterior
                    </button>

                    <button
                        type="button"
                        x-show="paso < 4"
                        @click="paso++"
                        class="rounded-md border border-slate-900 bg-[#8BD044] px-5 py-2 text-sm font-bold shadow-sm transition hover:bg-green-400"
                    >
                        Siguiente
                    </button>

                    <button
                        type="button"
                        x-show="paso === 4"
                        @click="crearAsignacion = false; paso = 1"
                        class="rounded-md border border-slate-900 bg-[#36C6C8] px-5 py-2 text-sm font-bold shadow-sm transition hover:bg-[#25b3b5]"
                    >
                        Finalizar
                    </button>
                </div>
            </div>
        </section>
    </main>
</div>
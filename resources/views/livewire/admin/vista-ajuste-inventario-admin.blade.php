<div
    x-data="{ modalDetalles: false }"
    @keydown.escape.window="modalDetalles = false"
>
    <!-- Carga de Fuentes / CDN si aplica -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <livewire:layouts.header
        title="Ajuste de inventario"
        subtitle="Datos generales del inventario"
    />

    <livewire:layouts.menu />

    <main class="mx-3 my-5 overflow-hidden rounded-2xl border border-amber-900 bg-white shadow-sm sm:mx-6 sm:my-8 md:mx-10 lg:mx-12">
        <div class="p-4 sm:p-6">

            {{-- Búsqueda y filtros --}}
            <div class="mb-4 flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
                <div class="relative w-full lg:max-w-lg">
                    <input
                        type="search"
                        placeholder="Buscar registro..."
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

                <div class="grid grid-cols-3 overflow-hidden border border-slate-900 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)]">
                    <button type="button" class="border-r border-slate-900 bg-gray-200 px-5 py-2 text-sm font-medium text-slate-900 transition hover:bg-[#FFD600]">
                        Día
                    </button>
                    <button type="button" class="border-r border-slate-900 bg-gray-200 px-5 py-2 text-sm font-medium text-slate-900 transition hover:bg-[#FFD600]">
                        Semana
                    </button>
                    <button type="button" class="bg-gray-200 px-5 py-2 text-sm font-medium text-slate-900 transition hover:bg-[#FFD600]">
                        Mes
                    </button>
                </div>
            </div>

            {{-- Tabla --}}
            <div class="overflow-x-auto border border-slate-900">
                <table class="w-full min-w-[650px] border-collapse text-left">
                    <thead>
                        <tr class="divide-x divide-slate-900 border-b border-slate-900 bg-gray-200 text-center text-sm font-medium text-slate-900">
                            <th class="p-2">Material</th>
                            <th class="p-2">Cantidad</th>
                            <th class="p-2">Proveedor</th>
                            <th class="p-2">Fecha</th>
                            <th class="p-2">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr class="h-56 divide-x divide-slate-900 bg-gray-100 align-top text-sm text-slate-900">
                            <td class="p-2"></td>
                            <td class="p-2"></td>
                            <td class="p-2"></td>
                            <td class="p-2"></td>
                            <td class="p-3 text-center">
                                <button
                                    type="button"
                                    @click="modalDetalles = true"
                                    class="rounded-md border border-slate-900 bg-sky-400 px-4 py-1.5 text-xs font-bold text-slate-950 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] transition hover:bg-sky-300"
                                >
                                    Ver detalles
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Exportaciones y paginación --}}
            <div class="mt-3 flex flex-col items-center justify-between gap-4 sm:flex-row">
                <div class="flex gap-3">
                    <button
                        type="button"
                        class="rounded-md border border-slate-900 bg-[#F87171] px-4 py-2 text-xs font-bold text-slate-950 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] transition hover:bg-red-400"
                    >
                        Exportar a PDF
                    </button>

                    <button
                        type="button"
                        class="rounded-md border border-slate-900 bg-[#8BD044] px-4 py-2 text-xs font-bold text-slate-950 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] transition hover:bg-green-400"
                    >
                        Exportar a Excel
                    </button>
                </div>

                <nav aria-label="Paginación" class="flex items-center gap-1 text-sm">
                    <button type="button" class="rounded px-2 py-1 text-slate-700 hover:bg-amber-100">&lt;</button>
                    <button type="button" class="rounded border border-amber-900 bg-[#D99B00] px-2 py-1 font-bold text-slate-950">1</button>
                    <button type="button" class="rounded px-2 py-1 text-slate-700 hover:bg-amber-100">2</button>
                    <button type="button" class="rounded px-2 py-1 text-slate-700 hover:bg-amber-100">3</button>
                    <button type="button" class="rounded px-2 py-1 text-slate-700 hover:bg-amber-100">&gt;</button>
                </nav>
            </div>
        </div>
    </main>

    {{-- Modal de detalles del ajuste --}}
    <div
        x-show="modalDetalles"
        x-transition.opacity
        style="display: none;"
        class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto bg-black/60 p-4 font-['Raleway']"
        role="dialog"
        aria-modal="true"
        aria-labelledby="modal-title"
        @click.self="modalDetalles = false"
    >
        <div class="my-auto w-full max-w-xl overflow-hidden rounded-2xl border border-amber-900 bg-white shadow-2xl">

            {{-- Encabezado del modal --}}
            <div class="bg-[#D99B00] px-5 py-4 text-center text-slate-950 sm:py-5">
                <h2 id="modal-title" class="text-xl font-bold sm:text-2xl">
                    Ajuste de inventario
                </h2>
                <p class="mt-1 text-sm font-medium sm:text-base">
                    Detalles del ajuste de inventario
                </p>
            </div>

            {{-- Datos del ajuste --}}
            <div class="p-4 sm:p-6">
                <div class="space-y-3 rounded-xl border-2 border-slate-900 bg-gray-50 p-4 sm:p-5">

                    <div class="grid grid-cols-1 items-center gap-2 sm:grid-cols-[8rem_1fr] sm:gap-4">
                        <label for="detalle_usuario" class="text-sm font-medium text-slate-800 sm:text-right">
                            Usuario
                        </label>
                        <input
                            id="detalle_usuario"
                            type="text"
                            value="Nombre del usuario"
                            readonly
                            class="w-full rounded-lg border border-slate-900 bg-white px-3 py-2 text-sm text-slate-800"
                        >
                    </div>

                    <div class="grid grid-cols-1 items-center gap-2 sm:grid-cols-[8rem_1fr] sm:gap-4">
                        <label for="detalle_material" class="text-sm font-medium text-slate-800 sm:text-right">
                            Materia Prima
                        </label>
                        <input
                            id="detalle_material"
                            type="text"
                            value="Carnaza XXX"
                            readonly
                            class="w-full rounded-lg border border-slate-900 bg-white px-3 py-2 text-sm text-slate-800"
                        >
                    </div>

                    <div class="grid grid-cols-1 items-center gap-2 sm:grid-cols-[8rem_1fr] sm:gap-4">
                        <label for="detalle_cantidad" class="text-sm font-medium text-slate-800 sm:text-right">
                            Cantidad
                        </label>
                        <input
                            id="detalle_cantidad"
                            type="text"
                            value="120 dm"
                            readonly
                            class="w-full rounded-lg border border-slate-900 bg-white px-3 py-2 text-sm text-slate-800"
                        >
                    </div>

                    <div class="grid grid-cols-1 items-center gap-2 sm:grid-cols-[8rem_1fr] sm:gap-4">
                        <label for="detalle_motivo" class="text-sm font-medium text-slate-800 sm:text-right">
                            Motivo
                        </label>
                        <input
                            id="detalle_motivo"
                            type="text"
                            value="Motivo de ejemplo"
                            readonly
                            class="w-full rounded-lg border border-slate-900 bg-white px-3 py-2 text-sm text-slate-800"
                        >
                    </div>

                    <div class="grid grid-cols-1 items-center gap-2 sm:grid-cols-[8rem_1fr] sm:gap-4">
                        <label for="detalle_tipo_ajuste" class="text-sm font-medium text-slate-800 sm:text-right">
                            Tipo de ajuste
                        </label>
                        <input
                            id="detalle_tipo_ajuste"
                            type="text"
                            value="Aumento"
                            readonly
                            class="w-full rounded-lg border border-slate-900 bg-white px-3 py-2 text-sm text-slate-800"
                        >
                    </div>

                    <div class="flex justify-center pt-3">
                        <button
                            type="button"
                            @click="modalDetalles = false"
                            class="rounded-lg border-2 border-slate-900 bg-[#D94B4B] px-8 py-2 text-sm font-bold text-slate-950 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] transition hover:bg-red-500 active:translate-y-0.5"
                        >
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
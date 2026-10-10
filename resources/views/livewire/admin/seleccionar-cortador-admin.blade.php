<div>
    <!-- Carga de Fuentes / CDN si aplica -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Nuevo header refactoizado --}}
    <livewire:layouts.header title="Seleccionar cortador" subtitle="Buscar y seleccionar el cortador" />

    {{-- Nuevo menu refactorizado --}}
    <livewire:layouts.menu />

    <main class="mx-3 my-5 overflow-hidden rounded-2xl border border-amber-900 bg-white font-['Raleway'] text-slate-950 shadow-sm sm:mx-6 sm:my-8 md:mx-10 lg:mx-12">

    <div class="p-4 sm:p-6">
        {{-- Búsqueda --}}
        <div class="mb-4">
            <div class="relative w-full sm:mx-auto sm:max-w-lg">
                <input
                    type="search"
                    placeholder="Buscar cortador..."
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

        {{-- Tabla de cortadores --}}
        <div class="overflow-x-auto">
            <table class="w-full min-w-[500px] border-collapse text-left">
                <thead>
                    <tr class="divide-x divide-gray-400 border border-slate-900 bg-gray-200 text-center text-xs font-medium text-slate-800 sm:text-sm">
                        <th class="p-2 sm:p-3">Nombre completo</th>
                        <th class="w-32 p-2 sm:p-3">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="h-48 divide-x divide-gray-400 border-x border-b border-slate-900 bg-gray-100 align-top text-sm text-slate-900 sm:h-56">
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

        {{-- Acciones --}}
        <div class="mt-5 flex flex-col-reverse justify-end gap-3 sm:flex-row">
            <button
                type="button"
                class="rounded-md border border-slate-900 bg-[#F87171] px-5 py-2 text-sm font-bold text-slate-950 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] transition hover:bg-red-400"
            >
                Cancelar
            </button>

            <button
                type="button"
                class="rounded-md border border-slate-900 bg-[#8BD044] px-5 py-2 text-sm font-bold text-slate-950 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] transition hover:bg-green-400"
            >
                Siguiente
            </button>
        </div>
    </div>
    </main>
</div>

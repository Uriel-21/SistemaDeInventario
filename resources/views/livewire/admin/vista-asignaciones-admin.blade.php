<div>
    <!-- Carga de Fuentes / CDN si aplica -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Nuevo header refactoizado --}}
    <livewire:layouts.header title="Asignaciones activas de material" subtitle="Datos generales de la asignación de material" />

    {{-- Nuevo menu refactorizado --}}
    <livewire:layouts.menu />

    <main class="mx-3 my-5 overflow-hidden rounded-2xl border border-amber-900 bg-white font-['Raleway'] text-slate-950 shadow-sm sm:mx-6 sm:my-8 md:mx-10 lg:mx-12">


    <div class="p-4 sm:p-6">
        {{-- Tabla --}}
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
                                    class="rounded-md border border-slate-900 bg-[#F29B83] px-3 py-1.5 text-xs font-bold text-slate-950 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] transition hover:bg-[#ef866a]"
                                >
                                    Material adicional
                                </button>

                                <button
                                    type="button"
                                    class="rounded-md border border-slate-900 bg-[#36C6C8] px-3 py-1.5 text-xs font-bold text-slate-950 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] transition hover:bg-[#25b3b5]"
                                >
                                    Finalizar asignación
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Acciones generales --}}
        <div class="mt-6 flex flex-col-reverse justify-end gap-3 sm:flex-row">
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
                Nueva asignación
            </button>
        </div>
    </div>
    </main>
</div>

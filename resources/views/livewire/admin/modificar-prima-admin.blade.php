<div>
    <main class="mx-3 my-5 overflow-hidden rounded-2xl border border-amber-900 bg-white shadow-sm sm:mx-6 sm:my-8 md:mx-10 lg:mx-12">

        {{-- Encabezado --}}
        <div class="bg-[#D99B00] px-5 py-5 text-center text-slate-950 sm:px-6">
            <h1 class="text-xl font-bold sm:text-2xl">Modificar materia prima</h1>
            <p class="mt-1 text-sm font-medium sm:text-base">
                Registrar datos generales de la materia prima
            </p>
        </div>

        <div class="p-4 sm:p-8">
            {{-- Formulario visual --}}
            <form class="mx-auto max-w-md rounded-2xl border border-gray-500 bg-white p-5 sm:p-7">
                <div class="space-y-5">
                    <div>
                        <label for="folio" class="mb-2 block text-base font-medium text-slate-800">
                            Folio o código
                        </label>
                        <input
                            type="text"
                            id="folio"
                            name="folio"
                            class="w-full rounded-xl border border-gray-500 bg-white px-3 py-2 text-sm text-slate-900 shadow-inner focus:border-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-200"
                        >
                    </div>

                    <div>
                        <label for="nombre" class="mb-2 block text-base font-medium text-slate-800">
                            Nombre
                        </label>
                        <input
                            type="text"
                            id="nombre"
                            name="nombre"
                            class="w-full rounded-xl border border-gray-500 bg-white px-3 py-2 text-sm text-slate-900 shadow-inner focus:border-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-200"
                        >
                    </div>

                    <div>
                        <label for="stock_minimo" class="mb-2 block text-base font-medium text-slate-800">
                            Stock mínimo
                        </label>
                        <input
                            type="number"
                            id="stock_minimo"
                            name="stock_minimo"
                            min="0"
                            class="w-full rounded-xl border border-gray-500 bg-white px-3 py-2 text-sm text-slate-900 shadow-inner focus:border-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-200"
                        >
                    </div>

                    <div>
                        <label for="ubicacion" class="mb-2 block text-base font-medium text-slate-800">
                            Ubicación <span class="font-normal text-slate-600">(Opcional)</span>
                        </label>
                        <input
                            type="text"
                            id="ubicacion"
                            name="ubicacion"
                            class="w-full rounded-xl border border-gray-500 bg-white px-3 py-2 text-sm text-slate-900 shadow-inner focus:border-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-200"
                        >
                    </div>
                </div>
            </form>

            {{-- Botones visuales --}}
            <div class="mx-auto mt-4 flex max-w-md flex-col-reverse justify-center gap-3 sm:flex-row sm:gap-5">
                <button
                    type="button"
                    class="rounded-lg border border-red-800 bg-[#FF0000] px-8 py-3 font-bold text-white shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)] transition hover:bg-red-600 active:translate-y-0.5"
                >
                    Cancelar
                </button>

                <button
                    type="button"
                    class="rounded-lg border border-amber-900 bg-[#FFD600] px-8 py-3 font-bold text-slate-950 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)] transition hover:bg-amber-400 active:translate-y-0.5"
                >
                    Guardar
                </button>
            </div>
        </div>
    </main>
</div>
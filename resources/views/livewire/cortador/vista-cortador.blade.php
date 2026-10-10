<div class="flex min-h-screen items-center justify-center bg-gray-100 px-3 py-5 sm:px-6">
    {{-- Carga de fuentes/CDN si aún no están incluidas en el layout --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <main class="w-full max-w-md overflow-hidden rounded-2xl border border-amber-900 bg-white font-['Raleway'] text-slate-950 shadow-sm">

        {{-- Encabezado --}}
        <div class="bg-[#D99B00] px-4 py-5 text-center sm:px-5 sm:py-6">
            <h1 class="text-lg font-bold sm:text-xl">¡Hola usuario!</h1>
            <p class="mt-3 text-base font-medium sm:mt-4 sm:text-xl">
                Asignación programada
            </p>
        </div>

        <div class="space-y-3 p-4 sm:p-5">
            {{-- Material asignado --}}
            <section class="rounded-lg bg-gray-300 px-3 py-3 sm:px-4">
                <h2 class="text-sm font-medium text-slate-800 sm:text-base">
                    Material a trabajar:
                </h2>
                <p class="mt-1 break-words text-center text-base font-semibold text-slate-950 sm:text-lg">
                    XX
                </p>
            </section>

            {{-- Cantidad asignada --}}
            <section class="rounded-lg bg-gray-300 px-3 py-3 sm:px-4">
                <h2 class="text-sm font-medium text-slate-800 sm:text-base">
                    Cantidad asignada:
                </h2>
                <p class="mt-1 text-center text-base font-semibold text-slate-950 sm:text-lg">
                    XX
                </p>
            </section>

            {{-- Estimado de piezas o tareas --}}
            <section class="rounded-lg bg-gray-300 px-3 py-3 sm:px-4">
                <h2 class="text-sm font-medium leading-tight text-slate-800 sm:text-base">
                    Estimado de piezas o tareas:
                </h2>
                <p class="mt-1 text-center text-base font-semibold text-slate-950 sm:text-lg">
                    XX
                </p>
            </section>

            {{-- Cerrar sesión --}}
            <div class="flex justify-center pt-3">
                <button
                    type="button"
                    class="w-full rounded-md border border-slate-900 bg-[#F87171] px-6 py-2.5 text-sm font-bold text-slate-950 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] transition hover:bg-red-400 sm:w-auto"
                >
                    Cerrar sesión
                </button>
            </div>
        </div>
    </main>
</div>
<div class="flex min-h-screen items-center justify-center bg-gray-100 px-3 py-5 sm:px-6">
    {{-- Carga de fuentes/CDN si aún no están incluidas en tu layout principal --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <main
        class="w-full max-w-md overflow-hidden rounded-2xl border border-amber-900 bg-white font-['Raleway'] text-slate-950 shadow-sm">

        {{-- Encabezado --}}
        <div class="bg-[#D99B00] px-4 py-5 text-center sm:px-5 sm:py-6">
            {{-- Saludamos al cortador con su nombre real usando la sesión de Laravel --}}
            <h1 class="text-lg font-bold sm:text-xl">¡Hola, {{ auth()->user()->name }}!</h1>
            <p class="mt-3 text-base font-medium text-white sm:mt-4 sm:text-xl">
                Asignación programada
            </p>
        </div>

        <div class="space-y-3 p-4 sm:p-5">

            {{-- Validamos si el servicio encontró una asignación pendiente --}}
            @if ($this->asignacion)
                {{-- Material asignado --}}
                <section class="rounded-lg bg-gray-300 px-3 py-3 sm:px-4">
                    <h2 class="text-sm font-medium text-slate-800 sm:text-base">
                        Material a trabajar:
                    </h2>
                    <p class="mt-1 break-words text-center text-base font-bold text-slate-950 sm:text-lg">
                        {{ $this->asignacion->materiaPrima->nombre }}
                    </p>
                </section>

                {{-- Cantidad asignada --}}
                <section class="rounded-lg bg-gray-300 px-3 py-3 sm:px-4">
                    <h2 class="text-sm font-medium text-slate-800 sm:text-base">
                        Cantidad asignada:
                    </h2>
                    <p class="mt-1 text-center text-base font-bold text-slate-950 sm:text-lg">
                        {{-- Sumamos los decímetros iniciales y los adicionales (si los hay) --}}
                        {{ number_format($this->asignacion->dm_iniciales + ($this->asignacion->dm_adicionales ?? 0), 2) }}
                        dm
                    </p>
                </section>

                {{-- Estimado de piezas o tareas --}}
                <section class="rounded-lg bg-gray-300 px-3 py-3 sm:px-4">
                    <h2 class="text-sm font-medium leading-tight text-slate-800 sm:text-base">
                        Estimado de piezas o tareas:
                    </h2>
                    <p class="mt-1 text-center text-base font-bold text-slate-950 sm:text-lg">
                        {{ number_format($this->asignacion->cortes_estimados, 2) }}
                    </p>
                </section>
            @else
                {{-- Pantalla si no tiene trabajo pendiente en su mesa --}}
                <div class="rounded-lg bg-gray-100 px-3 py-8 text-center border-2 border-dashed border-gray-300">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <h3 class="mt-2 text-sm font-bold text-slate-900">Sin asignaciones</h3>
                    <p class="mt-1 text-sm text-slate-500">No tienes material pendiente por trabajar en este momento.
                        Consulta con el encargado.</p>
                </div>
            @endif

            {{-- Cerrar sesión --}}
            <div class="flex justify-center pt-3">
                <button type="button" wire:click="logout"
                    class="w-full rounded-md border border-slate-900 bg-[#F87171] px-6 py-2.5 text-sm font-bold text-slate-950 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] transition hover:bg-red-400 sm:w-auto">
                    Cerrar sesión
                </button>
            </div>
        </div>
    </main>
</div>

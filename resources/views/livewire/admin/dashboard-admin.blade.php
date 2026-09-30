<div class="min-h-screen bg-white font-['Raleway'] text-slate-950">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Nuevo header refactoizado --}}
    <livewire:layouts.header title="Dashboard general" subtitle="Datos generales" />

    {{-- Nuevo menu refactorizado --}}
    <livewire:layouts.menu />
    <main
        class="mx-3 my-5 rounded-2xl border border-amber-900 bg-[#D99B00] px-4 py-5 sm:mx-6 sm:my-8 sm:px-6 md:mx-10 md:px-8 lg:mx-12">
        <div class="mb-6 flex flex-col gap-3 min-[420px]:flex-row min-[420px]:justify-end sm:mb-7 sm:gap-4">
            <a href="#"
                class="rounded-md border border-amber-900 bg-[#FFD600] px-3 py-2 text-center text-sm hover:bg-amber-300">
                Materia prima
            </a>
            <a href="#"
                class="rounded-md border border-amber-900 bg-[#FFD600] px-3 py-2 text-center text-sm hover:bg-amber-300">
                Vista del Stock
            </a>
        </div>

        <div class="grid grid-cols-1 gap-3 min-[520px]:grid-cols-2 sm:gap-4 lg:grid-cols-3">
            <div
                class="flex min-h-24 flex-col items-center justify-center rounded-2xl border border-amber-900 bg-[#F5D477] px-3 py-3 text-center">
                <span class="text-sm font-bold leading-5 sm:text-base">Total de pares en Stock:</span>
                <span class="mt-1 text-2xl font-bold sm:text-2xl">32,800</span>
            </div>

            <div
                class="flex min-h-24 flex-col items-center justify-center rounded-2xl border border-amber-900 bg-[#F5D477] px-3 py-3 text-center">
                <span class="text-sm font-bold sm:text-base">Total del Stock:</span>
                <span class="mt-1 text-2xl font-bold">$ 450,00</span>
            </div>

            <div
                class="flex min-h-24 flex-col items-center justify-center rounded-2xl border border-amber-900 bg-[#F5D477] px-3 py-3 text-center">
                <span class="text-sm font-bold sm:text-base">Modelos activos:</span>
                <span class="mt-1 text-2xl font-bold">15</span>
            </div>

            <div
                class="flex min-h-24 flex-col items-center justify-center rounded-2xl border border-amber-900 bg-[#F5D477] px-3 py-3 text-center">
                <span class="text-sm font-bold leading-5 sm:text-base">Total de materia prima:</span>
                <span class="mt-1 text-2xl font-bold">2,000</span>
            </div>

            <div
                class="flex min-h-24 flex-col items-center justify-center rounded-2xl border border-amber-900 bg-[#F5D477] px-3 py-3 text-center">
                <span class="text-sm font-bold leading-5 sm:text-base">Pares generados hoy:</span>
                <span class="mt-1 text-2xl font-bold">1,000</span>
            </div>

            <div
                class="flex min-h-24 flex-col items-center justify-center rounded-2xl border border-amber-900 bg-[#F5D477] px-3 py-3 text-center">
                <span class="text-sm font-bold sm:text-base">Talla más pedida:</span>
                <span class="mt-1 text-2xl font-bold">M/L</span>
            </div>
        </div>
    </main>
    <script src="{{ asset('js/Menu.js') }}"></script>
</div>

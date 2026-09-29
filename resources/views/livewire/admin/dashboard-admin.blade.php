<div class="min-h-screen bg-white font-['Raleway'] text-slate-950">
  <header class="relative flex items-center justify-between gap-4 bg-[#D99B00] px-4 py-4 sm:px-8 md:px-12 lg:px-16">
    <div class="min-w-0">
      <h1 class="text-lg font-normal sm:text-xl">Dashboard del stock</h1>
      <p class="text-xs sm:text-sm">Datos generales del almacén</p>
      <script src="https://cdn.tailwindcss.com"></script>
      <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    </div>

    <button
      type="button"
      id="menu-toggle"
      aria-label="Abrir menú"
      aria-expanded="false"
      aria-controls="menu-opciones"
      class="flex h-11 w-12 shrink-0 flex-col items-center justify-center gap-1.5 rounded-lg border border-amber-900 bg-[#FFD600] shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)]"
    >
      <span class="h-0.5 w-6 rounded bg-slate-900"></span>
      <span class="h-0.5 w-6 rounded bg-slate-900"></span>
      <span class="h-0.5 w-6 rounded bg-slate-900"></span>
    </button>

    <div
      id="menu-fondo"
      hidden
      class="fixed inset-0 z-20 bg-black/40"
    ></div>

    <aside
      id="menu-opciones"
      aria-label="Menú principal"
      aria-hidden="true"
      class="invisible fixed right-0 top-0 z-30 flex h-dvh w-80 max-w-[90vw] translate-x-full flex-col items-center overflow-y-auto rounded-l-2xl border-l-2 border-amber-900 bg-white px-6 py-8 shadow-2xl transition-all duration-300"
    >
      <button
        type="button"
        id="menu-cerrar"
        aria-label="Cerrar menú"
        class="absolute right-4 top-4 rounded-lg px-3 py-1 text-2xl leading-none hover:bg-amber-100"
      >
        &times;
      </button>

      <img
        src="ruta-de-tu-logo.png"
        alt="Mena Tapia"
        class="mb-2 mt-6 h-20 max-w-full object-contain"
      >

      <h2 class="mb-5 text-xl font-medium text-slate-800">Menú Principal</h2>

      <nav class="flex w-full flex-col items-center gap-4">
        <a href="#" class="w-36 rounded-xl bg-[#FFD000] px-4 py-2 text-center font-medium hover:bg-amber-400">
          Materia prima
        </a>
        <a href="#" class="w-36 rounded-xl bg-[#FFD000] px-4 py-2 text-center font-medium hover:bg-amber-400">
          Rendimiento
        </a>
        <a href="#" class="w-36 rounded-xl bg-[#FFD000] px-4 py-2 text-center font-medium hover:bg-amber-400">
          Stock almacén
        </a>
        <a href="#" class="w-36 rounded-xl bg-[#FFD000] px-4 py-2 text-center font-medium hover:bg-amber-400">
          Usuarios
        </a>
      </nav>
    </aside>
  </header>

  <main class="mx-3 my-5 rounded-2xl border border-amber-900 bg-[#D99B00] px-4 py-5 sm:mx-6 sm:my-8 sm:px-6 md:mx-10 md:px-8 lg:mx-12">
    <div class="mb-6 flex flex-col gap-3 min-[420px]:flex-row min-[420px]:justify-end sm:mb-7 sm:gap-4">
      <a href="#" class="rounded-md border border-amber-900 bg-[#FFD600] px-3 py-2 text-center text-sm hover:bg-amber-300">
        Materia prima
      </a>
      <a href="#" class="rounded-md border border-amber-900 bg-[#FFD600] px-3 py-2 text-center text-sm hover:bg-amber-300">
        Vista del Stock
      </a>
    </div>

    <div class="grid grid-cols-1 gap-3 min-[520px]:grid-cols-2 sm:gap-4 lg:grid-cols-3">
      <div class="flex min-h-24 flex-col items-center justify-center rounded-2xl border border-amber-900 bg-[#F5D477] px-3 py-3 text-center">
        <span class="text-sm font-bold leading-5 sm:text-base">Total de pares en Stock:</span>
        <span class="mt-1 text-2xl font-bold sm:text-2xl">32,800</span>
      </div>

      <div class="flex min-h-24 flex-col items-center justify-center rounded-2xl border border-amber-900 bg-[#F5D477] px-3 py-3 text-center">
        <span class="text-sm font-bold sm:text-base">Total del Stock:</span>
        <span class="mt-1 text-2xl font-bold">$ 450,00</span>
      </div>

      <div class="flex min-h-24 flex-col items-center justify-center rounded-2xl border border-amber-900 bg-[#F5D477] px-3 py-3 text-center">
        <span class="text-sm font-bold sm:text-base">Modelos activos:</span>
        <span class="mt-1 text-2xl font-bold">15</span>
      </div>

      <div class="flex min-h-24 flex-col items-center justify-center rounded-2xl border border-amber-900 bg-[#F5D477] px-3 py-3 text-center">
        <span class="text-sm font-bold leading-5 sm:text-base">Total de materia prima:</span>
        <span class="mt-1 text-2xl font-bold">2,000</span>
      </div>

      <div class="flex min-h-24 flex-col items-center justify-center rounded-2xl border border-amber-900 bg-[#F5D477] px-3 py-3 text-center">
        <span class="text-sm font-bold leading-5 sm:text-base">Pares generados hoy:</span>
        <span class="mt-1 text-2xl font-bold">1,000</span>
      </div>

      <div class="flex min-h-24 flex-col items-center justify-center rounded-2xl border border-amber-900 bg-[#F5D477] px-3 py-3 text-center">
        <span class="text-sm font-bold sm:text-base">Talla más pedida:</span>
        <span class="mt-1 text-2xl font-bold">M/L</span>
      </div>
    </div>
</main>
<script src="{{ asset('js/Menu.js') }}"></script>
</div>
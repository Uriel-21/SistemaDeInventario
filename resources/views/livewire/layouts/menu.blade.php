<div x-data="{ openMenu: false }" @abrir-menu.window="openMenu = true" @keydown.escape.window="openMenu = false">
    <!-- Fondo Oscuro Overlay -->
    <div x-show="openMenu" x-transition.opacity.duration.300ms @click="openMenu = false" style="display: none;"
        class="fixed inset-0 z-20 bg-black/40"></div>

    <!-- Sidebar Offcanvas -->
    <aside x-show="openMenu" x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-300 transform" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full" style="display: none;" :aria-hidden="(!openMenu).toString()"
        class="fixed right-0 top-0 z-30 flex h-dvh w-80 max-w-[90vw] flex-col items-center overflow-y-auto rounded-l-2xl border-l-2 border-amber-900 bg-white px-6 py-8 shadow-2xl">
        <!-- Botón de Cerrar -->
        <button type="button" @click="openMenu = false" aria-label="Cerrar menú"
            class="absolute right-4 top-4 rounded-lg px-3 py-1 text-2xl leading-none hover:bg-amber-100">
            &times;
        </button>

        <img src="{{ asset('images/Guantes.png') }}" alt="Logo" class="mb-2 mt-6 h-20 max-w-full object-contain">

        <h2 class="mb-5 text-xl font-bold text-slate-800">Menú Principal</h2>

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
</div>

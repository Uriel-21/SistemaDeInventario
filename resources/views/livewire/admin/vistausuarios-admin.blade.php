<div class="min-h-screen bg-white font-['Raleway'] text-slate-950">
    <!-- Carga de Fuentes / CDN si aplica -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Header con Menú Integrado -->
    <header class="relative flex items-center justify-between gap-4 bg-[#D99B00] px-4 py-4 sm:px-8 md:px-12 lg:px-16 border-b border-amber-900">
        <div class="min-w-0">
            <h1 class="text-lg font-bold sm:text-2xl text-slate-950">Control de Usuarios</h1>
            <p class="text-xs sm:text-sm font-medium">Datos generales del almacén</p>
        </div>

        <!-- Botón Menú Hamburguesa -->
        <button
            type="button"
            id="menu-toggle"
            aria-label="Abrir menú"
            aria-expanded="false"
            aria-controls="menu-opciones"
            class="flex h-11 w-12 shrink-0 flex-col items-center justify-center gap-1.5 rounded-lg border border-amber-900 bg-[#FFD600] shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)] hover:bg-amber-400 transition-colors"
        >
            <span class="h-0.5 w-6 rounded bg-slate-900"></span>
            <span class="h-0.5 w-6 rounded bg-slate-900"></span>
            <span class="h-0.5 w-6 rounded bg-slate-900"></span>
        </button>

        <!-- Fondo Oscuro Overlay -->
        <div
            id="menu-fondo"
            hidden
            class="fixed inset-0 z-20 bg-black/40"
        ></div>

        <!-- Sidebar Offcanvas -->
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
    </header>

    <!-- Contenido Principal -->
    <main class="mx-3 my-5 rounded-2xl border border-amber-900 bg-white p-4 sm:mx-6 sm:my-8 sm:p-6 md:mx-10 md:p-8 lg:mx-12 shadow-sm">
        
        <!-- Controles Superiores: Buscador y Botón Nuevo -->
        <div class="mb-6 flex flex-col items-stretch justify-between gap-4 sm:flex-row sm:items-center">
            
            <!-- Buscador -->
            <div class="flex items-center gap-3">
                <label for="search" class="text-sm font-bold text-slate-900 whitespace-nowrap sm:text-base">
                    Buscador de usuarios:
                </label>
                <input 
                    type="text" 
                    id="search"
                    placeholder=""
                    class="w-full sm:w-72 rounded-full border border-amber-900 bg-white px-4 py-1.5 text-sm text-slate-900 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] focus:outline-none focus:ring-2 focus:ring-amber-500"
                >
            </div>

            <!-- Botón Nuevo -->
            <a href="{{ route('crearusuarios') }}"
                type="button" 
                class="self-end sm:self-auto rounded-xl border border-amber-900 bg-[#FFD600] px-8 py-2 font-bold text-slate-950 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)] hover:bg-amber-400 transition-all active:translate-y-0.5"
            >
                Nuevo
            </a>
        </div>

        <!-- Tabla Estilizada Maquetada (Sin Dirección) -->
        <div class="overflow-x-auto rounded-lg border border-amber-900 bg-[#F5D477]">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-amber-900 bg-[#D99B00] text-slate-950 text-xs sm:text-sm font-bold divide-x divide-amber-900">
                        <th class="p-2 sm:p-3">Nombre (s)</th>
                        <th class="p-2 sm:p-3">Apellidos</th>
                        <th class="p-2 sm:p-3">Número celular</th>
                        <th class="p-2 sm:p-3">Correo electrónico</th>
                        <th class="p-2 sm:p-3">Rol</th>
                        <th class="p-2 sm:p-3 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-amber-900">
                    <!-- Fila 1 con Botones de Muestra Visual -->
                    <tr class="divide-x divide-amber-900 h-12 text-xs sm:text-sm font-medium text-slate-900">
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                        <td class="p-2"></td>
                        <td class="p-2 sm:p-3 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button 
                                    type="button" 
                                    class="rounded-md border border-slate-900 bg-[#00FF00] px-3 py-1 text-xs font-bold text-slate-950 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] hover:bg-green-400 transition-all"
                                >
                                    Editar
                                </button>
                                <button 
                                    type="button" 
                                    class="rounded-md border border-slate-900 bg-[#FF0000] px-3 py-1 text-xs font-bold text-white shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] hover:bg-red-600 transition-all"
                                >
                                    Borrar
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Filas vacías adicionales para rellenar la estructura visual de la tabla (6 columnas en total) -->
                    <tr class="divide-x divide-amber-900 h-12"><td class="p-2"></td><td class="p-2"></td><td class="p-2"></td><td class="p-2"></td><td class="p-2"></td><td class="p-2"></td></tr>
                    <tr class="divide-x divide-amber-900 h-12"><td class="p-2"></td><td class="p-2"></td><td class="p-2"></td><td class="p-2"></td><td class="p-2"></td><td class="p-2"></td></tr>
                    <tr class="divide-x divide-amber-900 h-12"><td class="p-2"></td><td class="p-2"></td><td class="p-2"></td><td class="p-2"></td><td class="p-2"></td><td class="p-2"></td></tr>
                    <tr class="divide-x divide-amber-900 h-12"><td class="p-2"></td><td class="p-2"></td><td class="p-2"></td><td class="p-2"></td><td class="p-2"></td><td class="p-2"></td></tr>
                    <tr class="divide-x divide-amber-900 h-12"><td class="p-2"></td><td class="p-2"></td><td class="p-2"></td><td class="p-2"></td><td class="p-2"></td><td class="p-2"></td></tr>
                </tbody>
            </table>
        </div>

        <!-- Paginación estilo vintage/minimalista -->
        <div class="mt-4 flex justify-center text-slate-950 font-mono text-sm tracking-widest">
            <span>&lt;1 2 3 4 5 6&gt;</span>
        </div>
    </main>

    <!-- JS para controlar el Menú Lateral -->
    <script src="{{ asset('js/Menu.js') }}"></script>
</div>
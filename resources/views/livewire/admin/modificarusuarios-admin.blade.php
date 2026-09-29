<div class="min-h-screen bg-white font-['Raleway'] text-slate-950">
    <!-- Carga de Fuentes / CDN si aplica -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Header con Menú Integrado -->
    <header class="relative flex items-center justify-between gap-4 bg-[#D99B00] px-4 py-4 sm:px-8 md:px-12 lg:px-16 border-b border-amber-900">
        <div class="min-w-0">
            <h1 class="text-lg font-bold sm:text-2xl text-slate-950">Edición de Usuarios</h1>
            <p class="text-xs sm:text-sm font-medium">Modificación o corrección de usuarios</p>
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
                <a href="{{ route('usuarios') }}" class="w-36 rounded-xl bg-[#FFD000] px-4 py-2 text-center font-medium hover:bg-amber-400">
                    Usuarios
                </a>
            </nav>
        </aside>
    </header>

    <!-- Contenido Principal -->
    <main class="mx-3 my-5 sm:mx-6 sm:my-8 md:mx-10 lg:mx-12">
        <form class="mx-auto max-w-4xl space-y-6">
            
            <!-- Card / Contenedor con borde del formulario de edición -->
            <div class="rounded-3xl border border-slate-400 bg-white p-6 sm:p-10 shadow-sm">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    
                    <!-- Nombre (s) -->
                    <div class="space-y-1.5">
                        <label for="nombre" class="block text-sm font-bold text-slate-800">
                            Nombre (s):
                        </label>
                        <input 
                            type="text" 
                            id="nombre"
                            placeholder="José Jesús"
                            class="w-full rounded-2xl border border-slate-400 bg-white px-4 py-2 text-sm text-slate-900 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.4)] focus:border-amber-600 focus:outline-none focus:ring-1 focus:ring-amber-600"
                        >
                    </div>

                    <!-- Apellidos -->
                    <div class="space-y-1.5">
                        <label for="apellidos" class="block text-sm font-bold text-slate-800">
                            Apellidos:
                        </label>
                        <input 
                            type="text" 
                            id="apellidos"
                            placeholder="Gómez Pérez"
                            class="w-full rounded-2xl border border-slate-400 bg-white px-4 py-2 text-sm text-slate-900 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.4)] focus:border-amber-600 focus:outline-none focus:ring-1 focus:ring-amber-600"
                        >
                    </div>

                    <!-- Número celular -->
                    <div class="space-y-1.5">
                        <label for="celular" class="block text-sm font-bold text-slate-800">
                            Numero celular:
                        </label>
                        <input 
                            type="text" 
                            id="celular"
                            placeholder="4741469315"
                            class="w-full rounded-2xl border border-slate-400 bg-white px-4 py-2 text-sm text-slate-900 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.4)] focus:border-amber-600 focus:outline-none focus:ring-1 focus:ring-amber-600"
                        >
                    </div>

                    <!-- Correo electrónico -->
                    <div class="space-y-1.5">
                        <label for="email" class="block text-sm font-bold text-slate-800">
                            Correo electrónico:
                        </label>
                        <input 
                            type="email" 
                            id="email"
                            placeholder="ejemplo@gmail.com"
                            class="w-full rounded-2xl border border-slate-400 bg-white px-4 py-2 text-sm text-slate-900 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.4)] focus:border-amber-600 focus:outline-none focus:ring-1 focus:ring-amber-600"
                        >
                    </div>

                    <!-- Contraseña -->
                    <div class="space-y-1.5">
                        <label for="password" class="block text-sm font-bold text-slate-800">
                            Contraseña:
                        </label>
                        <input 
                            type="password" 
                            id="password"
                            placeholder="•••••"
                            class="w-full rounded-2xl border border-slate-400 bg-white px-4 py-2 text-sm text-slate-900 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.4)] focus:border-amber-600 focus:outline-none focus:ring-1 focus:ring-amber-600"
                        >
                    </div>

                    <!-- Rol -->
                    <div class="space-y-1.5">
                        <label for="rol" class="block text-sm font-bold text-slate-800">
                            Rol:
                        </label>
                        <div class="relative">
                            <select 
                                id="rol"
                                class="w-full appearance-none rounded-2xl border border-slate-400 bg-white px-4 py-2 pr-10 text-sm text-slate-900 shadow-[1px_1px_0px_0px_rgba(0,0,0,0.4)] focus:border-amber-600 focus:outline-none focus:ring-1 focus:ring-amber-600"
                            >
                                <option value="Cortador">Cortador</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Almacenista">Almacenista</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-700">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Botones de Acción (Abajo a la Derecha) -->
            <div class="flex items-center justify-end gap-4 pt-2">
                <button 
                    type="submit" 
                    class="rounded-xl border border-amber-900 bg-[#FFD600] px-8 py-2.5 text-sm font-bold text-slate-950 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)] hover:bg-amber-400 transition-all active:translate-y-0.5"
                >
                    Modificar
                </button>

                <a 
                    href="{{ route('usuarios') }}" 
                    class="rounded-xl border border-red-900 bg-[#FF2222] px-8 py-2.5 text-center text-sm font-bold text-white shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)] hover:bg-red-700 transition-all active:translate-y-0.5"
                >
                    Cancelar
                </a>
            </div>

        </form>
    </main>

    <!-- JS para controlar el Menú Lateral -->
    <script src="{{ asset('js/Menu.js') }}"></script>
</div>
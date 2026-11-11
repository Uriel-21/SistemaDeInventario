<div x-data="{ openMenu: false }" @abrir-menu.window="openMenu = true" @keydown.escape.window="openMenu = false">
    <!-- Fondo Oscuro Overlay -->
    <div x-show="openMenu" x-transition.opacity.duration.300ms @click="openMenu = false" style="display: none;"
        class="fixed inset-0 z-40 bg-black/50 backdrop-blur-xs"></div>

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

        <a href="{{ route('dashboard') }}" class="mb-2 mt-6 transition-transform hover:scale-105">
            <img src="{{ asset('Images/Guantes.png') }}" alt="Logo" class="h-20 max-w-full object-contain">
        </a>

        <h2 class="mb-5 text-xl font-bold text-slate-800">Menú Principal</h2>

        <nav class="flex w-full flex-col items-center gap-4">
            @can('ver almacen de materia prima')
                <a href=" {{ route('materiaprima') }} "
                    class="w-36 rounded-xl bg-[#FFD000] px-4 py-2 text-center font-medium hover:bg-amber-400">
                    Materia prima
                </a>
            @endcan

        <!-- Botón de Cerrar y Encabezado -->
        <div class="relative mb-5 flex flex-col items-center border-b border-gray-200 pb-4">
            <button type="button" @click="openMenu = false" aria-label="Cerrar menú"
                class="absolute right-0 top-0 rounded-lg p-1.5 text-slate-700 transition hover:bg-amber-100 hover:text-slate-950 active:scale-95">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <img src="{{ asset('Images/Guantes.png') }}" alt="Logo" class="mt-1 h-16 object-contain">
            <h2 class="mt-2 text-base font-bold text-slate-900 uppercase tracking-wider">Menú Principal</h2>
        </div>

        <!-- Navegación Categorizada -->
        <nav class="flex w-full flex-col gap-5">

            {{-- SECCIÓN: MATERIA PRIMA --}}
            @if (auth()->user()->can('ver almacen de materia prima') ||
                    auth()->user()->can('ver historial de devoluciones de materia prima') ||
                    auth()->user()->can('ver historial de entradas de materia prima') ||
                    auth()->user()->can('ver ajustes de inventario de materia prima'))
                <div class="space-y-2">
                    <div class="flex items-center gap-2 px-1 text-xs font-bold uppercase tracking-wider text-amber-900">
                        <svg class="h-4 w-4 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        <span>Materia Prima</span>
                    </div>
                    <div class="flex flex-col gap-2">
                        @can('ver almacen de materia prima')
                            <a href="{{ route('materiaprima') }}"
                                class="flex items-center justify-between rounded-xl border border-slate-900 bg-[#FFD000] px-3.5 py-2 text-sm font-semibold text-slate-950 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.85)] transition hover:bg-amber-400 hover:translate-x-0.5 active:translate-y-0.5">
                                <span>Almacén Prima</span>
                                <span class="text-xs">➔</span>
                            </a>
                        @endcan

                        @can('ver historial de entradas de materia prima')
                            <a href="{{ route('consultaprima') }}"
                                class="flex items-center justify-between rounded-xl border border-slate-900 bg-amber-50 px-3.5 py-2 text-sm font-semibold text-slate-900 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.85)] transition hover:bg-amber-200 hover:translate-x-0.5 active:translate-y-0.5">
                                <span>Entradas</span>
                                <span class="text-xs">➔</span>
                            </a>
                        @endcan

                        @can('ver historial de devoluciones de materia prima')
                            <a href="{{ route('vistadevolucionprima') }}"
                                class="flex items-center justify-between rounded-xl border border-slate-900 bg-amber-50 px-3.5 py-2 text-sm font-semibold text-slate-900 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.85)] transition hover:bg-amber-200 hover:translate-x-0.5 active:translate-y-0.5">
                                <span>Devoluciones</span>
                                <span class="text-xs">➔</span>
                            </a>
                        @endcan

                        @can('ver ajustes de inventario de materia prima')
                            <a href="{{ route('vistaajusteinventario') }}"
                                class="flex items-center justify-between rounded-xl border border-slate-900 bg-amber-50 px-3.5 py-2 text-sm font-semibold text-slate-900 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.85)] transition hover:bg-amber-200 hover:translate-x-0.5 active:translate-y-0.5">
                                <span>Ajustes de Inventario</span>
                                <span class="text-xs">➔</span>
                            </a>
                        @endcan
                    </div>
                </div>
            @endif

            {{-- SECCIÓN: PRODUCCIÓN Y ASIGNACIONES --}}
            @if (auth()->user()->can('ver asignaciones activas') || auth()->user()->can('ver historial de asignaciones'))
                <div class="space-y-2">
                    <div class="flex items-center gap-2 px-1 text-xs font-bold uppercase tracking-wider text-amber-900">
                        <svg class="h-4 w-4 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <span>Asignaciones</span>
                    </div>
                    <div class="flex flex-col gap-2">
                        @can('ver asignaciones activas')
                            <a href="{{ route('asignaciones.index') }}"
                                class="flex items-center justify-between rounded-xl border border-slate-900 bg-[#FFD000] px-3.5 py-2 text-sm font-semibold text-slate-950 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.85)] transition hover:bg-amber-400 hover:translate-x-0.5 active:translate-y-0.5">
                                <span>Asignaciones Activas</span>
                                <span class="text-xs">➔</span>
                            </a>
                        @endcan

                        @can('ver historial de asignaciones')
                            <a href="{{ route('asignaciones.historial') }}"
                                class="flex items-center justify-between rounded-xl border border-slate-900 bg-amber-50 px-3.5 py-2 text-sm font-semibold text-slate-900 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.85)] transition hover:bg-amber-200 hover:translate-x-0.5 active:translate-y-0.5">
                                <span>Historial Asignaciones</span>
                                <span class="text-xs">➔</span>
                            </a>
                        @endcan
                    </div>
                </div>
            @endif

            {{-- SECCIÓN: PRODUCTO TERMINADO --}}
            @if (auth()->user()->can('ver producto terminado') ||
                    auth()->user()->can('ver lotes en almacen') ||
                    auth()->user()->can('ver historial de salidas de producto terminado') ||
                    auth()->user()->can('ver historial de ajustes de producto terminado'))
                <div class="space-y-2">
                    <div class="flex items-center gap-2 px-1 text-xs font-bold uppercase tracking-wider text-amber-900">
                        <svg class="h-4 w-4 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 8h14M5 8a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2H7a2 2 0 01-2-2V8zm0 0l2 2m10-2l-2 2" />
                        </svg>
                        <span>Producto Terminado</span>
                    </div>
                    <div class="flex flex-col gap-2">
                        @can('ver producto terminado')
                            <a href="{{ route('productoterminado') }}"
                                class="flex items-center justify-between rounded-xl border border-slate-900 bg-[#FFD000] px-3.5 py-2 text-sm font-semibold text-slate-950 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.85)] transition hover:bg-amber-400 hover:translate-x-0.5 active:translate-y-0.5">
                                <span>Almacén Terminado</span>
                                <span class="text-xs">➔</span>
                            </a>
                        @endcan

                        @can('ver lotes en almacen')
                            <a href="{{ route('historiallotes') }}"
                                class="flex items-center justify-between rounded-xl border border-slate-900 bg-amber-50 px-3.5 py-2 text-sm font-semibold text-slate-900 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.85)] transition hover:bg-amber-200 hover:translate-x-0.5 active:translate-y-0.5">
                                <span>Historial de Lotes</span>
                                <span class="text-xs">➔</span>
                            </a>
                        @endcan

                        @can('ver historial de salidas de producto terminado')
                            <a href="{{ route('historialsalidas') }}"
                                class="flex items-center justify-between rounded-xl border border-slate-900 bg-amber-50 px-3.5 py-2 text-sm font-semibold text-slate-900 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.85)] transition hover:bg-amber-200 hover:translate-x-0.5 active:translate-y-0.5">
                                <span>Historial de Salidas</span>
                                <span class="text-xs">➔</span>
                            </a>
                        @endcan

                        @can('ver historial de ajustes de producto terminado')
                            <a href="{{ route('historialAjusteProductoTerminado.show') }}"
                                class="flex items-center justify-between rounded-xl border border-slate-900 bg-amber-50 px-3.5 py-2 text-sm font-semibold text-slate-900 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.85)] transition hover:bg-amber-200 hover:translate-x-0.5 active:translate-y-0.5">
                                <span>Ajustes Terminado</span>
                                <span class="text-xs">➔</span>
                            </a>
                        @endcan

                        <a href="{{ route('etiquetasPendientes') }}"
                            class="flex items-center justify-between rounded-xl border border-slate-900 bg-amber-50 px-3.5 py-2 text-sm font-semibold text-slate-900 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.85)] transition hover:bg-amber-200 hover:translate-x-0.5 active:translate-y-0.5">
                            <span>Etiquetas Pendientes</span>
                            <span class="text-xs">➔</span>
                        </a>
                    </div>
                </div>
            @endif

            {{-- SECCIÓN: ADMINISTRACIÓN --}}
            @can('ver usuarios')
                <div class="space-y-2 border-t border-gray-200 pt-3">
                    <div class="flex items-center gap-2 px-1 text-xs font-bold uppercase tracking-wider text-amber-900">
                        <svg class="h-4 w-4 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <span>Administración</span>
                    </div>
                    <div class="flex flex-col gap-2">
                        <a href="{{ route('usuarios') }}"
                            class="flex items-center justify-between rounded-xl border border-slate-900 bg-sky-300 px-3.5 py-2 text-sm font-semibold text-slate-950 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.85)] transition hover:bg-sky-400 hover:translate-x-0.5 active:translate-y-0.5">
                            <span>Gestión de Usuarios</span>
                            <span class="text-xs">➔</span>
                        </a>
                    </div>
                </div>
            @endcan

        </nav>
    </aside>
</div>
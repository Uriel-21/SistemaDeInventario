<div class="min-h-screen bg-slate-50 font-['Raleway'] text-slate-900">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Header --}}
    <livewire:layouts.header title="Dashboard del stock" subtitle="Visión general del almacén e inventario" />

    {{-- Menú --}}
    <livewire:layouts.menu />

    <main class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
        
        <!-- Barra Superior de Acciones Directas -->
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-900 border border-amber-300">
                    <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    Estado del Inventario: Óptimo
                </span>
            </div>

            <div class="flex items-center gap-3">
                <a href="#"
                   class="inline-flex items-center gap-2 rounded-xl border border-amber-900 bg-[#FFD600] px-4 py-2.5 text-sm font-bold text-slate-950 shadow-[3px_3px_0px_0px_rgba(0,0,0,0.85)] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    Materia prima
                </a>
                <a href="#"
                   class="inline-flex items-center gap-2 rounded-xl border border-amber-900 bg-[#FFD600] px-4 py-2.5 text-sm font-bold text-slate-950 shadow-[3px_3px_0px_0px_rgba(0,0,0,0.85)] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    Vista del Stock
                </a>
            </div>
        </div>

        <!-- Contenedor Principal de Métricas (4 Opciones Clicables) -->
        <div class="rounded-3xl border-2 border-amber-900 bg-[#D99B00] p-6 sm:p-8 shadow-[6px_6px_0px_0px_rgba(0,0,0,0.85)]">
            
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                
                <!-- 1. TARJETA DESTACADA (HERO): Total de pares en almacén -->
                <a href="#" class="group md:col-span-2 relative overflow-hidden flex flex-col justify-between rounded-2xl border-2 border-amber-900 bg-[#FFF8E7] p-6 sm:p-7 shadow-sm hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,0.85)] transition-all">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-extrabold uppercase tracking-wider text-amber-900">Métrica Principal</p>
                            <h3 class="mt-1 text-xl font-bold text-slate-900 group-hover:underline decoration-2 underline-offset-4">Total de pares en almacén</h3>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="rounded-xl border border-amber-900 bg-[#FFD600] p-3 text-slate-950">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v1a2 2 0 01-2 2M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex items-end justify-between gap-4">
                        <div class="flex flex-wrap items-baseline gap-4">
                            <span class="text-4xl font-extrabold tracking-tight sm:text-5xl text-slate-950">32,800</span>
                            <span class="inline-flex items-center text-xs font-bold text-emerald-700 bg-emerald-100 px-2.5 py-1 rounded-full border border-emerald-300">
                                ↑ Disposición alta
                            </span>
                        </div>
                        <span class="inline-flex items-center gap-1 text-xs font-extrabold text-amber-950 group-hover:translate-x-1 transition-transform">
                            Ver detalle
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </span>
                    </div>
                </a>

                <!-- 2. Modelos activos -->
                <a href="#" class="group flex items-center justify-between gap-4 rounded-2xl border-2 border-amber-900 bg-[#F5D477] p-6 hover:bg-[#ebd083] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,0.85)] transition-all">
                    <div class="flex items-center gap-4">
                        <div class="rounded-xl border border-amber-900 bg-white p-3.5 text-amber-950 shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 10h.01M7 13h.01M10 7h7M10 10h7M10 13h7M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs font-extrabold text-amber-950 uppercase tracking-wide">Modelos activos</p>
                            <p class="mt-0.5 text-3xl font-extrabold text-slate-950">15 <span class="text-sm font-semibold text-slate-800">Modelos</span></p>
                        </div>
                    </div>
                    <svg class="w-5 h-5 text-amber-950 shrink-0 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                </a>

                <!-- 3. Cantidad de cortes en el día -->
                <a href="#" class="group flex items-center justify-between gap-4 rounded-2xl border-2 border-amber-900 bg-[#F5D477] p-6 hover:bg-[#ebd083] hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,0.85)] transition-all">
                    <div class="flex items-center gap-4">
                        <div class="rounded-xl border border-amber-900 bg-white p-3.5 text-amber-950 shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs font-extrabold text-amber-950 uppercase tracking-wide">Cantidad de cortes en el día</p>
                            <p class="mt-0.5 text-3xl font-extrabold text-slate-950">1,000 <span class="text-sm font-semibold text-slate-800">Cortes</span></p>
                        </div>
                    </div>
                    <svg class="w-5 h-5 text-amber-950 shrink-0 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                </a>

                <!-- 4. Talla más solicitada (Barra inferior completa) -->
                <a href="#" class="group md:col-span-2 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between rounded-2xl border-2 border-amber-900 bg-[#FFF8E7] px-6 py-4 shadow-sm hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,0.85)] transition-all">
                    <div class="flex items-center gap-3">
                        <div class="rounded-full bg-amber-200 p-2 text-amber-900">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        </div>
                        <span class="text-sm font-bold text-slate-800">Talla más solicitada:</span>
                    </div>
                    <div class="flex items-center gap-3 self-start sm:self-auto">
                        <span class="rounded-xl border border-amber-900 bg-[#FFD600] px-4 py-1.5 text-lg font-extrabold text-slate-950">
                            Talla M / L
                        </span>
                        <svg class="w-5 h-5 text-amber-950 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </div>
                </a>

            </div>
        </div>
    </main>
</div>
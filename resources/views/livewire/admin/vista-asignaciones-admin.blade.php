<div x-data="{ crearAsignacion: false, paso: 1, modalMateriaAdicional = false, modalFinalizarAsignacion = false }" @keydown.escape.window="modalMateriaAdicional = false, modalFinalizarAsignacion = false">
    {{-- Carga de fuentes/CDN si aún no están incluidas en el layout --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <livewire:layouts.header title="Asignaciones activas de material"
        subtitle="Datos generales de la asignación de material" />

    <livewire:layouts.menu />

    <main
        class="mx-3 my-5 overflow-hidden rounded-2xl border border-amber-900 bg-white font-['Raleway'] text-slate-950 shadow-sm sm:mx-6 sm:my-8 md:mx-10 lg:mx-12">

    </main>
</div>

<div>
    <div x-data="{
        vista: 'tabla',
        paso: 1,
        modalMaterialAdicional: false,
        modalFinalizarAsignacion: false
    }" @keydown.escape.window="modalMateriaAdicional = false; modalFinalizarAsignacion = false">

        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap"
            rel="stylesheet">

        <livewire:layouts.header title="Asignaciones activas de material"
            subtitle="Datos generales de la asignación de material" />
        <livewire:layouts.menu />

        <main
            class="mx-3 my-5 overflow-hidden rounded-2xl border border-amber-900 bg-white font-['Raleway'] text-slate-950 shadow-sm sm:mx-6 sm:my-8 md:mx-10 lg:mx-12">

            <div x-show="vista === 'tabla'">
                <livewire:admin.asignaciones.vista-asignaciones-activas />
            </div>


            <div x-show="vista === 'crear'" style="display: none;">
                <livewire:admin.asignaciones.crear-asignacion />
            </div>

        </main>
        <livewire:admin.asignaciones.modal-materia-adicional />
        <livewire:admin.asignaciones.modal-finalizar-asignacion />
    </div>

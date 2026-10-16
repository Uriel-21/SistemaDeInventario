<div>
    <section class="p-4 sm:p-6">
        <div class="mb-6">
            <h1 class="text-xl font-bold sm:text-2xl">Nueva asignación</h1>
            <p class="mt-1 text-sm text-slate-600">Sigue los pasos para completar la asignación de material.</p>
        </div>

        <div class="mb-8">
            <div class="relative mx-auto flex max-w-3xl items-start justify-between">
                {{-- Línea gris de fondo --}}
                <div class="absolute left-0 right-0 top-4 h-0.5 bg-gray-300"></div>
                {{-- Línea verde que avanza. La fórmula cambia porque ahora son 3 pasos (divido entre 2) --}}
                <div class="absolute left-0 top-4 h-0.5 bg-green-600 transition-all duration-300"
                    :style="`width: ${(paso - 1) / 2 * 100}%`"></div>


                <div class="relative z-10 flex flex-col items-center text-center">
                    <span
                        class="flex h-8 w-8 items-center justify-center rounded-full border-2 text-sm font-bold transition-colors"
                        :class="paso >= 1 ? 'border-green-700 bg-green-600 text-white' :
                            'border-gray-300 bg-white text-gray-500'">1</span>
                    <span class="mt-2 text-xs font-medium">Cortador</span>
                </div>

                <div class="relative z-10 flex flex-col items-center text-center">
                    <span
                        class="flex h-8 w-8 items-center justify-center rounded-full border-2 text-sm font-bold transition-colors"
                        :class="paso >= 2 ? 'border-green-700 bg-green-600 text-white' :
                            'border-gray-300 bg-white text-gray-500'">2</span>
                    <span class="mt-2 text-xs font-medium">Material</span>
                </div>

                <div class="relative z-10 flex flex-col items-center text-center">
                    <span
                        class="flex h-8 w-8 items-center justify-center rounded-full border-2 text-sm font-bold transition-colors"
                        :class="paso >= 3 ? 'border-green-700 bg-green-600 text-white' :
                            'border-gray-300 bg-white text-gray-500'">3</span>
                    <span class="mt-2 text-xs font-medium">Confirmar</span>
                </div>
            </div>
        </div>
        <form wire:submit.prevent="save">
            <div x-show="paso === 1" class="min-h-64">
                {{-- Encabezado --}}
                <div class="mb-4 bg-[#D99B00] px-4 py-3 text-white rounded-t-md">
                    <h2 class="font-bold">Seleccionar cortador</h2>
                    <p class="text-sm">Buscar y seleccionar el empleado encargado del corte</p>
                </div>

                @if ($nombreCortadorSeleccionado)
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[450px] border-collapse">
                            <thead>
                                <tr
                                    class="divide-x divide-gray-400 border border-slate-900 bg-gray-200 text-center text-sm">
                                    <th class="p-2">Cortador Asignado</th>
                                    <th class="p-2 w-32">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    class="h-20 divide-x divide-gray-400 border-x border-b border-slate-900 bg-green-50">
                                    <td class="p-3 font-semibold text-green-900">
                                        <div class="flex items-center gap-2">
                                            <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            {{ $nombreCortadorSeleccionado }}
                                        </div>
                                    </td>
                                    <td class="p-3 text-center">
                                        <button type="button" wire:click="quitarSeleccionCortador"
                                            class="rounded-md border border-slate-900 bg-red-500 px-4 py-1.5 text-xs font-bold text-white shadow-sm hover:bg-red-400 transition">
                                            Cambiar
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @else
                    {{-- Buscador --}}
                    <input type="search" wire:model.live.debounce.300ms="searchCortador"
                        placeholder="Buscar cortador..."
                        class="mb-4 w-full border border-slate-900 bg-gray-100 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 sm:max-w-md rounded-md">

                    {{-- Tabla con los 5 cortadores o los resultados de búsqueda --}}
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[450px] border-collapse">
                            <thead>
                                <tr
                                    class="divide-x divide-gray-400 border border-slate-900 bg-gray-200 text-center text-sm">
                                    <th class="p-2">Nombre completo</th>
                                    <th class="p-2 w-32">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($cortadores as $cortador)
                                    <tr
                                        class="h-20 divide-x divide-gray-400 border-x border-b border-slate-900 bg-gray-50 hover:bg-gray-100 transition">

                                        <td class="p-3">{{ $cortador->name }} ({{ $cortador->email }})</td>

                                        <td class="p-3 text-center">
                                            <button type="button"
                                                wire:click="seleccionarCortador({{ $cortador->id }}, '{{ $cortador->name }}')"
                                                class="rounded-md border border-slate-900 bg-sky-400 px-4 py-1.5 text-xs font-bold shadow-sm hover:bg-sky-300">
                                                Seleccionar
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="border-x border-b border-slate-900 bg-gray-50">
                                        <td colspan="2" class="p-3 text-center text-gray-500">
                                            No se encontraron cortadores con ese nombre.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <div x-show="paso === 2" class="min-h-64">
                {{-- Encabezado idéntico a la imagen --}}
                <div class="mb-4 bg-[#D99B00] px-4 py-3 text-white rounded-t-md">
                    <h2 class="font-bold">Seleccionar el material</h2>
                    <p class="text-sm">Buscar, seleccionar y elegir la cantidad de material</p>
                </div>

                {{-- ZONA DE BÚSQUEDA Y TABLA --}}
                @if ($nombreMaterialSeleccionado)
                    <div class="overflow-x-auto mb-6">
                        <table class="w-full min-w-[450px] border-collapse border border-slate-900">
                            <thead>
                                <tr
                                    class="divide-x divide-gray-400 border-b border-slate-900 bg-gray-200 text-center text-sm">
                                    <th class="p-2">Nombre del material</th>
                                    <th class="p-2">Cantidad disponible</th>
                                    <th class="p-2 w-32">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="h-16 divide-x divide-gray-400 border-b border-slate-900 bg-green-50">
                                    <td class="p-3 font-semibold text-green-900 text-center">
                                        {{ $nombreMaterialSeleccionado }}</td>
                                    <td class="p-3 text-center text-green-700 font-bold">Seleccionado</td>
                                    <td class="p-3 text-center">
                                        <button type="button" wire:click="quitarSeleccionMaterial"
                                            class="rounded-md border border-slate-900 bg-red-500 px-4 py-1.5 text-xs font-bold text-white shadow-sm hover:bg-red-400 transition">
                                            Cambiar
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="relative mb-4">
                        <input type="search" wire:model.live.debounce.300ms="searchMaterial"
                            placeholder="Buscar material..."
                            class="w-full border border-slate-900 bg-gray-100 px-3 py-2 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 rounded-sm">
                        <svg class="absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-600"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21-4.35-4.35M19 10.5a8.5 8.5 0 1 1-17 0 8.5 8.5 0 0 1 17 0Z" />
                        </svg>
                    </div>

                    <div class="overflow-x-auto mb-6">
                        <table class="w-full min-w-[450px] border-collapse border border-slate-900">
                            <thead>
                                <tr
                                    class="divide-x divide-gray-400 border-b border-slate-900 bg-gray-200 text-center text-sm">
                                    <th class="p-2 font-normal">Nombre del material</th>
                                    <th class="p-2 font-normal">Cantidad disponible</th>
                                    <th class="p-2 font-normal w-32">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($materiales as $material)
                                    <tr
                                        class="h-16 divide-x divide-gray-400 border-b border-slate-900 bg-gray-50 hover:bg-gray-100 transition">
                                        <td class="p-3">{{ $material->nombre }}</td>
                                        <td class="p-3 text-center">{{ $material->stock_real_dm ?? '0' }}</td>
                                        <td class="p-3 text-center">
                                            <button type="button"
                                                wire:click="seleccionarMaterial({{ $material->id }}, '{{ $material->nombre }}', {{ $material->stock_real_dm }})"
                                                class="rounded-md border border-slate-900 bg-[#6BA4E8] px-4 py-1 text-xs text-black shadow-sm hover:bg-blue-400">
                                                Seleccionar
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="border-b border-slate-900 bg-gray-50">
                                        <td colspan="3" class="p-3 text-center text-gray-500">No se encontraron
                                            materiales.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @endif

                <div
                    class="flex flex-col md:flex-row gap-8 {{ !$nombreMaterialSeleccionado ? 'opacity-50 pointer-events-none' : '' }}">

                    {{-- Columna Izquierda: Inputs --}}
                    <div class="flex-1 flex flex-col justify-center space-y-6">
                        <div>
                            <div class="flex justify-between items-end mb-1">
                                <label class="block text-sm text-gray-800">Cantidad (dm):</label>
                                <span class="text-xs text-gray-500">Disponible: {{ $stock_disponible }} dm</span>
                            </div>

                            <input type="number" step="any" wire:model.live="form.dm_iniciales"
                                class="w-48 rounded-md border bg-gray-100 px-3 py-1 text-sm shadow-inner focus:outline-none focus:ring-2 {{ $form->dm_iniciales > $stock_disponible ? 'border-red-500 focus:ring-red-200' : 'border-slate-900 focus:ring-amber-500' }}">

                            @if ($form->dm_iniciales > $stock_disponible)
                                <p class="text-red-600 text-xs font-bold mt-1">
                                    ¡Excede el stock por {{ $form->dm_iniciales - $stock_disponible }} dm!
                                </p>
                            @endif
                        </div>

                        <div>
                            <label class="block text-sm text-gray-800 mb-1"> Gasto por corte (dm):</label>
                            <input type="number" step="0.01" wire:model.live="form.consumo_estimado"
                                class="w-48 rounded-md border border-slate-900 bg-gray-100 px-3 py-1 text-sm shadow-inner focus:outline-none focus:ring-2 focus:ring-amber-500">
                        </div>
                    </div>

                    <div class="flex-1">
                        <div
                            class="h-full min-h-[140px] rounded-md border border-slate-900 bg-[#EFEFEF] flex flex-col items-center justify-center p-4">
                            <span class="text-sm text-gray-800 mb-4">Piezas estimadas</span>

                            <span class="text-5xl font-light text-slate-800">
                                @if ($form->dm_iniciales && $form->consumo_estimado && $form->consumo_estimado > 0)
                                    {{ round($form->dm_iniciales / $form->consumo_estimado, 2) }}
                                @else
                                    XX
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>


            <div x-show="paso === 3" style="display: none;" class="min-h-64">
                <div class="mb-4 bg-[#D99B00] px-4 py-3 text-white rounded-t-md">
                    <h2 class="font-bold">Resumen de Asignación</h2>
                    <p class="text-sm">Verifica que los datos sean correctos antes de guardar</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-gray-50 p-6 border border-gray-300 rounded-md">
                    {{-- Resumen del Cortador --}}
                    <div>
                        <h3
                            class="text-sm font-bold text-gray-500 uppercase tracking-wider border-b border-gray-300 pb-2 mb-3">
                            Datos del Cortador
                        </h3>
                        {{-- Mostramos el nombre seleccionado. Si por alguna razón está vacío, mostramos un texto por defecto --}}
                        <p class="text-lg font-semibold">
                            {{ $nombreCortadorSeleccionado ?: 'Ningún cortador seleccionado' }}
                        </p>
                    </div>

                    {{-- Resumen del Material --}}
                    <div>
                        <h3
                            class="text-sm font-bold text-gray-500 uppercase tracking-wider border-b border-gray-300 pb-2 mb-3">
                            Datos del Material
                        </h3>
                        <p class="text-lg font-semibold">
                            {{ $nombreMaterialSeleccionado ?: 'Ningún material seleccionado' }}
                        </p>
                        <ul class="mt-2 space-y-1 text-sm">
                            <li>
                                <span class="font-medium">Total asignado:</span>
                                {{ $form->dm_iniciales ?: '0' }} dm
                            </li>
                            <li>
                                <span class="font-medium">Gasto por tarea (25 Unidades):</span>
                                {{ $form->consumo_estimado ?: '0' }} dm
                            </li>
                            <li>
                                <span class="font-medium">Tareas estimadas:</span>
                                @if ($form->dm_iniciales && $form->consumo_estimado && $form->consumo_estimado > 0)
                                    {{ floor($form->dm_iniciales / $form->consumo_estimado) }}
                                @else
                                    0
                                @endif
                                Tareas
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="mt-4 p-3 bg-blue-50 border border-blue-200 rounded-md text-blue-800 text-sm">
                    <strong>Nota:</strong> Al confirmar, el material será descontado del inventario y asignado al
                    cortador.
                </div>
            </div>
            {{-- Botonera inferior para cambiar de pasos --}}
            <div class="mt-8 flex flex-col-reverse justify-end gap-3 sm:flex-row">

                {{-- Botón Anterior --}}
                <button type="button" x-show="paso > 1" @click="paso--"
                    class="rounded-md border border-slate-900 bg-white px-5 py-2 text-sm font-bold shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] transition hover:bg-gray-100">
                    Anterior
                </button>

                {{-- Botón Siguiente --}}
                <button type="button" x-show="paso < 3" @click="paso++"
                    class="rounded-md border border-slate-900 bg-[#8BD044] px-5 py-2 text-sm font-bold shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] transition hover:bg-green-400">
                    Siguiente
                </button>

                {{-- Botón Guardar --}}
                <button type="submit" x-show="paso === 3"
                    class="rounded-md border border-slate-900 bg-[#9fc836] px-5 py-2 text-sm font-bold shadow-[1px_1px_0px_0px_rgba(0,0,0,0.7)] transition hover:bg-[#25b3b5]">
                    Confirmar y Guardar
                </button>

            </div>
        </form>
    </section>
</div>

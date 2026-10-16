<div>
    <section class="p-4 sm:p-6">
        {{-- Tabla principal --}}
        <div class="overflow-x-auto bg-white">
            <table class="w-full min-w-[800px] border-collapse border border-slate-900 text-sm">
                <thead>
                    <tr class="bg-[#E5E7EB] text-center">
                        <th class="border border-slate-900 p-3 font-bold text-slate-900">Cortador</th>
                        <th class="border border-slate-900 p-3 font-bold text-slate-900">Material</th>
                        <th class="border border-slate-900 p-3 font-bold text-slate-900">Asignado (dm)</th>
                        <th class="border border-slate-900 p-3 font-bold text-slate-900">Piezas Estimadas</th>
                        <th class="border border-slate-900 p-3 font-bold text-slate-900">Estado</th>
                        <th class="border border-slate-900 p-3 font-bold text-slate-900 w-48">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($asignaciones as $asignacion)
                        <tr class="bg-[#F8FAFC] transition-colors hover:bg-gray-100">

                            <td class="border border-slate-900 p-3 text-slate-900">
                                {{ $asignacion->user->name ?? 'Usuario eliminado' }}
                            </td>

                            <td class="border border-slate-900 p-3 text-slate-900">
                                {{ $asignacion->materiaPrima->nombre ?? 'Material no encontrado' }}
                            </td>

                            <td class="border border-slate-900 p-3 font-bold text-slate-700 text-center">
                                {{ number_format($asignacion->dm_iniciales, 2) }}
                                @if ($asignacion->dm_adicionales > 0)
                                    <span class="text-amber-600">+
                                        {{ number_format($asignacion->dm_adicionales, 2) }}</span>
                                @endif
                                dm
                            </td>

                            <td class="border border-slate-900 p-3 text-center text-slate-900">
                                {{ $asignacion->cortes_estimados }}
                            </td>

                            <td class="border border-slate-900 p-3 text-center">
                                {{ ucfirst($asignacion->estado) }}
                            </td>

                            {{-- Botones de acción dentro de la tabla (Azul cielo como en la imagen) --}}
                            <td class="border border-slate-900 p-3 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button type="button"
                                        wire:click="$dispatch('abrir-modal-finalizar', { id: {{ $asignacion->id }} })"
                                        class="rounded-sm border border-slate-900 bg-[#029eff] px-3 py-1.5 text-xs font-bold text-slate-900 transition hover:bg-sky-400">
                                        Finalizar
                                    </button>

                                    <button type="button"
                                        wire:click="$dispatch('abrir-modal-adicional', { id: {{ $asignacion->id }} })"
                                        class="rounded-sm border border-slate-900 bg-[#03efc0] px-3 py-1.5 text-xs font-bold text-slate-900 transition hover:bg-sky-400">
                                        + Material
                                    </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6"
                                class="border border-slate-900 bg-[#F8FAFC] p-8 text-center text-slate-600">
                                No hay asignaciones pendientes en este momento.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Botonera inferior (Rojo, Verde, Amarillo) --}}
        <div class="mt-4 flex flex-col justify-between gap-3 sm:flex-row sm:items-center">

            {{-- Botones de Exportación
            <div class="flex gap-2">
                <button type="button"
                    class="rounded-sm border border-slate-900 bg-[#F87171] px-4 py-2 text-sm font-bold text-slate-900 transition hover:bg-red-500">
                    Exportar a PDF
                </button>

                <button type="button"
                    class="rounded-sm border border-slate-900 bg-[#84CC16] px-4 py-2 text-sm font-bold text-slate-900 transition hover:bg-lime-600">
                    Exportar a Excel
                </button>
            </div> --}}

            {{-- Botón de Nueva Entrada --}}
            <button type="button" @click="vista = 'crear'; paso = 1"
                class="rounded-sm border border-slate-900 bg-[#FFD600] px-5 py-2 text-sm font-bold text-slate-900 transition hover:bg-yellow-400">
                + Nueva asignación
            </button>

        </div>
    </section>
</div>

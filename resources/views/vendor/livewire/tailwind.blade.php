@if ($paginator->hasPages())
    <div class="mt-6 flex items-center justify-center gap-2">

        <!-- Botón Anterior -->
        @if ($paginator->onFirstPage())
            <span
                class="cursor-not-allowed rounded-xl border border-amber-900 bg-slate-100 px-4 py-2 text-sm font-bold text-slate-400 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)]">
                &laquo; Ant
            </span>
        @else
            <button wire:click="previousPage"
                class="rounded-xl border border-amber-900 bg-white px-4 py-2 text-sm font-bold text-slate-900 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)] transition-colors hover:bg-[#FFD600]">
                &laquo; Ant
            </button>
        @endif

        <!-- Números de Página -->
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            @if ($i == $paginator->currentPage())
                <!-- Página Actual (Amarillo) -->
                <span
                    class="rounded-xl border border-amber-900 bg-[#D99B00] px-4 py-2 text-sm font-black text-slate-950 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)]">
                    {{ $i }}
                </span>
            @else
                <!-- Otras Páginas (Blancas) -->
                <button wire:click="gotoPage({{ $i }})"
                    class="rounded-xl border border-amber-900 bg-white px-4 py-2 text-sm font-bold text-slate-900 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)] transition-colors hover:bg-[#FFD600]">
                    {{ $i }}
                </button>
            @endif
        @endfor

        <!-- Botón Siguiente -->
        @if ($paginator->hasMorePages())
            <button wire:click="nextPage"
                class="rounded-xl border border-amber-900 bg-white px-4 py-2 text-sm font-bold text-slate-900 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)] transition-colors hover:bg-[#FFD600]">
                Sig &raquo;
            </button>
        @else
            <span
                class="cursor-not-allowed rounded-xl border border-amber-900 bg-slate-100 px-4 py-2 text-sm font-bold text-slate-400 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)]">
                Sig &raquo;
            </span>
        @endif

    </div>
@endif

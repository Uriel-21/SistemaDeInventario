<div>
    <header
        class="relative flex items-center justify-between gap-4 bg-[#D99B00] px-4 py-4 sm:px-8 md:px-12 lg:px-16 border-b border-amber-900">
        <div class="min-w-0">
            <h1 class="text-lg font-bold sm:text-2xl text-slate-950"> {{ $title }} </h1>
            <p class="text-xs sm:text-sm font-medium"> {{ $subtitle }} </p>
        </div>
        <button type="button" @click="$dispatch('abrir-menu')" aria-label="Abrir menú"
            class="flex h-11 w-12 shrink-0 flex-col items-center justify-center gap-1.5 rounded-lg border border-amber-900 bg-[#FFD600] shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)] hover:bg-amber-400 transition-colors">
            <span class="h-0.5 w-6 rounded bg-slate-900"></span>
            <span class="h-0.5 w-6 rounded bg-slate-900"></span>
            <span class="h-0.5 w-6 rounded bg-slate-900"></span>
        </button>
</div>

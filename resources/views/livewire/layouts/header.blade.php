<div>
    <header x-data="{ openUserMenu: false }"
        class="relative flex items-center justify-between gap-4 bg-[#D99B00] px-4 py-4 sm:px-8 md:px-12 lg:px-16 border-b border-amber-900">
        
        <!-- Título y Subtítulo -->
        <div class="min-w-0">
            <h1 class="text-lg font-bold sm:text-2xl text-slate-950"> {{ $title }} </h1>
            <p class="text-xs sm:text-sm font-medium text-slate-900"> {{ $subtitle }} </p>
        </div>

        <!-- Contenedor Derecho: Menú de Usuario y Botón Hamburguesa -->
        <div class="flex items-center gap-3">
            
            <!-- Dropdown del Usuario -->
            <div class="relative">
                <!-- Botón Trigger (Foto o Nombre) -->
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <button @click="openUserMenu = ! openUserMenu" 
                            class="flex text-sm border-2 border-amber-900 rounded-full focus:outline-none focus:ring-2 focus:ring-amber-950 transition shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)]">
                        <img class="size-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </button>
                @else
                    <button @click="openUserMenu = ! openUserMenu" 
                            type="button" 
                            class="inline-flex items-center px-3 py-2 border border-amber-900 text-sm leading-4 font-bold rounded-lg text-slate-950 bg-[#FFD600] shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)] hover:bg-amber-400 focus:outline-none transition">
                        {{ Auth::user()->name }}
                        <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                @endif

                <!-- Menú Desplegable -->
                <div x-show="openUserMenu" 
                     @click.outside="openUserMenu = false"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="absolute right-0 z-50 mt-2 w-56 rounded-xl bg-white py-2 shadow-xl border-2 border-amber-900" 
                     style="display: none;">
                    
                    <!-- Gestión de Cuenta -->
                    <div class="block px-4 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                        {{ __('Gestionar Cuenta') }}
                    </div>

                    <x-dropdown-link href="{{ route('profile.show') }}" class="hover:bg-amber-100 text-gray-800">
                        {{ __('Perfil') }}
                    </x-dropdown-link>

                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-dropdown-link href="{{ route('api-tokens.index') }}" class="hover:bg-amber-100 text-gray-800">
                            {{ __('API Tokens') }}
                        </x-dropdown-link>
                    @endif

                    <!-- Equipos (Teams) si aplica -->
                    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                        <div class="border-t border-gray-200 my-1"></div>

                        <div class="block px-4 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                            {{ __('Manage Team') }}
                        </div>

                        <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" class="hover:bg-amber-100 text-gray-800">
                            {{ __('Team Settings') }}
                        </x-dropdown-link>

                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                            <x-dropdown-link href="{{ route('teams.create') }}" class="hover:bg-amber-100 text-gray-800">
                                {{ __('Create New Team') }}
                            </x-dropdown-link>
                        @endcan

                        @if (Auth::user()->allTeams()->count() > 1)
                            <div class="border-t border-gray-200 my-1"></div>

                            <div class="block px-4 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                {{ __('Switch Teams') }}
                            </div>

                            @foreach (Auth::user()->allTeams() as $team)
                                <x-switchable-team :team="$team" />
                            @endforeach
                        @endif
                    @endif

                    <div class="border-t border-gray-200 my-1"></div>

                    <!-- Cerrar Sesión -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <x-dropdown-link href="{{ route('logout') }}"
                                         @click.prevent="$root.submit();" 
                                         class="text-red-600 hover:bg-red-50 font-medium">
                            {{ __('Cerrar Sesión') }}
                        </x-dropdown-link>
                    </form>
                </div>
            </div>

            <!-- Botón de Menú Hamburguesa Principal -->
            <button type="button" @click="$dispatch('abrir-menu')" aria-label="Abrir menú"
                class="flex h-11 w-12 shrink-0 flex-col items-center justify-center gap-1.5 rounded-lg border border-amber-900 bg-[#FFD600] shadow-[2px_2px_0px_0px_rgba(0,0,0,0.7)] hover:bg-amber-400 transition-colors">
                <span class="h-0.5 w-6 rounded bg-slate-900"></span>
                <span class="h-0.5 w-6 rounded bg-slate-900"></span>
                <span class="h-0.5 w-6 rounded bg-slate-900"></span>
            </button>
        </div>
    </header>
</div>
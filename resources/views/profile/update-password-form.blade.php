<div class="rounded-3xl border-2 border-amber-900 bg-[#D99B00] p-6 sm:p-8 shadow-[6px_6px_0px_0px_rgba(0,0,0,0.85)] max-w-4xl mx-auto my-6">
    
    <!-- Encabezado del Formulario -->
    <div class="mb-6 border-b border-amber-900/30 pb-4">
        <h3 class="text-xl font-extrabold text-slate-950">
            {{ __('Actualizar Contraseña') }}
        </h3>
        <p class="text-xs sm:text-sm font-medium text-slate-900 mt-1">
            {{ __('Asegúrate de que tu cuenta esté utilizando una contraseña larga y aleatoria para mantener la seguridad.') }}
        </p>
    </div>

    <!-- Formulario de Livewire -->
    <form wire:submit="updatePassword">
        
        <div class="grid grid-cols-1 gap-5">

            <!-- Contraseña Actual -->
            <div class="col-span-1">
                <label for="current_password" class="block text-sm font-bold text-slate-950 mb-1">
                    {{ __('Contraseña Actual') }}
                </label>
                
                <div class="relative" x-data="{ showCurrent: false }">
                    <input id="current_password" 
                           :type="showCurrent ? 'text' : 'password'" 
                           class="block w-full bg-gray-200 border-none rounded-xl py-3 pl-4 pr-12 text-gray-800 placeholder-gray-500 focus:ring-2 focus:ring-yellow-500 focus:bg-white transition" 
                           wire:model="state.current_password" 
                           autocomplete="current-password" 
                           placeholder="Ingresa tu contraseña actual" />

                    <button type="button" 
                            @click="showCurrent = !showCurrent" 
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600 hover:text-black focus:outline-none">
                        <template x-if="!showCurrent">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-7 0-10-7-10-7a19.16 19.16 0 014.13-5.225m3.75-2.222A9.97 9.97 0 0112 4c7 0 10 7 10 7a19.26 19.26 0 01-2.923 3.821M15 12a3 3 0 11-6 0 3 3 0 016 0zM3 3l18 18"></path></svg>
                        </template>
                        <template x-if="showCurrent">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </template>
                    </button>
                </div>
                <x-input-error for="current_password" class="mt-2 text-red-700 font-bold text-xs" />
            </div>

            <!-- Nueva Contraseña -->
            <div class="col-span-1">
                <label for="password" class="block text-sm font-bold text-slate-950 mb-1">
                    {{ __('Nueva Contraseña') }}
                </label>
                
                <div class="relative" x-data="{ showNew: false }">
                    <input id="password" 
                           :type="showNew ? 'text' : 'password'" 
                           class="block w-full bg-gray-200 border-none rounded-xl py-3 pl-4 pr-12 text-gray-800 placeholder-gray-500 focus:ring-2 focus:ring-yellow-500 focus:bg-white transition" 
                           wire:model="state.password" 
                           autocomplete="new-password" 
                           placeholder="Escribe tu nueva contraseña" />

                    <button type="button" 
                            @click="showNew = !showNew" 
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600 hover:text-black focus:outline-none">
                        <template x-if="!showNew">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-7 0-10-7-10-7a19.16 19.16 0 014.13-5.225m3.75-2.222A9.97 9.97 0 0112 4c7 0 10 7 10 7a19.26 19.26 0 01-2.923 3.821M15 12a3 3 0 11-6 0 3 3 0 016 0zM3 3l18 18"></path></svg>
                        </template>
                        <template x-if="showNew">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </template>
                    </button>
                </div>
                <x-input-error for="password" class="mt-2 text-red-700 font-bold text-xs" />
            </div>

            <!-- Confirmar Contraseña -->
            <div class="col-span-1">
                <label for="password_confirmation" class="block text-sm font-bold text-slate-950 mb-1">
                    {{ __('Confirmar Nueva Contraseña') }}
                </label>
                
                <div class="relative" x-data="{ showConfirm: false }">
                    <input id="password_confirmation" 
                           :type="showConfirm ? 'text' : 'password'" 
                           class="block w-full bg-gray-200 border-none rounded-xl py-3 pl-4 pr-12 text-gray-800 placeholder-gray-500 focus:ring-2 focus:ring-yellow-500 focus:bg-white transition" 
                           wire:model="state.password_confirmation" 
                           autocomplete="new-password" 
                           placeholder="Confirma la contraseña" />

                    <button type="button" 
                            @click="showConfirm = !showConfirm" 
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600 hover:text-black focus:outline-none">
                        <template x-if="!showConfirm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-7 0-10-7-10-7a19.16 19.16 0 014.13-5.225m3.75-2.222A9.97 9.97 0 0112 4c7 0 10 7 10 7a19.26 19.26 0 01-2.923 3.821M15 12a3 3 0 11-6 0 3 3 0 016 0zM3 3l18 18"></path></svg>
                        </template>
                        <template x-if="showConfirm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </template>
                    </button>
                </div>
                <x-input-error for="password_confirmation" class="mt-2 text-red-700 font-bold text-xs" />
            </div>

        </div>

        <!-- Botones y Confirmación -->
        <div class="mt-8 flex items-center justify-end gap-4 border-t border-amber-900/30 pt-4">
            
            <x-action-message class="me-3 text-xs font-bold text-slate-950 bg-amber-200 px-3 py-1 rounded-lg border border-amber-900" on="saved">
                {{ __('Guardado correctamente.') }}
            </x-action-message>

            <button type="submit" 
                    class="rounded-xl border border-amber-900 bg-[#FFD600] px-6 py-2.5 text-sm font-bold text-slate-950 hover:bg-amber-400 transition shadow-[3px_3px_0px_0px_rgba(0,0,0,0.85)]">
                {{ __('Guardar') }}
            </button>
        </div>

    </form>
</div>
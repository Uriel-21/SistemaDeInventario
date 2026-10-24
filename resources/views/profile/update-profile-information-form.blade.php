<div class="rounded-3xl border-2 border-amber-900 bg-[#D99B00] p-6 sm:p-8 shadow-[6px_6px_0px_0px_rgba(0,0,0,0.85)] max-w-4xl mx-auto my-6">
    
    <!-- Encabezado del Formulario -->
    <div class="mb-6 border-b border-amber-900/30 pb-4">
        <h3 class="text-xl font-extrabold text-slate-950">
            {{ __('Información del Perfil') }}
        </h3>
        <p class="text-xs sm:text-sm font-medium text-slate-900 mt-1">
            {{ __('Actualiza la información de tu cuenta y tu dirección de correo electrónico.') }}
        </p>
    </div>

    <!-- Formulario de Livewire -->
    <form wire:submit="updateProfileInformation">
        
        <div class="grid grid-cols-1 gap-6">

            <!-- Foto de Perfil -->
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div x-data="{photoName: null, photoPreview: null}" class="col-span-1">
                    
                    <!-- Input oculto para cargar la foto -->
                    <input type="file" id="photo" class="hidden"
                            wire:model.live="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                    <label class="block text-sm font-bold text-slate-950 mb-2" for="photo">
                        {{ __('Foto de perfil') }}
                    </label>

                    <div class="flex items-center gap-4 my-2">
                        <!-- Foto Actual -->
                        <div x-show="! photoPreview">
                            <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full size-20 object-cover border-2 border-amber-900 shadow-sm">
                        </div>

                        <!-- Previsualización de la Nueva Foto -->
                        <div x-show="photoPreview" style="display: none;">
                            <span class="block rounded-full size-20 bg-cover bg-no-repeat bg-center border-2 border-amber-900 shadow-sm"
                                  x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                            </span>
                        </div>

                        <div class="flex flex-wrap gap-2">
                            <button type="button" 
                                    x-on:click.prevent="$refs.photo.click()"
                                    class="rounded-xl border border-amber-900 bg-[#FFD600] px-4 py-2 text-xs font-bold text-slate-950 hover:bg-amber-400 transition shadow-[2px_2px_0px_0px_rgba(0,0,0,0.85)]">
                                {{ __('Seleccionar nueva foto') }}
                            </button>

                            @if ($this->user->profile_photo_path)
                                <button type="button" 
                                        wire:click="deleteProfilePhoto"
                                        class="rounded-xl border border-red-900 bg-[#ff2626] px-4 py-2 text-xs font-bold text-white hover:bg-red-600 transition shadow-[2px_2px_0px_0px_rgba(0,0,0,0.85)]">
                                    {{ __('Eliminar foto') }}
                                </button>
                            @endif
                        </div>
                    </div>

                    <x-input-error for="photo" class="mt-2 text-red-700 font-bold text-xs" />
                </div>
            @endif

            <!-- Nombre -->
            <div class="col-span-1">
                <label for="name" class="block text-sm font-bold text-slate-950 mb-1">
                    {{ __('Nombre') }}
                </label>
                <input id="name" 
                       type="text" 
                       class="block w-full bg-gray-200 border-none rounded-xl py-3 px-4 text-gray-800 placeholder-gray-500 focus:ring-2 focus:ring-yellow-500 focus:bg-white transition" 
                       wire:model="state.name" 
                       required 
                       autocomplete="name" 
                       placeholder="Tu nombre completo" />
                <x-input-error for="name" class="mt-2 text-red-700 font-bold text-xs" />
            </div>

            <!-- Correo Electrónico -->
            <div class="col-span-1">
                <label for="email" class="block text-sm font-bold text-slate-950 mb-1">
                    {{ __('Correo Electrónico') }}
                </label>
                <input id="email" 
                       type="email" 
                       class="block w-full bg-gray-200 border-none rounded-xl py-3 px-4 text-gray-800 placeholder-gray-500 focus:ring-2 focus:ring-yellow-500 focus:bg-white transition" 
                       wire:model="state.email" 
                       required 
                       autocomplete="username" 
                       placeholder="correo@ejemplo.com" />
                <x-input-error for="email" class="mt-2 text-red-700 font-bold text-xs" />

                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                    <div class="mt-3 bg-[#FFF8E7] p-3 rounded-xl border border-amber-900 text-xs text-slate-900">
                        <p>
                            {{ __('Tu dirección de correo electrónico no está verificada.') }}

                            <button type="button" class="underline font-bold text-amber-900 hover:text-black ms-1" wire:click.prevent="sendEmailVerification">
                                {{ __('Haz clic aquí para reenviar el correo de verificación.') }}
                            </button>
                        </p>

                        @if ($this->verificationLinkSent)
                            <p class="mt-2 font-bold text-green-700">
                                {{ __('Se ha enviado un nuevo enlace de verificación a tu correo electrónico.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

        </div>

        <!-- Botones y Mensaje de Confirmación -->
        <div class="mt-8 flex items-center justify-end gap-4 border-t border-amber-900/30 pt-4">
            
            <x-action-message class="me-3 text-xs font-bold text-slate-950 bg-amber-200 px-3 py-1 rounded-lg border border-amber-900" on="saved">
                {{ __('Guardado correctamente.') }}
            </x-action-message>

            <button type="submit" 
                    wire:loading.attr="disabled" 
                    wire:target="photo"
                    class="rounded-xl border border-amber-900 bg-[#FFD600] px-6 py-2.5 text-sm font-bold text-slate-950 hover:bg-amber-400 transition shadow-[3px_3px_0px_0px_rgba(0,0,0,0.85)]">
                {{ __('Guardar') }}
            </button>
        </div>

    </form>
</div>
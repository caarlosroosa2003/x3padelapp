<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <!-- Nombre -->
        <div>
            <x-input-label for="name" value="Nombre" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email (Solo lectura) -->
        <div>
            <x-input-label for="email" value="Email (no editable)" />
            <div class="mt-1 block w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-700 cursor-not-allowed">
                <div class="flex items-center justify-between">
                    <span class="font-medium">{{ $user->email }}</span>
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
            </div>
            <p class="mt-2 text-sm text-gray-700">
                <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                El correo electrónico no se puede modificar por razones de seguridad.
            </p>

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded">
                    <p class="text-sm text-yellow-800">
                        Tu dirección de email no está verificada.

                        <button form="send-verification" class="underline text-sm text-yellow-900 hover:text-yellow-700 font-semibold">
                            Haz clic aquí para reenviar el email de verificación.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            Se ha enviado un nuevo enlace de verificación a tu email.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Teléfono -->
        <div>
            <x-input-label for="telefono" value="Teléfono" />
            <x-text-input id="telefono" name="telefono" type="tel" class="mt-1 block w-full" :value="old('telefono', $user->telefono)" autocomplete="tel" placeholder="+34 123 456 789" />
            <x-input-error class="mt-2" :messages="$errors->get('telefono')" />
        </div>

        <!-- Estadísticas del Usuario -->
        <div class="bg-gradient-to-r from-[#C3E617]/10 to-[#a8c916]/10 rounded-lg p-6 border-2 border-[#C3E617]">
            <h3 class="font-semibold text-gray-800 mb-4">📊 Tus Estadísticas</h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="text-center">
                    <div class="text-3xl font-bold text-[#C3E617]">{{ $user->reservas_count }}</div>
                    <div class="text-sm text-gray-800">Reservas Realizadas</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-black">{{ $user->reservas_gratis_disponibles }}</div>
                    <div class="text-sm text-gray-800">Reservas Gratis</div>
                </div>
            </div>
            @if($user->is_admin)
                <div class="mt-4 text-center">
                    <span class="inline-block bg-black text-[#C3E617] px-4 py-2 rounded-full text-sm font-semibold">
                        ⚡ Administrador
                    </span>
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>Guardar Cambios</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 font-semibold"
                >✓ Guardado</p>
            @endif
        </div>
    </form>
</section>

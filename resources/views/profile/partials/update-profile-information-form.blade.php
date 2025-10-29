<section>
    <header>
        <h2 class="text-2xl font-bold text-gray-900">
            Información del Perfil
        </h2>

        <p class="mt-2 text-gray-600">
            Actualiza la información de tu cuenta y dirección de email.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Nombre -->
        <div>
            <x-input-label for="name" value="Nombre" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 bg-yellow-50 border-l-4 border-yellow-400 p-4">
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
                    <div class="text-sm text-gray-600">Reservas Realizadas</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-black">{{ $user->reservas_gratis_disponibles }}</div>
                    <div class="text-sm text-gray-600">Reservas Gratis</div>
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

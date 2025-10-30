@extends('layouts.app')

@section('title', 'Mi Perfil - X3 Pádel')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-black to-gray-900 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-5xl font-bold mb-4">Mi Perfil</h1>
                <p class="text-xl text-gray-300">Gestiona tu información personal y configuración de cuenta</p>
            </div>
            <div class="hidden md:block">
                <div class="bg-[#C3E617] bg-opacity-20 rounded-full p-4">
                    <svg class="w-20 h-20 text-[#C3E617]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contenido del Perfil -->
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Información del Usuario -->
        <div class="bg-white rounded-2xl p-8 shadow-lg mb-8 border-l-4 border-[#C3E617]">
            <div class="max-w-2xl mx-auto">
                <div class="flex items-center mb-6">
                    <div class="bg-[#C3E617] bg-opacity-20 rounded-full p-3 mr-4">
                        <svg class="w-6 h-6 text-[#C3E617]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Datos Personales</h3>
                        <p class="text-sm text-gray-700">Información básica de tu cuenta</p>
                    </div>
                </div>
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Cambiar Contraseña -->
        <div class="bg-white rounded-2xl p-8 shadow-lg mb-8 border-l-4 border-blue-500">
            <div class="max-w-2xl mx-auto">
                <div class="flex items-center mb-6">
                    <div class="bg-blue-500 bg-opacity-20 rounded-full p-3 mr-4">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Seguridad</h3>
                        <p class="text-sm text-gray-700">Gestiona tu contraseña</p>
                    </div>
                </div>
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Eliminar Cuenta -->
        <div class="bg-white rounded-2xl p-8 shadow-lg border-l-4 border-red-500">
            <div class="max-w-2xl mx-auto">
                <div class="flex items-center mb-6">
                    <div class="bg-red-500 bg-opacity-20 rounded-full p-3 mr-4">
                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Zona de Peligro</h3>
                        <p class="text-sm text-gray-700">Eliminar tu cuenta de forma permanente</p>
                    </div>
                </div>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</section>
@endsection

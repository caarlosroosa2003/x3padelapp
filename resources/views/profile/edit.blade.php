@extends('layouts.app')

@section('title', 'Mi Perfil - X3 Pádel')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-black to-gray-900 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-5xl font-bold mb-4">Mi Perfil</h1>
        <p class="text-xl text-gray-300">Gestiona tu información personal</p>
    </div>
</section>

<!-- Contenido del Perfil -->
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Información del Usuario -->
        <div class="bg-white rounded-2xl p-8 shadow-lg mb-8">
            <div class="max-w-2xl mx-auto">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Cambiar Contraseña -->
        <div class="bg-white rounded-2xl p-8 shadow-lg mb-8">
            <div class="max-w-2xl mx-auto">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Eliminar Cuenta -->
        <div class="bg-white rounded-2xl p-8 shadow-lg">
            <div class="max-w-2xl mx-auto">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</section>
@endsection

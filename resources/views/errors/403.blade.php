@extends('layouts.app')

@section('title', 'Acceso Denegado - X3 Pádel')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full text-center">
        <!-- Icono de error -->
        <div class="mx-auto flex items-center justify-center h-32 w-32 rounded-full bg-red-100 mb-8">
            <svg class="h-20 w-20 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
        </div>

        <!-- Título del error -->
        <h1 class="text-6xl font-bold text-gray-900 mb-4">403</h1>
        <h2 class="text-3xl font-bold text-gray-800 mb-4">Acceso Denegado</h2>
        
        <!-- Mensaje -->
        <div class="mb-8">
            <p class="text-gray-800 mb-2">
                @if(isset($exception) && $exception->getMessage())
                    {{ $exception->getMessage() }}
                @else
                    No tienes permisos para acceder a esta página.
                @endif
            </p>
            <p class="text-gray-700 text-sm">
                Esta sección está reservada para administradores de X3 Pádel.
            </p>
        </div>

        <!-- Información adicional -->
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-8 text-left">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        <strong>Nota:</strong> Si crees que deberías tener acceso a esta sección, contacta con un administrador.
                    </p>
                </div>
            </div>
        </div>

        <!-- Botones de acción -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ url('/') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-[#C3E617] hover:bg-[#d4f73a] transition duration-300 shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Volver al Inicio
            </a>

            <button onclick="history.back()" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition duration-300 shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Volver Atrás
            </button>
        </div>

        <!-- Logo -->
        <div class="mt-12">
            <img src="{{ asset('images/logox3.jpg') }}" alt="X3 Pádel" class="h-16 w-16 mx-auto opacity-50 rounded-lg">
        </div>
    </div>
</div>
@endsection


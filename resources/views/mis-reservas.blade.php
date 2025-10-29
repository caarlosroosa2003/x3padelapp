@extends('layouts.app')

@section('title', 'Mis Reservas - X3 Pádel')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-black to-gray-900 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-5xl font-bold mb-4">Mis Reservas</h1>
        <p class="text-xl text-gray-300">Gestiona tus reservas de pistas</p>
    </div>
</section>

<!-- Información del Usuario -->
<section class="py-8 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-r from-[#C3E617] to-[#a8c916] rounded-2xl p-6 mb-8">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="text-center md:text-left mb-4 md:mb-0">
                    <h2 class="text-2xl font-bold text-black mb-2">👋 Hola, {{ Auth::user()->name }}</h2>
                    <p class="text-gray-900">Email: {{ Auth::user()->email }}</p>
                    @if(Auth::user()->telefono)
                        <p class="text-gray-900">Teléfono: {{ Auth::user()->telefono }}</p>
                    @endif
                </div>
                <div class="flex gap-4">
                    <div class="bg-white rounded-xl p-6 text-center shadow-lg">
                        <div class="text-4xl font-bold text-black mb-2">{{ Auth::user()->reservas_count }}</div>
                        <div class="text-sm text-gray-700">Reservas Realizadas</div>
                    </div>
                    <div class="bg-black rounded-xl p-6 text-center shadow-lg">
                        <div class="text-4xl font-bold text-[#C3E617] mb-2">{{ Auth::user()->reservas_gratis_disponibles }}</div>
                        <div class="text-sm text-white">Reservas Gratis</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Progreso del Programa de Recompensas -->
        <div class="bg-white rounded-2xl p-8 shadow-lg border-2 border-gray-200 mb-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-4">🎁 Programa de Recompensas</h3>
            <p class="text-gray-600 mb-6">Por cada 5 reservas, ¡consigue 1 reserva gratis!</p>
            
            @php
                $progreso = Auth::user()->reservas_count % 5;
                $porcentaje = ($progreso / 5) * 100;
            @endphp
            
            <div class="relative pt-1">
                <div class="flex mb-2 items-center justify-between">
                    <div>
                        <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-black bg-[#C3E617]">
                            Progreso: {{ $progreso }}/5
                        </span>
                    </div>
                    <div class="text-right">
                        <span class="text-xs font-semibold inline-block text-gray-600">
                            {{ 5 - $progreso }} reservas más para la próxima gratis
                        </span>
                    </div>
                </div>
                <div class="overflow-hidden h-4 mb-4 text-xs flex rounded-full bg-gray-200">
                    <div style="width:{{ $porcentaje }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-[#C3E617] transition-all duration-500"></div>
                </div>
            </div>
            
            <div class="flex gap-2 mt-4">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $progreso)
                        <div class="flex-1 h-16 bg-[#C3E617] rounded-lg flex items-center justify-center">
                            <svg class="w-8 h-8 text-black" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    @else
                        <div class="flex-1 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                            <span class="text-2xl font-bold text-gray-400">{{ $i }}</span>
                        </div>
                    @endif
                @endfor
            </div>
        </div>
    </div>
</section>

<!-- Lista de Reservas -->
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">Historial de Reservas</h2>
        
        <!-- Mensaje temporal -->
        <div class="bg-blue-50 border-l-4 border-blue-400 p-6 rounded-lg mb-8">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-lg font-medium text-blue-800">Sistema de reservas en desarrollo</h3>
                    <p class="mt-2 text-sm text-blue-700">
                        El sistema completo de reservas se implementará próximamente. Aquí podrás ver:
                    </p>
                    <ul class="mt-2 text-sm text-blue-700 list-disc list-inside">
                        <li>Historial de todas tus reservas</li>
                        <li>Reservas activas y pasadas</li>
                        <li>Cancelar reservas futuras</li>
                        <li>Ver detalles de cada reserva (pista, fecha, hora, precio)</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Ejemplo de cómo se verán las reservas -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border-2 border-dashed border-gray-300 opacity-50">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Pista 1</h3>
                    <p class="text-gray-600">15 de Noviembre, 2024</p>
                </div>
                <span class="bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-semibold">
                    Confirmada
                </span>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                <div>
                    <p class="text-sm text-gray-500">Hora</p>
                    <p class="font-semibold">18:00 - 19:00</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Duración</p>
                    <p class="font-semibold">1 hora</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Precio</p>
                    <p class="font-semibold">20€</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Estado</p>
                    <p class="font-semibold text-green-600">Pagada</p>
                </div>
            </div>
            <button class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition duration-300">
                Cancelar Reserva
            </button>
        </div>
        
        <!-- Call to Action -->
        <div class="mt-12 text-center">
            <a href="{{ url('/reservas') }}" class="inline-block bg-[#C3E617] text-black px-10 py-4 rounded-full font-bold text-lg hover:bg-[#d4f73a] transition duration-300 transform hover:scale-105 shadow-lg">
                Hacer una Nueva Reserva
            </a>
        </div>
    </div>
</section>
@endsection



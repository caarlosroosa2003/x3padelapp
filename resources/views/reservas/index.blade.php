@extends('layouts.app')

@section('title', 'Reservar Pista - X3 Pádel')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-black to-gray-900 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-5xl font-bold mb-4">Reserva tu Pista</h1>
        <p class="text-xl text-gray-300">Elige tu pista favorita y selecciona el horario perfecto</p>
    </div>
</div>

<!-- Selección de Pistas -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Mensajes -->
        @if(session('error'))
        <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg">
            <div class="flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="font-bold">{{ session('error') }}</p>
            </div>
        </div>
        @endif

        <!-- Información de usuario autenticado -->
        @auth
        <div class="bg-gradient-to-r from-[#C3E617]/10 to-[#a8c916]/10 rounded-xl p-6 mb-8 border-2 border-[#C3E617]">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div class="flex items-center">
                    <div class="bg-[#C3E617] rounded-full p-3 mr-4">
                        <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800">Hola, {{ Auth::user()->name }}!</h3>
                        <p class="text-sm text-gray-800">Estás listo para reservar</p>
                    </div>
                </div>
                <div class="flex gap-6">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-[#C3E617]">{{ Auth::user()->reservas_count }}</div>
                        <div class="text-sm text-gray-800">Reservas Totales</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-black">{{ Auth::user()->reservas_gratis_disponibles }}</div>
                        <div class="text-sm text-gray-800">Reservas Gratis</div>
                    </div>
                </div>
            </div>
        </div>
        @endauth

        <!-- Grid de Pistas -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($pistas as $pista)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:scale-105 transition duration-300 border-2 border-transparent hover:border-[#C3E617]">
                <!-- Imagen de la pista -->
                <div class="relative h-48 bg-gradient-to-br from-gray-800 to-black flex items-center justify-center">
                    @if($pista->imagen)
                        <img src="{{ asset($pista->imagen) }}" alt="{{ $pista->nombre }}" class="w-full h-full object-cover">
                    @else
                        <svg class="w-24 h-24 text-[#C3E617] opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                    @endif
                    
                    <!-- Badge de tipo -->
                    <div class="absolute top-3 right-3">
                        @if($pista->tipo === 'cubierta')
                            <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-xs font-semibold">Cubierta</span>
                        @else
                            <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold">Exterior</span>
                        @endif
                    </div>
                </div>

                <!-- Información de la pista -->
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $pista->nombre }}</h3>
                    
                    @if($pista->descripcion)
                        <p class="text-gray-800 text-sm mb-4">{{ $pista->descripcion }}</p>
                    @endif

                    <!-- Características -->
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center text-sm text-gray-800">
                            <svg class="w-4 h-4 mr-2 text-[#C3E617]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Sesiones de 1h 30min</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-800">
                            <svg class="w-4 h-4 mr-2 text-[#C3E617]" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                            </svg>
                            <span>30€ por sesión</span>
                        </div>
                    </div>

                    <!-- Botón de reservar -->
                    @auth
                        <a href="{{ route('reservas.pista', $pista->id) }}" class="block w-full bg-[#C3E617] text-black text-center py-3 px-6 rounded-lg font-semibold hover:bg-[#d4f73a] transition duration-300">
                            Ver Horarios
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="block w-full bg-gray-300 text-gray-700 text-center py-3 px-6 rounded-lg font-semibold hover:bg-gray-400 transition duration-300">
                            Inicia Sesión para Reservar
                        </a>
                    @endauth
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-xl text-gray-700">No hay pistas disponibles en este momento</p>
            </div>
            @endforelse
        </div>

        <!-- Aviso de Antelación -->
        <div class="mt-12 mb-8">
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-6 rounded-lg shadow-lg">
                <div class="flex items-start">
                    <svg class="w-8 h-8 text-yellow-600 mr-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <h3 class="text-lg font-bold text-yellow-900 mb-2">⏰ Importante: Reserva con Antelación</h3>
                        <p class="text-yellow-800">
                            Las reservas deben realizarse con <strong>al menos 1 día de antelación</strong>. 
                            No se aceptan reservas para el mismo día. La fecha más próxima disponible es siempre <strong>mañana</strong>.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Información adicional -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl p-6 shadow-lg text-center">
                <div class="bg-blue-100 rounded-full p-4 w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="font-bold text-lg mb-2">Horarios Flexibles</h3>
                <p class="text-gray-800 text-sm">8:00 - 14:00 y 17:00 - 23:30</p>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-lg text-center">
                <div class="bg-green-100 rounded-full p-4 w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="font-bold text-lg mb-2">Programa de Recompensas</h3>
                <p class="text-gray-800 text-sm">Cada 5 reservas, ¡1 gratis!</p>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-lg text-center">
                <div class="bg-purple-100 rounded-full p-4 w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="font-bold text-lg mb-2">Cancelación Fácil</h3>
                <p class="text-gray-800 text-sm">Cancela tus reservas cuando quieras</p>
            </div>
        </div>
    </div>
</section>
@endsection


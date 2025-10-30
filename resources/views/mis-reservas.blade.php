@extends('layouts.app')

@section('title', 'Mis Reservas - X3 Pádel')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-black to-gray-900 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h1 class="text-5xl font-bold mb-4">Mis Reservas</h1>
                <p class="text-xl text-gray-300">Gestiona y consulta tu historial de reservas</p>
            </div>
            <div class="flex gap-4">
                <div class="bg-[#C3E617] bg-opacity-20 rounded-xl p-4 text-center">
                    <div class="text-[#C3E617] text-3xl font-bold">{{ $user->reservas_count }}</div>
                    <div class="text-gray-300 text-sm">Total Reservas</div>
                </div>
                <div class="bg-green-500 bg-opacity-20 rounded-xl p-4 text-center">
                    <div class="text-green-400 text-3xl font-bold">{{ $user->reservas_gratis_disponibles }}</div>
                    <div class="text-gray-300 text-sm">Gratis Disponibles</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contenido Principal -->
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Mensajes -->
        @if(session('success'))
        <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg">
            <div class="flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="font-bold">{{ session('success') }}</p>
            </div>
        </div>
        @endif

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

        <!-- Botón de nueva reserva -->
        <div class="mb-8">
            <a href="{{ route('reservas.index') }}" class="inline-flex items-center px-6 py-3 bg-[#C3E617] text-black font-semibold rounded-lg hover:bg-[#d4f73a] transition duration-300 shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Nueva Reserva
            </a>
        </div>

        <!-- Próximas Reservas -->
        <div class="mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-6 flex items-center">
                <svg class="w-8 h-8 mr-3 text-[#C3E617]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Próximas Reservas
            </h2>

            @forelse($proximasReservas as $reserva)
            <div class="bg-white rounded-xl shadow-lg p-6 mb-4 border-l-4 border-[#C3E617] hover:shadow-xl transition duration-300">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <!-- Información de la reserva -->
                    <div class="flex-1">
                        <div class="flex items-center gap-4 mb-3">
                            <div class="bg-[#C3E617] bg-opacity-20 rounded-full p-3">
                                <svg class="w-6 h-6 text-[#C3E617]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">{{ $reserva->pista->nombre }}</h3>
                                <p class="text-sm text-gray-700">{{ $reserva->pista->tipo === 'cubierta' ? 'Pista Cubierta' : 'Pista Exterior' }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-2 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="font-medium">{{ $reserva->fecha->format('d/m/Y') }}</span>
                                <span class="ml-2 text-gray-700">({{ $reserva->fecha->locale('es')->diffForHumans() }})</span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-2 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="font-medium">{{ date('H:i', strtotime($reserva->hora_inicio)) }} - {{ date('H:i', strtotime($reserva->hora_fin)) }}</span>
                                <span class="ml-2 text-gray-700">(1h 30min)</span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-2 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                @if($reserva->es_gratis)
                                    <span class="font-bold text-green-600">GRATIS</span>
                                @else
                                    <span class="font-medium">{{ number_format($reserva->precio, 2) }}€</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Acciones -->
                    <div class="flex flex-col gap-2">
                        <span class="px-4 py-2 bg-green-100 text-green-800 rounded-lg text-sm font-semibold text-center">
                            ✓ Confirmada
                        </span>
                        
                        @if(!$reserva->haPasado())
                        <form action="{{ route('reservas.cancelar', $reserva->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas cancelar esta reserva?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full px-4 py-2 bg-red-500 text-white rounded-lg text-sm font-semibold hover:bg-red-600 transition duration-300">
                                Cancelar Reserva
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                <svg class="w-20 h-20 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <p class="text-xl text-gray-700 mb-4">No tienes reservas próximas</p>
                <a href="{{ route('reservas.index') }}" class="inline-flex items-center px-6 py-3 bg-[#C3E617] text-black font-semibold rounded-lg hover:bg-[#d4f73a] transition duration-300">
                    Hacer una Reserva
                </a>
            </div>
            @endforelse
        </div>

        <!-- Historial de Reservas -->
        <div>
            <h2 class="text-3xl font-bold text-gray-900 mb-6 flex items-center">
                <svg class="w-8 h-8 mr-3 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Historial de Reservas
            </h2>

            @forelse($historialReservas as $reserva)
            <div class="bg-white rounded-xl shadow-lg p-6 mb-4 border-l-4 {{ $reserva->estado === 'cancelada' ? 'border-red-300 opacity-75' : 'border-gray-300' }}">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <!-- Información de la reserva -->
                    <div class="flex-1">
                        <div class="flex items-center gap-4 mb-3">
                            <div class="bg-gray-200 rounded-full p-3">
                                <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">{{ $reserva->pista->nombre }}</h3>
                                <p class="text-sm text-gray-700">{{ $reserva->pista->tipo === 'cubierta' ? 'Pista Cubierta' : 'Pista Exterior' }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-2 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>{{ $reserva->fecha->format('d/m/Y') }}</span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-2 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>{{ date('H:i', strtotime($reserva->hora_inicio)) }} - {{ date('H:i', strtotime($reserva->hora_fin)) }}</span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-2 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                @if($reserva->es_gratis)
                                    <span class="font-bold text-green-600">GRATIS</span>
                                @else
                                    <span>{{ number_format($reserva->precio, 2) }}€</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Estado -->
                    <div>
                        @if($reserva->estado === 'cancelada')
                            <span class="px-4 py-2 bg-red-100 text-red-800 rounded-lg text-sm font-semibold">
                                ✕ Cancelada
                            </span>
                        @elseif($reserva->estado === 'completada')
                            <span class="px-4 py-2 bg-blue-100 text-blue-800 rounded-lg text-sm font-semibold">
                                ✓ Completada
                            </span>
                        @else
                            <span class="px-4 py-2 bg-gray-100 text-gray-800 rounded-lg text-sm font-semibold">
                                • Pasada
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                <svg class="w-20 h-20 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-xl text-gray-700">No tienes historial de reservas</p>
            </div>
            @endforelse

            <!-- Paginación del historial -->
            @if($historialReservas->hasPages())
            <div class="mt-6">
                {{ $historialReservas->links() }}
            </div>
            @endif
        </div>
    </div>
</section>
@endsection

@extends('layouts.app')

@section('title', 'Reservas - X3 Pádel')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-black to-gray-900 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-5xl font-bold mb-4">Reserva tu Pista</h1>
        <p class="text-xl text-gray-300">Elige tu pista favorita y el horario que mejor se adapte a ti</p>
    </div>
</section>

<!-- Información del sistema de reservas -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-[#C3E617] rounded-2xl p-8 mb-12">
            <div class="flex items-center justify-center mb-4">
                <svg class="w-12 h-12 text-black mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h2 class="text-3xl font-bold text-black">Horarios Disponibles</h2>
            </div>
            <p class="text-center text-black text-lg">
                Lunes a Domingo: 8:00 - 23:00 horas
            </p>
        </div>

        <!-- Grid de pistas -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            @for ($i = 1; $i <= 4; $i++)
            <div class="bg-white border-2 border-gray-200 rounded-2xl p-6 hover:border-[#C3E617] hover:shadow-xl transition duration-300">
                <div class="text-center">
                    <div class="w-20 h-20 bg-[#C3E617] rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-4xl font-bold text-black">{{ $i }}</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Pista {{ $i }}</h3>
                    <span class="inline-block bg-green-100 text-green-800 px-4 py-1 rounded-full text-sm font-semibold mb-4">
                        Disponible
                    </span>
                    <ul class="text-left space-y-2 text-gray-600 mb-6">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-[#C3E617] mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Césped artificial premium
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-[#C3E617] mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Iluminación LED profesional
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-[#C3E617] mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Cristal panorámico
                        </li>
                    </ul>
                    <button class="w-full bg-black text-white py-3 rounded-lg hover:bg-gray-800 transition duration-300 font-semibold">
                        Seleccionar Pista
                    </button>
                </div>
            </div>
            @endfor
        </div>

        <!-- Información del programa de recompensas -->
        <div class="bg-gradient-to-r from-gray-900 to-black text-white rounded-2xl p-8">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="mb-6 md:mb-0">
                    <h3 class="text-3xl font-bold mb-2">🎁 Programa de Recompensas</h3>
                    <p class="text-xl text-gray-300">¡Cada 5 reservas, la siguiente es GRATIS!</p>
                </div>
                <div class="text-center">
                    <div class="bg-[#C3E617] text-black rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-2">
                        <span class="text-4xl font-bold">5</span>
                    </div>
                    <p class="text-sm text-gray-300">Reservas necesarias</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mensaje para usuarios no autenticados -->
@guest
<section class="py-12 bg-gray-50">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="bg-white rounded-2xl p-12 shadow-lg">
            <svg class="w-20 h-20 text-[#C3E617] mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Inicia sesión para reservar</h2>
            <p class="text-xl text-gray-600 mb-8">
                Crea una cuenta gratuita o inicia sesión para acceder al sistema de reservas
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="bg-[#C3E617] text-black px-8 py-4 rounded-full font-bold text-lg hover:bg-[#d4f73a] transition duration-300">
                    Crear Cuenta Gratis
                </a>
                <a href="{{ route('login') }}" class="bg-black text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-gray-800 transition duration-300">
                    Iniciar Sesión
                </a>
            </div>
        </div>
    </div>
</section>
@endguest

<!-- Precios -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Tarifas</h2>
            <p class="text-xl text-gray-600">Precios competitivos para todos nuestros usuarios</p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
            <!-- Tarifa Diurna -->
            <div class="bg-gray-50 rounded-2xl p-8 border-2 border-gray-200">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Diurno</h3>
                <p class="text-gray-600 mb-4">8:00 - 16:00</p>
                <div class="mb-6">
                    <span class="text-5xl font-bold text-[#C3E617]">15€</span>
                    <span class="text-gray-600">/hora</span>
                </div>
                <ul class="space-y-3 text-gray-600">
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-[#C3E617] mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Luz natural
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-[#C3E617] mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Mejor precio
                    </li>
                </ul>
            </div>
            
            <!-- Tarifa Normal -->
            <div class="bg-[#C3E617] rounded-2xl p-8 border-2 border-[#C3E617] transform scale-105">
                <div class="bg-black text-white px-4 py-1 rounded-full inline-block mb-4">
                    Más Popular
                </div>
                <h3 class="text-2xl font-bold text-black mb-4">Normal</h3>
                <p class="text-gray-800 mb-4">16:00 - 20:00</p>
                <div class="mb-6">
                    <span class="text-5xl font-bold text-black">20€</span>
                    <span class="text-gray-800">/hora</span>
                </div>
                <ul class="space-y-3 text-gray-900">
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-black mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Horario prime
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-black mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Mayor disponibilidad
                    </li>
                </ul>
            </div>
            
            <!-- Tarifa Nocturna -->
            <div class="bg-gray-50 rounded-2xl p-8 border-2 border-gray-200">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Nocturno</h3>
                <p class="text-gray-600 mb-4">20:00 - 23:00</p>
                <div class="mb-6">
                    <span class="text-5xl font-bold text-[#C3E617]">18€</span>
                    <span class="text-gray-600">/hora</span>
                </div>
                <ul class="space-y-3 text-gray-600">
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-[#C3E617] mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Iluminación LED
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-[#C3E617] mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Ambiente nocturno
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection



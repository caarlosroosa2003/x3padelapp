@extends('layouts.app')

@section('title', 'X3 Pádel - Inicio')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-black via-gray-900 to-black text-white overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNDM0U2MTciIGZpbGwtb3BhY2l0eT0iMC4xIj48cGF0aCBkPSJNMzYgMzRjMC0yLjIxIDEuNzktNCA0LTRzNCAxLjc5IDQgNC0xLjc5IDQtNCA0LTQtMS43OS00LTR6bTAgMjBjMC0yLjIxIDEuNzktNCA0LTRzNCAxLjc5IDQgNC0xLjc5IDQtNCA0LTQtMS43OS00LTR6TTIwIDM0YzAtMi4yMSAxLjc5LTQgNC00czQgMS43OSA0IDQtMS43OSA0LTQgNC00LTEuNzktNC00em0wIDIwYzAtMi4yMSAxLjc5LTQgNC00czQgMS43OSA0IDQtMS43OSA0LTQgNC00LTEuNzktNC00eiIvPjwvZz48L2c+PC9zdmc+')]"></div>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32 relative z-10">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="text-center md:text-left">
                <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                    Vive la experiencia
                    <span class="text-[#C3E617]">X3 Pádel</span>
                </h1>
                <p class="text-xl text-gray-300 mb-8">
                    Tu centro deportivo de confianza con 4 pistas profesionales. Reserva online y disfruta del mejor pádel.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                    <a href="{{ url('/reservas') }}" class="bg-[#C3E617] text-black px-8 py-4 rounded-full font-bold text-lg hover:bg-[#d4f73a] transition duration-300 transform hover:scale-105 shadow-lg">
                        Reservar Pista
                    </a>
                    <a href="{{ url('/catalogo') }}" class="bg-transparent border-2 border-[#C3E617] text-[#C3E617] px-8 py-4 rounded-full font-bold text-lg hover:bg-[#C3E617] hover:text-black transition duration-300 transform hover:scale-105">
                        Ver Catálogo
                    </a>
                </div>
            </div>
            <div class="hidden md:block">
                <img src="{{ asset('images/logo.svg') }}" alt="X3 Pádel" class="w-full max-w-md mx-auto animate-pulse">
            </div>
        </div>
    </div>
    
    <!-- Decorative wave -->
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 0L60 10C120 20 240 40 360 46.7C480 53 600 47 720 43.3C840 40 960 40 1080 46.7C1200 53 1320 67 1380 73.3L1440 80V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0V0Z" fill="#F9FAFB"/>
        </svg>
    </div>
</section>

<!-- Características -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">¿Por qué elegir X3 Pádel?</h2>
            <p class="text-xl text-gray-800">Ofrecemos las mejores instalaciones y servicios para tu experiencia deportiva</p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Característica 1 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                <div class="bg-[#C3E617] w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                    <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3 text-center">Reserva Online 24/7</h3>
                <p class="text-gray-800 text-center">Reserva tu pista en cualquier momento desde nuestra plataforma web</p>
            </div>
            
            <!-- Característica 2 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                <div class="bg-[#C3E617] w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                    <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3 text-center">4 Pistas Profesionales</h3>
                <p class="text-gray-800 text-center">Instalaciones de primera calidad con mantenimiento diario</p>
            </div>
            
            <!-- Característica 3 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                <div class="bg-[#C3E617] w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                    <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3 text-center">Programa de Recompensas</h3>
                <p class="text-gray-800 text-center">Cada 5 reservas, ¡tu siguiente reserva es gratis!</p>
            </div>
            
            <!-- Característica 4 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                <div class="bg-[#C3E617] w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                    <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3 text-center">Tienda Especializada</h3>
                <p class="text-gray-800 text-center">Catálogo completo de productos y accesorios de pádel</p>
            </div>
        </div>
    </div>
</section>

<!-- Horarios y Pistas -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Nuestras Pistas</h2>
            <p class="text-xl text-gray-800">Disponemos de 4 pistas profesionales listas para ti</p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            @for ($i = 1; $i <= 4; $i++)
            <div class="bg-gray-50 rounded-xl p-6 border-2 border-gray-200 hover:border-[#C3E617] transition duration-300">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-2xl font-bold text-gray-900">Pista {{ $i }}</h3>
                    <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Disponible</span>
                </div>
                <ul class="space-y-2 text-gray-800 mb-6">
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
                        Iluminación LED
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-[#C3E617] mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Cristal panorámico
                    </li>
                </ul>
                <a href="{{ url('/reservas?pista='.$i) }}" class="block w-full text-center bg-black text-white py-3 rounded-lg hover:bg-gray-800 transition duration-300 font-semibold">
                    Reservar Ahora
                </a>
            </div>
            @endfor
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-20 bg-gradient-to-r from-[#C3E617] to-[#a8c916]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl md:text-5xl font-bold text-black mb-6">
            ¿Listo para jugar?
        </h2>
        <p class="text-xl text-gray-900 mb-8">
            Únete a nuestra comunidad y comienza a disfrutar del mejor pádel
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            @guest
            <a href="{{ route('register') }}" class="bg-black text-white px-10 py-4 rounded-full font-bold text-lg hover:bg-gray-800 transition duration-300 transform hover:scale-105 shadow-lg">
                Crear Cuenta Gratis
            </a>
            @else
            <a href="{{ url('/reservas') }}" class="bg-black text-white px-10 py-4 rounded-full font-bold text-lg hover:bg-gray-800 transition duration-300 transform hover:scale-105 shadow-lg">
                Hacer una Reserva
            </a>
            @endguest
            <a href="{{ url('/contacto') }}" class="bg-white text-black px-10 py-4 rounded-full font-bold text-lg hover:bg-gray-100 transition duration-300 transform hover:scale-105 shadow-lg">
                Contactar
            </a>
        </div>
    </div>
</section>

<!-- Testimonios -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Lo que dicen nuestros clientes</h2>
            <p class="text-xl text-gray-800">Experiencias reales de nuestra comunidad</p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Testimonio 1 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg">
                <div class="flex items-center mb-4">
                    <div class="flex text-[#C3E617]">
                        @for ($i = 0; $i < 5; $i++)
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        @endfor
                    </div>
                </div>
                <p class="text-gray-800 mb-4">"Excelentes instalaciones y el sistema de reservas online es muy cómodo. ¡Las pistas están siempre en perfectas condiciones!"</p>
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-[#C3E617] rounded-full flex items-center justify-center text-black font-bold text-xl mr-3">
                        M
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">María García</p>
                        <p class="text-sm text-gray-700">Socia desde 2023</p>
                    </div>
                </div>
            </div>
            
            <!-- Testimonio 2 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg">
                <div class="flex items-center mb-4">
                    <div class="flex text-[#C3E617]">
                        @for ($i = 0; $i < 5; $i++)
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        @endfor
                    </div>
                </div>
                <p class="text-gray-800 mb-4">"El programa de recompensas es genial. Ya he conseguido varias reservas gratis. ¡Muy recomendable!"</p>
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-[#C3E617] rounded-full flex items-center justify-center text-black font-bold text-xl mr-3">
                        C
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Carlos Ruiz</p>
                        <p class="text-sm text-gray-700">Socio desde 2022</p>
                    </div>
                </div>
            </div>
            
            <!-- Testimonio 3 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg">
                <div class="flex items-center mb-4">
                    <div class="flex text-[#C3E617]">
                        @for ($i = 0; $i < 5; $i++)
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        @endfor
                    </div>
                </div>
                <p class="text-gray-800 mb-4">"Ambiente familiar y profesional. La tienda tiene todo lo que necesitas. ¡El mejor centro de pádel de la zona!"</p>
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-[#C3E617] rounded-full flex items-center justify-center text-black font-bold text-xl mr-3">
                        A
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Ana Martínez</p>
                        <p class="text-sm text-gray-700">Socia desde 2024</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection



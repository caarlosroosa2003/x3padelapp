@extends('layouts.app')

@section('title', 'Catálogo - X3 Pádel')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-black to-gray-900 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-5xl font-bold mb-4">Catálogo de Productos</h1>
        <p class="text-xl text-gray-300">Todo lo que necesitas para mejorar tu juego</p>
    </div>
</section>

<!-- Categorías -->
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-12">
            <button class="bg-[#C3E617] text-black py-4 px-6 rounded-lg font-semibold hover:bg-[#d4f73a] transition duration-300">
                Todas
            </button>
            <button class="bg-white text-gray-900 py-4 px-6 rounded-lg font-semibold hover:bg-gray-100 transition duration-300 border-2 border-gray-200">
                Palas
            </button>
            <button class="bg-white text-gray-900 py-4 px-6 rounded-lg font-semibold hover:bg-gray-100 transition duration-300 border-2 border-gray-200">
                Calzado
            </button>
            <button class="bg-white text-gray-900 py-4 px-6 rounded-lg font-semibold hover:bg-gray-100 transition duration-300 border-2 border-gray-200">
                Accesorios
            </button>
        </div>

        <!-- Grid de productos -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $productos = [
                    ['nombre' => 'Pala Profesional X3 Pro', 'precio' => '149.99', 'categoria' => 'Palas'],
                    ['nombre' => 'Pala Intermedia X3 Sport', 'precio' => '89.99', 'categoria' => 'Palas'],
                    ['nombre' => 'Zapatillas Pádel Premium', 'precio' => '79.99', 'categoria' => 'Calzado'],
                    ['nombre' => 'Mochila X3 Pro Series', 'precio' => '59.99', 'categoria' => 'Accesorios'],
                    ['nombre' => 'Overgrip Pack x3', 'precio' => '12.99', 'categoria' => 'Accesorios'],
                    ['nombre' => 'Paletero X3 Deluxe', 'precio' => '69.99', 'categoria' => 'Accesorios'],
                ];
            @endphp

            @foreach($productos as $producto)
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition duration-300 transform hover:-translate-y-2">
                <div class="bg-gradient-to-br from-gray-100 to-gray-200 h-64 flex items-center justify-center">
                    <svg class="w-32 h-32 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div class="p-6">
                    <span class="inline-block bg-[#C3E617] text-black px-3 py-1 rounded-full text-sm font-semibold mb-3">
                        {{ $producto['categoria'] }}
                    </span>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $producto['nombre'] }}</h3>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-3xl font-bold text-[#C3E617]">{{ $producto['precio'] }}€</span>
                        <div class="flex text-yellow-400">
                            @for ($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            @endfor
                        </div>
                    </div>
                    <p class="text-gray-800 mb-4">
                        Producto de alta calidad diseñado para mejorar tu rendimiento en la pista.
                    </p>
                    <button class="w-full bg-black text-white py-3 rounded-lg hover:bg-gray-800 transition duration-300 font-semibold">
                        Ver Detalles
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="bg-gradient-to-r from-black to-gray-900 text-white rounded-2xl p-12">
            <h2 class="text-4xl font-bold mb-4">¿No encuentras lo que buscas?</h2>
            <p class="text-xl text-gray-300 mb-8">
                Contáctanos y te ayudaremos a encontrar el producto perfecto para ti
            </p>
            <a href="{{ url('/contacto') }}" class="inline-block bg-[#C3E617] text-black px-8 py-4 rounded-full font-bold text-lg hover:bg-[#d4f73a] transition duration-300">
                Contactar
            </a>
        </div>
    </div>
</section>
@endsection



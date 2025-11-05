@extends('layouts.app')

@section('title', ($product->nombre ?? 'Producto') . ' - X3 Pádel')

@section('content')
<section class="bg-gradient-to-r from-black to-gray-900 text-white py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="text-sm text-gray-300 flex items-center justify-between">
            <div>
                <a href="{{ route('home') }}" class="hover:text-white">Inicio</a>
                <span class="mx-2">/</span>
                <a href="{{ route('catalogo') }}" class="hover:text-white">Catálogo</a>
                <span class="mx-2">/</span>
                <span class="text-white">{{ $product->nombre }}</span>
            </div>
            <a href="{{ route('catalogo') }}" class="bg-white text-black px-5 py-2.5 rounded-lg font-semibold hover:bg-gray-100 transition">← Volver</a>
        </nav>
        <h1 class="mt-6 text-3xl md:text-4xl font-bold">{{ $product->nombre }}</h1>
        <span class="mt-3 inline-flex items-center px-3 py-1 rounded-full bg-[#C3E617] text-black text-sm font-semibold">{{ $product->categoria }}</span>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <!-- Imagen izquierda -->
            <div class="bg-white rounded-2xl overflow-hidden shadow-xl">
                <div class="w-full h-[520px] bg-gray-100 flex items-center justify-center overflow-hidden">
                    @if($product->imagen)
                    <img src="{{ Storage::url($product->imagen) }}" alt="{{ $product->nombre }}" class="w-full h-full object-cover">
                    @else
                    <div class="bg-gradient-to-br from-gray-100 to-gray-200 w-full h-full flex items-center justify-center">
                        <svg class="w-28 h-28 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Detalles derecha -->
            <div>
                <div class="bg-white rounded-2xl shadow-xl p-8 text-gray-900">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-600">Precio</div>
                        <div class="text-3xl md:text-4xl font-extrabold text-[#C3E617]">{{ number_format($product->precio, 2, ',', '.') }}€</div>
                    </div>

                    @if($product->descripcion)
                    <div class="mt-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-2">Descripción</h2>
                        <p class="text-gray-800 leading-relaxed">{{ $product->descripcion }}</p>
                    </div>
                    @endif

                    <div class="mt-6">
                        @if($product->stock > 0)
                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-800 text-xs font-semibold">En stock: {{ $product->stock }}</span>
                        @else
                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-800 text-xs font-semibold">Sin stock</span>
                        @endif
                    </div>

                    <div class="mt-8">
                        <a href="{{ route('contacto') }}" class="inline-flex items-center px-6 py-3 bg-black text-white rounded-lg font-semibold hover:bg-gray-800 transition">Contactar para comprar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@php
    $relacionados = \App\Models\Product::activos()
        ->where('categoria', $product->categoria)
        ->where('id', '!=', $product->id)
        ->latest()->take(3)->get();
@endphp
@if($relacionados->count())
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h3 class="text-xl font-bold text-gray-900 mb-6">También te puede interesar</h3>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($relacionados as $rel)
            <a href="{{ route('producto.show', $rel) }}" class="group bg-gray-50 rounded-2xl overflow-hidden shadow hover:shadow-lg transition">
                <div class="h-44 bg-gray-100 overflow-hidden">
                    @if($rel->imagen)
                    <img src="{{ Storage::url($rel->imagen) }}" alt="{{ $rel->nombre }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    @endif
                </div>
                <div class="p-4">
                    <div class="text-xs text-gray-600">{{ $rel->categoria }}</div>
                    <div class="font-semibold text-gray-900">{{ $rel->nombre }}</div>
                    <div class="mt-1 font-bold text-[#C3E617]">{{ number_format($rel->precio, 2, ',', '.') }}€</div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection



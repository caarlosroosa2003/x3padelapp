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

<!-- Categorías y productos desde BD -->
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-12">
            @foreach($categorias as $categoria)
            <a href="{{ $categoria === 'Todas' ? route('catalogo') : route('catalogo', ['categoria' => $categoria]) }}"
               class="{{ ($categoriaSeleccionada ?? 'Todas') === $categoria ? 'bg-[#C3E617] text-black' : 'bg-white text-gray-900 border-2 border-gray-200' }} py-4 px-6 rounded-lg font-semibold hover:bg-[#d4f73a] transition duration-300 text-center">
                {{ $categoria }}
            </a>
            @endforeach
        </div>

        @if($productos->count() > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($productos as $producto)
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition duration-300 transform hover:-translate-y-2">
                <div class="h-64 flex items-center justify-center overflow-hidden cursor-zoom-in" onclick="openImageModal('{{ $producto->imagen ? e(Storage::url($producto->imagen)) : '' }}')">
                    @if($producto->imagen)
                    <img src="{{ Storage::url($producto->imagen) }}" alt="{{ $producto->nombre }}" class="w-full h-full object-cover" loading="lazy" decoding="async">
                    @else
                    <div class="bg-gradient-to-br from-gray-100 to-gray-200 w-full h-full flex items-center justify-center">
                        <svg class="w-32 h-32 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    @endif
                </div>
                <div class="p-6">
                    <span class="inline-block bg-[#C3E617] text-black px-3 py-1 rounded-full text-sm font-semibold mb-3">{{ $producto->categoria }}</span>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $producto->nombre }}</h3>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-3xl font-bold text-[#C3E617]">{{ number_format($producto->precio, 2, ',', '.') }}€</span>
                        @if(isset($producto->stock))
                            @if($producto->stock > 0)
                            <span class="text-sm text-gray-600">Stock: {{ $producto->stock }}</span>
                            @else
                            <span class="text-sm text-red-600 font-semibold">Sin stock</span>
                            @endif
                        @endif
                    </div>
                    @if($producto->descripcion)
                    <p class="text-gray-600 mb-4 line-clamp-2">{{ $producto->descripcion }}</p>
                    @endif
                    <a href="{{ route('contacto') }}" class="block text-center w-full bg-black text-white py-3 rounded-lg hover:bg-gray-800 transition duration-300 font-semibold">Contactar para comprar</a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-16">
            <svg class="w-24 h-24 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">No hay productos disponibles</h3>
            <a href="{{ route('catalogo') }}" class="inline-block bg-[#C3E617] text-black px-6 py-3 rounded-lg font-semibold hover:bg-[#d4f73a] transition">Ver Todos</a>
        </div>
        @endif
    </div>
</section>

<!-- Modal de imagen (lightbox) -->
<div id="productImageModal" class="fixed inset-0 bg-black/90 backdrop-blur-sm hidden items-center justify-center z-[2147483647]" onclick="closeImageModal(event)" aria-hidden="true" style="background-color: rgba(0,0,0,0.9); z-index:2147483647;">
    <div class="relative max-w-xl w-11/12 pointer-events-auto">
        <button type="button" aria-label="Cerrar" class="absolute -top-12 right-0 bg-white hover:bg-gray-100 text-black rounded-full w-10 h-10 flex items-center justify-center shadow-lg z-50 font-bold text-xl" onclick="hideImageModal(event)">✕</button>
        <img id="modalImage" src="" alt="Imagen de producto" class="w-full h-auto max-h-[70vh] object-contain rounded-lg shadow-2xl bg-white">
    </div>
</div>

<script>
function openImageModal(src) {
    var modal = document.getElementById('productImageModal');
    var img = document.getElementById('modalImage');
    if (!src) return;
    img.src = src;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    modal.setAttribute('aria-hidden', 'false');
}
function hideImageModal(e) {
    if (e) e.stopPropagation();
    var modal = document.getElementById('productImageModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    modal.setAttribute('aria-hidden', 'true');
}
function closeImageModal(e) {
    if (e.target && e.target.id === 'productImageModal') {
        hideImageModal();
    }
}
// Cerrar con ESC
document.addEventListener('keydown', function(ev) {
    if (ev.key === 'Escape') {
        var modal = document.getElementById('productImageModal');
        if (modal && !modal.classList.contains('hidden')) hideImageModal();
    }
});
</script>

<!-- Call to Action -->
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="bg-gradient-to-r from-black to-gray-900 text-white rounded-2xl p-12">
            <h2 class="text-4xl font-bold mb-4">¿No encuentras lo que buscas?</h2>
            <p class="text-xl text-gray-300 mb-8">
                Contáctanos y te ayudaremos a encontrar el producto perfecto para ti
            </p>
            <a href="{{ route('contacto') }}" class="inline-block bg-[#C3E617] text-black px-8 py-4 rounded-full font-bold text-lg hover:bg-[#d4f73a] transition duration-300">
                Contactar
            </a>
        </div>
    </div>
</section>
@endsection



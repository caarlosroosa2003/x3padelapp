@extends('layouts.app')

@section('title', 'Gestión de Productos - X3 Pádel')

@section('content')
<div class="bg-gradient-to-r from-gray-900 to-black text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold mb-2">Gestión de Productos</h1>
                <p class="text-gray-300">Administra el catálogo de productos</p>
            </div>
            <div class="flex gap-4">
                <a href="{{ route('admin.dashboard') }}" class="bg-white text-black px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">← Dashboard</a>
                <a href="{{ route('admin.products.create') }}" class="bg-[#C3E617] text-black px-6 py-3 rounded-lg font-semibold hover:bg-[#d4f73a] transition duration-300">+ Nuevo Producto</a>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @if(session('success'))
    <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-gray-800 to-black px-6 py-4">
            <h2 class="text-xl font-bold text-white">Productos</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Producto</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Categoría</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Precio</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Stock</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($products as $product)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                @if($product->imagen)
                                <img src="{{ Storage::url($product->imagen) }}" class="h-14 w-14 rounded-lg object-cover" alt="{{ $product->nombre }}">
                                @else
                                <div class="h-14 w-14 rounded-lg bg-gray-200"></div>
                                @endif
                                <div class="ml-4">
                                    <div class="font-semibold text-gray-900">{{ $product->nombre }}</div>
                                    <div class="text-sm text-gray-600">ID: {{ $product->id }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">{{ $product->categoria }}</td>
                        <td class="px-6 py-4 font-semibold">{{ number_format($product->precio, 2, ',', '.') }}€</td>
                        <td class="px-6 py-4">{{ $product->stock }}</td>
                        <td class="px-6 py-4">
                            @if($product->activo)
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Activo</span>
                            @else
                            <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">Inactivo</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600 hover:underline mr-3">Editar</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar producto?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-600">No hay productos. Crea el primero.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($products, 'hasPages') && $products->hasPages())
        <div class="px-6 py-4 bg-gray-50 border-t">{{ $products->links() }}</div>
        @endif
    </div>
</div>
@endsection



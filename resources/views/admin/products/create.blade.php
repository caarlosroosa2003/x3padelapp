@extends('layouts.app')

@section('title', 'Crear Producto - X3 Pádel')

@section('content')
<div class="bg-gradient-to-r from-gray-900 to-black text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <h1 class="text-4xl font-bold">Nuevo Producto</h1>
            <a href="{{ route('admin.products.index') }}" class="bg-white text-black px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">← Volver</a>
        </div>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-xl shadow-lg p-8">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-6">
                <x-input-label for="nombre" :value="__('Nombre')" />
                <x-text-input id="nombre" name="nombre" type="text" class="mt-1 block w-full" :value="old('nombre')" required />
                <x-input-error class="mt-2" :messages="$errors->get('nombre')" />
            </div>

            <div class="mb-6">
                <x-input-label for="descripcion" :value="__('Descripción')" />
                <textarea id="descripcion" name="descripcion" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('descripcion') }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('descripcion')" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <x-input-label for="precio" :value="__('Precio (€)')" />
                    <x-text-input id="precio" name="precio" type="number" step="0.01" min="0" class="mt-1 block w-full" :value="old('precio')" required />
                    <x-input-error class="mt-2" :messages="$errors->get('precio')" />
                </div>
                <div>
                    <x-input-label for="categoria" :value="__('Categoría')" />
                    <select id="categoria" name="categoria" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                        <option value="">Selecciona</option>
                        @foreach($categorias as $cat)
                        <option value="{{ $cat }}" {{ old('categoria')===$cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('categoria')" />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <div>
                    <x-input-label for="stock" :value="__('Stock')" />
                    <x-text-input id="stock" name="stock" type="number" min="0" class="mt-1 block w-full" :value="old('stock', 0)" />
                    <x-input-error class="mt-2" :messages="$errors->get('stock')" />
                </div>
                <div>
                    <x-input-label for="imagen" :value="__('Imagen')" />
                    <input id="imagen" name="imagen" type="file" accept="image/jpeg,image/jpg,image/png,image/gif,image/webp,image/bmp,image/svg+xml" class="mt-1 block w-full text-sm text-gray-700">
                    <p class="mt-1 text-xs text-gray-500">Formatos aceptados: JPG, JPEG, PNG, GIF, WEBP, BMP, SVG (máx. 10MB)</p>
                    <x-input-error class="mt-2" :messages="$errors->get('imagen')" />
                </div>
            </div>

            <div class="mt-6">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="activo" value="1" {{ old('activo', true) ? 'checked' : '' }} class="rounded border-gray-300 text-[#C3E617] focus:ring-[#C3E617]">
                    <span class="ml-2 text-sm text-gray-700">Activo</span>
                </label>
            </div>

            <div class="flex items-center justify-end gap-4 mt-8">
                <a href="{{ route('admin.products.index') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition">Cancelar</a>
                <x-primary-button>Crear</x-primary-button>
            </div>
        </form>
    </div>
    </div>
@endsection



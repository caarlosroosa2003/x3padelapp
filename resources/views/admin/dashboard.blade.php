@extends('layouts.app')

@section('title', 'Panel de Administración - X3 Pádel')

@section('content')
<div class="bg-gradient-to-r from-gray-900 to-black text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold mb-2">Panel de Administración</h1>
                <p class="text-gray-300">Bienvenido, {{ Auth::user()->name }}</p>
            </div>
            <a href="{{ route('admin.products.index') }}" class="bg-white text-black px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">Gestionar Productos</a>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-[#C3E617]">
            <p class="text-gray-700 text-sm">Total Usuarios</p>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_usuarios'] ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500">
            <p class="text-gray-700 text-sm">Nuevos este Mes</p>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['usuarios_nuevos_mes'] ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500">
            <p class="text-gray-700 text-sm">Administradores</p>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_admins'] ?? 0 }}</p>
        </div>
        <div class="bg-gradient-to-br from-[#C3E617] to-[#a8c916] rounded-xl shadow-lg p-6 text-black">
            <p class="font-medium mb-3">Accesos Rápidos</p>
            <a href="{{ route('admin.users') }}" class="block text-sm hover:underline mb-1">→ Gestionar Usuarios</a>
            <a href="{{ route('admin.products.index') }}" class="block text-sm hover:underline mb-1">→ Gestionar Productos</a>
            <a href="{{ url('/reservas') }}" class="block text-sm hover:underline">→ Ver Reservas</a>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-gray-800 to-black px-6 py-4">
            <h2 class="text-xl font-bold text-black">Usuarios Recientes</h2>
        </div>
        <div class="p-6 overflow-x-auto">
            <table class="min-w-full w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Usuario</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Registro</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Rol</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse(($stats['usuarios_recientes'] ?? []) as $usuario)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $usuario->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $usuario->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $usuario->created_at->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($usuario->is_admin)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">Admin</span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Usuario</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-6 text-center text-gray-600">Sin usuarios recientes</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection



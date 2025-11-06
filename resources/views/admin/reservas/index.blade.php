@extends('layouts.app')

@section('title', 'Reservas - Panel Admin')

@section('content')
<div class="bg-gradient-to-r from-gray-900 to-black text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold mb-2">Reservas</h1>
                <p class="text-gray-300">Gestión y seguimiento de reservas</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="bg-white text-black px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">← Dashboard</a>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Estadísticas -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow p-5 border-l-4 border-[#C3E617]">
            <div class="text-gray-700 text-sm">Total Reservas</div>
            <div class="text-3xl font-bold text-gray-900 mt-1">{{ $stats['total'] ?? 0 }}</div>
        </div>
        <div class="bg-white rounded-xl shadow p-5 border-l-4 border-green-500">
            <div class="text-gray-700 text-sm">Confirmadas</div>
            <div class="text-3xl font-bold text-gray-900 mt-1">{{ $stats['confirmadas'] ?? 0 }}</div>
        </div>
        <div class="bg-white rounded-xl shadow p-5 border-l-4 border-yellow-500">
            <div class="text-gray-700 text-sm">Pendientes</div>
            <div class="text-3xl font-bold text-gray-900 mt-1">{{ $stats['pendientes'] ?? 0 }}</div>
        </div>
        <div class="bg-white rounded-xl shadow p-5 border-l-4 border-red-500">
            <div class="text-gray-700 text-sm">Canceladas</div>
            <div class="text-3xl font-bold text-gray-900 mt-1">{{ $stats['canceladas'] ?? 0 }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <div class="bg-white rounded-xl shadow p-5">
            <div class="text-gray-700 text-sm">Reservas Hoy</div>
            <div class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['hoy'] ?? 0 }}</div>
        </div>
        <div class="bg-white rounded-xl shadow p-5">
            <div class="text-gray-700 text-sm">Futuras</div>
            <div class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['futuras'] ?? 0 }}</div>
        </div>
        <div class="bg-white rounded-xl shadow p-5">
            <div class="text-gray-700 text-sm">Gratis (este mes)</div>
            <div class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['gratis_mes'] ?? 0 }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
        <div class="bg-white rounded-xl shadow p-5">
            <div class="text-gray-700 text-sm">Ingresos este mes</div>
            <div class="text-2xl font-extrabold text-gray-900 mt-1">{{ number_format($stats['ingresos_mes'] ?? 0, 2, ',', '.') }}€</div>
        </div>
        <div class="bg-white rounded-xl shadow p-5">
            <div class="text-gray-700 text-sm">Ingresos totales</div>
            <div class="text-2xl font-extrabold text-gray-900 mt-1">{{ number_format($stats['ingresos_total'] ?? 0, 2, ',', '.') }}€</div>
        </div>
    </div>

    <!-- Controles de paginación -->
    <div class="flex items-center justify-between mb-4">
        <div class="text-sm text-gray-700">Mostrando {{ $reservas->firstItem() }}–{{ $reservas->lastItem() }} de {{ $reservas->total() }}</div>
        <form method="GET" class="flex items-center gap-2">
            <label for="per_page" class="text-sm text-gray-700">Por página</label>
            <select id="per_page" name="per_page" class="border rounded-md px-2 py-1 text-sm" onchange="this.form.submit()">
                @foreach([10,20,50,100] as $n)
                    <option value="{{ $n }}" {{ (int)request('per_page',20)===$n ? 'selected' : '' }}>{{ $n }}</option>
                @endforeach
            </select>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-gray-800 to-black px-6 py-4">
            <h2 class="text-xl font-bold text-white">Listado de Reservas ({{ $reservas->total() }})</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Fecha</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Horario</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Pista</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Usuario</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Precio</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($reservas as $reserva)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $reserva->fecha?->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ optional($reserva->hora_inicio)->format('H:i') }} - {{ optional($reserva->hora_fin)->format('H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $reserva->pista->nombre ?? '—' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $reserva->user->name ?? '—' }}</div>
                            <div class="text-xs text-gray-600">{{ $reserva->user->email ?? '' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php $estado = $reserva->estado ?? 'pendiente'; @endphp
                            @if($estado === 'confirmada')
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Confirmada</span>
                            @elseif($estado === 'cancelada')
                                <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Cancelada</span>
                            @else
                                <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Pendiente</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $reserva->es_gratis ? '0,00€ (Gratis)' : number_format($reserva->precio ?? 0, 2, ',', '.') . '€' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-600">No hay reservas registradas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($reservas->hasPages())
        <div class="px-6 py-4 bg-gray-50 border-t">{{ $reservas->links() }}</div>
        @endif
    </div>
</div>
@endsection



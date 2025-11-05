@extends('layouts.app')

@section('title', 'Reservar ' . $pista->nombre . ' - X3 Pádel')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-black to-gray-900 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <a href="{{ route('reservas.index') }}" class="text-[#C3E617] hover:text-[#d4f73a] font-semibold mb-2 inline-block">
                    ← Volver a pistas
                </a>
                <h1 class="text-4xl font-bold">{{ $pista->nombre }}</h1>
                <p class="text-gray-300 mt-2">{{ $pista->descripcion ?? 'Selecciona fecha y horario para tu reserva' }}</p>
            </div>
            <div class="bg-[#C3E617] bg-opacity-20 rounded-xl p-4">
                <div class="text-white text-3xl font-bold">30€</div>
                <div class="text-white text-sm ">por sesión (1h 30min)</div>
            </div>
        </div>
    </div>
</div>

<!-- Contenido Principal -->
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Columna Izquierda: Calendario -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-24">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-[#C3E617]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Selecciona una Fecha
                    </h2>
                    
                    <input type="date" 
                           id="fecha-reserva" 
                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-[#C3E617] focus:border-transparent text-lg"
                           min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                           max="{{ date('Y-m-d', strtotime('+60 days')) }}"
                           value="{{ date('Y-m-d', strtotime('+1 day')) }}">

                    <div class="mt-6 p-4 bg-blue-50 rounded-lg border-2 border-blue-200">
                        <h3 class="font-semibold text-blue-900 mb-2 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                            Información de Horarios
                        </h3>
                        <ul class="text-sm text-blue-800 space-y-1">
                            <li>• Mañana: 8:00 - 14:00</li>
                            <li>• Tarde: 17:00 - 23:30</li>
                            <li>• Cerrado: 14:00 - 17:00</li>
                            <li>• Duración: 1h 30min</li>
                        </ul>
                    </div>

                    <div class="mt-4 p-4 bg-yellow-50 rounded-lg border-2 border-yellow-300">
                        <h3 class="font-semibold text-yellow-900 mb-2 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            Importante
                        </h3>
                        <p class="text-sm text-yellow-800">
                            Las reservas deben hacerse con <strong>1 día de antelación mínimo</strong>. No se aceptan reservas para el mismo día.
                        </p>
                    </div>

                    @auth
                    @if(Auth::user()->reservas_gratis_disponibles > 0)
                    <div class="mt-6 p-4 bg-gradient-to-r from-[#C3E617]/20 to-[#a8c916]/20 rounded-lg border-2 border-[#C3E617]">
                        <h3 class="font-semibold text-gray-900 mb-2 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-[#C3E617]" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            ¡Tienes reservas gratis!
                        </h3>
                        <p class="text-sm text-gray-700">
                            Tienes <strong>{{ Auth::user()->reservas_gratis_disponibles }}</strong> reserva(s) gratis disponible(s).
                        </p>
                    </div>
                    @endif
                    @endauth
                </div>
            </div>

            <!-- Columna Derecha: Horarios Disponibles -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-[#C3E617]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Horarios Disponibles
                    </h2>

                    <!-- Loading State -->
                    <div id="loading-horarios" class="text-center py-12">
                        <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-[#C3E617]"></div>
                        <p class="mt-4 text-gray-800">Cargando horarios...</p>
                    </div>

                    <!-- Horarios Container -->
                    <div id="horarios-container" class="hidden">
                        <!-- Horarios de Mañana -->
                        <div id="horarios-manana" class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
                                </svg>
                                Mañana (8:00 - 14:00)
                            </h3>
                            <div id="slots-manana" class="grid grid-cols-1 sm:grid-cols-2 gap-4"></div>
                        </div>

                        <!-- Horarios de Tarde -->
                        <div id="horarios-tarde">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.715-5.349L11 6.477V16h2a1 1 0 110 2H7a1 1 0 110-2h2V6.477L6.237 7.582l1.715 5.349a1 1 0 01-.285 1.05A3.989 3.989 0 015 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L9 4.323V3a1 1 0 011-1z"></path>
                                </svg>
                                Tarde (17:00 - 23:30)
                            </h3>
                            <div id="slots-tarde" class="grid grid-cols-1 sm:grid-cols-2 gap-4"></div>
                        </div>

                        <!-- Sin horarios disponibles -->
                        <div id="no-horarios" class="hidden text-center py-12">
                            <svg class="w-20 h-20 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-xl text-gray-700">No hay horarios disponibles para esta fecha</p>
                            <p class="text-gray-600 mt-2">Intenta seleccionar otro día</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal de Confirmación -->
<div id="modal-confirmar" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8">
        <div class="text-center">
            <div class="bg-[#C3E617] bg-opacity-20 rounded-full p-4 w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                <svg class="w-8 h-8 text-[#C3E617]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-4">Confirmar Reserva</h3>
            
            <div class="text-left bg-gray-50 rounded-lg p-4 mb-6">
                <div class="grid grid-cols-2 gap-2 text-sm">
                    <div class="text-gray-800">Pista:</div>
                    <div class="font-semibold">{{ $pista->nombre }}</div>
                    
                    <div class="text-gray-800">Fecha:</div>
                    <div class="font-semibold" id="modal-fecha"></div>
                    
                    <div class="text-gray-800">Horario:</div>
                    <div class="font-semibold" id="modal-horario"></div>
                    
                    <div class="text-gray-800">Precio:</div>
                    <div class="font-semibold text-[#C3E617]" id="modal-precio">30€</div>
                </div>
            </div>

            @auth
            @if(Auth::user()->reservas_gratis_disponibles > 0)
            <div class="mb-6">
                <label class="flex items-center justify-center cursor-pointer">
                    <input type="checkbox" id="usar-gratis" class="rounded border-gray-300 text-[#C3E617] shadow-sm focus:ring-[#C3E617] mr-2">
                    <span class="text-sm text-gray-700">Usar reserva gratis (Tienes {{ Auth::user()->reservas_gratis_disponibles }})</span>
                </label>
            </div>
            @endif
            @endauth

            <form id="form-reserva" method="POST" action="{{ route('reservas.crear') }}">
                @csrf
                <input type="hidden" name="pista_id" value="{{ $pista->id }}">
                <input type="hidden" name="fecha" id="input-fecha">
                <input type="hidden" name="hora_inicio" id="input-hora-inicio">
                <input type="hidden" name="hora_fin" id="input-hora-fin">
                <input type="hidden" name="usar_reserva_gratis" id="input-usar-gratis" value="0">

                <div class="flex gap-4">
                    <button type="button" onclick="cerrarModal()" class="flex-1 bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-300 transition duration-300">
                        Cancelar
                    </button>
                    <button type="submit" class="flex-1 bg-[#C3E617] text-black px-6 py-3 rounded-lg font-semibold hover:bg-[#d4f73a] transition duration-300">
                        Confirmar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
const pistaId = {{ $pista->id }};
// Fecha mínima: mañana (1 día de antelación)
const tomorrow = new Date();
tomorrow.setDate(tomorrow.getDate() + 1);
const tomorrowString = tomorrow.toISOString().split('T')[0];
let fechaSeleccionada = document.getElementById('fecha-reserva').value || tomorrowString;

// Cargar horarios al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    cargarHorarios(fechaSeleccionada);
});

// Cargar horarios cuando cambie la fecha
document.getElementById('fecha-reserva').addEventListener('change', function(e) {
    fechaSeleccionada = e.target.value;
    cargarHorarios(fechaSeleccionada);
});

// Función para cargar horarios
async function cargarHorarios(fecha) {
    const loadingElement = document.getElementById('loading-horarios');
    const horariosContainer = document.getElementById('horarios-container');
    const noHorarios = document.getElementById('no-horarios');
    
    loadingElement.classList.remove('hidden');
    horariosContainer.classList.add('hidden');
    
    try {
        const response = await fetch(`/reservas/pista/${pistaId}/horarios?fecha=${fecha}`);
        const data = await response.json();
        
        if (data.success) {
            mostrarHorarios(data.horarios, fecha);
        } else {
            alert(data.message);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error al cargar los horarios');
    }
    
    loadingElement.classList.add('hidden');
}

// Función para mostrar horarios
function mostrarHorarios(horarios, fecha) {
    const slotsManana = document.getElementById('slots-manana');
    const slotsTarde = document.getElementById('slots-tarde');
    const horariosContainer = document.getElementById('horarios-container');
    const noHorarios = document.getElementById('no-horarios');
    
    slotsManana.innerHTML = '';
    slotsTarde.innerHTML = '';
    
    const horariosManana = horarios.filter(h => h.hora_inicio < '14:00');
    const horariosTarde = horarios.filter(h => h.hora_inicio >= '17:00');
    
    if (horarios.length === 0) {
        horariosContainer.classList.add('hidden');
        noHorarios.classList.remove('hidden');
        return;
    }
    
    horariosContainer.classList.remove('hidden');
    noHorarios.classList.add('hidden');
    
    // Renderizar horarios de mañana
    horariosManana.forEach(horario => {
        slotsManana.appendChild(crearSlotHorario(horario, fecha));
    });
    
    // Renderizar horarios de tarde
    horariosTarde.forEach(horario => {
        slotsTarde.appendChild(crearSlotHorario(horario, fecha));
    });
    
    // Ocultar secciones sin horarios
    document.getElementById('horarios-manana').style.display = horariosManana.length > 0 ? 'block' : 'none';
    document.getElementById('horarios-tarde').style.display = horariosTarde.length > 0 ? 'block' : 'none';
}

// Crear elemento de horario
function crearSlotHorario(horario, fecha) {
    const div = document.createElement('div');
    
    if (horario.disponible) {
        div.className = 'border-2 border-gray-200 rounded-lg p-4 hover:border-[#C3E617] hover:bg-[#C3E617]/5 cursor-pointer transition duration-300';
        div.onclick = () => abrirModalConfirmacion(fecha, horario);
    } else {
        div.className = 'border-2 border-gray-200 rounded-lg p-4 bg-gray-100 opacity-50 cursor-not-allowed';
    }
    
    div.innerHTML = `
        <div class="flex justify-between items-center">
            <div>
                <div class="font-bold text-lg text-gray-900">${horario.hora_inicio} - ${horario.hora_fin}</div>
                <div class="text-sm text-gray-800">1h 30min</div>
            </div>
            <div class="text-right">
                ${horario.disponible 
                    ? '<span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">Disponible</span>' 
                    : '<span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-semibold">Ocupado</span>'
                }
                <div class="text-[#C3E617] font-bold mt-1">${horario.precio}€</div>
            </div>
        </div>
    `;
    
    return div;
}

// Abrir modal de confirmación
function abrirModalConfirmacion(fecha, horario) {
    document.getElementById('modal-fecha').textContent = new Date(fecha + 'T00:00:00').toLocaleDateString('es-ES', { 
        weekday: 'long', 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric' 
    });
    document.getElementById('modal-horario').textContent = `${horario.hora_inicio} - ${horario.hora_fin}`;
    document.getElementById('modal-precio').textContent = `${horario.precio}€`;
    
    document.getElementById('input-fecha').value = fecha;
    document.getElementById('input-hora-inicio').value = horario.hora_inicio;
    document.getElementById('input-hora-fin').value = horario.hora_fin;
    
    document.getElementById('modal-confirmar').classList.remove('hidden');
}

// Cerrar modal
function cerrarModal() {
    document.getElementById('modal-confirmar').classList.add('hidden');
}

// Cerrar modal al hacer clic fuera
document.getElementById('modal-confirmar').addEventListener('click', function(e) {
    if (e.target === this) {
        cerrarModal();
    }
});

// Manejar checkbox de usar reserva gratis
const usarGratisCheckbox = document.getElementById('usar-gratis');
if (usarGratisCheckbox) {
    usarGratisCheckbox.addEventListener('change', function() {
        document.getElementById('input-usar-gratis').value = this.checked ? '1' : '0';
        const precioElement = document.getElementById('modal-precio');
        if (this.checked) {
            precioElement.textContent = 'GRATIS';
            precioElement.classList.add('text-green-600');
            precioElement.classList.remove('text-[#C3E617]');
        } else {
            precioElement.textContent = '30€';
            precioElement.classList.remove('text-green-600');
            precioElement.classList.add('text-[#C3E617]');
        }
    });
}
</script>
@endpush
@endsection


<?php

namespace App\Http\Controllers;

use App\Models\Pista;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReservaController extends Controller
{
    /**
     * Mostrar página de selección de pista
     */
    public function index()
    {
        $pistas = Pista::where('disponible', true)->get();
        return view('reservas.index', compact('pistas'));
    }

    /**
     * Mostrar calendario y horarios de una pista específica
     */
    public function mostrarPista($pistaId)
    {
        $pista = Pista::findOrFail($pistaId);
        
        if (!$pista->disponible) {
            return redirect()->route('reservas.index')
                ->with('error', 'Esta pista no está disponible.');
        }

        return view('reservas.calendario', compact('pista'));
    }

    /**
     * Obtener horarios disponibles para una fecha y pista específica (AJAX)
     */
    public function obtenerHorarios(Request $request, $pistaId)
    {
        $fecha = $request->input('fecha');
        $pista = Pista::findOrFail($pistaId);

        // Validar que la fecha sea al menos mañana (1 día de antelación)
        $fechaMinima = Carbon::tomorrow()->toDateString();
        if (Carbon::parse($fecha)->isBefore($fechaMinima)) {
            return response()->json([
                'success' => false,
                'message' => 'Las reservas deben realizarse con al menos 1 día de antelación. La fecha más próxima disponible es mañana.'
            ]);
        }

        $horarios = $this->generarHorariosDisponibles($pista, $fecha);

        return response()->json([
            'success' => true,
            'horarios' => $horarios
        ]);
    }

    /**
     * Generar lista de horarios disponibles
     * Horario: 8:00 - 23:30 (cerrado de 14:00 a 17:00)
     * Duración: 1h 30min
     */
    private function generarHorariosDisponibles($pista, $fecha)
    {
        $horarios = [];
        
        // Horarios de la mañana: 8:00 - 14:00
        $horaActual = Carbon::createFromTime(8, 0);
        $horaCierre = Carbon::createFromTime(14, 0);
        
        while ($horaActual < $horaCierre) {
            $horaInicio = $horaActual->format('H:i');
            $horaFin = $horaActual->copy()->addMinutes(90)->format('H:i');
            
            // No agregar si el horario de fin excede las 14:00
            if ($horaFin <= '14:00') {
                $disponible = $pista->estaDisponible($fecha, $horaInicio, $horaFin);
                
                $horarios[] = [
                    'hora_inicio' => $horaInicio,
                    'hora_fin' => $horaFin,
                    'disponible' => $disponible,
                    'precio' => 30.00 // Precio por reserva
                ];
            }
            
            $horaActual->addMinutes(90);
        }
        
        // Horarios de la tarde: 17:00 - 23:30
        $horaActual = Carbon::createFromTime(17, 0);
        $horaCierre = Carbon::createFromTime(23, 30);
        
        while ($horaActual < $horaCierre) {
            $horaInicio = $horaActual->format('H:i');
            $horaFin = $horaActual->copy()->addMinutes(90)->format('H:i');
            
            // No agregar si el horario de fin excede las 23:30
            if ($horaFin <= '23:30') {
                $disponible = $pista->estaDisponible($fecha, $horaInicio, $horaFin);
                
                $horarios[] = [
                    'hora_inicio' => $horaInicio,
                    'hora_fin' => $horaFin,
                    'disponible' => $disponible,
                    'precio' => 30.00
                ];
            }
            
            $horaActual->addMinutes(90);
        }

        return $horarios;
    }

    /**
     * Crear una nueva reserva
     */
    public function crear(Request $request)
    {
        $request->validate([
            'pista_id' => 'required|exists:pistas,id',
            'fecha' => 'required|date|after:today', // Cambio: debe ser después de hoy (mínimo mañana)
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'usar_reserva_gratis' => 'boolean'
        ], [
            'fecha.after' => 'Las reservas deben realizarse con al menos 1 día de antelación.'
        ]);

        $pista = Pista::findOrFail($request->pista_id);
        $user = auth()->user();

        // Verificar que el usuario puede hacer reservas (no bloqueado)
        if (!$user->puedeReservar()) {
            if ($user->bloqueado) {
                return back()->with('error', 'Tu cuenta está bloqueada. Contacta con el administrador.');
            }
            if ($user->no_shows_count >= 3) {
                return back()->with('error', 'Has acumulado 3 o más no-shows. Tu cuenta ha sido bloqueada temporalmente. Contacta con el administrador.');
            }
        }

        // Verificar disponibilidad
        if (!$pista->estaDisponible($request->fecha, $request->hora_inicio, $request->hora_fin)) {
            return back()->with('error', 'Este horario ya no está disponible.');
        }

        // Verificar si el usuario quiere usar una reserva gratis
        $esGratis = false;
        $precio = 30.00;

        if ($request->usar_reserva_gratis && $user->reservas_gratis_disponibles > 0) {
            $esGratis = true;
            $precio = 0;
            $user->decrement('reservas_gratis_disponibles');
        }

        // Crear la reserva
        $reserva = Reserva::create([
            'user_id' => $user->id,
            'pista_id' => $request->pista_id,
            'fecha' => $request->fecha,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'precio' => $precio,
            'es_gratis' => $esGratis,
            'estado' => 'confirmada',
        ]);

        // Incrementar contador de reservas (solo para estadísticas, no para recompensas)
        $user->increment('reservas_count');

        // NOTA: Las recompensas NO se otorgan aquí. Se otorgan solo cuando las reservas se completan (pasan)
        // Ver método procesarReservasCompletadas() para más detalles

        return redirect()->route('mis-reservas')
            ->with('success', '¡Reserva confirmada exitosamente!');
    }

    /**
     * Mostrar historial de reservas del usuario autenticado
     */
    public function misReservas()
    {
        $user = auth()->user();
        
        // Obtener todas las reservas del usuario ordenadas por fecha (más recientes primero)
        $reservas = Reserva::where('user_id', $user->id)
            ->with('pista')
            ->orderBy('fecha', 'desc')
            ->orderBy('hora_inicio', 'desc')
            ->paginate(10);
        
        // Separar reservas por estado
        $proximasReservas = Reserva::where('user_id', $user->id)
            ->where('estado', 'confirmada')
            ->where('fecha', '>=', now()->toDateString())
            ->with('pista')
            ->orderBy('fecha', 'asc')
            ->orderBy('hora_inicio', 'asc')
            ->get();
        
        $historialReservas = Reserva::where('user_id', $user->id)
            ->where(function($query) {
                $query->where('fecha', '<', now()->toDateString())
                      ->orWhere('estado', 'cancelada')
                      ->orWhere('estado', 'completada');
            })
            ->with('pista')
            ->orderBy('fecha', 'desc')
            ->orderBy('hora_inicio', 'desc')
            ->paginate(10);

        return view('mis-reservas', compact('proximasReservas', 'historialReservas', 'user'));
    }

    /**
     * Cancelar una reserva
     */
    public function cancelar($id)
    {
        $reserva = Reserva::findOrFail($id);
        $user = auth()->user();

        // Verificar que la reserva pertenezca al usuario autenticado
        if ($reserva->user_id !== $user->id) {
            abort(403, 'No tienes permiso para cancelar esta reserva.');
        }

        // No permitir cancelar reservas pasadas
        if ($reserva->haPasado()) {
            return back()->with('error', 'No puedes cancelar una reserva que ya pasó.');
        }

        // Si fue gratis, devolver la reserva gratis
        if ($reserva->es_gratis) {
            $user->increment('reservas_gratis_disponibles');
        }

        // Decrementar contador de reservas (solo para estadísticas)
        $user->decrement('reservas_count');

        // Marcar como cancelada
        $reserva->update(['estado' => 'cancelada']);

        // Recalcular reservas completadas y ajustar recompensas
        // Esto evita que los usuarios abusen del sistema cancelando reservas para obtener recompensas gratis
        $user->recalcularReservasCompletadas();

        return back()->with('success', 'Reserva cancelada exitosamente.');
    }

    /**
     * Realizar check-in de una reserva
     */
    public function checkIn($id)
    {
        $reserva = Reserva::findOrFail($id);
        $user = auth()->user();

        // Verificar que la reserva pertenezca al usuario autenticado
        if ($reserva->user_id !== $user->id) {
            abort(403, 'No tienes permiso para realizar check-in en esta reserva.');
        }

        // Solo se puede hacer check-in en reservas futuras o el mismo día antes del inicio
        $fechaHoraInicio = Carbon::parse($reserva->fecha->format('Y-m-d') . ' ' . $reserva->hora_inicio);
        
        if ($fechaHoraInicio->isPast()) {
            return back()->with('error', 'No puedes hacer check-in en una reserva que ya pasó.');
        }

        // Hacer check-in
        $reserva->marcarCheckIn();

        return back()->with('success', 'Check-in realizado exitosamente.');
    }

    /**
     * Procesar reservas completadas y otorgar recompensas
     * Este método debe ejecutarse periódicamente (por ejemplo, mediante un comando programado)
     * o cuando una reserva pasa su fecha/hora de fin
     */
    public function procesarReservasCompletadas()
    {
        // Obtener todas las reservas que ya pasaron y están confirmadas (no canceladas)
        $reservasCompletadas = Reserva::where('estado', 'confirmada')
            ->whereRaw('CONCAT(fecha, " ", hora_fin) < ?', [now()])
            ->with('user')
            ->get();

        foreach ($reservasCompletadas as $reserva) {
            $user = $reserva->user;

            // Marcar como completada si no se hizo check-in (será marcado como no-show)
            if (!$reserva->check_in_realizado) {
                $reserva->marcarNoShow();
            }

            // Actualizar estado a completada
            $reserva->update(['estado' => 'completada']);

            // Recalcular reservas completadas y otorgar recompensas
            $reservasCompletadasAnterior = $user->reservas_completadas;
            $user->recalcularReservasCompletadas();

            // Si llegó a un múltiplo de 5, otorgar recompensa
            if ($user->reservas_completadas % 5 == 0 && $user->reservas_completadas > 0 && $user->reservas_completadas > $reservasCompletadasAnterior) {
                // La recompensa ya se otorgó en recalcularReservasCompletadas()
                // Pero podemos notificar al usuario aquí si es necesario
            }
        }

        return response()->json(['message' => 'Reservas procesadas exitosamente']);
    }
}

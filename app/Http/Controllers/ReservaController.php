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

        // Incrementar contador de reservas
        $user->increment('reservas_count');

        // Cada 5 reservas, dar una gratis
        if ($user->reservas_count % 5 == 0 && !$esGratis) {
            $user->increment('reservas_gratis_disponibles');
            return redirect()->route('mis-reservas')
                ->with('success', '¡Reserva confirmada! 🎉 Has ganado una reserva gratis por hacer 5 reservas.');
        }

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

        // Verificar que la reserva pertenezca al usuario autenticado
        if ($reserva->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para cancelar esta reserva.');
        }

        // No permitir cancelar reservas pasadas
        if ($reserva->haPasado()) {
            return back()->with('error', 'No puedes cancelar una reserva que ya pasó.');
        }

        // Si fue gratis, devolver la reserva gratis
        if ($reserva->es_gratis) {
            auth()->user()->increment('reservas_gratis_disponibles');
        }

        // Decrementar contador de reservas
        auth()->user()->decrement('reservas_count');

        $reserva->update(['estado' => 'cancelada']);

        return back()->with('success', 'Reserva cancelada exitosamente.');
    }
}

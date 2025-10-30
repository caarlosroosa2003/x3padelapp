<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pista extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'tipo',
        'disponible',
        'imagen',
    ];

    protected $casts = [
        'disponible' => 'boolean',
    ];

    /**
     * Obtener las reservas de esta pista
     */
    public function reservas(): HasMany
    {
        return $this->hasMany(Reserva::class);
    }

    /**
     * Verificar si la pista está disponible en una fecha y hora específica
     * Detecta correctamente solapamientos de horarios
     */
    public function estaDisponible($fecha, $horaInicio, $horaFin): bool
    {
        if (!$this->disponible) {
            return false;
        }

        // Una reserva se solapa si:
        // 1. La hora_inicio de la reserva existente es menor que hora_fin del nuevo horario
        // 2. Y la hora_fin de la reserva existente es mayor que hora_inicio del nuevo horario
        return !$this->reservas()
            ->where('fecha', $fecha)
            ->where('estado', '!=', 'cancelada')
            ->where(function ($query) use ($horaInicio, $horaFin) {
                $query->where('hora_inicio', '<', $horaFin)
                      ->where('hora_fin', '>', $horaInicio);
            })
            ->exists();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Reserva extends Model
{
    protected $fillable = [
        'user_id',
        'pista_id',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'precio',
        'es_gratis',
        'estado',
        'notas',
    ];

    protected $casts = [
        'fecha' => 'date',
        'hora_inicio' => 'datetime:H:i',
        'hora_fin' => 'datetime:H:i',
        'precio' => 'decimal:2',
        'es_gratis' => 'boolean',
    ];

    /**
     * Obtener el usuario que hizo la reserva
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtener la pista reservada
     */
    public function pista(): BelongsTo
    {
        return $this->belongsTo(Pista::class);
    }

    /**
     * Scope para reservas confirmadas
     */
    public function scopeConfirmadas($query)
    {
        return $query->where('estado', 'confirmada');
    }

    /**
     * Scope para reservas futuras
     */
    public function scopeFuturas($query)
    {
        return $query->where('fecha', '>=', now()->toDateString());
    }

    /**
     * Verificar si la reserva es hoy
     */
    public function esHoy(): bool
    {
        return $this->fecha->isToday();
    }

    /**
     * Verificar si ya pasó la reserva
     */
    public function haPasado(): bool
    {
        return $this->fecha->isPast() || 
               ($this->fecha->isToday() && now()->format('H:i') > $this->hora_fin);
    }
}

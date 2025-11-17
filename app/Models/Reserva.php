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
        'check_in_realizado',
        'check_in_at',
        'no_show',
    ];

    protected $casts = [
        'fecha' => 'date',
        'hora_inicio' => 'string',
        'hora_fin' => 'string',
        'precio' => 'decimal:2',
        'es_gratis' => 'boolean',
        'check_in_realizado' => 'boolean',
        'check_in_at' => 'datetime',
        'no_show' => 'boolean',
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
        if ($this->fecha->isPast()) {
            return true;
        }
        
        if ($this->fecha->isToday()) {
            $horaFin = Carbon::createFromTimeString($this->hora_fin);
            return now()->greaterThan($horaFin);
        }
        
        return false;
    }

    /**
     * Verificar si la reserva está completada (pasó y no fue cancelada)
     */
    public function estaCompletada(): bool
    {
        return $this->estado === 'completada' || 
               ($this->estado === 'confirmada' && $this->haPasado());
    }

    /**
     * Marcar check-in realizado
     */
    public function marcarCheckIn(): void
    {
        $this->update([
            'check_in_realizado' => true,
            'check_in_at' => now(),
            'no_show' => false,
        ]);
    }

    /**
     * Marcar como no-show (no se presentó)
     */
    public function marcarNoShow(): void
    {
        if (!$this->check_in_realizado && $this->haPasado() && $this->estado === 'confirmada') {
            $this->update(['no_show' => true]);
            $this->user->increment('no_shows_count');
        }
    }

    /**
     * Scope para reservas completadas (que ya pasaron y no fueron canceladas)
     */
    public function scopeCompletadas($query)
    {
        return $query->where(function($q) {
            $q->where('estado', 'completada')
              ->orWhere(function($q2) {
                  $q2->where('estado', 'confirmada')
                     ->whereRaw('CONCAT(fecha, " ", hora_fin) < ?', [now()]);
              });
        });
    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'telefono',
        'password',
        'is_admin',
        'reservas_count',
        'reservas_completadas',
        'reservas_gratis_disponibles',
        'no_shows_count',
        'bloqueado',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
            'bloqueado' => 'boolean',
        ];
    }

    /**
     * Relación con reservas
     */
    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }

    /**
     * Recalcular reservas completadas y ajustar recompensas
     */
    public function recalcularReservasCompletadas(): void
    {
        $reservasCompletadas = $this->reservas()
            ->where(function($q) {
                $q->where('estado', 'completada')
                  ->orWhere(function($q2) {
                      $q2->where('estado', 'confirmada')
                         ->whereRaw('CONCAT(fecha, " ", hora_fin) < ?', [now()]);
                  });
            })
            ->where('estado', '!=', 'cancelada')
            ->count();

        $this->reservas_completadas = $reservasCompletadas;

        // Recalcular recompensas basadas en reservas completadas
        // Solo se cuentan las reservas que ya pasaron y no fueron canceladas
        $recompensasEsperadas = floor($reservasCompletadas / 5);
        $recompensasUsadas = $this->reservas()->where('es_gratis', true)->count();
        
        // Si el usuario tiene más recompensas de las que debería, ajustar
        if ($this->reservas_gratis_disponibles > ($recompensasEsperadas - $recompensasUsadas)) {
            $this->reservas_gratis_disponibles = max(0, $recompensasEsperadas - $recompensasUsadas);
        } else {
            // Si tiene menos, otorgar las que faltan (solo si completó 5, 10, 15, etc.)
            if ($reservasCompletadas % 5 == 0 && $reservasCompletadas > 0) {
                $recompensasTotales = $reservasCompletadas / 5;
                $recompensasDisponiblesEsperadas = $recompensasTotales - $recompensasUsadas;
                if ($this->reservas_gratis_disponibles < $recompensasDisponiblesEsperadas) {
                    $this->reservas_gratis_disponibles = $recompensasDisponiblesEsperadas;
                }
            }
        }

        $this->save();
    }

    /**
     * Verificar si el usuario puede hacer reservas (no bloqueado y sin demasiados no-shows)
     */
    public function puedeReservar(): bool
    {
        // Bloqueado automático si tiene 3 o más no-shows
        if ($this->no_shows_count >= 3) {
            $this->bloqueado = true;
            $this->save();
            return false;
        }

        return !$this->bloqueado;
    }
}

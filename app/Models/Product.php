<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'categoria',
        'imagen',
        'stock',
        'activo',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'stock' => 'integer',
        'activo' => 'boolean',
    ];

    /**
     * Scope para productos activos
     */
    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }

    /**
     * Scope para filtrar por categoría
     */
    public function scopePorCategoria($query, $categoria)
    {
        return $query->where('categoria', $categoria);
    }
}

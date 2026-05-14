<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $fillable = [
        'codigo',
        'descripcion',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }

    public function modelos()
    {
        return $this->belongsToMany(ModeloEquipo::class, 'equipo_modelo', 'equipo_id', 'modelo_equipo_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModeloEquipo extends Model
{
    protected $table = 'modelos_equipo';

    protected $fillable = ['nombre', 'descripcion', 'activo'];

    protected $casts = ['activo' => 'boolean'];

    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }
}
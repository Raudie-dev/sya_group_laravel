<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class formulario1 extends Model
{
    protected $table = 'formulario_1';

    protected $fillable = [
        'registro_id',
        'inspector_nombre',
        'inspector_rut',
        'lugar_muestreo',
        'direccion_muestreo',
        'punto_muestreo',
        'inicio_muestreo',
        'fin_muestreo',
        'observaciones'
    ];

    public function registro()
    {
        return $this->belongsTo(Registro::class);
    }
}

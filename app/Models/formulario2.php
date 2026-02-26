<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formulario2 extends Model
{
    protected $table = 'formulario_2';

    protected $fillable = [
        'registro_id',
        'lugar_muestreo',
        'inicio_muestreo',
        'fin_muestreo',
        'observaciones'
    ];

    public function registro()
    {
        return $this->belongsTo(Registro::class);
    }
}

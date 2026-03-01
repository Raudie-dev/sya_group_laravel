<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formulario2Lectura extends Model
{
    protected $table = 'formulario_2_lecturas';

    protected $fillable = [
        'formulario2_id',
        'fecha',
        'hora',
        'n_muestra',
        'valor_ph',
        'valor_temp',
    ];

    protected $casts = [
        'fecha' => 'date',
        'hora'  => 'datetime:H:i',
    ];

    public function formulario()
    {
        return $this->belongsTo(Formulario2::class, 'formulario2_id');
    }
}
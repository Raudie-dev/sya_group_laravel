<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formulario9 extends Model
{
    protected $table = 'formulario_9';

    protected $fillable = [
        'registro_id',
        'frecuencia_control',
        'equipo_codigo',
        'registros',
    ];

    protected $casts = [
        'registros' => 'array',
    ];

    public function registro()
    {
        return $this->belongsTo(Registro::class);
    }
}
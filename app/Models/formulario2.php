<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Formulario2 extends Model
{
    protected $table = 'formulario_2';

    protected $fillable = [
        'registro_id',
        'tipo_muestra',
        'inspector_nombre',
        'inspector_rut',
        'lugar_muestreo',
        'direccion_muestreo',
        'punto_muestreo',
        'inicio_muestreo',
        'fin_muestreo',
        'observaciones',
        'temp_termino',
        'nombre_proyecto',
        'n_rca',
        

        // equipos
        'eq_muestreo_cod', 'eq_muestreo_chk',
        'eq_ph_cod', 'eq_ph_chk',
        'eq_temp_cod', 'eq_temp_chk',

        // anexos
        'anexo_1_titulo', 'anexo_1_file',
        'anexo_2_titulo', 'anexo_2_file',
        'anexo_3_titulo', 'anexo_3_file',
        'anexo_4_titulo', 'anexo_4_file',
    ];

    protected $casts = [
        'inicio_muestreo' => 'datetime',
        'fin_muestreo'    => 'datetime',
        'eq_muestreo_chk' => 'boolean',
        'eq_ph_chk'       => 'boolean',
        'eq_temp_chk'     => 'boolean',
    ];

    public function registro(): BelongsTo
    {
        return $this->belongsTo(Registro::class);
    }

    public function lecturas(): HasMany
    {
        return $this->hasMany(Formulario2Lectura::class, 'formulario2_id');
    }
}
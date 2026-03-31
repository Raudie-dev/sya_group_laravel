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

        'equipos_detalle',    
    ];

    protected $casts = [
        'inicio_muestreo' => 'datetime',
        'fin_muestreo'    => 'datetime',
        'eq_muestreo_chk' => 'boolean',
        'eq_ph_chk'       => 'boolean',
        'eq_temp_chk'     => 'boolean',
        'mostrar_dj_inspector' => 'boolean',
        'mostrar_dj_etfa'      => 'boolean',
        'equipos_detalle'    => 'array',
    ];

    public function registro(): BelongsTo
    {
        return $this->belongsTo(Registro::class);
    }

    public function lecturas(): HasMany
    {
        return $this->hasMany(Formulario2Lectura::class, 'formulario2_id');
    }

    public function getEquiposArrayAttribute(): array
    {
        if (!empty($this->equipos_detalle)) {
            return $this->equipos_detalle;
        }

        return [
            ['label' => 'Toma de Muestra: NCh411/10.Of2005. Parte 10. Muestreo de aguas residuales - Recolección y manejo de las muestras. 2005. INN', 'eq_val' => '', 'chk_val' => true],
            ['label' => 'pH: (NCh2313/1.Of2021. Parte 1. Determinación de pH.1995. INN)',             'eq_val' => '', 'chk_val' => true],
            ['label' => 'Temperatura: (NCh2313/2.Of95. Parte 2. Determinación de la temperatura.1995. INN)',      'eq_val' => '', 'chk_val' => true],
        ];
    }
}


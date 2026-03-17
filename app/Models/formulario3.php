<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formulario3 extends Model
{
    protected $table = 'formulario_3';

    protected $fillable = [
        'registro_id',

        // Sección 2
        'inspector_nombre',
        'inspector_rut',

        // Sección 3
        'lugar_muestreo',
        'direccion_muestreo',
        'punto_muestreo',
        'tipo_muestra',
        'inicio_muestreo',
        'fin_muestreo',

        // Equipos (selects + checkboxes) ← FALTABAN ESTOS
        'eq_muestreo_cod',
        'eq_muestreo_chk',
        'eq_ph_cod',
        'eq_ph_chk',
        'eq_temp_cod',
        'eq_temp_chk',

        // JSON
        'equipos_detalle',
        'mediciones_detalle',

        // Sección 5
        'observaciones',
        'anexo_1_file', 'anexo_1_titulo',
        'anexo_2_file', 'anexo_2_titulo',
        'anexo_3_file', 'anexo_3_titulo',
        'anexo_4_file', 'anexo_4_titulo',
    ];

    protected $casts = [
        'equipos_detalle'    => 'array',
        'mediciones_detalle' => 'array',
        'eq_muestreo_chk'    => 'boolean',
        'eq_ph_chk'          => 'boolean',
        'eq_temp_chk'        => 'boolean',
        'inicio_muestreo'      => 'datetime',
        'fin_muestreo'         => 'datetime',
    ];

    public function getEquiposArrayAttribute()
    {
        if (!empty($this->equipos_detalle)) {
            return $this->equipos_detalle;
        }

        return [
            ['nombre' => 'Toma de Muestra: NCh411/10.Of2005.', 'codigo' => '', 'check' => '1'],
            ['nombre' => 'pH: (NCh2313/1.Of95.)',               'codigo' => '', 'check' => '1'],
            ['nombre' => 'Temperatura: (NCh2313/2.Of95.)',       'codigo' => '', 'check' => '1'],
        ];
    }

    public function getMedicionesArrayAttribute()
    {
        if (!empty($this->mediciones_detalle)) {
            return $this->mediciones_detalle;
        }

        return [
            ['item' => 'RIL', 'fecha' => '', 'hora' => '', 'ph' => '', 'temp' => '', 'cloro' => ''],
            ['item' => 'SST', 'fecha' => '', 'hora' => '', 'ph' => '', 'temp' => '', 'cloro' => ''],
        ];
    }
}
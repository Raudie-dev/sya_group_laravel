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
        'temperatura_inicial',
        'mostrar_dj_inspector',
        'mostrar_dj_etfa',

        // Equipos
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
        'mostrar_dj_inspector' => 'boolean',
        'mostrar_dj_etfa'      => 'boolean',
    ];

    public function getEquiposArrayAttribute(): array
    {
        if (!empty($this->equipos_detalle)) {
            return $this->equipos_detalle;
        }

        return [
            ['label' => 'Toma de Muestra: NCh411/10.Of2005. Parte 10. Muestreo de aguas residuales - Recolección y manejo de las muestras. 2005. INN', 'eq_val' => '', 'chk_val' => true],
            ['label' => 'pH: (NCh2313/1.Of2021. Parte 1. Determinación de pH.1995. INN)',             'eq_val' => '', 'chk_val' => true],
            ['label' => 'Temperatura: (NCh2313/2.Of95. Parte 2. Determinación de la temperatura.1995. INN)',      'eq_val' => '', 'chk_val' => true],
            ['label' => 'Cloro libre residual: IMCLB',    'eq_val' => '', 'chk_val' => true],
        ];
    }

    public function getMedicionesArrayAttribute()
    {
        if (!empty($this->mediciones_detalle)) {
            return $this->mediciones_detalle;
        }

        return [
            ['item' => 'Inicio', 'fecha' => '', 'hora' => '', 'ph' => '', 'temp' => '', 'cloro' => ''],
            ['item' => 'Fin', 'fecha' => '', 'hora' => '', 'ph' => '', 'temp' => '', 'cloro' => ''],
        ];
    }
    
    public function registro()
    {
        return $this->belongsTo(Registro::class);
    }
}
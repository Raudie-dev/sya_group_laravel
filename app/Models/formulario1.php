<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formulario1 extends Model
{
    protected $table = 'formulario_1';

    protected $fillable = [
        'registro_id',
        'tipo_muestra',
        'temperatura_inicial',
        'inspector_nombre', 'inspector_rut',
        'lugar_muestreo', 'direccion_muestreo', 'punto_muestreo',
        'inicio_muestreo', 'fin_muestreo',
        'observaciones',
        'eq_muestreo_cod', 'eq_muestreo_chk',
        'eq_ph_cod', 'eq_ph_chk',
        'eq_temp_cod', 'eq_temp_chk',
        'eq_cloro_cod', 'eq_cloro_chk',
        'r_f_inicio', 'r_h_inicio', 'r_ph_inicio', 'r_t_inicio',
        'r_f_fin', 'r_h_fin', 'r_ph_fin', 'r_t_fin',
        'anexo_1_titulo', 'anexo_1_file',
        'anexo_2_titulo', 'anexo_2_file',
        'anexo_3_titulo', 'anexo_3_file',
        'anexo_4_titulo', 'anexo_4_file',
        //nuevos
        'equipos_detalle',    
        'mediciones_detalle', 

    ];

    protected $casts = [
        'inicio_muestreo' => 'datetime',
        'fin_muestreo'    => 'datetime',
        'r_f_inicio'      => 'date',
        'r_f_fin'         => 'date',
        'mostrar_dj_inspector' => 'boolean',
        'mostrar_dj_etfa'      => 'boolean',
        //nuevos
        'equipos_detalle'    => 'array',
        'mediciones_detalle' => 'array',
    ];

    public function registro()
    {
        return $this->belongsTo(Registro::class);
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
}

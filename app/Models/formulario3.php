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
        'n_rca',
        'nombre_proyecto',

        // Sección 3
        'lugar_muestreo',
        'direccion_muestreo',
        'punto_muestreo',
        'tipo_muestra',
        'eq_muestreo_cod', 'eq_muestreo_chk',
        'eq_ph_cod', 'eq_ph_chk',
        'eq_temp_cod', 'eq_temp_chk',

        // Sección 4
        'insitu_item_1', 'insitu_fecha_1', 'insitu_hora_1', 'insitu_ph_1', 'insitu_temp_1', 'insitu_cloro_1',
        'insitu_item_2', 'insitu_fecha_2', 'insitu_hora_2', 'insitu_ph_2', 'insitu_temp_2', 'insitu_cloro_2',

        // Sección 5
        'observaciones',
        'anexo_1_file', 'anexo_1_titulo',
        'anexo_2_file', 'anexo_2_titulo',
        'anexo_3_file', 'anexo_3_titulo',
        'anexo_4_file', 'anexo_4_titulo',
    ];
}
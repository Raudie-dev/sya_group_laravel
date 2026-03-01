<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class formulario1 extends Model
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

    ];

    protected $casts = [
        'inicio_muestreo' => 'datetime',
        'fin_muestreo'    => 'datetime',
        'r_f_inicio'      => 'date',
        'r_f_fin'         => 'date',
    ];

    public function registro()
    {
        return $this->belongsTo(Registro::class);
    }

/*     public static function rules()
    {
        return [
            'inspector_nombre'   => 'required|string|max:255',
            'inspector_rut'      => 'required|string|max:20',
            'lugar_muestreo'     => 'required|string|max:255',
            'direccion_muestreo' => 'required|string|max:255',
            'punto_muestreo'     => 'required|string|max:100',
            'inicio_muestreo'    => 'required|date',
            'fin_muestreo'       => 'required|date|after_or_equal:inicio_muestreo',
            'observaciones'      => 'nullable|string|max:1000',
        ];
    } */
}

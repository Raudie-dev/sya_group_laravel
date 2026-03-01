<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulario5 extends Model
{
    use HasFactory;

    protected $table = 'formulario_5'; // Cambia si tu tabla tiene otro nombre

    protected $fillable = [

        // ══ SECCIÓN 2 — Inspector y Proyecto
        'inspector_nombre',
        'inspector_rut',
        'n_rca',
        'nombre_proyecto',

        // ══ SECCIÓN 3 — Información del Muestreo
        'lugar_muestreo',
        'direccion_muestreo',
        'punto_muestreo',
        'tipo_muestra',
        'inicio_muestreo',
        'fin_muestreo',
        'eq_muestreo_cod',
        'eq_muestreo_chk',
        'eq_ph_cod',
        'eq_ph_chk',
        'eq_temp_cod',
        'eq_temp_chk',
        'eq_cloro_cod',
        'eq_cloro_chk',

        // ══ SECCIÓN 4 — Resultados In Situ
        'r_f_inicio',
        'r_h_inicio',
        'r_ph_inicio',
        'r_t_inicio',
        'r_f_fin',
        'r_h_fin',
        'r_ph_fin',
        'r_t_fin',
        'temperatura_inicial',

        // ══ SECCIÓN 5 — Observaciones y Anexos
        'observaciones',
        'anexo_1_file', 'anexo_1_titulo',
        'anexo_2_file', 'anexo_2_titulo',
        'anexo_3_file', 'anexo_3_titulo',
        'anexo_4_file', 'anexo_4_titulo',
    ];

    protected $casts = [
        // Fechas
        'fecha_emision' => 'date',
        'inicio_muestreo' => 'datetime',
        'fin_muestreo'    => 'datetime',
        'r_f_inicio'      => 'date',
        'r_f_fin'         => 'date',

        // Booleanos para checkboxes
        'eq_muestreo_chk' => 'boolean',
        'eq_ph_chk'       => 'boolean',
        'eq_temp_chk'     => 'boolean',
        'eq_cloro_chk'    => 'boolean',
    ];

    /**
     * Relación con registro (si cada formulario pertenece a un registro)
     */
    public function registro()
    {
        return $this->belongsTo(Registro::class, 'registro_id');
    }
}
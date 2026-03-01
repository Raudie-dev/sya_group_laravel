<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulario4 extends Model
{
    use HasFactory;

    // Nombre de la tabla (si no sigue la convención plural de Laravel)
    protected $table = 'formulario_4'; // cambia si tu tabla se llama diferente

    // Campos que se pueden asignar en masa
    protected $fillable = [
        'registro_id',

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
        'r_cl_inicio',
        'r_f_fin',
        'r_h_fin',
        'r_ph_fin',
        'r_t_fin',
        'r_cl_fin',
        'temperatura_inicial',

        // ══ SECCIÓN 5 — Observaciones y Anexos
        'observaciones',
        'anexo_1_file',
        'anexo_1_titulo',
        'anexo_2_file',
        'anexo_2_titulo',
    ];

    // Casts para fechas y booleanos
    protected $casts = [
        'fecha_emision' => 'date',
        'r_f_inicio'    => 'date',
        'r_f_fin'       => 'date',
        'eq_muestreo_chk' => 'boolean',
        'eq_ph_chk'       => 'boolean',
        'eq_temp_chk'     => 'boolean',
        'eq_cloro_chk'    => 'boolean',
    ];

    /**
     * Relación con Registro (si corresponde)
     */
    public function registro()
    {
        return $this->belongsTo(Registro::class, 'registro_id');
    }
}
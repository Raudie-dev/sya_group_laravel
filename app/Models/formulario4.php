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
        'inicio_muestreo',
        'fin_muestreo',

        // JSON
        'equipos_detalle',
        'mediciones_detalle',

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
        'inicio_muestreo' => 'datetime',
        'fin_muestreo'    => 'datetime',
        'eq_muestreo_chk' => 'boolean',
        'eq_ph_chk'       => 'boolean',
        'eq_temp_chk'     => 'boolean',
        'eq_cloro_chk'    => 'boolean',
        'mostrar_dj_inspector' => 'boolean',
        'mostrar_dj_etfa'      => 'boolean',
        'equipos_detalle'    => 'array',
        'mediciones_detalle' => 'array',
    ];

    /**
     * Relación con Registro (si corresponde)
     */
    public function registro()
    {
        return $this->belongsTo(Registro::class, 'registro_id');
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
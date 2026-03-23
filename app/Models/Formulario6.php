<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Formulario6 extends Model
{
    protected $table = 'formulario_6';

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
        // Equipos
        'eq_muestreo_cod', 'eq_muestreo_chk',
        'eq_ph_cod',       'eq_ph_chk',
        'eq_temp_cod',     'eq_temp_chk',
        // Sección 4 ← NUEVOS
        'estacion',
        'punto_muestreo_sec4',
        'utm_este',
        'utm_norte',
        // JSON
        'equipos_detalle',
        'mediciones_detalle',
        'resultados_detalle',  
        // Sección 6
        'observaciones',
        // Sección 8 — Anexos
        'anexo_1_file', 'anexo_1_titulo',
        'anexo_2_file', 'anexo_2_titulo',
        'anexo_3_file', 'anexo_3_titulo',
        'anexo_4_file', 'anexo_4_titulo',
        'anexo_5_file', 'anexo_5_titulo',
        'anexo_6_file', 'anexo_6_titulo',
        'anexo_7_file', 'anexo_7_titulo',
    ];

    protected $casts = [
        'equipos_detalle'    => 'array',
        'mediciones_detalle' => 'array',
        'resultados_detalle' => 'array',   
        'eq_muestreo_chk'    => 'boolean',
        'eq_ph_chk'          => 'boolean',
        'eq_temp_chk'        => 'boolean',
        'inicio_muestreo'    => 'datetime',
        'fin_muestreo'       => 'datetime',
        'mostrar_dj_inspector' => 'boolean',
        'mostrar_dj_etfa'      => 'boolean',
    ];

    public function getEquiposArrayAttribute(): array
    {
        return $this->equipos_detalle ?? [
            ['nombre' => 'Toma de Muestra: NCh411/10.Of2005.', 'codigo' => '', 'check' => '1'],
            ['nombre' => 'pH: (NCh2313/1.Of95.)',               'codigo' => '', 'check' => '1'],
            ['nombre' => 'Temperatura: (NCh2313/2.Of95.)',       'codigo' => '', 'check' => '1'],
        ];
    }

    public function getMedicionesArrayAttribute(): array
    {
        return $this->mediciones_detalle ?? [
            ['item' => 'RIL', 'fecha' => '', 'hora' => '', 'ph' => '', 'temp' => ''],
            ['item' => 'SST', 'fecha' => '', 'hora' => '', 'ph' => '', 'temp' => ''],
        ];
    }

    // ← NUEVO: accessor para Sección 7
    public function getResultadosArrayAttribute(): array
    {
        return $this->resultados_detalle ?? [
            ['item' => '', 'resultado' => ''],
        ];
    }
}
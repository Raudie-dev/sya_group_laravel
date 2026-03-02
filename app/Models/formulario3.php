<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formulario3 extends Model
{
    protected $table = 'formulario_3';

    protected $fillable = [
        'registro_id',
        // Sección 2
        'inspector_nombre', 'inspector_rut', 

        // Sección 3
        'lugar_muestreo', 'direccion_muestreo', 'punto_muestreo', 'tipo_muestra',
        // COLUMNAS JSON EN LA BD
        'equipos_detalle',
        'mediciones_detalle',
        // Sección 5
        'observaciones',
        'anexo_1_file', 'anexo_1_titulo',
        'anexo_2_file', 'anexo_2_titulo',
        'anexo_3_file', 'anexo_3_titulo',
        'anexo_4_file', 'anexo_4_titulo',
    ];

    /**
     * Laravel convierte automáticamente JSON <-> Array
     */
    protected $casts = [
        'equipos_detalle' => 'array',
        'mediciones_detalle' => 'array',
    ];

    /**
     * Accesores para la Vista:
     * Si el campo JSON está vacío (registro antiguo), devuelve un array por defecto.
     * Si tiene datos, devuelve el array casteado.
     */
    public function getEquiposArrayAttribute()
    {
        // Si ya existen datos guardados en el nuevo formato JSON
        if (!empty($this->equipos_detalle)) {
            return $this->equipos_detalle;
        }

        // Estructura por defecto para cuando el formulario está nuevo
        return [
            ['nombre' => 'Toma de Muestra: NCh411/10.Of2005.', 'codigo' => '', 'check' => '1'],
            ['nombre' => 'pH: (NCh2313/1.Of95.)', 'codigo' => '', 'check' => '1'],
            ['nombre' => 'Temperatura: (NCh2313/2.Of95.)', 'codigo' => '', 'check' => '1'],
        ];
    }

    public function getMedicionesArrayAttribute()
    {
        if (!empty($this->mediciones_detalle)) {
            return $this->mediciones_detalle;
        }

        // Estructura por defecto
        return [
             ['item' => 'RIL', 'fecha' => '', 'hora' => '', 'ph' => '', 'temp' => '', 'cloro' => ''],
             ['item' => 'SST', 'fecha' => '', 'hora' => '', 'ph' => '', 'temp' => '', 'cloro' => '']
        ];
    }
}
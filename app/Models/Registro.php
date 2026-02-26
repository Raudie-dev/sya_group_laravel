<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    protected $fillable = [
        'tipo_form_id',
        'titulo_informe',
        'codigo_informe',
        'fecha_emision',
        'empresa_nombre',
        'cliente_direccion',
        'region',
        'comuna',
        'logo_cliente',
        'nombre_proyecto',
        'n_rca'
    ];

    /*
    |--------------------------------------------------------------------------
    | MAPA DINÁMICO DE FORMULARIOS
    |--------------------------------------------------------------------------
    */
    public static $formularios = [
        1 => \App\Models\formulario1::class,
        2 => \App\Models\formulario2::class,
        // 3 => \App\Models\formulario3::class,
        // 4 => \App\Models\formulario4::class,
        // 5 => \App\Models\formulario5::class,
    ];

    /*
    |--------------------------------------------------------------------------
    | Relación dinámica
    |--------------------------------------------------------------------------
    */
    public function formulario()
    {
        $modelo = self::$formularios[$this->tipo_form_id] ?? null;

        if (!$modelo) {
            return null;
        }

        return $this->hasOne($modelo);
    }

    /*
    |--------------------------------------------------------------------------
    | Obtener modelo relacionado dinámicamente
    |--------------------------------------------------------------------------
    */
    public function getFormularioInstance()
    {
        return $this->formulario;
    }
}

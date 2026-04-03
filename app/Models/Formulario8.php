<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formulario8 extends Model
{
    protected $table = 'formulario_8';

    protected $fillable = [
        'registro_id',
        'proyecto', 'fecha', 'cadena_custodia',
        'responsable_verificacion', 'firma_verificacion_file',
        'envases_externos',
        'sonda_aplica', 'sonda_marca', 'sonda_modelo', 'sonda_serie',
        'sonda_operatividad', 'sonda_verificacion', 'sonda_lote_buffer', 'sonda_observaciones',
        'muestreador_aplica', 'muestreador_marca', 'muestreador_modelo', 'muestreador_serie',
        'muestreador_operatividad', 'muestreador_verificacion', 'muestreador_lote_buffer', 'muestreador_observaciones',
        'ph_aplica', 'ph_modelo', 'ph_serie',
        'ph_operatividad', 'ph_verificacion',
        'ph_lote_buffer_4', 'ph_lote_buffer_7', 'ph_lote_buffer_10', 'ph_observaciones',
    ];

    protected $casts = [
        'fecha'                    => 'date',
        'sonda_aplica'             => 'boolean',
        'muestreador_aplica'       => 'boolean',
        'ph_aplica'                => 'boolean',
        'envases_externos'         => 'array',
        'sonda_operatividad'       => 'array',
        'sonda_verificacion'       => 'array',
        'muestreador_operatividad' => 'array',
        'muestreador_verificacion' => 'array',
        'ph_operatividad'          => 'array',
        'ph_verificacion'          => 'array',
    ];

    public function registro()
    {
        return $this->belongsTo(Registro::class);
    }
}
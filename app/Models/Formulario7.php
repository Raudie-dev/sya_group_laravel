<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formulario7 extends Model
{
    protected $table = 'formulario_7';
    
    protected $fillable = [
        'registro_id', 
        'proyecto', 
        'fecha', 
        'participantes',
        'responsable_verificacion', 
        'responsable_aprobacion',
        'documentacion', 
        'logistica', 
        'materiales', 
        'equipos_chequeo',
        'firma_responsable_verificacion', 
        'firma_responsable_aprobacion',
    ];
    
    protected $casts = [
        'fecha'                => 'date',
        'documentacion'        => 'array',
        'logistica'            => 'array',
        'materiales'           => 'array',
        'equipos_chequeo'      => 'array',
    ];
    
    public function registro() 
    { 
        return $this->belongsTo(Registro::class); 
    }
}
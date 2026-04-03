<?php

namespace App\Services\Formularios;

class FormularioFactory
{
    public static function make($tipoFormId)
    {
        $tipoFormId = (int)$tipoFormId;
        
        return match ($tipoFormId) {

            
            1 => new FormularioGenericoService(
                \App\Models\Formulario1::class,
                'registros.pdf.formulario_1'
                ),

            2 => new Formulario2Service(),
            
            3 => new Formulario3Service(), 

            4 => new FormularioGenericoService(
                \App\Models\Formulario4::class,
                'registros.pdf.formulario_4'
            ),

            5 => new FormularioGenericoService(
                \App\Models\Formulario5::class,
                'registros.pdf.formulario_5'
            ),

            6 => new Formulario6Service(), 

            7 => new Formulario7Service(),

            8 => new Formulario8Service(),
            
            9 => new Formulario9Service(),

            default => throw new \Exception('Tipo de formulario no válido'),
        };
    }
}
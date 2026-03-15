<?php

namespace App\Services\Formularios;

class FormularioFactory
{
    public static function make($tipoFormId)
    {
        $tipoFormId = (int)$tipoFormId;
        
        return match ($tipoFormId) {

            2 => new Formulario2Service(),

            1 => new FormularioGenericoService(
                \App\Models\Formulario1::class,
                'registros.pdf.formulario_1'
            ),

            3 => new Formulario3Service(), 

            4 => new FormularioGenericoService(
                \App\Models\Formulario4::class,
                'registros.pdf.formulario_4'
            ),

            5 => new FormularioGenericoService(
                \App\Models\Formulario5::class,
                'registros.pdf.formulario_5'
            ),

            default => throw new \Exception('Tipo de formulario no válido'),
        };
    }
}
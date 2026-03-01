<?php

namespace App\Services\Formularios;

class FormularioGenericoService extends BaseFormularioService
{
    protected $modelo;
    protected $vistaPdf;

    public function __construct($modelo, $vistaPdf)
    {
        $this->modelo = $modelo;
        $this->vistaPdf = $vistaPdf;
    }

    public function vistaPdf()
    {
        return $this->vistaPdf;
    }

    public function obtenerFormulario($registro)
    {
        return $this->modelo::where('registro_id', $registro->id)->firstOrFail();
    }

    public function guardar($registro, $request)
    {
        $formulario = new $this->modelo();
        $formulario->registro_id = $registro->id;

        $this->llenarCamposComunes($formulario, $request);
        $this->guardarAnexos($formulario, $request, 'anexos_form');

        $formulario->save();
    }

    public function actualizar($registro, $request)
    {
        $formulario = $this->modelo::where('registro_id', $registro->id)->firstOrFail();

        $this->llenarCamposComunes($formulario, $request);
        $this->guardarAnexos($formulario, $request, 'anexos_form');

        $formulario->save();
    }
}
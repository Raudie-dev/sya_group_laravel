<?php

namespace App\Services\Formularios;

use Illuminate\Support\Facades\Storage;

abstract class BaseFormularioService
{
    /**
     * Todas las clases hijas deben definir el modelo
     */
    protected $modelo;

    protected function llenarCamposComunes($formulario, $request)
    {
        $formulario->fill($request->only([
            'inspector_nombre',
            'titulo_informe',
            'inspector_rut',
            'codigo_informe',
            'lugar_muestreo',
            'direccion_muestreo',
            'punto_muestreo',
            'inicio_muestreo',
            'fin_muestreo',
            'observaciones',
            'tipo_muestra',
            'temperatura_inicial',
            'r_f_inicio', 'r_h_inicio', 'r_ph_inicio', 'r_t_inicio', 'r_cl_inicio',
            'r_f_fin',    'r_h_fin',    'r_ph_fin',    'r_t_fin', 'r_cl_fin',
            'insitu_item_1', 'insitu_fecha_1', 'insitu_hora_1', 'insitu_ph_1', 'insitu_temp_1', 'insitu_cloro_1',
            'insitu_item_2', 'insitu_fecha_2', 'insitu_hora_2', 'insitu_ph_2', 'insitu_temp_2', 'insitu_cloro_2',
        ]));

        $formulario->eq_muestreo_cod = $request->eq_muestreo_cod;
        $formulario->eq_muestreo_chk = $request->boolean('eq_muestreo_chk');
        $formulario->eq_ph_cod       = $request->eq_ph_cod;
        $formulario->eq_ph_chk       = $request->boolean('eq_ph_chk');
        $formulario->eq_temp_cod     = $request->eq_temp_cod;
        $formulario->eq_temp_chk     = $request->boolean('eq_temp_chk');
        $formulario->eq_cloro_cod    = $request->eq_cloro_cod;
        $formulario->eq_cloro_chk    = $request->boolean('eq_cloro_chk');
    }

    protected function guardarAnexos($formulario, $request, $carpeta = 'anexos')
    {
        foreach (range(1, 4) as $i) {
            if ($request->hasFile('an'.$i)) {
                $path = $request->file('an'.$i)->store($carpeta, 'public');
                $formulario->{'anexo_'.$i.'_file'} = $path;
            }

            if ($request->filled('an'.$i.'_titulo')) {
                $formulario->{'anexo_'.$i.'_titulo'} = $request->input('an'.$i.'_titulo');
            }
        }
    }

    public function obtenerFormulario($registro)
    {
        return $this->modelo::where('registro_id', $registro->id)
            ->firstOrFail();
    }

    abstract public function guardar($registro, $request);
    abstract public function actualizar($registro, $request);
    abstract public function vistaPdf();
}
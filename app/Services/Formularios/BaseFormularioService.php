<?php

namespace App\Services\Formularios;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;

abstract class BaseFormularioService
{
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
            'r_f_fin',    'r_h_fin',    'r_ph_fin',    'r_t_fin',    'r_cl_fin',
            'insitu_item_1', 'insitu_fecha_1', 'insitu_hora_1', 'insitu_ph_1', 'insitu_temp_1', 'insitu_cloro_1',
            'insitu_item_2', 'insitu_fecha_2', 'insitu_hora_2', 'insitu_ph_2', 'insitu_temp_2', 'insitu_cloro_2',
        ]));

        $formulario->eq_muestreo_cod        = $request->eq_muestreo_cod;
        $formulario->eq_muestreo_chk        = $request->boolean('eq_muestreo_chk');
        $formulario->eq_ph_cod              = $request->eq_ph_cod;
        $formulario->eq_ph_chk              = $request->boolean('eq_ph_chk');
        $formulario->eq_temp_cod            = $request->eq_temp_cod;
        $formulario->eq_temp_chk            = $request->boolean('eq_temp_chk');
        $formulario->eq_cloro_cod           = $request->eq_cloro_cod;
        $formulario->eq_cloro_chk           = $request->boolean('eq_cloro_chk');
        $formulario->mostrar_dj_inspector   = $request->boolean('mostrar_dj_inspector');
        $formulario->mostrar_dj_etfa        = $request->boolean('mostrar_dj_etfa');
    }

    protected function guardarAnexos($formulario, $request, $carpeta = 'anexos_form')
    {
        foreach (range(1, 4) as $i) {
            if ($request->hasFile('an'.$i)) {
                $path = $this->guardarImagenVertical(
                    $request->file('an'.$i),
                    $carpeta
                );
                $formulario->{'anexo_'.$i.'_file'} = $path;
            }

            if ($request->filled('an'.$i.'_titulo')) {
                $formulario->{'anexo_'.$i.'_titulo'} = $request->input('an'.$i.'_titulo');
            }
        }
    }

    /**
     * 
     * Guarda la imagen corrigiendo orientación EXIF.
     */
    protected function guardarImagenVertical($file, string $carpeta): string
    {
        $manager = new ImageManager(new Driver());
        $image   = $manager->read($file->getRealPath());

        $image->orient();

        // Si es más ancho que alto = horizontal, déjalo así
        // Si es más alto que ancho = vertical, déjalo así
        // (sin hacer nada, mantiene la orientación natural)

        $filename = $carpeta . '/' . Str::random(40) . '.jpg';
        $fullPath = storage_path('app/public/' . $filename);

        if (!is_dir(dirname($fullPath))) {
            mkdir(dirname($fullPath), 0755, true);
        }

        $image->toJpeg(85)->save($fullPath);

        return $filename;
    }

    public function obtenerFormulario($registro)
    {
        return $this->modelo::where('registro_id', $registro->id)
            ->firstOrFail();
    }

    abstract public function guardar($registro, $request);
    abstract public function actualizar($registro, $request);
    abstract public function vistaPdf();

    protected function llenarFlagsPdf($formulario, $request): void
    {
        $formulario->mostrar_dj_inspector = $request->boolean('mostrar_dj_inspector');
        $formulario->mostrar_dj_etfa      = $request->boolean('mostrar_dj_etfa');
    }
    
    protected function guardarTablasDinamicas($formulario, $request): void
    {
        $formulario->equipos_detalle = collect($request->input('equipos', []))
            ->filter(fn($r) => !empty($r['label']))
            ->values()
            ->toArray();

        $cols = collect($request->input('mediciones_cols', []))
            ->filter(fn($c) => !empty($c['key']))
            ->map(fn($c) => [
                'id'        => $c['id'],
                'label'     => $c['label'],
                'type'      => $c['type'],
                'key'       => $c['key'],
                'deletable' => filter_var($c['deletable'], FILTER_VALIDATE_BOOLEAN),
                'editable'  => filter_var($c['editable'],  FILTER_VALIDATE_BOOLEAN),
            ])
            ->values()
            ->toArray();

        $rows = collect($request->input('mediciones', []))
            ->filter(fn($r) => !empty($r['item']))
            ->map(fn($row) => [
                'item'   => $row['item'],
                'values' => collect($row)->except('item')->toArray(),
            ])
            ->values()
            ->toArray();

        $formulario->mediciones_detalle = [
            'cols' => $cols,
            'rows' => $rows,
        ];
    }

    protected function resolverFechaMuestra($formulario): ?\Carbon\Carbon
{
    if ($formulario->inicio_muestreo) {
        return $formulario->inicio_muestreo;
    }

    if ($formulario->registro?->fecha_emision) {
        return \Carbon\Carbon::parse($formulario->registro->fecha_emision);
    }

    return null;
}
}
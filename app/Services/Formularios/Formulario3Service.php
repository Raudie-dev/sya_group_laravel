<?php

namespace App\Services\Formularios;

use App\Models\Formulario3;
use App\Models\Registro;
use Illuminate\Http\Request;

class Formulario3Service extends BaseFormularioService
{
    protected $modelo = Formulario3::class;

    public function guardar($registro, $request)
    {
        return $this->procesarGuardado($registro, $request);
    }

    public function actualizar($registro, $request)
    {
        return $this->procesarGuardado($registro, $request);
    }

    private function procesarGuardado(Registro $registro, Request $request)
    {
        // Excluir todo lo que se maneja manualmente
        $data = $request->except([
            '_token', '_method',
            'equipos', 'mediciones','mediciones_cols', 'files',
            'an1', 'an2', 'an3', 'an4',
            'an1_titulo', 'an2_titulo', 'an3_titulo', 'an4_titulo',
            'anexo_1_file', 'anexo_2_file', 'anexo_3_file', 'anexo_4_file', // ← por si llegan
        ]);

        $data['registro_id'] = $registro->id;

        // JSON — se asignan separado para que los casts del modelo los serialicen bien
        $data['equipos_detalle'] = collect($request->input('equipos', []))
            ->filter(fn($r) => !empty($r['label']))
            ->values()
            ->toArray();

        // Cols: normalizar booleanos que vienen como '1'/'0'
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

        // Rows: aplanar a { item, values: {...} }
        $rows = collect($request->input('mediciones', []))
            ->filter(fn($r) => !empty($r['item']))
            ->map(fn($row) => [
                'item'   => $row['item'],
                'values' => collect($row)->except('item')->toArray(),
            ])
            ->values()
            ->toArray();

        $data['mediciones_detalle'] = [
            'cols' => $cols,
            'rows' => $rows,
        ];

        $formulario = Formulario3::firstOrNew(['registro_id' => $registro->id]);
        $formulario->fill($data);

        // Anexos con corrección de orientación
        $this->guardarAnexos($formulario, $request, 'anexos/Formulario3');

        // Flags para mostrar/ocultar páginas de declaración jurada en el PDF
        $this->llenarFlagsPdf($formulario, $request);

        $formulario->save();

        return $formulario;
    }

    public function obtenerFormulario($registro)
    {
        return Formulario3::where('registro_id', $registro->id)->first();
    }

    public function vistaPdf()
    {
        return 'registros.pdf.formulario_3';
    }

    public function datosParaPdf($formulario)
    {
        return [];
    }
}
<?php

namespace App\Services\Formularios;

use App\Models\Formulario6;
use App\Models\Registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Formulario6Service extends BaseFormularioService
{
    protected $modelo = Formulario6::class;

    public function guardar($registro, $request)
    {
        return $this->procesarGuardado($registro, $request);
    }

    public function actualizar($registro, $request)
    {
        return $this->procesarGuardado($registro, $request);
    }

    private function procesarGuardado(Registro $registro, Request $request): Formulario6
    {
        $data = $request->except([
            '_token', '_method',
            // Arrays/archivos manejados manualmente
            'mediciones', 'mediciones_cols', 'resultados',
            'anexo_1', 'anexo_2', 'anexo_3', 'anexo_4',
            'anexo_5', 'anexo_6', 'anexo_7',
            // Sección 1 → van al modelo Registro
            'titulo_informe', 'codigo', 'fecha_emision',
            'cliente_nombre', 'region', 'comuna',
            'cliente_direccion', 'logo_cliente',
            'n_rca', 'nombre_proyecto', 'equipos', 
        ]);

        $data['registro_id'] = $registro->id;

        // ── equipos_detalle ──────────────────────────────────────────────
        $data['equipos_detalle'] = collect($request->input('equipos', []))
            ->filter(fn($r) => !empty($r['label']))
            ->map(fn($r) => [
                'label'   => $r['label'],
                'eq_val'  => $r['eq_val']  ?? '',
                'chk_val' => filter_var($r['chk_val'] ?? false, FILTER_VALIDATE_BOOLEAN),
            ])
            ->values()
            ->toArray();

        // ── mediciones_detalle ──────────────────────────────────────────────
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

        // ── resultados_detalle ──────────────────────────────────────────────
        $data['resultados_detalle'] = $request->has('resultados')
            ? array_values($request->input('resultados'))
            : [];

        // ── Persistir formulario ────────────────────────────────────────────
        $formulario = Formulario6::firstOrNew(['registro_id' => $registro->id]);
        $formulario->fill($data);

        // ── Anexos 1–7 (explícito, no depende de guardarAnexos base) ────────
        foreach (range(1, 7) as $n) {
            $campo = "anexo_{$n}";
            if ($request->hasFile($campo)) {
                // Eliminar archivo anterior si existe
                $campoFile = "anexo_{$n}_file";
                if (!empty($formulario->$campoFile)) {
                    Storage::disk('public')->delete($formulario->$campoFile);
                }

                $path = $request->file($campo)
                    ->store('anexos/Formulario6', 'public');

                $formulario->{"anexo_{$n}_file"} = $path;
            }
        }

        // Flags para mostrar/ocultar páginas de declaración jurada en el PDF 
        $this->llenarFlagsPdf($formulario, $request);

        $formulario->save();

        // ── Actualizar campos del modelo Registro (Sección 1) ───────────────
        $this->actualizarRegistro($registro, $request);

        return $formulario;
    }

    private function actualizarRegistro(Registro $registro, Request $request): void
    {
        $campos = $request->only([
            'titulo_informe', 'fecha_emision',
            'region', 'comuna', 'cliente_direccion',
            'n_rca', 'nombre_proyecto',
        ]);

        // Mapeos donde el name del input difiere del campo en BD
        if ($request->filled('codigo')) {
            $campos['codigo_informe'] = $request->input('codigo');
        }
        if ($request->filled('cliente_nombre')) {
            $campos['empresa_nombre'] = $request->input('cliente_nombre');
        }
        if ($request->hasFile('logo_cliente')) {
            if (!empty($registro->logo_cliente)) {
                Storage::disk('public')->delete($registro->logo_cliente);
            }
            $campos['logo_cliente'] = $request->file('logo_cliente')
                ->store('logos', 'public');
        }

        $registro->fill($campos)->save();
    }

    public function obtenerFormulario($registro): ?Formulario6
    {
        return Formulario6::where('registro_id', $registro->id)->first();
    }

    public function vistaPdf(): string
    {
        return 'registros.pdf.formulario_6';
    }

    public function datosParaPdf($formulario): array
    {
        return [];
    }
}
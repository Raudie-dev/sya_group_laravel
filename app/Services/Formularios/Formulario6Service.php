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
            'mediciones', 'resultados',
            'anexo_1', 'anexo_2', 'anexo_3', 'anexo_4',
            'anexo_5', 'anexo_6', 'anexo_7',
            // Sección 1 → van al modelo Registro
            'titulo_informe', 'codigo', 'fecha_emision',
            'cliente_nombre', 'region', 'comuna',
            'cliente_direccion', 'logo_cliente',
            'n_rca', 'nombre_proyecto',
        ]);

        $data['registro_id'] = $registro->id;

        // ── Checkboxes (si no vienen en POST = false) ──────────────────────
        foreach (['eq_muestreo_chk', 'eq_ph_chk', 'eq_temp_chk'] as $chk) {
            $data[$chk] = $request->boolean($chk);
        }

        // ── equipos_detalle: construir desde campos individuales ────────────
        // La vista envía eq_muestreo_cod, eq_ph_cod, eq_temp_cod — no un array
        $data['equipos_detalle'] = [
            [
                'nombre' => 'Toma de Muestra: NCh411/10.Of2005.',
                'codigo' => $request->input('eq_muestreo_cod', ''),
                'check'  => $request->boolean('eq_muestreo_chk'),
            ],
            [
                'nombre' => 'pH: (NCh2313/1.Of95.)',
                'codigo' => $request->input('eq_ph_cod', ''),
                'check'  => $request->boolean('eq_ph_chk'),
            ],
            [
                'nombre' => 'Temperatura: (NCh2313/2.Of95.)',
                'codigo' => $request->input('eq_temp_cod', ''),
                'check'  => $request->boolean('eq_temp_chk'),
            ],
        ];

        // ── mediciones_detalle ──────────────────────────────────────────────
        $data['mediciones_detalle'] = $request->has('mediciones')
            ? array_values($request->input('mediciones'))
            : [];

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
<?php

namespace App\Services\Formularios;

use App\Models\Formulario2;
use App\Models\Formulario2Lectura;
use Illuminate\Support\Facades\Storage;

class Formulario2Service extends BaseFormularioService
{
    protected $modelo = Formulario2::class;

    public function vistaPdf()
    {
        return 'registros.pdf.formulario_2';
    }

    public function obtenerFormulario($registro)
    {
        return $this->modelo::where('registro_id', $registro->id)
        ->with('lecturas')          // esto es lo que faltaba
        ->firstOrFail();
    }

    public function guardar($registro, $request)
    {
        // ── Campos del modelo Registro ──────────────────────────────────────
        $registro->fill([
            'titulo_informe'    => $request->titulo_informe,
            'codigo_informe'    => $request->codigo,
            'fecha_emision'     => $request->fecha_emision ?: null,
            'empresa_nombre'    => $request->cliente_nombre,
            'region'            => $request->region,
            'comuna'            => $request->comuna,
            'cliente_direccion' => $request->cliente_direccion,
        ]);

        if ($request->hasFile('logo_cliente')) {
            $registro->logo_cliente = $request->file('logo_cliente')
                ->store('logos_clientes', 'public');
        }

        $registro->save();

        // ── Campos del modelo Formulario2 ───────────────────────────────────
        $formulario = new Formulario2();
        $formulario->registro_id = $registro->id;
        $this->llenarCamposFormulario($formulario, $request);
        $formulario->save();

        // ── Lecturas ────────────────────────────────────────────────────────
        $this->sincronizarLecturas($formulario, $request);
    }

    public function actualizar($registro, $request)
    {
        // ── Campos del modelo Registro ──────────────────────────────────────
        $registro->fill([
            'titulo_informe'    => $request->titulo_informe,
            'codigo_informe'    => $request->codigo,
            'fecha_emision'     => $request->fecha_emision ?: null,
            'empresa_nombre'    => $request->cliente_nombre,
            'region'            => $request->region,
            'comuna'            => $request->comuna,
            'cliente_direccion' => $request->cliente_direccion,
        ]);

        if ($request->hasFile('logo_cliente')) {
            // Eliminar logo anterior si existe
            if ($registro->logo_cliente) {
                Storage::disk('public')->delete($registro->logo_cliente);
            }
            $registro->logo_cliente = $request->file('logo_cliente')
                ->store('logos_clientes', 'public');
        }

        $registro->save();

        // ── Campos del modelo Formulario2 ───────────────────────────────────
        $formulario = Formulario2::where('registro_id', $registro->id)->firstOrFail();
        $this->llenarCamposFormulario($formulario, $request);
        $formulario->save();

        // ── Lecturas (eliminar las anteriores y recrear) ────────────────────
        $formulario->lecturas()->delete();
        $this->sincronizarLecturas($formulario, $request);
    }

    // ────────────────────────────────────────────────────────────────────────
    // Helpers privados
    // ────────────────────────────────────────────────────────────────────────

    /**
     * Rellena todos los campos propios de Formulario2.
     */
    private function llenarCamposFormulario(Formulario2 $formulario, $request): void
    {
        $formulario->fill([
            // Sección 2 — Inspector y Proyecto
            'inspector_nombre' => $request->inspector_nombre,
            'inspector_rut'    => $request->inspector_rut,
            'n_rca'            => $request->n_rca,
            'nombre_proyecto'  => $request->nombre_proyecto,

            // Sección 3 — Muestreo
            'lugar_muestreo'      => $request->lugar_muestreo,
            'direccion_muestreo'  => $request->direccion_muestreo,
            'punto_muestreo'      => $request->punto_muestreo,
            'tipo_muestra'        => $request->tipo_muestra,
            'inicio_muestreo'     => $request->inicio_muestreo ?: null,
            'fin_muestreo'        => $request->fin_muestreo    ?: null,

            // Equipos
            'eq_muestreo_cod' => $request->eq_muestreo_cod,
            'eq_muestreo_chk' => $request->boolean('eq_muestreo_chk'),
            'eq_ph_cod'       => $request->eq_ph_cod,
            'eq_ph_chk'       => $request->boolean('eq_ph_chk'),
            'eq_temp_cod'     => $request->eq_temp_cod,
            'eq_temp_chk'     => $request->boolean('eq_temp_chk'),

            // Sección 4
            'temp_termino' => $request->temp_termino ?: null,

            // Sección 5 — Observaciones
            'observaciones' => $request->observaciones,

            // Títulos de anexos
            'anexo_1_titulo' => $request->an1_titulo,
            'anexo_2_titulo' => $request->an2_titulo,
            'anexo_3_titulo' => $request->an3_titulo,
            'anexo_4_titulo' => $request->an4_titulo,
        ]);

        // Archivos de anexos
        foreach ([1 => 'an1', 2 => 'an2', 3 => 'an3', 4 => 'an4'] as $n => $inputName) {
            $fileField = "anexo_{$n}_file";
            if ($request->hasFile($inputName)) {
                // Eliminar archivo anterior si existe
                if ($formulario->$fileField) {
                    Storage::disk('public')->delete($formulario->$fileField);
                }
                $formulario->$fileField = $request->file($inputName)
                    ->store("anexos/formulario2", 'public');
            }
        }
    }

    /**
     * Crea las filas de lectura a partir de los arrays del request.
     */
    private function sincronizarLecturas(Formulario2 $formulario, $request): void
    {
        $fechas = $request->input('lectura_fecha', []);
        $horas  = $request->input('lectura_hora',  []);
        $ns     = $request->input('lectura_n',     []);
        $phs    = $request->input('lectura_ph',    []);
        $temps  = $request->input('lectura_temp',  []);

        $total = count($fechas);

        for ($i = 0; $i < $total; $i++) {
            // Omitir filas completamente vacías
            $fecha = $fechas[$i] ?? null;
            $hora  = $horas[$i]  ?? null;
            $ph    = $phs[$i]    ?? null;
            $temp  = $temps[$i]  ?? null;

            if (!$fecha && !$hora && $ph === null && $temp === null) {
                continue;
            }

            Formulario2Lectura::create([
                'formulario2_id' => $formulario->id,
                'fecha'          => $fecha    ?: null,
                'hora'           => $hora     ? "1970-01-01 {$hora}:00" : null,
                'n_muestra'      => $ns[$i]   ?? null,
                'valor_ph'       => $ph       !== '' ? $ph   : null,
                'valor_temp'     => $temp     !== '' ? $temp : null,
            ]);
        }
    }
}
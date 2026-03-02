<?php

namespace App\Services\Formularios;

use App\Models\formulario2;
use App\Models\Formulario2Lectura;
use Illuminate\Support\Facades\Storage;

class Formulario2Service extends BaseFormularioService
{
    protected $modelo = formulario2::class;

    public function vistaPdf()
    {
        return 'registros.pdf.formulario_2';
    }

    public function obtenerFormulario($registro)
    {
        return $this->modelo::where('registro_id', $registro->id)
            ->with(['lecturas' => fn($q) => $q->orderBy('fecha')->orderBy('hora')])
            ->firstOrFail();
    }

    /**
     * Devuelve todas las variables extra que necesita la vista PDF:
     *   - $stats       → array con media/mínima/máxima de ph y temp
     *   - $graficoPh   → URL de imagen QuickChart (o null)
     *   - $graficoTemp → URL de imagen QuickChart (o null)
     *
     * Uso en el controlador:
     *   $formulario = $service->obtenerFormulario($registro);
     *   $extras     = $service->datosParaPdf($formulario);
     *   $pdf = Pdf::loadView($service->vistaPdf(), array_merge(
     *       compact('registro', 'formulario'),
     *       $extras
     *   ));
     */
    public function datosParaPdf(formulario2 $formulario): array
    {
        $lecturas = $formulario->lecturas;

        $phs    = $lecturas->pluck('valor_ph')->filter()->map(fn($v)  => (float)$v)->values();
        $temps  = $lecturas->pluck('valor_temp')->filter()->map(fn($v) => (float)$v)->values();
        $labels = $lecturas->map(fn($l, $i) => $l->n_muestra ?? ($i + 1))->values()->all();

        // ── Estadísticas ─────────────────────────────────────────────────────
        $stats = [
            'ph' => [
                'media'  => $phs->count()   ? round($phs->avg(),   2) : null,
                'minima' => $phs->count()   ? round($phs->min(),   2) : null,
                'maxima' => $phs->count()   ? round($phs->max(),   2) : null,
            ],
            'temp' => [
                'media'  => $temps->count() ? round($temps->avg(),  2) : null,
                'minima' => $temps->count() ? round($temps->min(),  2) : null,
                'maxima' => $temps->count() ? round($temps->max(),  2) : null,
            ],
        ];

        // ── URLs de gráficos (QuickChart) ────────────────────────────────────
        $graficoPh = $phs->count() >= 2
            ? $this->buildChartUrl($phs->all(), $labels, '#3b82f6', 'pH')
            : null;

        $graficoTemp = $temps->count() >= 2
            ? $this->buildChartUrl($temps->all(), $labels, '#f97316', 'Temperatura °C')
            : null;

        return compact('stats', 'graficoPh', 'graficoTemp');
    }

    // ────────────────────────────────────────────────────────────────────────
    // Helpers privados
    // ────────────────────────────────────────────────────────────────────────

    private function buildChartUrl(array $datos, array $labels, string $color, string $label): ?string
    {
        $config = [
            'type' => 'line',
            'data' => [
                'labels'   => $labels,
                'datasets' => [[
                    'label'                => $label,
                    'data'                 => $datos,
                    'borderColor'          => $color,
                    'backgroundColor'      => $color . '33',
                    'borderWidth'          => 2,
                    'pointRadius'          => 4,
                    'pointBackgroundColor' => $color,
                    'fill'                 => true,
                    'tension'              => 0.3,
                ]],
            ],
            'options' => [
                'plugins' => [
                    'legend'     => ['display' => false],
                    'datalabels' => [
                        'display' => true,
                        'align'   => 'top',
                        'font'    => ['size' => 11],
                    ],
                ],
                'scales' => [
                    'y' => ['ticks' => ['font' => ['size' => 11]]],
                    'x' => ['ticks' => ['font' => ['size' => 11]]],
                ],
            ],
        ];

        $url = 'https://quickchart.io/chart?w=700&h=250&c=' . urlencode(json_encode($config));

        try {
            $imageData = \Illuminate\Support\Facades\Http::get($url)->body();

            if (!$imageData) {
                return null;
            }

            return 'data:image/png;base64,' . base64_encode($imageData);

        } catch (\Exception $e) {
            return null;
        }
    }

    private function llenarCamposFormulario(formulario2 $formulario, $request): void
    {
        $formulario->fill([
            'inspector_nombre'   => $request->inspector_nombre,
            'inspector_rut'      => $request->inspector_rut,
            'n_rca'              => $request->n_rca,
            'nombre_proyecto'    => $request->nombre_proyecto,
            'lugar_muestreo'     => $request->lugar_muestreo,
            'direccion_muestreo' => $request->direccion_muestreo,
            'punto_muestreo'     => $request->punto_muestreo,
            'tipo_muestra'       => $request->tipo_muestra,
            'inicio_muestreo'    => $request->inicio_muestreo ?: null,
            'fin_muestreo'       => $request->fin_muestreo    ?: null,
            'eq_muestreo_cod'    => $request->eq_muestreo_cod,
            'eq_muestreo_chk'    => $request->boolean('eq_muestreo_chk'),
            'eq_ph_cod'          => $request->eq_ph_cod,
            'eq_ph_chk'          => $request->boolean('eq_ph_chk'),
            'eq_temp_cod'        => $request->eq_temp_cod,
            'eq_temp_chk'        => $request->boolean('eq_temp_chk'),
            'temp_termino'       => $request->temp_termino ?: null,
            'observaciones'      => $request->observaciones,
            'anexo_1_titulo'     => $request->an1_titulo,
            'anexo_2_titulo'     => $request->an2_titulo,
            'anexo_3_titulo'     => $request->an3_titulo,
            'anexo_4_titulo'     => $request->an4_titulo,
        ]);

        foreach ([1 => 'an1', 2 => 'an2', 3 => 'an3', 4 => 'an4'] as $n => $inputName) {
            $fileField = "anexo_{$n}_file";
            if ($request->hasFile($inputName)) {
                if ($formulario->$fileField) {
                    Storage::disk('public')->delete($formulario->$fileField);
                }
                $formulario->$fileField = $request->file($inputName)
                    ->store("anexos/formulario2", 'public');
            }
        }
    }

    private function sincronizarLecturas(formulario2 $formulario, $request): void
    {
        $fechas = $request->input('lectura_fecha', []);
        $horas  = $request->input('lectura_hora',  []);
        $ns     = $request->input('lectura_n',     []);
        $phs    = $request->input('lectura_ph',    []);
        $temps  = $request->input('lectura_temp',  []);

        for ($i = 0, $total = count($fechas); $i < $total; $i++) {
            $fecha = $fechas[$i] ?? null;
            $hora  = $horas[$i]  ?? null;
            $ph    = $phs[$i]    ?? null;
            $temp  = $temps[$i]  ?? null;

            if (!$fecha && !$hora && $ph === null && $temp === null) {
                continue;
            }

            Formulario2Lectura::create([
                'formulario2_id' => $formulario->id,
                'fecha'          => $fecha ?: null,
                'hora'           => $hora  ? "1970-01-01 {$hora}:00" : null,
                'n_muestra'      => $ns[$i] ?? null,
                'valor_ph'       => $ph    !== '' ? $ph   : null,
                'valor_temp'     => $temp  !== '' ? $temp : null,
            ]);
        }
    }

    public function guardar($registro, $request): void
    {
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

        $formulario = new formulario2();
        $formulario->registro_id = $registro->id;
        $this->llenarCamposFormulario($formulario, $request);
        $formulario->save();

        $this->sincronizarLecturas($formulario, $request);
    }

    public function actualizar($registro, $request): void
    {
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
            if ($registro->logo_cliente) {
                Storage::disk('public')->delete($registro->logo_cliente);
            }
            $registro->logo_cliente = $request->file('logo_cliente')
                ->store('logos_clientes', 'public');
        }
        $registro->save();

        $formulario = formulario2::where('registro_id', $registro->id)->firstOrFail();
        $this->llenarCamposFormulario($formulario, $request);
        $formulario->save();

        $formulario->lecturas()->delete();
        $this->sincronizarLecturas($formulario, $request);
    }
}
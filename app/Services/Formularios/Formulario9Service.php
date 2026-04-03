<?php
namespace App\Services\Formularios;

use App\Models\Formulario9;

class Formulario9Service extends BaseFormularioService
{
    protected $modelo = Formulario9::class;

    public function vistaPdf(): string
    {
        return 'registros.pdf.formulario_9';
    }

    public function guardar($registro, $request): void
    {
        $f = new Formulario9(['registro_id' => $registro->id]);
        $this->fill($f, $request);
        $f->save();
    }

    public function actualizar($registro, $request): void
    {
        $f = Formulario9::where('registro_id', $registro->id)->firstOrFail();
        $this->fill($f, $request);
        $f->save();
    }

    private function fill(Formulario9 $f, $request): void
    {
        $f->frecuencia_control = $request->input('frecuencia_control');
        $f->equipo_codigo      = $request->input('equipo_codigo');

        // Normalizar filas — filtrar vacías
        $filas = collect($request->input('registros', []))
            ->filter(fn($r) => !empty($r['fecha']) || !empty($r['responsable']) || !empty($r['conc_estandar']))
            ->map(fn($r) => [
                'fecha'          => $r['fecha']          ?? '',
                'responsable'    => $r['responsable']    ?? '',
                'conc_estandar'  => $r['conc_estandar']  ?? '',
                'aprobado'       => !empty($r['aprobado']),
                'rechazado'      => !empty($r['rechazado']),
                'estado_celdas'  => $r['estado_celdas']  ?? '',
                'estado_equipo'  => $r['estado_equipo']  ?? '',
                'observaciones'  => $r['observaciones']  ?? '',
            ])
            ->values()
            ->toArray();

        $f->registros = $filas;
    }
}
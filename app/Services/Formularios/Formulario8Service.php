<?php
namespace App\Services\Formularios;

use App\Models\Formulario8;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;

class Formulario8Service extends BaseFormularioService
{
    protected $modelo = Formulario8::class;

    public function vistaPdf(): string
    {
        return 'registros.pdf.formulario_8';
    }

    public function guardar($registro, $request): void
    {
        $f = new Formulario8(['registro_id' => $registro->id]);
        $this->fill($f, $request);
        $f->save();
    }

    public function actualizar($registro, $request): void
    {
        $f = Formulario8::where('registro_id', $registro->id)->firstOrFail();
        $this->fill($f, $request);
        $f->save();
    }

    private function fill(Formulario8 $f, $request): void
    {
        $f->fill($request->only([
            'proyecto', 'fecha', 'cadena_custodia', 'responsable_verificacion',
            'sonda_marca', 'sonda_modelo', 'sonda_serie', 'sonda_lote_buffer', 'sonda_observaciones',
            'muestreador_marca', 'muestreador_modelo', 'muestreador_serie', 'muestreador_lote_buffer', 'muestreador_observaciones',
            'ph_modelo', 'ph_serie', 'ph_lote_buffer_4', 'ph_lote_buffer_7', 'ph_lote_buffer_10', 'ph_observaciones',
        ]));

        $f->sonda_aplica       = $request->boolean('sonda_aplica');
        $f->muestreador_aplica = $request->boolean('muestreador_aplica');
        $f->ph_aplica          = $request->boolean('ph_aplica');

        // JSONs
        $f->envases_externos         = $request->input('envases_externos', []);
        $f->sonda_operatividad       = $request->input('sonda_operatividad', []);
        $f->sonda_verificacion       = $request->input('sonda_verificacion', []);
        $f->muestreador_operatividad = $request->input('muestreador_operatividad', []);
        $f->muestreador_verificacion = $request->input('muestreador_verificacion', []);
        $f->ph_operatividad          = $request->input('ph_operatividad', []);
        $f->ph_verificacion          = $request->input('ph_verificacion', []);

        // Firma
        if ($request->hasFile('firma_verificacion')) {
            if ($f->firma_verificacion_file) {
                Storage::disk('public')->delete($f->firma_verificacion_file);
            }
            $f->firma_verificacion_file = $this->guardarImagenVertical(
                $request->file('firma_verificacion'), 'firmas_form8'
            );
        }
    }
}
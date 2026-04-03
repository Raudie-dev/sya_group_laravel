<?php

namespace App\Services\Formularios;

use App\Models\Formulario6;
use App\Models\Registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Formulario7Service extends BaseFormularioService
{
    protected $modelo = \App\Models\Formulario7::class;
    public function vistaPdf() { return 'registros.pdf.formulario_7'; }

    public function guardar($registro, $request)
    {
        $f = new \App\Models\Formulario7(['registro_id' => $registro->id]);
        $this->fill($f, $request);
        $f->save();
    }
    
    public function actualizar($registro, $request)
    {
        $f = \App\Models\Formulario7::where('registro_id', $registro->id)->firstOrFail();
        
        // Eliminar imágenes antiguas si se suben nuevas
        if ($request->hasFile('firma_responsable_verificacion')) {
            if ($f->firma_responsable_verificacion && Storage::disk('public')->exists($f->firma_responsable_verificacion)) {
                Storage::disk('public')->delete($f->firma_responsable_verificacion);
            }
        }
        
        if ($request->hasFile('firma_responsable_aprobacion')) {
            if ($f->firma_responsable_aprobacion && Storage::disk('public')->exists($f->firma_responsable_aprobacion)) {
                Storage::disk('public')->delete($f->firma_responsable_aprobacion);
            }
        }
        
        $this->fill($f, $request);
        $f->save();
    }
    
    private function fill($f, $request)
    {
        // Datos básicos
        $f->fill($request->only([
            'proyecto', 'fecha', 'participantes',
            'responsable_verificacion', 'responsable_aprobacion', 'observaciones'
        ]));
        
        //$f->mostrar_dj_inspector = $request->boolean('mostrar_dj_inspector');
        //$f->mostrar_dj_etfa      = $request->boolean('mostrar_dj_etfa');
        
        // Guardar arrays dinámicos
        $f->documentacion   = $request->input('documentacion', []);
        $f->logistica       = $request->input('logistica', []);
        $f->materiales      = $request->input('materiales', []);
        $f->equipos_chequeo = $request->input('equipos_chequeo', []);
        
        // Guardar imágenes de firmas
        if ($request->hasFile('firma_responsable_verificacion')) {
            $path = $this->guardarImagenFirma(
                $request->file('firma_responsable_verificacion'),
                'firmas_form7'
            );
            $f->firma_responsable_verificacion = $path;
        }
        
        if ($request->hasFile('firma_responsable_aprobacion')) {
            $path = $this->guardarImagenFirma(
                $request->file('firma_responsable_aprobacion'),
                'firmas_form7'
            );
            $f->firma_responsable_aprobacion = $path;
        }
        
        // Guardar otros anexos si existen
        $this->guardarAnexos($f, $request, 'anexos_form7');
    }
    
    /**
     * Guarda la imagen de firma optimizada para visualización
     */
    protected function guardarImagenFirma($file, string $carpeta): string
    {
        $manager = new \Intervention\Image\ImageManager(
            new \Intervention\Image\Drivers\Gd\Driver()
        );
        
        $image = $manager->read($file->getRealPath());
        
        // Corregir orientación automática
        $image->orient();
        
        // Redimensionar si es muy grande (máximo 800px de ancho o alto)
        $image->scaleDown(width: 800, height: 800);
        
        // Generar nombre único
        $filename = $carpeta . '/' . uniqid() . '_' . time() . '.jpg';
        $fullPath = storage_path('app/public/' . $filename);
        
        // Crear directorio si no existe
        if (!is_dir(dirname($fullPath))) {
            mkdir(dirname($fullPath), 0755, true);
        }
        
        // Guardar como JPEG con calidad 85%
        $image->toJpeg(85)->save($fullPath);
        
        return $filename;
    }
}
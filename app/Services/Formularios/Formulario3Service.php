<?php

namespace App\Services\Formularios;

use App\Models\formulario3;
use App\Models\Registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class formulario3Service
{
    /**
     * Método llamado desde RegistroController@store
     * Orden: Registro primero, Request segundo.
     */
    public function guardar(Registro $registro, Request $request)
    {
        return $this->procesarGuardado($registro, $request);
    }

    /**
     * Método llamado desde RegistroController@update
     */
    public function actualizar(Registro $registro, Request $request)
    {
        return $this->procesarGuardado($registro, $request);
    }

    /**
     * Lógica centralizada para guardar o actualizar
     */
    private function procesarGuardado(Registro $registro, Request $request)
    {
        // 1. Limpiar datos básicos
        $data = $request->except(['_token', '_method', 'equipos', 'mediciones', 'files']);

        // 2. Asignar el ID del registro padre
        $data['registro_id'] = $registro->id;

        // 3. LOGICA CAMPOS DINÁMICOS (Arrays -> JSON)
        // Usamos array_values para reindexar y evitar JSON sucios con índices raros.
        $data['equipos_detalle'] = $request->has('equipos') 
            ? array_values($request->input('equipos')) 
            : [];

        $data['mediciones_detalle'] = $request->has('mediciones') 
            ? array_values($request->input('mediciones')) 
            : [];

        // 4. LOGICA DE ARCHIVOS (Anexos)
        $archivos = [
            'anexo_1_file'  => 'anexos',
            'anexo_2_file'  => 'anexos',
            'anexo_3_file'  => 'anexos',
            'anexo_4_file'  => 'anexos',
            // Nota: El logo_cliente ya lo guardas en el Controller en la tabla registros,
            // pero si también lo necesitas en formulario_3, descomenta esto:
            // 'logo_cliente'  => 'logos', 
        ];

        foreach ($archivos as $inputName => $folder) {
            if ($request->hasFile($inputName)) {
                $data[$inputName] = $request->file($inputName)->store($folder, 'public');
            }
        }

        // 5. UPDATE OR CREATE
        // Buscamos si ya existe el formulario para este registro
        $formulario = formulario3::where('registro_id', $registro->id)->first();

        if ($formulario) {
            $formulario->update($data);
            return $formulario;
        } else {
            return formulario3::create($data);
        }
    }

    /**
     * Métodos requeridos para el PDF (según tu controlador)
     */
    
    public function obtenerFormulario(Registro $registro)
    {
        // Retorna la instancia del formulario 3 asociada al registro
        return formulario3::where('registro_id', $registro->id)->first();
    }

    public function vistaPdf()
    {
        return 'registros.pdf.formulario_3';
    }

    public function datosParaPdf($formulario)
    {
        // Si necesitas pasar variables extra a la vista del PDF, hazlo aquí
        return [
            // 'instancia' => $formulario (El controlador ya pasa 'formulario')
        ];
    }
}
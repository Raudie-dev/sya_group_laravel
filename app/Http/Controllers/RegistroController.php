<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Container\Attributes\Log;
use Illuminate\Support\Facades\Storage;
use App\Services\Formularios\FormularioFactory;
class RegistroController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $registros = Registro::latest()->paginate(10);

        return view('dashboard', compact('registros'));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */
    public function create($tipo_form_id = 1)
    {
        return view('registros.create');
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate(['tipo_form_id' => 'required|integer']);

        DB::transaction(function () use ($request) {

            // 1. Guardar Logo
            $logoPath = null;
            if ($request->hasFile('logo_cliente')) {
                $logoPath = $request->file('logo_cliente')->store('logos_clientes', 'public');
            }

            // 2. Crear Registro
            $registro = Registro::create([
                'tipo_form_id'     => $request->tipo_form_id,
                'titulo_informe'   => $request->titulo_informe,
                'codigo_informe'   => $request->codigo,
                'fecha_emision'    => $request->fecha_emision,
                'empresa_nombre'   => $request->cliente_nombre,
                'cliente_direccion'=> $request->cliente_direccion ?? '',
                'region'           => $request->region,
                'comuna'           => $request->comuna,
                'logo_cliente'     => $logoPath,
                'nombre_proyecto'  => $request->nombre_proyecto,
                'n_rca'            => $request->n_rca,
            ]);

            // 3. Delegar al Service
            $service = FormularioFactory::make($registro->tipo_form_id);
            $service->guardar($registro, $request);

        });

        return redirect()->route('registros.index')
            ->with('success', 'Registro creado correctamente');
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        $registro = Registro::with(['rilPuntual', 'ril24Horas'])->findOrFail($id);

        return view('registros.show', compact('registro'));
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $registro = Registro::findOrFail($id);

        $modeloFormulario = Registro::$formularios[$registro->tipo_form_id] ?? null;

        $instancia = null;

        if ($modeloFormulario) {
            $instancia = $modeloFormulario::where('registro_id', $registro->id)->first();
        }

        if (!$instancia) {
            abort(404, 'Formulario no encontrado.');
        }

        return view('registros.create', compact('registro', 'instancia'));
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        try {
            $registro = Registro::findOrFail($id);

            DB::transaction(function () use ($request, $registro) {

                // 1. Logo
                $logoPath = $registro->logo_cliente;

                if ($request->hasFile('logo_cliente')) {
                    if ($logoPath && Storage::disk('public')->exists($logoPath)) {
                        Storage::disk('public')->delete($logoPath);
                    }

                    $logoPath = $request->file('logo_cliente')
                        ->store('logos_clientes', 'public');
                }

                // 2. Actualizar Registro
                $registro->update([
                    'titulo_informe'    => $request->titulo_informe,
                    'codigo_informe'    => $request->codigo,
                    'fecha_emision'     => $request->fecha_emision,
                    'empresa_nombre'    => $request->cliente_nombre,
                    'cliente_direccion' => $request->cliente_direccion ?? '',
                    'region'            => $request->region,
                    'comuna'            => $request->comuna,
                    'logo_cliente'      => $logoPath,
                    'nombre_proyecto'   => $request->nombre_proyecto,
                    'n_rca'             => $request->n_rca,
                ]);

                // 3. Delegar al Service
                $service = FormularioFactory::make($registro->tipo_form_id);
                $service->actualizar($registro, $request);

            });

            return redirect()->route('registros.index')
                ->with('success', 'Registro actualizado correctamente');

        } catch (\Throwable $e) {
            return back()->with('error', 'Error al actualizar: ' . $e->getMessage());
        }
    }

    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $registro = Registro::findOrFail($id);

        DB::transaction(function () use ($registro) {

            // 1. Eliminar imágenes del formulario relacionado
            $modeloFormulario = Registro::$formularios[$registro->tipo_form_id] ?? null;
            if ($modeloFormulario) {
                $formulario = $modeloFormulario::where('registro_id', $registro->id)->first();
                if ($formulario) {
                    // Eliminar anexos
                    foreach (range(1, 4) as $i) {
                        $archivo = $formulario->{'anexo_' . $i . '_file'};
                        if ($archivo && Storage::disk('public')->exists($archivo)) {
                            Storage::disk('public')->delete($archivo);
                        }
                    }
                    $formulario->delete();
                }
            }

            // 2. Eliminar logo del registro
            if ($registro->logo_cliente && Storage::disk('public')->exists($registro->logo_cliente)) {
                Storage::disk('public')->delete($registro->logo_cliente);
            }

            // 3. Eliminar el registro
            $registro->delete();
        });

        return redirect()->route('registros.index')
            ->with('success', 'Registro eliminado correctamente');
    }
    /*
    |--------------------------------------------------------------------------
    | PDF
    |--------------------------------------------------------------------------
    */
    public function pdf($id)
    {
        $registro = Registro::findOrFail($id);

        $service = FormularioFactory::make($registro->tipo_form_id);

        $formulario = $service->obtenerFormulario($registro);

        $vista = $service->vistaPdf();

        $pdf = Pdf::loadView($vista, [
            'registro'   => $registro,
            'formulario' => $formulario,
        ])->setPaper('a4', 'portrait');

        return $pdf->stream('registro_'.$registro->id.'.pdf');
    }
}

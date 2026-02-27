<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use App\Models\formulario_1;
use App\Models\formulario_2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

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
    public function store(Request $request, $tipo_form_id = null)
    {
        // Validación mínima del tipo de formulario
        $request->validate([
            'tipo_form_id' => 'required|integer',
        ]);

        // Validación de los campos específicos según el formulario
        $modeloFormulario = Registro::$formularios[$request->tipo_form_id] ?? null;
        if ($modeloFormulario) {
            $request->validate($modeloFormulario::rules());
        }

        DB::transaction(function () use ($request, $modeloFormulario) {

            // Guardar logo del cliente si se subió
            $logoPath = null;
            if ($request->hasFile('logo_cliente')) {
                $file = $request->file('logo_cliente');
                $logoPath = $file->store('logos_clientes', 'public'); // Carpeta storage/app/public/logos_clientes
            }

            // Crear registro principal
            $registro = Registro::create([
                'tipo_form_id'     => $request->tipo_form_id,
                'titulo_informe'   => $request->titulo_informe,
                'codigo_informe'   => $request->codigo,           // mapeo
                'fecha_emision'    => $request->fecha_emision,
                'empresa_nombre'   => $request->cliente_nombre,   // mapeo
                'cliente_direccion'=> $request->cliente_direccion ?? '',
                'region'           => $request->region,
                'comuna'           => $request->comuna,
                'logo_cliente'     => $logoPath,
                'nombre_proyecto'  => $request->nombre_proyecto,
                'n_rca'            => $request->n_rca,
            ]);

            // Guardar formulario específico si existe
            if ($modeloFormulario) {
                $formulario = new $modeloFormulario();
                $formulario->fill($request->all());
                $formulario->registro_id = $registro->id;

                // Guardar anexos (1 al 4)
                foreach (range(1, 4) as $i) {
                    $fileInput = 'an'.$i;
                    $titleInput = 'an'.$i.'_titulo';

                    if ($request->hasFile($fileInput)) {
                        $file = $request->file($fileInput);
                        $path = $file->store('anexos_form1', 'public'); // Carpeta storage/app/public/anexos_form1
                        $formulario->{'anexo_'.$i.'_file'} = $path;
                    }

                    if ($request->filled($titleInput)) {
                        $formulario->{'anexo_'.$i.'_titulo'} = $request->$titleInput;
                    }
                }

                $formulario->save();
            }
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
        $registro = Registro::findOrFail($id);

        DB::transaction(function () use ($request, $registro) {

            // Guardar nuevo logo si se subió
            $logoPath = $registro->logo_cliente; // mantener el anterior por defecto
            if ($request->hasFile('logo_cliente')) {
                $file = $request->file('logo_cliente');
                $logoPath = $file->store('logos_clientes', 'public'); // Carpeta storage/app/public/logos_clientes
            }

            // Actualizar campos principales del registro
            $registro->update([
                'titulo_informe'    => $request->titulo_informe,
                'codigo_informe'    => $request->codigo_informe,
                'fecha_emision'     => $request->fecha_emision,
                'empresa_nombre'    => $request->empresa_nombre,
                'cliente_direccion' => $request->cliente_direccion ?? '',
                'region'            => $request->region,
                'comuna'            => $request->comuna,
                'logo_cliente'      => $logoPath,
                'nombre_proyecto'   => $request->nombre_proyecto,
                'n_rca'             => $request->n_rca,
            ]);

            // Actualizar formulario específico si existe
            $modeloFormulario = Registro::$formularios[$registro->tipo_form_id] ?? null;

            if ($modeloFormulario) {
                $formulario = $modeloFormulario::where('registro_id', $registro->id)->first();

                if ($formulario) {
                    $formulario->fill($request->all());

                    // Guardar anexos (1 al 4)
                    foreach (range(1, 4) as $i) {
                        $fileInput = 'an'.$i;
                        $titleInput = 'an'.$i.'_titulo';

                        if ($request->hasFile($fileInput)) {
                            $file = $request->file($fileInput);
                            $path = $file->store('anexos_form1', 'public'); // Carpeta storage/app/public/anexos_form1
                            $formulario->{'anexo_'.$i.'_file'} = $path;
                        }

                        if ($request->filled($titleInput)) {
                            $formulario->{'anexo_'.$i.'_titulo'} = $request->$titleInput;
                        }
                    }

                    $formulario->save();
                }
            }
        });

        return redirect()->route('registros.index')
            ->with('success', 'Registro actualizado correctamente');
    }

    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $registro = Registro::findOrFail($id);
        $registro->delete();

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
        $registro = Registro::with('formulario')->findOrFail($id);

        // Genera el PDF usando la vista
        $pdf = Pdf::loadView('registros.pdf', compact('registro'))
                ->setPaper('a4', 'portrait');

        // Puedes descargarlo o mostrarlo en el navegador
        return $pdf->show('registro_'.$registro->id.'.pdf');
        // return $pdf->stream('registro_'.$registro->id.'.pdf'); // para verlo en el navegador
    }
}

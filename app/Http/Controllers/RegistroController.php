<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use App\Models\formulario_1;
use App\Models\formulario_2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $request->validate([
            'tipo_form_id' => 'required|integer',
        ]);

        DB::transaction(function () use ($request) {

            $registro = Registro::create(
                $request->only([
                    'tipo_form_id',
                    'titulo_informe',
                    'codigo_informe',
                    'fecha_emision',
                    'empresa_nombre',
                    'cliente_direccion',
                    'region',
                    'comuna',
                    'logo_cliente',
                    'nombre_proyecto',
                    'n_rca'
                ])
            );

            $modeloFormulario = Registro::$formularios[$request->tipo_form_id] ?? null;

            if ($modeloFormulario) {

                $formulario = new $modeloFormulario();

                $formulario->fill($request->all());
                $formulario->registro_id = $registro->id;

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

        return view('registros.edit', compact('registro', 'instancia'));
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

            $registro->update(
                $request->only([
                    'titulo_informe',
                    'codigo_informe',
                    'fecha_emision',
                    'empresa_nombre',
                    'cliente_direccion',
                    'region',
                    'comuna',
                    'logo_cliente',
                    'nombre_proyecto',
                    'n_rca'
                ])
            );

            $modeloFormulario = Registro::$formularios[$registro->tipo_form_id] ?? null;

            if ($modeloFormulario) {

                $formulario = $modeloFormulario::where('registro_id', $registro->id)->first();

                if ($formulario) {
                    $formulario->update($request->all());
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
}

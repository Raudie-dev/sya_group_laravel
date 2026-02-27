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
    public function store(Request $request)
    {
        $request->validate(['tipo_form_id' => 'required|integer']);

        $modeloFormulario = Registro::$formularios[$request->tipo_form_id] ?? null;
        if ($modeloFormulario) {
            $request->validate($modeloFormulario::rules());
        }

        DB::transaction(function () use ($request, $modeloFormulario) {

            $logoPath = null;
            if ($request->hasFile('logo_cliente')) {
                $logoPath = $request->file('logo_cliente')->store('logos_clientes', 'public');
            }

            $registro = Registro::create([
                'tipo_form_id'     => $request->tipo_form_id,
                'titulo_informe'   => $request->titulo_informe,
                'codigo_informe'   => $request->codigo,          // form envía "codigo"
                'fecha_emision'    => $request->fecha_emision,
                'empresa_nombre'   => $request->cliente_nombre,  // form envía "cliente_nombre"
                'cliente_direccion'=> $request->cliente_direccion ?? '',
                'region'           => $request->region,
                'comuna'           => $request->comuna,
                'logo_cliente'     => $logoPath,
                'nombre_proyecto'  => $request->nombre_proyecto,
                'n_rca'            => $request->n_rca,
            ]);

            if ($modeloFormulario) {
                $formulario = new $modeloFormulario();
                $formulario->registro_id = $registro->id;

                // Campos directos (nombre en form == columna BD)
                $formulario->fill($request->only([
                    'inspector_nombre', 'inspector_rut',
                    'lugar_muestreo', 'direccion_muestreo', 'punto_muestreo',
                    'inicio_muestreo', 'fin_muestreo',
                    'observaciones',
                    'r_f_inicio', 'r_h_inicio', 'r_ph_inicio', 'r_t_inicio',
                    'r_f_fin',    'r_h_fin',    'r_ph_fin',    'r_t_fin',
                ]));

                // Equipos — mapeo manual porque los name del form difieren de la BD
                $formulario->eq_muestreo_cod = $request->eq_muestreo_cod;
                $formulario->eq_muestreo_chk = $request->boolean('eq_muestreo_chk');
                $formulario->eq_ph_cod       = $request->eq_ph_cod;
                $formulario->eq_ph_chk       = $request->boolean('eq_ph_chk');
                $formulario->eq_temp_cod     = $request->eq_temp_cod;
                $formulario->eq_temp_chk     = $request->boolean('eq_temp_chk');
                $formulario->eq_cloro_cod    = $request->eq_cloro_cod;
                $formulario->eq_cloro_chk    = $request->boolean('eq_cloro_chk');

                // Anexos
                foreach (range(1, 4) as $i) {
                    if ($request->hasFile('an'.$i)) {
                        $formulario->{'anexo_'.$i.'_file'} = $request->file('an'.$i)->store('anexos_form1', 'public');
                    }
                    if ($request->filled('an'.$i.'_titulo')) {
                        $formulario->{'anexo_'.$i.'_titulo'} = $request->input('an'.$i.'_titulo');
                    }
                }

                $formulario->save();
            }
        });

        return redirect()->route('registros.index')->with('success', 'Registro creado correctamente');
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

            $logoPath = $registro->logo_cliente;
            if ($request->hasFile('logo_cliente')) {
                $logoPath = $request->file('logo_cliente')->store('logos_clientes', 'public');
            }

            // Mismos mapeos que en store
            $registro->update([
                'titulo_informe'   => $request->titulo_informe,
                'codigo_informe'   => $request->codigo,          // form envía "codigo"
                'fecha_emision'    => $request->fecha_emision,
                'empresa_nombre'   => $request->cliente_nombre,  // form envía "cliente_nombre"
                'cliente_direccion'=> $request->cliente_direccion ?? '',
                'region'           => $request->region,
                'comuna'           => $request->comuna,
                'logo_cliente'     => $logoPath,
                'nombre_proyecto'  => $request->nombre_proyecto,
                'n_rca'            => $request->n_rca,
            ]);

            $modeloFormulario = Registro::$formularios[$registro->tipo_form_id] ?? null;

            if ($modeloFormulario) {
                $formulario = $modeloFormulario::where('registro_id', $registro->id)->firstOrFail();

                $formulario->fill($request->only([
                    'inspector_nombre', 'inspector_rut',
                    'lugar_muestreo', 'direccion_muestreo', 'punto_muestreo',
                    'inicio_muestreo', 'fin_muestreo',
                    'observaciones',
                    'r_f_inicio', 'r_h_inicio', 'r_ph_inicio', 'r_t_inicio',
                    'r_f_fin',    'r_h_fin',    'r_ph_fin',    'r_t_fin',
                ]));

                // Equipos
                $formulario->eq_muestreo_cod = $request->eq_muestreo_cod;
                $formulario->eq_muestreo_chk = $request->boolean('eq_muestreo_chk');
                $formulario->eq_ph_cod       = $request->eq_ph_cod;
                $formulario->eq_ph_chk       = $request->boolean('eq_ph_chk');
                $formulario->eq_temp_cod     = $request->eq_temp_cod;
                $formulario->eq_temp_chk     = $request->boolean('eq_temp_chk');
                $formulario->eq_cloro_cod    = $request->eq_cloro_cod;
                $formulario->eq_cloro_chk    = $request->boolean('eq_cloro_chk');

                // Anexos
                foreach (range(1, 4) as $i) {
                    if ($request->hasFile('an'.$i)) {
                        $formulario->{'anexo_'.$i.'_file'} = $request->file('an'.$i)->store('anexos_form1', 'public');
                    }
                    if ($request->filled('an'.$i.'_titulo')) {
                        $formulario->{'anexo_'.$i.'_titulo'} = $request->input('an'.$i.'_titulo');
                    }
                }

                $formulario->save();
            }
        });

        return redirect()->route('registros.index')->with('success', 'Registro actualizado correctamente');
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
        $registro = Registro::findOrFail($id);

        $modeloFormulario = Registro::$formularios[$registro->tipo_form_id] ?? null;

        if (!$modeloFormulario) {
            abort(404, 'Tipo de formulario no encontrado.');
        }

        $formulario = $modeloFormulario::where('registro_id', $registro->id)->firstOrFail();

        // Mapa de vistas PDF por tipo_form_id
        $vistaPdf = [
            1 => 'registros.pdf.formulario_1',
            2 => 'registros.pdf.formulario_2',
            // 3 => 'registros.pdf.formulario_3',
        ];

        $vista = $vistaPdf[$registro->tipo_form_id] ?? null;

        if (!$vista) {
            abort(404, 'Vista PDF no disponible para este formulario.');
        }

        $pdf = Pdf::loadView($vista, [
            'registro'   => $registro,
            'formulario' => $formulario,
        ])->setPaper('a4', 'portrait');

        //$pdf->setOptions(['enable_php' => true]);

        return $pdf->stream('registro_'.$registro->id.'.pdf');
    }
}

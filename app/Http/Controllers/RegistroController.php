<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Services\Formularios\FormularioFactory;
use Illuminate\Support\Facades\Auth;
use App\Models\Equipo;
use App\Models\ModeloEquipo;

class RegistroController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        Log::channel('daily')->info('[RegistroController@index] Iniciando listado', [
            'filtros' => $request->only(['titulo', 'codigo', 'empresa', 'proyecto', 'fecha_desde', 'fecha_hasta']),
            'per_page' => $request->query('per_page'),
            'user_id' => Auth::id(),
        ]);

        try {
            $perPage = in_array($request->query('per_page'), [10, 25, 50, 100])
                ? (int) $request->query('per_page')
                : 10;

            $query = Registro::latest();

            if ($request->filled('titulo')) {
                $query->where('titulo_informe', 'like', '%' . $request->titulo . '%');
            }
            if ($request->filled('codigo')) {
                $query->where('codigo_informe', 'like', '%' . $request->codigo . '%');
            }
            if ($request->filled('empresa')) {
                $query->where('empresa_nombre', 'like', '%' . $request->empresa . '%');
            }
            if ($request->filled('proyecto')) {
                $query->where('nombre_proyecto', 'like', '%' . $request->proyecto . '%');
            }
            if ($request->filled('fecha_desde')) {
                $query->whereDate('fecha_emision', '>=', $request->fecha_desde);
            }
            if ($request->filled('fecha_hasta')) {
                $query->whereDate('fecha_emision', '<=', $request->fecha_hasta);
            }

            $registros = $query->paginate($perPage)->appends($request->query());

            Log::channel('daily')->info('[RegistroController@index] Listado completado', [
                'total'    => $registros->total(),
                'pagina'   => $registros->currentPage(),
            ]);

            return view('dashboard', compact('registros'));

        } catch (\Throwable $e) {
            Log::channel('daily')->error('[RegistroController@index] Error al listar registros', [
                'mensaje' => $e->getMessage(),
                'archivo' => $e->getFile(),
                'linea'   => $e->getLine(),
                'trace'   => $e->getTraceAsString(),
            ]);

            return back()->with('error', 'Error al cargar los registros.');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */
    public function create($tipo_form_id = 1)
    {
        Log::channel('daily')->info('[RegistroController@create] Accediendo al formulario de creación', [
            'tipo_form_id' => $tipo_form_id,
            'user_id' => Auth::id()
        ]);

        // Obtener listado de los codigos de los equipos y modelos para los selects dinámicos
        $equipos = $this->getEquiposList();
        $modelos = $this->getModelosList();

        return view('registros.create', compact('equipos', 'modelos'));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        Log::channel('daily')->info('[RegistroController@store] Iniciando creación de registro', [
            'tipo_form_id'   => $request->tipo_form_id,
            'titulo_informe' => $request->titulo_informe,
            'codigo'         => $request->codigo,
            'cliente_nombre' => $request->cliente_nombre,
            'user_id'        => Auth::id()
        ]);

        try {
            $request->validate(['tipo_form_id' => 'required|integer']);

            DB::transaction(function () use ($request) {

                // 1. Logo
                $logoPath = null;
                if ($request->hasFile('logo_cliente')) {
                    $logoPath = $request->file('logo_cliente')->store('logos_clientes', 'public');
                    Log::channel('daily')->info('[RegistroController@store] Logo cliente guardado', [
                        'path' => $logoPath,
                    ]);
                }

                // 2. Crear Registro
                $registro = Registro::create([
                    'tipo_form_id'     => $request->tipo_form_id,
                    'titulo_informe'   => $request->titulo_informe,
                    'codigo_informe'   => $request->codigo,
                    'fecha_emision'    => $request->fecha_emision,
                    'empresa_nombre'   => $request->cliente_nombre,
                    'rut_empresa'       => $request->rut_empresa,           
                    'representante_nombre' => $request->representante_nombre,
                    'representante_run'    => $request->representante_run, 
                    'cliente_direccion'=> $request->cliente_direccion ?? '',
                    'region'           => $request->region,
                    'comuna'           => $request->comuna,
                    'logo_cliente'     => $logoPath,
                    'nombre_proyecto'  => $request->nombre_proyecto,
                    'n_rca'            => $request->n_rca,
                ]);

                Log::channel('daily')->info('[RegistroController@store] Registro creado en BD', [
                    'registro_id' => $registro->id,
                    'tipo_form'   => $registro->tipo_form_id,
                ]);

                // 3. Delegar al Service
                $service = FormularioFactory::make($registro->tipo_form_id);
                $service->guardar($registro, $request);

                Log::channel('daily')->info('[RegistroController@store] Formulario específico guardado', [
                    'registro_id' => $registro->id,
                    'service'     => get_class($service),
                ]);
            });

            Log::channel('daily')->info('[RegistroController@store] Creación completada con éxito');

            return redirect()->route('registros.index')
                ->with('success', 'Registro creado correctamente');

        } catch (\Throwable $e) {
            Log::channel('daily')->error('[RegistroController@store] Error al crear registro', [
                'mensaje' => $e->getMessage(),
                'archivo' => $e->getFile(),
                'linea'   => $e->getLine(),
                'trace'   => $e->getTraceAsString(),
                'request' => $request->except(['_token', 'logo_cliente']),
            ]);

            return back()->with('error', 'Error al crear el registro: ' . $e->getMessage());
        }
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        Log::channel('daily')->info('[RegistroController@show] Accediendo a detalle de registro', [
            'registro_id' => $id,
            'user_id' => Auth::id()
        ]);

        try {
            $registro = Registro::with(['rilPuntual', 'ril24Horas'])->findOrFail($id);

            Log::channel('daily')->info('[RegistroController@show] Registro encontrado', [
                'registro_id'  => $registro->id,
                'tipo_form_id' => $registro->tipo_form_id,
            ]);

            return view('registros.show', compact('registro'));

        } catch (\Throwable $e) {
            Log::channel('daily')->error('[RegistroController@show] Error al mostrar registro', [
                'registro_id' => $id,
                'mensaje'     => $e->getMessage(),
                'archivo'     => $e->getFile(),
                'linea'       => $e->getLine(),
            ]);

            abort(404, 'Registro no encontrado.');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        Log::channel('daily')->info('[RegistroController@edit] Iniciando edición de registro', [
            'registro_id' => $id,
            'user_id' => Auth::id()
        ]);

        try {
            $registro = Registro::findOrFail($id);

            $modeloFormulario = Registro::$formularios[$registro->tipo_form_id] ?? null;
            $instancia        = null;

            if ($modeloFormulario) {
                $instancia = $modeloFormulario::where('registro_id', $registro->id)->first();
                Log::channel('daily')->info('[RegistroController@edit] Instancia de formulario obtenida', [
                    'registro_id' => $id,
                    'modelo'      => $modeloFormulario,
                    'encontrado'  => $instancia ? 'sí' : 'no',
                ]);
            } else {
                Log::channel('daily')->warning('[RegistroController@edit] No se encontró modelo para tipo_form_id', [
                    'tipo_form_id' => $registro->tipo_form_id,
                ]);
            }

            if (!$instancia) {
                Log::channel('daily')->error('[RegistroController@edit] Formulario no encontrado para el registro', [
                    'registro_id'  => $id,
                    'tipo_form_id' => $registro->tipo_form_id,
                ]);
                abort(404, 'Formulario no encontrado.');
            }
            
            // Obtener listado de los codigos de los equipos y modelos para los selects dinámicos
            $equipos = $this->getEquiposList();
            $modelos = $this->getModelosList();

            return view('registros.create', compact('registro', 'instancia', 'equipos', 'modelos'));

        } catch (\Throwable $e) {
            Log::channel('daily')->error('[RegistroController@edit] Error al cargar edición', [
                'registro_id' => $id,
                'mensaje'     => $e->getMessage(),
                'archivo'     => $e->getFile(),
                'linea'       => $e->getLine(),
            ]);

            return back()->with('error', 'Error al cargar el formulario de edición.');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        Log::channel('daily')->info('[RegistroController@update] Iniciando actualización de registro', [
            'registro_id'    => $id,
            'titulo_informe' => $request->titulo_informe,
            'codigo'         => $request->codigo,
            'user_id' => Auth::id()
        ]);

        try {
            $registro = Registro::findOrFail($id);

            DB::transaction(function () use ($request, $registro) {

                // 1. Logo
                $logoPath = $registro->logo_cliente;

                if ($request->hasFile('logo_cliente')) {
                    if ($logoPath && Storage::disk('public')->exists($logoPath)) {
                        Storage::disk('public')->delete($logoPath);
                        Log::channel('daily')->info('[RegistroController@update] Logo anterior eliminado', [
                            'path' => $logoPath,
                        ]);
                    }
                    $logoPath = $request->file('logo_cliente')->store('logos_clientes', 'public');
                    Log::channel('daily')->info('[RegistroController@update] Nuevo logo guardado', [
                        'path' => $logoPath,
                    ]);
                }

                // 2. Actualizar Registro
                $registro->update([
                    'titulo_informe'    => $request->titulo_informe,
                    'codigo_informe'    => $request->codigo,
                    'fecha_emision'     => $request->fecha_emision,
                    'empresa_nombre'    => $request->cliente_nombre,
                    'rut_empresa'       => $request->rut_empresa,           
                    'representante_nombre' => $request->representante_nombre,
                    'representante_run'    => $request->representante_run,
                    'cliente_direccion' => $request->cliente_direccion ?? '',
                    'region'            => $request->region,
                    'comuna'            => $request->comuna,
                    'logo_cliente'      => $logoPath,
                    'nombre_proyecto'   => $request->nombre_proyecto,
                    'n_rca'             => $request->n_rca,
                ]);

                Log::channel('daily')->info('[RegistroController@update] Registro actualizado en BD', [
                    'registro_id' => $registro->id,
                ]);

                // 3. Delegar al Service
                $service = FormularioFactory::make($registro->tipo_form_id);
                $service->actualizar($registro, $request);

                Log::channel('daily')->info('[RegistroController@update] Formulario específico actualizado', [
                    'registro_id' => $registro->id,
                    'service'     => get_class($service),
                ]);
            });

            Log::channel('daily')->info('[RegistroController@update] Actualización completada con éxito', [
                'registro_id' => $id,
            ]);

            return redirect()->route('registros.index')
                ->with('success', 'Registro actualizado correctamente');

        } catch (\Throwable $e) {
            Log::channel('daily')->error('[RegistroController@update] Error al actualizar registro', [
                'registro_id' => $id,
                'mensaje'     => $e->getMessage(),
                'archivo'     => $e->getFile(),
                'linea'       => $e->getLine(),
                'trace'       => $e->getTraceAsString(),
                'request'     => $request->except(['_token', 'logo_cliente']),
            ]);

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
        Log::channel('daily')->info('[RegistroController@destroy] Iniciando eliminación de registro', [
            'registro_id' => $id,
            'user_id' => Auth::id()
        ]);

        try {
            $registro = Registro::findOrFail($id);

            DB::transaction(function () use ($registro) {

                $modeloFormulario = Registro::$formularios[$registro->tipo_form_id] ?? null;

                if ($modeloFormulario) {
                    $formulario = $modeloFormulario::where('registro_id', $registro->id)->first();

                    if ($formulario) {
                        // Eliminar todos los anexos (1-7 para cubrir todos los formularios)
                        foreach (range(1, 7) as $i) {
                            $archivo = $formulario->{'anexo_' . $i . '_file'} ?? null;
                            if ($archivo && Storage::disk('public')->exists($archivo)) {
                                Storage::disk('public')->delete($archivo);
                                Log::channel('daily')->info('[RegistroController@destroy] Anexo eliminado', [
                                    'registro_id' => $registro->id,
                                    'anexo'       => "anexo_{$i}_file",
                                    'path'        => $archivo,
                                ]);
                            }
                        }

                        $formulario->delete();
                        Log::channel('daily')->info('[RegistroController@destroy] Formulario específico eliminado', [
                            'registro_id' => $registro->id,
                            'modelo'      => $modeloFormulario,
                        ]);
                    }
                }

                // Eliminar logo
                if ($registro->logo_cliente && Storage::disk('public')->exists($registro->logo_cliente)) {
                    Storage::disk('public')->delete($registro->logo_cliente);
                    Log::channel('daily')->info('[RegistroController@destroy] Logo cliente eliminado', [
                        'path' => $registro->logo_cliente,
                    ]);
                }

                $registro->delete();
            });

            Log::channel('daily')->info('[RegistroController@destroy] Registro eliminado con éxito', [
                'registro_id' => $registro->id,
            ]);

            return redirect()->route('registros.index')
                ->with('success', 'Registro eliminado correctamente');

        } catch (\Throwable $e) {
            Log::channel('daily')->error('[RegistroController@destroy] Error al eliminar registro', [
                'registro_id' => $id,
                'mensaje'     => $e->getMessage(),
                'archivo'     => $e->getFile(),
                'linea'       => $e->getLine(),
                'trace'       => $e->getTraceAsString(),
            ]);

            return back()->with('error', 'Error al eliminar el registro.');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | PDF
    |--------------------------------------------------------------------------
    */
    public function pdf($id)
    {
        Log::channel('daily')->info('[RegistroController@pdf] Generando PDF', [
            'registro_id' => $id,
            'user_id' => Auth::id()
        ]);

        try {
            $registro = Registro::findOrFail($id);

            $service    = FormularioFactory::make($registro->tipo_form_id);
            $formulario = $service->obtenerFormulario($registro);
            $vista      = $service->vistaPdf();

            $extras = method_exists($service, 'datosParaPdf')
                ? $service->datosParaPdf($formulario)
                : [];

            Log::channel('daily')->info('[RegistroController@pdf] Cargando vista para PDF', [
                'registro_id' => $id,
                'vista'       => $vista,
                'service'     => get_class($service),
            ]);

            $pdf = Pdf::loadView($vista, array_merge(
                ['registro' => $registro, 'formulario' => $formulario],
                $extras
            ))->setPaper('a4', 'portrait');

            Log::channel('daily')->info('[RegistroController@pdf] PDF generado con éxito', [
                'registro_id' => $id,
                'archivo'     => 'registro_' . $registro->id . '.pdf',
            ]);

            return $pdf->stream('registro_' . $registro->id . '.pdf');

        } catch (\Throwable $e) {
            Log::channel('daily')->error('[RegistroController@pdf] Error al generar PDF', [
                'registro_id' => $id,
                'mensaje'     => $e->getMessage(),
                'archivo'     => $e->getFile(),
                'linea'       => $e->getLine(),
                'trace'       => $e->getTraceAsString(),
            ]);

            return back()->with('error', 'Error al generar el PDF: ' . $e->getMessage());
        }
    }

    /**
     * Obtiene la lista de códigos de equipos activos (para los selects).
     *
     * @return array
     */
    private function getEquiposList(): array
    {
        return Equipo::activos()
            ->with('modelos')
            ->orderBy('codigo')
            ->get()
            ->map(fn($e) => [
                'codigo'      => $e->codigo,
                'descripcion' => $e->descripcion ?? '',
                'modelos'     => $e->modelos->pluck('nombre')->toArray(),
            ])
            ->toArray();
    }

    /**
     * Obtiene la lista de códigos de modelos activos (para los selects).
     *
     * @return array
     */
    private function getModelosList(): array
    {
        return ModeloEquipo::activos()
            ->orderBy('nombre')
            ->get()
            ->map(fn($m) => [
                'nombre'      => $m->nombre,
                'descripcion' => $m->descripcion ?? '',
            ])
            ->toArray();
    }
}
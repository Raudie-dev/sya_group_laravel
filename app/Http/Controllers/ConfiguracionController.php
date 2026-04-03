<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\ModeloEquipo;
use Illuminate\Http\Request;

class ConfiguracionController extends Controller
{
    // ──────────────────────────────────────────────
    //  INDEX
    // ──────────────────────────────────────────────
    public function index()
    {
        $equipos = Equipo::orderBy('codigo')->get();
        $modelos = ModeloEquipo::orderBy('nombre')->get();

        return view('configuracion.index', compact('equipos', 'modelos'));
    }

    // ══════════════════════════════════════════════
    //  EQUIPOS — STORE / UPDATE / DESTROY
    // ══════════════════════════════════════════════

    public function store(Request $request)
    {
        $request->validate([
            'codigo'      => ['required', 'string', 'max:50', 'unique:equipos,codigo'],
            'descripcion' => ['nullable', 'string', 'max:255'],
        ], [
            'codigo.required' => 'El código del equipo es obligatorio.',
            'codigo.unique'   => 'Ya existe un equipo con ese código.',
            'codigo.max'      => 'El código no puede superar los 50 caracteres.',
        ]);

        Equipo::create([
            'codigo'      => strtoupper(trim($request->codigo)),
            'descripcion' => $request->descripcion,
            'activo'      => true,
        ]);

        return redirect()
            ->route('configuracion.index')
            ->with('success', 'Equipo «' . strtoupper($request->codigo) . '» agregado correctamente.');
    }

    public function update(Request $request, Equipo $equipo)
    {
        $request->validate([
            'codigo'      => ['required', 'string', 'max:50', 'unique:equipos,codigo,' . $equipo->id],
            'descripcion' => ['nullable', 'string', 'max:255'],
            'activo'      => ['nullable', 'boolean'],
        ], [
            'codigo.required' => 'El código del equipo es obligatorio.',
            'codigo.unique'   => 'Ya existe otro equipo con ese código.',
        ]);

        $equipo->update([
            'codigo'      => strtoupper(trim($request->codigo)),
            'descripcion' => $request->descripcion,
            'activo'      => $request->boolean('activo', true),
        ]);

        return redirect()
            ->route('configuracion.index')
            ->with('success', 'Equipo «' . $equipo->codigo . '» actualizado correctamente.');
    }

    public function destroy(Equipo $equipo)
    {
        $codigo = $equipo->codigo;
        $equipo->delete();

        return redirect()
            ->route('configuracion.index')
            ->with('success', 'Equipo «' . $codigo . '» eliminado.');
    }

    // ══════════════════════════════════════════════
    //  MODELOS — STORE / UPDATE / DESTROY
    // ══════════════════════════════════════════════

    public function storeModelo(Request $request)
    {
        $request->validate([
            'nombre'      => ['required', 'string', 'max:100', 'unique:modelos_equipo,nombre'],
            'descripcion' => ['nullable', 'string', 'max:255'],
        ], [
            'nombre.required' => 'El nombre del modelo es obligatorio.',
            'nombre.unique'   => 'Ya existe un modelo con ese nombre.',
        ]);

        ModeloEquipo::create([
            'nombre'      => trim($request->nombre),
            'descripcion' => $request->descripcion,
            'activo'      => true,
        ]);

        return redirect()
            ->route('configuracion.index')
            ->with('success', 'Modelo «' . $request->nombre . '» agregado correctamente.');
    }

    public function updateModelo(Request $request, ModeloEquipo $modelo)
    {
        $request->validate([
            'nombre'      => ['required', 'string', 'max:100', 'unique:modelos_equipo,nombre,' . $modelo->id],
            'descripcion' => ['nullable', 'string', 'max:255'],
            'activo'      => ['nullable', 'boolean'],
        ], [
            'nombre.required' => 'El nombre del modelo es obligatorio.',
            'nombre.unique'   => 'Ya existe otro modelo con ese nombre.',
        ]);

        $modelo->update([
            'nombre'      => trim($request->nombre),
            'descripcion' => $request->descripcion,
            'activo'      => $request->boolean('activo', true),
        ]);

        return redirect()
            ->route('configuracion.index')
            ->with('success', 'Modelo «' . $modelo->nombre . '» actualizado correctamente.');
    }

    public function destroyModelo(ModeloEquipo $modelo)
    {
        $nombre = $modelo->nombre;
        $modelo->delete();

        return redirect()
            ->route('configuracion.index')
            ->with('success', 'Modelo «' . $nombre . '» eliminado.');
    }

    // ──────────────────────────────────────────────
    //  API — Códigos activos para selects de formularios
    // ──────────────────────────────────────────────
    public function apiEquipos()
    {
        return response()->json(
            Equipo::activos()->orderBy('codigo')->pluck('codigo')
        );
    }

    public function apiModelos()
    {
        return response()->json(
            ModeloEquipo::activos()->orderBy('nombre')->pluck('nombre')
        );
    }
}
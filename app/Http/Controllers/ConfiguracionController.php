<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class ConfiguracionController extends Controller
{
    // ──────────────────────────────────────────────
    //  INDEX — Listado de equipos
    // ──────────────────────────────────────────────
    public function index()
    {
        $equipos = Equipo::orderBy('codigo')->get();

        return view('configuracion.index', compact('equipos'));
    }

    // ──────────────────────────────────────────────
    //  STORE — Guardar nuevo equipo
    // ──────────────────────────────────────────────
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

    // ──────────────────────────────────────────────
    //  UPDATE — Editar equipo existente
    // ──────────────────────────────────────────────
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

    // ──────────────────────────────────────────────
    //  DESTROY — Eliminar equipo
    // ──────────────────────────────────────────────
    public function destroy(Equipo $equipo)
    {
        $codigo = $equipo->codigo;
        $equipo->delete();

        return redirect()
            ->route('configuracion.index')
            ->with('success', 'Equipo «' . $codigo . '» eliminado.');
    }

    // ──────────────────────────────────────────────
    //  API — Devuelve códigos activos (para los selects de los formularios)
    // ──────────────────────────────────────────────
    public function apiEquipos()
    {
        $codigos = Equipo::activos()->orderBy('codigo')->pluck('codigo');

        return response()->json($codigos);
    }
}
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ConfiguracionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí se definen todas las rutas web de la aplicación.
| Se aplican middlewares y nombres de rutas consistentes.
|
*/

// Ruta pública de bienvenida
Route::get('/', function () {
    return redirect()->route('login');
});

// Dashboard: requiere usuario autenticado y verificado
Route::get('/dashboard', [RegistroController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Rutas de perfil protegidas por auth
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Rutas CRUD de Registros
|--------------------------------------------------------------------------
| Protegidas con auth
| Incluyen opciones de PDF y formularios dinámicos según tipo_form_id
*/
Route::middleware('auth')->group(function () {

    // Listado de registros
    Route::get('/registros', [RegistroController::class, 'index'])->name('registros.index');

    // Crear registro (opcional: tipo de formulario)
    Route::get('/registros/create/{tipo_form_id?}', [RegistroController::class, 'create'])
        ->name('registros.create');

    // Guardar registro
    Route::post('/registros/store/{tipo_form_id?}', [RegistroController::class, 'store'])
        ->name('registros.store');

    // Editar registro
    Route::get('/registros/{registro}/edit', [RegistroController::class, 'edit'])
        ->name('registros.edit');

    // Actualizar registro
    Route::put('/registros/{registro}', [RegistroController::class, 'update'])
        ->name('registros.update');

    // Eliminar registro
    Route::delete('/registros/{registro}', [RegistroController::class, 'destroy'])
        ->name('registros.destroy');

    // Generar PDF del registro
    Route::get('/registros/{registro}/pdf', [RegistroController::class, 'pdf'])->name('registros.pdf');

    // Vista de usuarios (solo visual)
    Route::get('/usuarios', function () {
        return view('usuarios.index'); 
    })->name('usuarios.index');
});

/*
|--------------------------------------------------------------------------
| Rutas de administración (solo admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('usuarios')->name('usuarios.')->group(function () {
    // CRUD de usuarios
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::get('/{usuario}/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('/{usuario}', [UserController::class, 'update'])->name('update');
    Route::delete('/{usuario}', [UserController::class, 'destroy'])->name('destroy');
});

/*
|--------------------------------------------------------------------------
| Configuración del sistema (solo admin)
|--------------------------------------------------------------------------
| Ahora estas rutas NO dependen de 'usuarios' y sus nombres serán
| 'configuracion.*'
*/
Route::middleware(['auth', 'admin'])->prefix('configuracion')->name('configuracion.')->group(function () {
    // Vista principal de configuración
    Route::get('/', [ConfiguracionController::class, 'index'])->name('index');

    // CRUD de equipos
    Route::post('/equipos', [ConfiguracionController::class, 'store'])->name('equipos.store');
    Route::put('/equipos/{equipo}', [ConfiguracionController::class, 'update'])->name('equipos.update');
    Route::delete('/equipos/{equipo}', [ConfiguracionController::class, 'destroy'])->name('equipos.destroy');

    // API interna para obtener lista de equipos (selects dinámicos)
    Route::get('/equipos/api', [ConfiguracionController::class, 'apiEquipos'])->name('equipos.api');

    // CRUD de modelos - CORREGIDO
    Route::post('/modelos', [ConfiguracionController::class, 'storeModelo'])->name('modelos.store');
    Route::put('/modelos/{modelo}', [ConfiguracionController::class, 'updateModelo'])->name('modelos.update');
    Route::delete('/modelos/{modelo}', [ConfiguracionController::class, 'destroyModelo'])->name('modelos.destroy');
});


// Carga de rutas de autenticación (login, register, password, etc.)
require __DIR__.'/auth.php';
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistroController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas temporales para desarrollo
Route::middleware(['auth'])->group(function () {

    // CRUD de Registros con formularios dinámicos
    Route::get('/registros', [RegistroController::class, 'index'])->name('registros.index');

    Route::get('/registros/create/{tipo_form_id?}', [RegistroController::class, 'create'])
        ->name('registros.create');

    Route::post('/registros/store/{tipo_form_id?}', [RegistroController::class, 'store'])
        ->name('registros.store');

    Route::get('/registros/{registro}/edit', [RegistroController::class, 'edit'])
        ->name('registros.edit');

    Route::put('/registros/{registro}', [RegistroController::class, 'update'])
        ->name('registros.update');

    // Opcional: eliminar registro
    Route::delete('/registros/{registro}', [RegistroController::class, 'destroy'])
        ->name('registros.destroy');
    
    Route::get('/usuarios', function () {
        return view('usuarios.index'); 
    })->name('usuarios.index');
});
require __DIR__.'/auth.php';

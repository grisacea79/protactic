<?php

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\TareaController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});*/

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {

Route::get('/', [ClienteController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [ClienteController::class, 'index']);

    // --- CRUD DE CLIENTES ---
    Route::resource('cliente', ClienteController::class);

    // --- CRUD DE PROYECTOS ---
    Route::resource('proyecto', ProyectoController::class);
    
    // Tu ruta personalizada para ver el detalle de un proyecto
    Route::get('/showProyect/{id}', [ProyectoController::class, 'show'])->name('proyecto.show');

    // --- PROCESAMIENTO DE TAREAS (Para tus Modales y Tabla) ---
    Route::put('/tarea/{id}', [TareaController::class, 'update'])->name('tarea.update');
    Route::delete('/tarea/{id}', [TareaController::class, 'destroy'])->name('tarea.destroy');
    
   });

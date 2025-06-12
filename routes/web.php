<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\LibroController;
use Inertia\Inertia;

// Todas las rutas dentro de este grupo tendrán el middleware web aplicado
Route::middleware('web')->group(function () {
    // Página principal
    Route::get('/', function () {
        return Inertia::render('Home', [
            'message' => 'Si puedes ver este mensaje, Inertia está funcionando.'
        ]);
    });

    // Ruta de prueba explícita
    Route::get('/test', function() {
        return Inertia::render('Test', [
            'message' => 'Esta es una página de prueba'
        ]);
    });

    // // Rutas para Autores
    // Route::resource('autores', AutorController::class);
// Definir rutas para autores
Route::get('/autores', [AutorController::class, 'index'])->name('autores.index');
Route::get('/autores/create', [AutorController::class, 'create'])->name('autores.create');
Route::post('/autores', [AutorController::class, 'store'])->name('autores.store');
Route::get('/autores/{autor}', [AutorController::class, 'show'])->name('autores.show');
Route::get('/autores/{autor}/edit', [AutorController::class, 'edit'])->name('autores.edit');
Route::put('/autores/{autor}', [AutorController::class, 'update'])->name('autores.update');
Route::delete('/autores/{autor}', [AutorController::class, 'destroy'])->name('autores.destroy');
// Añadir esta ruta para ocultar autores usando POST
Route::post('/autores/{autor}/ocultar', [AutorController::class, 'ocultar'])->name('autores.ocultar');


    // Rutas para Libros
    Route::resource('libros', LibroController::class);
});
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\LibroController;
use Inertia\Inertia;

Route::middleware('web')->group(function () {
    // Página principal
    Route::get('/', function () {
        return Inertia::render('Home', [
            'message' => 'Si puedes ver este mensaje, Inertia está funcionando.'
        ]);
    });

    // Rutas para Autores (incluye ruta de ocultar en lugar de destroy)
    Route::get('/autores', [AutorController::class, 'index'])->name('autores.index');
    Route::get('/autores/create', [AutorController::class, 'create'])->name('autores.create');
    Route::post('/autores', [AutorController::class, 'store'])->name('autores.store');
    Route::get('/autores/{autor}', [AutorController::class, 'show'])->name('autores.show');
    Route::get('/autores/{autor}/edit', [AutorController::class, 'edit'])->name('autores.edit');
    Route::post('/autores/{autor}', [AutorController::class, 'update'])->name('autores.update');
    Route::post('/autores/{autor}/ocultar', [AutorController::class, 'ocultar'])->name('autores.ocultar');

    // Rutas para Libros (se puede usar resource ya que usamos DELETE directamente)
    Route::resource('libros', LibroController::class);
});
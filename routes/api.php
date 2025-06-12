<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutorController;

Route::middleware('api')->group(function () {
    Route::apiResource('autores', AutorController::class);
});

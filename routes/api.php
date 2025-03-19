<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// Registrar las rutas de la API para productos con autenticación
Route::middleware('auth:sanctum')->group(function () {
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'show');  // Ver productos
        Route::post('/products/create', 'create');  // Crear un producto
        Route::delete('/products/delete/{id}', 'destroy');  // Eliminar un producto
        Route::patch('/products/update/{id}', 'update');  // Actualizar un producto
    });
});

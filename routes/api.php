<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'show'); // Ver productos
    Route::post('/products/create', 'create'); // Crear un producto (Usualmente se usa "store" en lugar de "create")
    Route::delete('/products/delete/{id}', 'destroy'); // Eliminar un producto
    Route::patch('/products/update/{id}', 'update'); // Actualizar un producto
});
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TareaController;

// Ruta base generada automáticamente por Laravel
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// --- TUS RUTAS DEL LABORATORIO 10 ---
Route::apiResource('/tareas', TareaController::class);
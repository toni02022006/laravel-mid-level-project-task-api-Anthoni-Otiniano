<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController; // ¡IMPORTA TU CONTROLADOR DE TAREAS!

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas de recursos para Proyectos
Route::apiResource('projects', ProjectController::class);

// Rutas de recursos para Tareas
Route::apiResource('tasks', TaskController::class); // ¡Añade esta línea!
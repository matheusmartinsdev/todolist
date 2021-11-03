<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Rotas Protegidas

Route::middleware('auth:sanctum')->group(function () {
    
    // TASKS ROUTES - Todas protegidas por auth:sanctum middleware
    
    // 1 - Exibe uma lista paginada das tarefas.
    Route::get('tarefas', [TaskController::class, 'show'])->middleware('auth:sanctum');

    // 2 - Exibe uma tarefa de acordo com o ID informado.
    Route::get('tarefas/{id}', [TaskController::class, 'showById']);

    // 3 - Cria uma nova tarefa.
    Route::post('tarefas', [TaskController::class, 'store']);

    // 4 - Edita uma tarefa
    Route::patch('tarefas/{id}', [TaskController::class, 'update']);

    // 5 - Deleta uma tarefa
    Route::delete('tarefas/{id}', [TaskController::class, 'delete']);

    // USERS ROUTES
    Route::post('usuarios/logout', [UserController::class, 'logout']);
});

// Rotas públicas

Route::post('usuarios', [UserController::class, 'register']);

// Fallback
Route::fallback(function () {
    return response()->json(['erro' => 'Endpoind não encontrado!'], 404);
});
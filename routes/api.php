<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//1 - Exibe uma lista paginada das tarefas.
Route::get('tarefas', [TaskController::class, 'show']);

//2 - Exibe uma tarefa de acordo com o ID informado.
Route::get('tarefas/{id}', [TaskController::class, 'showById']);

//3 - Cria uma nova tarefa.
Route::post('tarefas', [TaskController::class, 'store']);

//4 - Edita uma tarefa
Route::patch('tarefas/{id}', [TaskController::class, 'update']);

//5 - Deleta uma tarefa
Route::delete('tarefas/{id}', [TaskController::class, 'delete']);
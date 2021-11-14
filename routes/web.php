<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $props = [];
    
    if (Auth::check()) 
    {
        $props = [
            'isLogged' => true
        ];
    }
    
    return Inertia::render('Welcome', $props);
});

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
            
    Route::delete('/tarefas/{id}', [DashboardController::class, 'destroy'])->name('delete');

    Route::post('/tarefas/cadastrar', [DashboardController::class, 'store'])->name('store');

    Route::patch('/tarefas/{id}', [TaskController::class, 'update'])->name('update');
});
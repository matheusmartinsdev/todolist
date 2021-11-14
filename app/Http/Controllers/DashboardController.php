<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    /**
     * Busca no model uma lista paginada de tarefas.
     * Caso haja 'status' na requisição, retorna uma lista paginada de tarefas com aquele status. 
     * 
     * @param \Illuminate\Http\Request $request
     * @return Inertia\Inertia
     */
    public function index(Request $request)
    {
        if ($request->has('status')) {
            $tasks = Task::where('user_id', Auth::id())
                    ->where('status', $request->status)
                    ->paginate(5);
        } else {
            $tasks = Task::where('user_id', Auth::id())->paginate(5);
        }
        
        return Inertia::render('Dashboard', ['tasks' => $tasks]);
    }

    /**
     * Registra uma nova tarefa no banco de dados.
     *
     * @param  App\Http\Requests\StoreTaskRequest  $request
     * @return Illuminate\Support\Facades\Redirect com mensagem de sucesso
     */
    public function store(StoreTaskRequest $request)
    {
        $userId = auth()->id();
        
        Task::create([
            'text' => $request->text,
            'status' => $request->status,
            'user_id' => $userId
        ]);

        return Redirect::route('dashboard')->with('success', 'Tarefa adicionada com sucesso!');
    }

    /**
     * Atualiza um registro no banco de dados.
     *
     * @param  \App\Http\Requests\UpdateTaskRequest  $request
     * @param  int  $id
     * @return Illuminate\Support\Facades\Redirect
     */
    public function update(UpdateTaskRequest $request, int $id)
    {
        $task = Task::where('user_id', auth()->id())
                ->findOrFail($id);
        
        $task->update($request->validated());

        return Redirect::route('dashboard')->with('success', 'Tarefa atualizada!');
    }

    /**
     * Remove uma tarefa do banco de dados.
     *
     * @param  int  $id
     * @return Illuminate\Support\Facades\Redirect com mensagem de sucesso
     */
    public function destroy(int $id)
    {
        $task = Task::where('user_id', auth()->id())
                ->findOrFail($id);
        $task->delete();
        
        return Redirect::route('dashboard')->with('destroy', 'Tarefa removida com sucesso!');
    }
}
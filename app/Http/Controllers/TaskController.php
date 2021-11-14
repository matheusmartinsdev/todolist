<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;
use App\Http\Resources\TaskResource as TaskResource;
use App\Models\Task as Task;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function show(Request $request)
    {   
        if ($request->has('status')) {
            $tasks = Task::where('user_id', Auth::id())
                    ->where('status', $request->status)
                    ->paginate(5);
        } else {
            $tasks = Task::where('user_id', Auth::id())->paginate(5);
        }
        
        return TaskResource::collection($tasks);        
    }

    public function showById (Request $request, int $id)
    {
        $userId = auth()->id();
        $task = Task::where('user_id', $userId)
                ->findOrFail($id);

        return new TaskResource($task);
    }

    public function store(StoreTaskRequest $request)
    {
        $userId = auth()->id();
        
        $task = Task::create([
            'text' => $request->text,
            'status' => $request->status,
            'user_id' => $userId
        ]);

        return new TaskResource($task);
    }

    public function update(UpdateTaskRequest $request, int $id)
    {
        $task = Task::where('user_id', auth()->id())
                ->findOrFail($id);
        
        $task->update($request->validated());
        
        return new TaskResource($task);
    }
    
    public function destroy(Request $request, int $id)
    {
        $task = Task::where('user_id', auth()->id())
                ->findOrFail($id);
        $task->delete();
        
        return new TaskResource($task);
    }
}
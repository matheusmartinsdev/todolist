<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;
use App\Http\Resources\TaskResource as TaskResource;
use App\Models\Task as Task;

class TaskController extends Controller
{
    public function show(Request $request)
    {   
        if ($request->has('status')) {
            $tasks = Task::where('user_id', auth()->id())
                    ->where('status', $request->status)
                    ->get();
        } else {
            $tasks = Task::where('user_id', auth()->id())->get();
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

    public function delete(Request $request, int $id)
    {
        $task = Task::where('user_id', auth()->id())
                ->findOrFail($id);
        $task->delete();
        return new TaskResource($task);
    }
}
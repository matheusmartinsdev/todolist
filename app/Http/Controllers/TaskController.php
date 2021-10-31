<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\TaskResource as TaskResource;
use App\Models\Task as Task;

class TaskController extends Controller
{
    public function show()
    {
        $request = request();
        
        if ($request->has('status')) {
            $tasks = Task::where('status', $request->status)->get();
        } else {
            $tasks = Task::all();
        }
        
        return TaskResource::collection($tasks);
    }

    public function showById (int $id)
    {
        $task = Task::findOrFail($id);
        return new TaskResource($task);
    }

    public function store(Request $request)
    {
        $task = Task::create($request->all());
        return new TaskResource($task);
    }

    public function delete(int $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return new TaskResource($task);
    }
}
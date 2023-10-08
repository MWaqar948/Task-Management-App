<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Repositories\TaskRepository;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public $taskRepository;

    public function __construct(TaskRepository $taskRepository) {
        $this->taskRepository = $taskRepository;
        $this->middleware('auth:sanctum')->except(['index']);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request_params = $request->all();
        
        // Fetch Data
        $tasks = $this->taskRepository->getAll($request_params);
        
        return response()->success($tasks);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStoreRequest $request)
    {
        $validatedData = $request->validated();
        $task = $this->taskRepository->add($validatedData);
        
        $payload = [
            'task' => $task
        ];
        return response()->created($payload);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)        
    {
        if(!$task)
            return response()->notFound();

        $payload = [
            'task' => $task
        ];
        return response()->success($payload);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(TaskUpdateRequest $request, Task $task)
    {
        if(!$task)
            return response()->notFound();
        
        $this->taskRepository->update($request->validated(), $task->id);
        
        $payload = [
            'task' => $task->refresh()
        ];
        return response()->created($payload);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if(!$task)
            return response()->notFound();

        $task = $this->taskRepository->delete($task->id);
        return response()->deleted();
    }
}

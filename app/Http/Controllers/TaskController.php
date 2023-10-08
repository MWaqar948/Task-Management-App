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
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request_params = $request->all();

       /*  $activeUser = auth()->user();
        $default_params = [
            'user_id' => $activeUser?->id ?? 1,
        ];
        
        $combined_params = array_merge($default_params, $request_params); */
        
        // Fetch Data
        $tasks = $this->taskRepository->getAll($request_params);
        
        $payload = [
            'tasks' => $tasks,
        ];
        return response()->success($payload);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStoreRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->id() ?? 1;
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
            return response()->noContent();

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
            return response()->noContent();
        
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
            return response()->noContent();

        $task = $this->taskRepository->delete($task->id);
        return response()->deleted();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Repositories\TaskRepository;
use App\Http\Requests\TaskStoreRequest;
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

        $activeUser = auth()->user();
        $default_params = [
            'user_id' => $activeUser->id
        ];
        
        $combined_params = array_merge($default_params, $request_params);
        
        // Fetch Data
        $tasks = $this->taskRepository->getAll($combined_params);
        
        $payload = array(
            'tasks' => $tasks,
        );
        return response()->success($payload);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // $task = $this->taskRepository->add($request->all());
        // return response()->json(['task' => $task]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStoreRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->id();
        $task = $this->taskRepository->add($validatedData);
        
        $payload = array(
            'task' => $task
        );
        return response()->created($payload);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)        
    {
        // $task = $this->taskRepository->add($request->all());
        
        return response()->json(['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return response()->json(['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskStoreRequest $request, Task $task)
    {
        if(!$task)
            return response()->noContent();
        
        $this->taskRepository->update($request->validated(), $task->id);
        
        $payload = array(
            'task' => $task->refresh()
        );
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

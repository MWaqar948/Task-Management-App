<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository
{
    /** 
     * Get tasks by user
     */
    function getAll($params)
    {
        $user_id = $params['user_id'] ?? null;

        return Task::when($user_id, function($query, $user_id){
            $query->where('user_id', $user_id);
        })->get();
    }

    /** 
     * Get task by id
     */
    function getTaskById($id)
    {
        return Task::find($id);
    }

    /** 
     * Add new task
     */
    function add($data)
    {
        return Task::create($data);
    }
    
    /** 
     * Update task
     */
    function update($data, $id)
    {
        return Task::where('id', $id)->update($data);
    }
    
    /** 
     * Delete task by id
     */
    function delete($id)
    {
        return Task::where('id', $id)->delete();
    }
}
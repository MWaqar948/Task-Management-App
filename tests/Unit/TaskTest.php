<?php

namespace Tests\Unit;

use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    /**
     * A basic unit test example.
     */
    public function test_store(): void
    {
        $task = [
            "title" => "Create DB Schema",
            "description" => "This task for db Schema",
            "due_date" => "2023-10-07",
        ];
        
        $response = $this->postJson(route('tasks.store'), $task);
 
        $response
            ->assertStatus(201)
            ->assertJson([
                'task' => $task,
            ]);
    }

    public function test_update(): void
    {
        $task = [
            "title" => "Create DB SChema",
            "description" => "This task for db Schema",
            "due_date" => "2023-10-07",
            "status" => "in-progress",
        ];
        
        $response = $this->putJson(route('tasks.update', ['task' => 1]), $task);
 
        $response
            ->assertStatus(201)
            ->assertJson([
                'task' => $task,
            ]);
    }
    
    public function test_delete(): void
    {   
        $response = $this->deleteJson(route('tasks.destroy', ['task' => 1]));
 
        $response->assertStatus(204);
    }
}

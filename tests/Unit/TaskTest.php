<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;

class TaskTest extends TestCase
{
    protected static $token;

    /**
     * Setup Resources for Tests
     */
    public function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create();
        self::$token = $user->createToken('Todo-app')->plainTextToken;
    }

    /**
     * Task Store Test.
     */
    public function test_store(): void
    {
        $task = [
            "title" => "Create DB Schema",
            "description" => "This task for db Schema",
            "due_date" => "2023-10-07",
        ];

        $response = $this->withHeader('Authorization', 'Bearer ' . self::$token)->postJson(route('tasks.store'), $task);
 
        $response
            ->assertStatus(201)
            ->assertJson([
                'task' => $task,
            ]);
    }

    /**
     * Task Update Test.
     */
    public function test_update(): void
    {
        $user = User::find(1);
        $token = $user->createToken('Todo-app')->plainTextToken;
        $task = [
            "title" => "Create DB SChema",
            "description" => "This task for db Schema",
            "due_date" => "2023-10-07",
            "status" => "in-progress",
        ];
        
        $response = $this->withHeader('Authorization', 'Bearer ' . self::$token)->putJson(route('tasks.update', ['task' => 1]), $task);
 
        $response
            ->assertStatus(201)
            ->assertJson([
                'task' => $task,
            ]);
    }
    
    /**
     * Task Delete Test.
     */
    public function test_delete(): void
    { 

        $response = $this->withHeader('Authorization', 'Bearer ' . self::$token)->deleteJson(route('tasks.destroy', ['task' => 1]));
 
        $response->assertStatus(204);
    }
}

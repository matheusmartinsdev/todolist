<?php

namespace Tests\Feature\App\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Task;
use Inertia\Testing\Assert;
use Tests\TestCase;
use Illuminate\Support\Collection;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     *
     */
    public function test_wheter_a_task_list_by_status_is_provided()
    {
        //Creating fake user to test
        $user = User::factory()->create();
        
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        //Log in user
        $this->actingAs($user);

        $taskStatusToBeTested = 'ativa'; //Enum: 'ativa'|'feita'|'cancelada'

        Task::factory()->create([
            'text' => 'tarefa',
            'status' => $taskStatusToBeTested,
            'user_id' => $user->id
        ]);

        Task::factory()->create([
            'text' => 'tarefa',
            'status' => 'cancelada',
            'user_id' => $user->id
        ]);  
        
        Task::factory()->create([
            'text' => 'tarefa',
            'status' => 'feita',
            'user_id' => $user->id
        ]);
        
        //Checking if the $taskStatusToBeTested is founded in the task list.
        $response = $this->get('/dashboard?status=' . $taskStatusToBeTested);
        $response->assertInertia(fn (Assert $page) => $page
            ->url('/dashboard?status='. $taskStatusToBeTested)
            ->where('tasks.data', fn (Collection $value) => 
                !$value->contains('status', 'cancelada') &&
                !$value->contains('status', 'feita'))
        );

        $response->assertStatus(200);
    }
}
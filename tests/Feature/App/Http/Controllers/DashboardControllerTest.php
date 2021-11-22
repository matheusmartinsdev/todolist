<?php

namespace Tests\Feature\App\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Task;
use Inertia\Testing\Assert;
use Tests\TestCase;

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

        //Creating fake task
        $task = Task::factory()->create([
            'text' => 'tarefa',
            'status' => $taskStatusToBeTested,
            'user_id' => $user->id
        ]);

        //Checking if the $taskStatusToBeTested is founded in the task list.
        $response = $this->get('/dashboard?status=' . $task->status);
        $response->assertInertia(fn (Assert $page) => $page
            ->url('/dashboard?status='. $task->status)
            ->where('tasks.data.0.status', $task->status)
        );

        $response->assertStatus(200);
    }
}

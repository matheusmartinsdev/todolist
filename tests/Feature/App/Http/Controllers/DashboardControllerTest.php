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
     * Testa se uma lista de tarefas é fornecida de acordo com filtro 'status' provido
     */
    public function test_wheter_a_task_list_by_status_is_provided()
    {
        //Criando um usuário fake para testar
        $user = User::factory()->create();
        
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        //Logando o usuário fake criado
        $this->actingAs($user);


        $taskStatusToBeTested = 'ativa'; //Enum: 'ativa'|'feita'|'cancelada'

        //Criando tarefas com status diversos
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
        
        //Checando se apenas a tarefa do tipo $taskStatusToBeTested está na lista
        $response = $this->get('/dashboard?status=' . $taskStatusToBeTested);
        $response->assertInertia(fn (Assert $page) => $page
            ->url('/dashboard?status='. $taskStatusToBeTested)
            ->where('tasks.data', fn (Collection $value) => 
                !$value->contains('status', 'cancelada') &&
                !$value->contains('status', 'feita'))
        );

        $response->assertStatus(200);
    }

    /**
     * Testa se as tarefas estão sendo persistidas corretamente.
     */
    public function test_if_the_task_is_properly_stored()
    {
        //Criando um usuário fake
        $user = User::factory()->create();

        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        //Logando com o usuário fake
        $this->actingAs($user);

        //Criando uma tarefa
        $task = Task::factory()->create([
            'text' => 'fake task',
            'status' => 'ativa',
            'user_id' => $user->id
        ]);

        //Verificando se a tarefa criada está presente na requisição
        $response = $this->get('/api/tarefas/' . $task->id);
        $response->assertOk();
    }

    /**
     * Testa se apenas usuários logados podem criar tarefas.
     */
    public function test_only_logged_in_users_can_create_tasks()
    {
        $task = [
            'text' => 'tarefa teste',
            'status' => 'feita',
            'user_id' => 1
        ];
        
        $response = $this->post('/tarefas/cadastrar', $task);
        
        $response->assertRedirect('/login');
    }
    
    /**
     * Testa se as colunas do model Task estão corretas
     */
    public function test_if_task_columns_is_correct()
    {
        //Campos esperados ao cadastrar uma tarefa
        $expectedFillableFields = [
            'text',
            'status',
            'user_id'
        ];

        //Instanciando Model
        $task = new Task();

        //Verificando se há diferença entre os campos
        $arrayCompare = array_diff($expectedFillableFields, $task->getFillable());

        //Assegurando que não há diferença entre os campos
        $this->assertEquals(0, count($arrayCompare));
    }


}
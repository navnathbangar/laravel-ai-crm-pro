<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_task_page_loads()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get(route('tasks.index'));

        $response->assertStatus(200);
    }

    public function test_task_create_page_loads()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get(route('tasks.create'));

        $response->assertStatus(200);
    }

    public function test_task_can_be_created()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post(route('tasks.store'), [

                'task_code' => 'TASK001',
                'title' => 'Laravel Testing',
                'assigned_to' => 'Navnath',
                'priority' => 'High',
                'status' => 'Pending',
                'start_date' => now()->format('Y-m-d'),
                'due_date' => now()->addDays(7)->format('Y-m-d'),
                'description' => 'Task Description',

            ]);

        $response->assertRedirect(route('tasks.index'));

        $this->assertDatabaseHas('tasks', [
            'task_code' => 'TASK001',
            'title' => 'Laravel Testing',
        ]);
    }

    public function test_task_can_be_updated()
    {
        $user = User::factory()->create();

        $task = Task::factory()->create();

        $response = $this->actingAs($user)
            ->put(route('tasks.update', $task), [

                'task_code' => $task->task_code,
                'title' => 'Updated Task',
                'assigned_to' => 'Admin',
                'priority' => 'Medium',
                'status' => 'In Progress',
                'start_date' => now()->format('Y-m-d'),
                'due_date' => now()->addDays(5)->format('Y-m-d'),
                'description' => 'Updated Description',

            ]);

        $response->assertRedirect(route('tasks.index'));

        $this->assertDatabaseHas('tasks', [
            'title' => 'Updated Task',
        ]);
    }

    public function test_task_can_be_deleted()
    {
        $user = User::factory()->create();

        $task = Task::factory()->create();

        $response = $this->actingAs($user)
            ->delete(route('tasks.destroy', $task));

        $response->assertRedirect();

        $this->assertSoftDeleted($task);
    }

    public function test_task_can_be_restored()
    {
        $user = User::factory()->create();

        $task = Task::factory()->create();

        $task->delete();

        $response = $this->actingAs($user)
            ->post(route('tasks.restore', $task->id));

        $response->assertRedirect();

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'deleted_at' => null,
        ]);
    }

    public function test_task_can_be_force_deleted()
    {
        $user = User::factory()->create();

        $task = Task::factory()->create();

        $task->delete();

        $response = $this->actingAs($user)
            ->delete(route('tasks.forceDelete', $task->id));

        $response->assertRedirect();

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }

    public function test_task_search()
    {
        $user = User::factory()->create();

        Task::factory()->create([
            'title' => 'Laravel Project'
        ]);

        Task::factory()->create([
            'title' => 'React Project'
        ]);

        $response = $this->actingAs($user)
            ->get('/tasks?search=Laravel');

        $response->assertSee('Laravel Project');

        $response->assertDontSee('React Project');
    }

    public function test_task_excel_export_page_loads()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get(route('tasks.export.excel'));

        $response->assertOk();
    }

    public function test_task_pdf_export_page_loads()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get(route('tasks.export.pdf'));

        $response->assertOk();
    }

    public function test_title_is_required()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post(route('tasks.store'), [

                'task_code' => 'TASK100',
                'title' => '',

            ]);

        $response->assertSessionHasErrors('title');
    }

    public function test_task_code_must_be_unique()
    {
        Task::factory()->create([
            'task_code' => 'TASK001'
        ]);

        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post(route('tasks.store'), [

                'task_code' => 'TASK001',
                'title' => 'Duplicate Task',
                'priority' => 'High',
                'status' => 'Pending',
                'start_date' => now()->format('Y-m-d'),
                'due_date' => now()->addDays(2)->format('Y-m-d'),

            ]);

        $response->assertSessionHasErrors('task_code');
    }

    public function test_guest_cannot_access_task_module()
    {
        $response = $this->get(route('tasks.index'));

        $response->assertRedirect('/login');
    }

    public function test_guest_cannot_create_task()
    {
        $response = $this->post(route('tasks.store'));

        $response->assertRedirect('/login');
    }
}
<?php

namespace Tests\Unit;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_task_can_be_created()
    {
        $task = Task::factory()->create();

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
        ]);
    }

    public function test_fillable_attributes()
    {
        $task = new Task();

        $this->assertEquals([
            'task_code',
            'title',
            'description',
            'assigned_to',
            'priority',
            'status',
            'start_date',
            'due_date',
            'completed_at',
        ], $task->getFillable());
    }

    public function test_soft_deletes_trait_is_used()
    {
        $task = Task::factory()->create();

        $task->delete();

        $this->assertSoftDeleted('tasks', [
            'id' => $task->id,
        ]);
    }

    public function test_task_can_be_updated()
    {
        $task = Task::factory()->create();

        $task->update([
            'title' => 'Updated Task',
        ]);

        $this->assertDatabaseHas('tasks', [
            'title' => 'Updated Task',
        ]);
    }

    public function test_task_can_be_force_deleted()
    {
        $task = Task::factory()->create();

        $task->forceDelete();

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }

    public function test_task_factory_returns_model()
    {
        $task = Task::factory()->make();

        $this->assertInstanceOf(Task::class, $task);
    }

    public function test_task_dates_are_casted()
    {
        $task = Task::factory()->create();

        $this->assertNotNull($task->start_date);
        $this->assertNotNull($task->due_date);
    }
}
<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function task_can_be_assigned_to_project(): void
    {
        $project = Project::factory()->create();
        $task = Task::factory()->create();

        $task->project()->associate($project);
        $task->save();

        $this->assertEquals($project->id, $task->project_id);
    }

    #[Test]
    public function user_can_be_assigned_to_task(): void
    {
        $task = Task::factory()->create();
        $user = User::factory()->create();

        $task->user()->associate($user);
        $task->save();

        $this->assertEquals($user->id, $task->user_id);
    }
}

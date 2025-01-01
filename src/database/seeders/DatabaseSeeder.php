<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->seedUsers();
        $this->seedProjects();
        $this->seedTaskStatuses();
        $this->seedTasks();
    }

    private function seedUsers(): void
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password1'),
        ]);

        User::factory()->create([
            'name' => 'user one',
            'email' => 'userone@example.com',
            'password' => Hash::make('password1'),
        ]);

        User::factory()->create([
            'name' => 'foo bar user',
            'email' => 'foobaruser@example.com',
            'password' => Hash::make('password1'),
        ]);

        User::factory()->create([
            'name' => 'another user',
            'email' => 'anotheruser@example.com',
            'password' => Hash::make('password1'),
        ]);
    }

    private function seedProjects(): void
    {
        Project::factory()->createMany(
        [
            ['name' => 'Project number uno'],
            ['name' => 'Small project'],
            ['name' => 'SECRET PROJECT', 'end_date' => (new \DateTime())->format('Y-m-d')],
        ]);
    }

    private function seedTasks(): void
    {
        Task::factory()->createMany(
            [
                ['name' => 'Task 1',
                    'project_id' => 1,
                    'status_id' => 1,
                    'user_id' => 2],
                ['name' => 'Second task',
                    'project_id' => 1,
                    'status_id' => 1,
                    'user_id' => 2],
                ['name' => 'Another one',
                    'project_id' => 1,
                    'status_id' => 1,
                    'user_id' => 3],
                ['name' => 'Looong task',
                    'project_id' => 2,
                    'status_id' => 1,
                    'user_id' => 4],
                ['name' => 'Lonely task 1',
                    'project_id' => null,
                    'status_id' => 1,
                    'user_id' => 4],
                ['name' => 'Another Lonely task',
                    'project_id' => null,
                    'status_id' => 1,
                    'user_id' => 4],
                ['name' => 'FINISHED TASK',
                    'project_id' => 3,
                    'status_id' => 3,
                    'end_date' => (new \DateTime())->format('Y-m-d'),
                    'user_id' => 2],
            ]);
    }

    private function seedTaskStatuses(): void
    {
        TaskStatus::factory()->createMany(
            [
                ['name' => 'do zrobienia'], # this should be in english and be translated
                ['name' => 'w trakcie'],
                ['name' => 'zakończone'],
            ]
        );
    }
}

<?php

namespace App\Domains\Projects\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domains\Projects\Models\Task;
use App\Domains\Projects\Models\TaskComment;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaskComment>
 */
class TaskCommentFactory extends Factory
{ 
    protected $model = TaskComment::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'tenant_id'   => fake()->numberBetween(1, 100),
            'user_id'     => fake()->numberBetween(1, 200),
            'task_id'     => Task::inRandomOrder()->first()?->id ?? 1,
            'body'        => fake()->paragraph(),
            'attchments'  => fake()->optional()->randomElements(
                ['uploads/file1.pdf', 'uploads/image.jpg'], fake()->numberBetween(0, 3)
            ),
        ];
    }
}

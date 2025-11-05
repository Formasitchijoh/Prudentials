<?php

namespace App\Domains\Projects\Database\factories;   // ← fixed

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domains\Projects\Models\Project;
use App\Domains\Projects\Models\Task; // By Updating the namespace of Task in the Model Directory is is automaticalle detected here
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tenant_id'         => fake()->numberBetween(1, 100),
            'project_id'        => Project::inRandomOrder()->first()?->id ?? 1,
            'milestone_id'      => fake()->optional()->numberBetween(1, 50),
            'title'             => fake()->sentence(4),
            'description'       => fake()->paragraph(),
            'type'              => fake()->randomElement(['task', 'bug', 'feature']),
            'assignee_id'       => fake()->optional()->numberBetween(1, 200),
            'reporter_id'       => fake()->optional()->numberBetween(1, 200),
            'status'            => fake()->randomElement(['todo', 'in_progress', 'blocked', 'review', 'done']),
            'priority'          => fake()->randomElement(['low', 'medium', 'high', 'critical']),
            'estimated_hours'   => fake()->optional()->randomFloat(2, 0, 100),
            'actual_hours'      => fake()->optional()->randomFloat(2, 0, 100),
        ];
    }
}

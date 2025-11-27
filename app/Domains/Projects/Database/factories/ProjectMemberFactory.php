<?php

namespace App\Domains\Projects\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domains\Projects\Models\Project;
use App\Domains\Projects\Models\ProjectMember;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProjectMember>
 */
class ProjectMemberFactory extends Factory
{   
    protected $model = ProjectMember::class;
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
            'user_id'           => fake()->numberBetween(1, 100),
            'role_id'           => fake()->randomElement([1,2,3]),
        ];
    }
}

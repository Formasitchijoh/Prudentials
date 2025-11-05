<?php

namespace App\Domains\Projects\Database\factories;   // ← fixed

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domains\Projects\Models\Project;              // correct import

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domains\Projects\Models\Project>
 */
class ProjectFactory extends Factory
{
    /** @var class-string<\App\Domains\Projects\Models\Project> */
    protected $model = Project::class;               // explicit link

    public function definition(): array
    {
        return [
            'name'        => fake()->jobTitle(),
            'description' => fake()->text(100),
            'tenant_id'   => fake()->numberBetween(10, 1000),
            'slug'        => fake()->text(20),
            'owner_id'    => fake()->numberBetween(10, 1000),
            'status'      => 'approved',
        ];
    }
}
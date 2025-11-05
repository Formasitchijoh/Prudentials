<?php

namespace App\Domains\Projects\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domains\Projects\Models\Project;            // correct import
use App\Domains\Projects\Models\ProjectDocument; 
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProjectDocument>
 */
class ProjectDocumentFactory extends Factory
{ 
    protected $model = ProjectDocument::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'tenant_id'     => fake()->numberBetween(1, 100),
            'project_id'    => Project::inRandomOrder()->first()?->id ?? 1,
            'name'          => fake()->words(3, true) . '.' . fake()->fileExtension(),
            'type'          => fake()->mimeType(),
            'storage_path'  => fake()->filePath(),
            'uploaded_by'   => fake()->numberBetween(1, 200),
        ];
    }
}

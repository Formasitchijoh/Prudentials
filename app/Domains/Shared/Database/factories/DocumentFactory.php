<?php

namespace App\Domains\Shared\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */

class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tenant_id'     => fake()->numberBetween(1, 100),
            'name'          => fake()->words(3, true) . '.' . fake()->fileExtension(),
            'type'          => fake()->mimeType(),
            'storage_path'  => fake()->filePath(),
            'uploaded_by'   => fake()->numberBetween(1, 200),

        ];
    }
}

<?php

namespace App\Domains\Projects\Database\seeders;

use Illuminate\Database\Seeder;
use App\Domains\Projects\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // The HasAttached method is for hasMany Relationships OR many-to-many relationship 
        Project::factory(20)->create();
    }
}

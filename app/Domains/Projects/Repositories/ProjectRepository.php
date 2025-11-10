<?php 

namespace App\Domains\Projects\Repositories;

use App\Domains\Projects\Models\Project;
use \Illuminate\Database\Eloquent\Collection;


class ProjectRepository
{

    public function create(array $project)
    {
        return Project::create($project);
    }

    public function getAll()
    {
        return Project::latest()->get();
    }

    /**
     * Find a Project by it's ID 
     */

}
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
    public function update(array $project, int $id)
    {
        return Project::where('id', $id)->update($project);
    }

    public function delete(int $id) 
    {
        return Project::where('id', $id)->delete();
    }

    /**
     * Find a Project by it's ID 
     */

}
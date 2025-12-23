<?php


namespace App\Domains\Projects\Services;

use App\Domains\Projects\Repositories\ProjectRepository;

use App\Domains\Projects\Models\Project;

class ProjectService
{
    protected $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
        // These repository are not passed they are type hinted into the 
        // Service to inject the repository dependenyc into the service 
    }

    public function create(array $project)
    {
        return $this->projectRepository->create($project);
    }

    public function update(array $project, int $id)
    {
        return $this->projectRepository->update($project, $id);
    }

    public function delete(int $id) 
    {
        return $this->projectRepository->delete($id);
    }

    public function getAllProjects()
    {
        return $this->projectRepository->getAll();
    }
}
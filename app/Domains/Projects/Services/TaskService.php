<?php


namespace App\Domains\Projects\Services;

use App\Domains\Projects\Repositories\TaskRepository;

use App\Domains\Projects\Models\Task;

class TaskService
{
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
        // These repository are not passed they are type hinted into the 
        // Service to inject the repository dependenycy into the service 
    }

    public function create(array $tasks)
    {
        return $this->taskRepository->create($tasks);
    }

    public function getAllTasks()
    {
        return $this->taskRepository->getAll();
    }
}
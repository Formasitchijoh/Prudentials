<?php


namespace App\Domains\Projects\Services;

use App\Domains\Projects\Repositories\TaskRepository;

use App\Domains\Projects\Models\Task;
use Illuminate\Http\Request;

class TaskService
{
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
        // These repository are not passed they are type hinted into the 
        // Service to inject the repository dependenycy into the service 
    }

    public function create(Request $request)
    {
        return $this->taskRepository->create($request);
    }

    public function getAllTasks()
    {
        return $this->taskRepository->getAll();
    }

    public function findTask($taskId)
    {
        return $this->taskRepository->findById($taskId);
    }
}
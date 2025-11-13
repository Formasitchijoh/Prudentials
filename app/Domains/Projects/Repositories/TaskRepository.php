<?php

namespace App\Domains\Projects\Repositories;

use App\Domains\Projects\Models\Task;

class TaskRepository
{
    public function create(array $task)
    {
        return Task::create($task);
    }

    public function getAll()
    {
        return Task::latest()->get();
    }
}

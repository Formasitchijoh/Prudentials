<?php

namespace App\Domains\Projects\Repositories;

use App\Domains\Projects\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use App\Domains\Projects\Repositories\TaskMemberRepository as RepositoriesTaskMemberRepository;

class TaskRepository
{
    public function create(Request $request)
    {
        $validatedTask = $request->validate([
            'tenant_id' => 'required',
            'project_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'type' => 'required',
            'assignee_id' => 'required|exists:users,id',
            'reporter_id' => 'required|exists:users,id',
            'status' => 'required',
            'priority' => 'required',
            'estimated_hours' => 'required',
            'actual_hours' => 'required'

        ]);
        $task =  Task::create($validatedTask);
        if ($validatedTask['assignee_id']) {
            RepositoriesTaskMemberRepository::addTaskMember([
                'tenant_id' => $validatedTask['tenant_id'],
                'user_id' => $validatedTask['assignee_id'],
                'task_id' => $task[0]->id,
            ]);
        }
        return $task;
    }

    public function getAll()
    {
        return Task::latest()->get();
    }

    public function findById($taskId)
    {
        $task = Task::with(['comments', 'documents'])->find($taskId);
        return $task;
    }
}

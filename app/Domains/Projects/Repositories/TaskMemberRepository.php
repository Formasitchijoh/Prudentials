<?php

namespace App\Domains\Projects\Repositories;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Domains\Projects\Models\TaskMember;
use Illuminate\Http\Request;
use App\Domains\Projects\Models\Task;
use Illuminate\Validation\Rule;

class TaskMemberRepository
{

    //  Adding existing members to this Task
    // Members could be users of the project


    public function getAppMembers()
    {
        return TaskMember::latest()->get();
    }

    public function getAllTaskMembers()
    {
        return TaskMember::latest()->get();
    }

    public function addTaskMembers(Request $request)
    {
        $validatedMember = $request->validate([
            'tenant_id' => 'required|exists:tenants,id',
            'user_id' => 'required|exists:users,id',
            'task_id' => 'required|exists:tasks,id',
            'user_id' => Rule::unique('task_members')->where(function ($query) use ($request) {
                return $query->where('task_id', $request->task_id);
            }),
        ]);

        TaskMember::create($validatedMember);
    }
    public static function addTaskMember(array $taskMember)
    {
        // $validatedMember = $request->validate([
        //     'tenant_id' => 'required|exists:tenants,id',
        //     'user_id' => 'required|exists:users,id',
        //     'task_id' => 'required|exists:tasks,id',
        //     'user_id' => Rule::unique('task_members')->where(function ($query) use ($request){
        //         return $query->where('task_id', $request->task_id);
        //     }),
        // ]);

        TaskMember::create($taskMember);
    }
}

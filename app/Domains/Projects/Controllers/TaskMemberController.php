<?php

namespace App\Domains\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Domains\Projects\Services\TaskMemberService;
use Illuminate\Http\Request;

class TaskMemberController extends Controller
{
    
    protected $taskMemberService;

    public function __construct(TaskMemberService $taskMemberService)
    {
        $this->taskMemberService = $taskMemberService;
    }

    public function index()
    {
        $taskMembers = $this->taskMemberService->getTaskMembers();
        return response()->json($taskMembers);
    }


    public function store(Request $request)
    {
        $this->taskMemberService->addTaskMembers($request);
        return response()->json(['message' => 'Member added successfully'], 201);
    }
}

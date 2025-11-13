<?php

namespace App\Domains\Projects\Controllers;

use App\Domains\Projects\Services\TaskService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
        
    }

    public function index()
    {
        $tasks = $this->taskService->getAllTasks();
        return response()->json($tasks);
    }

    
    public function store(Request $request)
    {
        return $this->taskService->create($request->all());
    }
}

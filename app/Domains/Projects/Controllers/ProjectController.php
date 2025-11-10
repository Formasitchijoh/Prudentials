<?php

namespace App\Domains\Projects\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domains\Projects\Services\ProjectService;

use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    protected $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function index()
    {
        $projects = $this->projectService->getAllProjects();
        return response()->json($projects);
    }

    public function store(Request $request)
    {
        Log::info($request);
        return $this->projectService->create($request->all());
    }
}

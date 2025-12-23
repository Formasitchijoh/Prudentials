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

    public function index(Request $request)
    {
        $requestIps = $request->cookie('auth_token');
        Log::info($requestIps);
        // return view('dashboard');
        $projects = $this->projectService->getAllProjects();
        return response()->json($projects);
    }

    public function store(Request $request)
    {
        return $this->projectService->create($request->all());
    }

    public function update(Request $request, int $id)
    {
        $project = $this->projectService->update($request->all(), $id);
        if($project == 0) {
        return response()->json(['message' => 'Project could not be updated']);
        } 
        return response()->json(['message' => 'Project updated successuflly']);
    }
    public function delete($id)
    {
        $this->projectService->delete($id);
        return response()->json(['message' => 'Project deleted Successfully']);
    }
}

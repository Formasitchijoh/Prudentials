<?php

namespace App\Domains\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Domains\Projects\Services\ProjectMemberService;
use Illuminate\Http\Request;
class ProjectMemberController extends Controller
{
    
    protected $projectMemberService;

    public function __construct(ProjectMemberService $projectMemberService)
    {
        $this->projectMemberService = $projectMemberService;
    }

    public function index()
    {
        $projectMembers = $this->projectMemberService->getAllMembers();
        return response()->json($projectMembers);
    }

    public function store(Request $request)
    {
        return $this->projectMemberService->addProjectMember($request);
    }
}

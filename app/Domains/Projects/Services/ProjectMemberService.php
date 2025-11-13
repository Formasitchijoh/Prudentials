<?php


namespace App\Domains\Projects\Services;

use App\Domains\Projects\Repositories\ProjectMemberRepository;
use Illuminate\Http\Request;
class ProjectMemberService
{
    protected $projectMemberRepository;

    public function __construct(ProjectMemberRepository $projectMemberRepository)
    {
        $this->projectMemberRepository = $projectMemberRepository;
        // These repository are not passed they are type hinted into the 
        // Service to inject the repository dependenyc into the service 
    }

    public function addProjectMember(Request $request)
    {
        return $this->projectMemberRepository->addProjectMember($request);
    }

    public function getAllMembers()
    {
        return $this->projectMemberRepository->getAllMembers();
    }

    public function addExistingMember(Request $request)
    {
        return $this->projectMemberRepository->addExistingMember($request);
    }
}
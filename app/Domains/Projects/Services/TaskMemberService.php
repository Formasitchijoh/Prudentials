<?php 

namespace App\Domains\Projects\Services;
use App\Domains\Projects\Repositories\TaskMemberRepository;
use Illuminate\Http\Request;

class TaskMemberService
{
    protected $taskMemberRepository;

    public function __construct(TaskMemberRepository $taskMemberRepository)
    {
        $this->taskMemberRepository = $taskMemberRepository;
    }
    public function getTaskMembers()
    {
        return $this->taskMemberRepository->getAllTaskMembers();
    }

    public function addTaskMembers(Request $request)
    {
        return  $this->taskMemberRepository->addTaskMembers($request);
    }

}
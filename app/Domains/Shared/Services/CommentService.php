<?php

namespace App\Domains\Shared\Services;
use App\Domains\Shared\Repositories\CommentRepository;
use Illuminate\Http\Request;

class CommentService
{
    protected $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function create(Request $request)
    {
        return $this->commentRepository->createComment($request);
    }

    public function getAllComments()
    {
        return $this->commentRepository->getAllComments();
    }

    public function commentsFiles()
    {
        return $this->commentRepository->commentsFiles();
    }
}
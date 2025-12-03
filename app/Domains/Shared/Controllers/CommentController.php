<?php

namespace App\Domains\Shared\Controllers;
use App\Http\Controllers\Controller;
use App\Domains\Shared\Services\CommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function index()
    {
        $comments = $this->commentService->getAllComments();
        // Log::info($comments);
        return response()->json($comments,200);
    }

    public function store(Request $request)
    {
        $this->commentService->create($request);
        return response()->json(['message' => "Comment added successfully"]);
    }

    public function commentFiles()
    {
        $documents = $this->commentService->commentsFiles();
        return response()->json($documents);
    }
}

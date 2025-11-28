<?php

namespace App\Domains\Shared\Repositories;

use App\Domains\Shared\Models\Comment;
use Illuminate\Http\Request; // Add this
use Illuminate\Support\Facades\Log;

class CommentRepository
{

    public function createComment(Request $request)
    {
        $comment = $request->validate([
            'tenant_id' => 'required|exists:tenants,id',
            'body' => 'required',
            'commentable_id' => 'required',
            'commentable_type' => 'required',
            'user_id' => 'required'
        ]);

        Log::info($request);
        return Comment::create($comment);
    }

    public function getAllComments()
    {
        $comment = Comment::findOrFail(1);

        return $comment->commentable;
    }
}

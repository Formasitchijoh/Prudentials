<?php

namespace App\Domains\Shared\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * 
 * This model has a polymorphic relation as it can belong to many other models like task, etc 
 */
class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;

    /**
     * Get the parent commentable model (task or project)
     * Morphing to x
     * 
     * To Retrieve the parent of a polymorphic child model, access the name of the methos that perfomed 
     * the call to morphTo which in this case is the commentable method on the Comment model 
     */

    /**
     * This is the method that will link to the comment class to all other polymorphic class
     * That will implement a method that call it for a one-to-many polymorphic relationship 
     */

    public function commentable():MorphTo
    {
        return $this->morphTo();
    }


}

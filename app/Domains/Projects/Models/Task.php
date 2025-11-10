<?php

namespace App\Domains\Projects\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany; // One to many morph
use Illuminate\Database\Eloquent\Relations\MorphToMany; // Many to Many morph 

use Illuminate\Database\Eloquent\Model;
use App\Domains\Projects\Models\Project;
use App\Domains\Shared\Models\Tag;

use App\Domains\Shared\Models\Comment;
use App\Models\User;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    
    /**
     * Get att of the post comments
     */

    public function comments():MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable')->chaperone();
    }

    public function members()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get all of the tags for the task
     * Many to many relationships for a polymorphic model whose interface can be shared and accessed independenly to
     * for each object
     */

    public function tags():MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}

<?php

namespace App\Domains\Projects\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Domains\Projects\Models\Task;
use App\Domains\Projects\Models\ProjectMember;
use App\Domains\Shared\Models\Comment;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\Domains\Projects\Models\ProjectFactory> */
    use HasFactory;

    /**
     * Indicates if the model's ID is auto-incrementing
     * 
     * @var bool
     */
    // protected $guard = [];
    /**
     * This is the main relationshhip to @User via pivot table projectMmembers
     * @belongsToMany relationship is a relationhip between two tables that have a many to many relationship
     */

    // public function members()
    // {
    //     // The pivot table here is the project_members table
    //     // By default on the model key will be presnt on the ->pivot model to 
    //     // if intermediate table contains extra attributes you must specify then using the ->withPivot
    //     return $this->belongsToMany(User::class,'project_members')
    //         ->using(ProjectMember::class) // This correspond to the custom intermediate table that specifies the pivot table slass
    //         ->withPivot(['role, tenant_id']) // specifies other columns of that table
    //         ->withTimestamps(); // allows eloquent to handle the created_at and updated_at time of the  pivot table
    // }

    public function members()
    {
        return $this->belongsToMany(User::class, 'project_members', 'project_id', 'user_id')
            ->using(ProjectMember::class)
            ->withPivot(['tenant_id', 'role'])
            ->withTimestamps();
    }
    /**
     * Get att of the post comments
     * // This morph relationship means that a commant can belong to a project, a task etc
     * Hence when retrieving a comment it determines which model it is related to
     */

    /**
     * morphOne are used to retrieve of the rows of the relation between the two tables 
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable')->chaperone();
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // Keep this on hold this relationship does not make sense for now
    public function projectMembers()
    {
        return $this->hasMany(ProjectMember::class);
    }
}

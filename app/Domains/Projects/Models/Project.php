<?php

namespace App\Domains\Projects\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Domains\Projects\Models\Task;
use App\Domains\Projects\Models\ProjectMember;
use App\Domains\Shared\Models\Comment;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\Domains\Projects\Models\ProjectFactory> */
    use HasUuids, HasFactory;

    /**
     * Indicates if the model's ID is auto-incrementing
     * 
     * @var bool
     */
    protected $keyType = 'string';
    public $incrementing = false;
    // protected $guard = [];
    /**
     * This is the main relationshhip to @User via pivot table projectMmembers
     * @belongsToMany relationship is a relationhip between two tables that have a many to many relationship
     */

    public function members()
    {
        // The pivot table here is the project_members table
        // By default on the model key will be presnt on the ->pivot model to 
        // if intermediate table contains extra attributes you must specify then using the ->withPivot
        return $this->belongsToMany(User::class)
            ->using(ProjectMember::class) // This correspond to the custom intermediate table that specifies the pivot table slass
            ->as('members')
            ->withPivot(['role']) // specifies other columns of that table
            ->withTimestamps(); // allows eloquent to handle the created_at and updated_at time of the  pivot table
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

    // Auto-generate UUID on creating
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {
    //         if (empty($model->id)) {
    //             $model->id = (string) Str::uuid();
    //         }
    //     });
    // }
}

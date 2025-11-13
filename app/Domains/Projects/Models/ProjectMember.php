<?php

namespace App\Domains\Projects\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Domains\Projects\Models\Project;
use App\Models\User;

/**
 * Because this is a pivot table it should extend the pivot class
 * 
 * These models cannot use the softdelete trait if you need it consider converting $this->
 * into an actual Eloquent model;
 */
class ProjectMember extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectMemberFactory> */
    use HasFactory;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    
    // public $incrementing = true;

    public function projects()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

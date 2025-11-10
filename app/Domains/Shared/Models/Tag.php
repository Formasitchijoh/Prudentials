<?php

namespace App\Domains\Shared\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

use App\Domains\Projects\Models\Task;
use App\Domains\Projects\Models\Project;


class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;

    /**
     * Get all of the post that are assigned this tag
     * ** Eloquent relationhips are defined via method_existsYou may call those methods ot obtain an instanc of the relationship
     * withouf actuall executing a query to load the related models
     */

    public function tasks():MorphToMany
    {
        return $this->morphedByMany(Task::class, 'taggable');
    }

    /**
     * Get all of the Projects that are assigned this tag
     */

    public function projects():MorphToMany
    {
        return $this->morphedByMany(Project::class, 'taggable');
    }


}

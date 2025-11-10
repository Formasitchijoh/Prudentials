<?php

namespace App\Domains\Projects\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;


class TaskMember extends Model
{
    /** @use HasFactory<\Database\Factories\TaskMemberFactory> */
    use HasFactory;
    public $incrementing = true;

}

<?php

namespace App\Domains\Shared\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taggable extends Model
{
    /** @use HasFactory<\Database\Factories\TaggableFactory> */
    use HasFactory;
}

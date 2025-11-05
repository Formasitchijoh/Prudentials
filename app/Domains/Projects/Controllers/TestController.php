<?php

namespace App\Domains\Projects\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domains\Projects\Models\Project;

class TestController extends Controller
{
    public function __invoke()
    {
        $project = Project::first();
        dd($project->description);
    }


}

<?php

namespace App\Domains\Projects\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domains\Projects\Models\Project;

class ProjectController extends Controller
{
    public function __contructor()
    {

    }

    public function index()
    {
        $projects = Project::latest()->get();
        
        return view('projects.index', [
            'projects' => $projects
        ]);
    }
}

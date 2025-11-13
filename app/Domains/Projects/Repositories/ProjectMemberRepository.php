<?php

namespace App\Domains\Projects\Repositories;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Domains\Projects\Models\ProjectMember;
use Illuminate\Http\Request; // Add this
use App\Domains\Projects\Models\Project;
use Illuminate\Support\Facades\Log;

class ProjectMemberRepository
{

    // Add a new Member to the project
    // create a User, then for that project(Project_id) create a Project Member


    // Add existing Users to a project
    // Query and return the user info(user_id) , for that project(project_id) create a project Member

    public function getAllMembers()
    {
        return ProjectMember::latest()->get();
    }


    public function addProjectMember(Request $request)
    {

        $validatedMember = $request->validate([
            'tenant_id' => 'required',
            'project_id' => 'required',
            'role' => 'required',
        ]);
        $isnewUser = $request->has('email') && $request->has('name');

        $project = Project::findOrFail($validatedMember['project_id']);

        if ($isnewUser) {
            $validatedUser = $request->validate([
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|confirmed'
            ]);

            $user = User::create([
                'name' => $validatedUser['name'],
                'email' => $validatedUser['email'],
                'password' => Hash::make($validatedUser['password'])
            ]);

            $pivot = ProjectMember::create([
                'tenant_id' => $validatedMember['tenant_id'],
                'project_id' => $project->id,
                'user_id' => $user->id,
                'role' => $validatedMember['role'],
            ]);

            return $pivot;

        } else if ($request->has('user_id')) {

            $user = User::findOrFail($request['user_id']); // get the user id passed and return it
            $pivot = ProjectMember::create([
                'tenant_id' => $validatedMember['tenant_id'],
                'project_id' => $project->id,
                'user_id' => $user->id,
                'role' => $validatedMember['role'],
            ]);

            return $pivot;
        }
    }
}

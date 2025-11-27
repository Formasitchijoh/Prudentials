<?php

namespace App\Domains\Projects\Repositories;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Domains\Projects\Models\ProjectMember;
use Illuminate\Http\Request; // Add this
use App\Domains\Projects\Models\Project;
use App\Models\Role;
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
            'tenant_id' => 'required|exists:tenants,id',
            'project_id' => 'required|exists:projects,id',
            'role_id' => 'required|exists:roles,id',
            // Also validate the project role name field if it is in the request
            // 'project_role' => 'required|string', 
        ]);
        $project = Project::findOrFail($validatedMember['project_id']);
        $role = Role::findOrFail($validatedMember['role_id']);
        Log::info($role);
        $isnewUser = $request->has('email') && $request->has('name');
        

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

            $user->roles()->attach($validatedMember['role_id']);

            $pivot = ProjectMember::create([
                'tenant_id' => $validatedMember['tenant_id'],
                'project_id' => $project->id,
                'user_id' => $user->id,
                'role_id' => $role->id,
            ]);

            return $pivot;
        } else if ($request->has('user_id')) {

            $user = User::findOrFail($request['user_id']); // get the user id passed and return it

            if (ProjectMember::where('user_id', $user->id)->where('project_id', $project->id)->exists()) {
                abort(409, 'User is already a member of this project');
            }

            $hasRole = $user->roles()->where('role_id', $validatedMember['role_id'])->exists();

            if ($hasRole) {
                abort(409, 'User already has this role');
            }

            $user->roles()->attach($validatedMember['role_id']);

            $pivot = ProjectMember::create([
                'tenant_id' => $validatedMember['tenant_id'],
                'project_id' => $project->id,
                'user_id' => $user->id,
                'role_id' => $role->id,
            ]);

            return $pivot;
        }
    }
}

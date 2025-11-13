<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Log;


/**
 * Protecting routes, attach the sanctum authentication guard to your protected routes in the web.php and api.php route filesize
 * This guare ensure theta incoming request are authenticated as either stateful, coolie authenticated request or
 * Contain a valid APi token header is the request os from a thrid party 
 * 
 * Authenticating all request using Sanctum ensure that we may always call the tokenCan methods on the currently authenticated user instance
 */

class AuthController extends Controller
{

    public function index()
    {
        //
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);
        Log::info('This is an informational message.');
        
        $user =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        Log::info($user);
        // We are using an APi service so we use the response
        return response()->json(['message' => 'User registered successfully']);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('authToken')->plainTextToken;
        return response()->json(['token' => $token]);
    }

    public function userInfo(Request $request)
    {
        return response()->json($request->user());
    }

    public function logOut(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}

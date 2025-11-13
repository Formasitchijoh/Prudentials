<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;

class TenantController extends Controller
{
    public function index()
    {
        $tenant = Tenant::latest()->get();
        return response()->json($tenant,200);
    }
    
    public function store(Request $request)
    {
        Tenant::create($request->all());

        return response()->json(['Message' => 'Tenant created Successully']);
    }
}

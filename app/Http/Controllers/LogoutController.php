<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function post(Request $request)
    {
        Auth::auth('api')->logout();
        // Auth::logout();
        return response()->json(['auth' => false], 200);
    }
}

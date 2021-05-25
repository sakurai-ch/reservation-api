<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function post(Request $request)
    {
        $items = User::where('email', $request->email)->first();
        $token = Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        if ($token) {
            return response()->json([
                'id' => $items->id,
                'auth' => true,
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => Auth::factory()->getTTL() * 60
            ], 200);
        } else {
            return response()->json(['auth' => false], 401);
        }
    }
}

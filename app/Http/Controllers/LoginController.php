<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function post(Request $request)
    {
        $items = User::where('email', $request->email)->first();
        // $check = Hash::check($request->password, $items->password);

        // if (!$token = Auth::guard('api')
        // ->attempt(['email' => $request->email, 'password' => $request->password])) {
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }

        $token = Auth::guard('api')->attempt(['email' => $request->email, 'password' => $request->password]);

        // if ($check) {
        if ($token) {
            return response()->json([
                'id' => $items->id,
                'auth' => true,
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => Auth::guard('api')->factory()->getTTL() * 60
            ], 200);
        } else {
            return response()->json(['auth' => false], 401);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function post(Request $request)
    {
        $items = User::where('email', $request->email)->first();
        $check = Hash::check($request->password, $items->password);
        if ($check) {
            return response()->json([
                'id' => $items->id,
                'auth' => true
            ], 200);
        } else {
            return response()->json(['auth' => false], 401);
        }
    }
}

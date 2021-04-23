<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function get(Request $request)
    {
        if ($request->has('user_id')) {
            $items = User::find($request->user_id)();
            $param = [
                'id' => $items->id,
                'user_name' => $items->user_name,
                'email' => $items->email
            ];
            return response()->json([
                'message' => 'User got successfully',
                'data' => $param
            ], 200);
        } else {
            return response()->json(['status' => 'not found'], 401);
        }
    }
    
    public function post(Request $request)
    {
        $check = User::where('email', $request->email)->exists();
        if(!$check){
            $hashed_password = Hash::make($request->password);
            $param = User::create([
                'user_name' => $request->user_name,
                'email' => $request->email,
                'password' => $hashed_password,
            ]);
            return response()->json([
                'message' => 'User created successfully',
                'data' => $param
            ], 201);
        }else{
            return response()->json([
                'message' => 'Email is already registered',
            ], 400);
        }
    }

}

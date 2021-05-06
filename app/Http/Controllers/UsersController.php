<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function get(Request $request)
    {
        if ($request->has('user_id')) {
            $param = User::get_users($request);
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
            $param = User::post_user($request);
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

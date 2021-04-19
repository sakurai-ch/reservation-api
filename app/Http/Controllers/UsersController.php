<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function get(Request $request)
    {
        if ($request->has('user_id')) {
            $items = User::where('user_id', $request->user_id)->first();
            $param = [
                'user_id' => $items->user_id,
                'user_name' => $items->user_name,
                'email' => $items->email
            ];
            return response()->json([
                'message' => 'User got successfully',
                'data' => $param
            ], 200);
        } else {
            return response()->json(['status' => 'not found'], 404);
        }
    }
    
    public function post(Request $request)
    {
        $check = User::where('email', $request->email)->exists();
        if(!$check){
            $now = Carbon::now();
            $hashed_password = Hash::make($request->password);
            $items = [
                'user_name' => $request->user_name,
                'email' => $request->email,
                'password' => $hashed_password,
                'created_at' => $now,
                'updated_at' => $now,
            ];
            User::insert($items);
            $param = User::where('email', $request->email)->first();
            return response()->json([
                'message' => 'User created successfully',
                'data' => $param
            ], 200);
        }else{
            return response()->json([
                'message' => 'Email is already registered',
            ], 400);
        }
    }

}

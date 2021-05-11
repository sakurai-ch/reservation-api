<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function get(Request $request)
    {
        // $param = Auth::guard('api')->user();
        try {
            $param = auth()->userOrFail();
            return response()->json([
                'message' => 'User got successfully',
                'data' => $param
            ], 200);
        } catch(Exception $e) {
            return response()->json(['status' => 'not found'], 401);
        }

        // if ($request->has('user_id')) {
        //     $param = User::get_users($request);
        //     return response()->json([
        //         'message' => 'User got successfully',
        //         'data' => $param
        //     ], 200);
        // } else {
        //     return response()->json(['status' => 'not found'], 401);
        // }
    }
    
    public function post(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|max:191',
            'email' => 'required|email|unique:users,email|max:191',
            'password' => 'required|regex:/^[a-zA-Z0-9]+$/|min:6|max:191',
        ]);
                
        // $check = User::where('email', $request->email)->exists();
        // if(!$check){
        if(!$validator->fails()){
            $param = User::post_user($request);
            return response()->json([
                'message' => 'User created successfully',
                'data' => $param
            ], 201);
        }else{
            return response()->json([
                // 'message' => 'Email is already registered',
                'message' => $validator->errors(),
            ], 400);
        }
    }

}

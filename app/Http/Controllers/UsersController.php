<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function get(Request $request)
    {
        $check = auth()->user()->administrator;
        if (!$check) {
            return response()->json([
                'message' => 'unauthorized',
            ], 401);
        }

        $param = User::get_managers($request);
        return response()->json([
            'message' => 'Manager got successfully',
            'data' => $param
        ], 200);
    }

    public function post(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|max:191',
            'email' => 'required|email|unique:users,email|max:191',
            'password' => 'required|regex:/^[a-zA-Z0-9]+$/|min:6|max:191',
        ]);

        if (!$validator->fails()) {
            $param = User::post_user($request);
            return response()->json([
                'message' => 'User created successfully',
                'data' => $param
            ], 201);
        } else {
            return response()->json([
                'message' => $validator->errors(),
            ], 400);
        }
    }
}

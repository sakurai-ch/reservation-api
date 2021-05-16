<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Models\User; //
use Illuminate\Http\Request;  //

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        // if (!$token = auth('api')->attempt($credentials)) {
        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        // request()->bearerToken();

        // return response()->json(auth()->user());
        // return response()->json(Auth::user());
        return response()->json(['sample'=>'0']);
    }

    // public function me(Request $request)
    // {
    //     if ($request->has('user_id')) {
    //         $param = User::get_users($request);
    //         return response()->json([
    //             'message' => 'User got successfully',
    //             'data' => $param
    //         ], 200);
    //     } else {
    //         return response()->json(['status' => 'not found'], 401);
    //     }
    // }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        // Auth::auth()->logout();

        return response()->json([
            'message' => 'Successfully logged out',
            'auth' => false //
        ]);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
        // return $this->respondWithToken(Auth::auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        $item = Auth::user();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            'user_data' => $item,
            'auth' => true,
        ]);
    }
}

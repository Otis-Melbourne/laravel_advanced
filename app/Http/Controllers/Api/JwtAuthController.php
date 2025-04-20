<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtAuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
        ] );

        if($validator->fails()){
            return response()->json([
                'statusCode' => 400,
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
            ], 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        $user->assignRole('user');

        $token = JWTAuth::fromUser($user);
        return response()->json([
            'statusCode' => 201,
            'message' => 'User registered successfully',
            'data' => [
                'user' => new UserResource($user),
                'token' => $token,
            ],
        ], 201);
    }

    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        try{
            if(!$token = JWTAuth::attempt($credentials)){
                return response()->json([
                    'statusCode' => 401,
                    'message' => 'Invalid credentials',
                ], 401);
            }
        }catch(\Exception $e){
            return response()->json([
                'statusCode' => 500,
                'message' => 'Could not create token',
            ], 500);
        }

        $user = JWTAuth::user();

        return response()->json([
            'statusCode' => 200,
            'message' => 'User logged in successfully',
            'data' => [
                'user' => new UserResource($user),
                'token' => $token,
            ],
        ], 200);
    }

    public function profile(){
        $user = JWTAuth::user();
        return response()->json([
            'statusCode' => 200,
            'message' => 'User got profile successfully',
            'data' => [
                'user' => $user->cheapOrder,
            ],
        ], 200);
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json([
            'statusCode' => 200,
            'message' => 'User logged out successfully',
        ], 200);
    }
}

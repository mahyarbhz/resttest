<?php

namespace App\Http\Controllers;

//use http\Client\Curl\User;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(\App\Http\Requests\RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        $token = $user->createToken('mytoken')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function login(\App\Http\Requests\LoginRequest $request)
    {
        $user = User::all()->where('email', $request['email'])->first();

        if (!$user || !Hash::check($request['password'], $user->password)) {
            return response([
                'message' => 'Your credentials are wrong.'
            ], 401);
        }

        $token = $user->createToken('mytoken')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ], 202);
    }

    public function logout(Request $request)
    {
        Auth::user()->tokens()->delete();
        return response(null, 204);
    }
}

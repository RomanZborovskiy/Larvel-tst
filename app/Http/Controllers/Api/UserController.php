<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function register(StoreUserRequest $request)
    {
        return User::create($request->all());
    }

    public function login(LoginUserRequest $request)
    {
        if(!Auth::attempt($request->only(['email', 'password']))){
            return response()->json([
                'message'=>'Wrong email or password'
            ], 401);
        }

        $user=Auth::user();
        $user->tokens()->delete();
        return new UserResource($user);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->json([
            'message'=>'token delete',    
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Http\Trait\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\LoginResource;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    use ApiResponseTrait;
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(RegisterRequest $request)
    {
        $request->validated();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return $this->customApi(new UserResource($user), 'User created successfully', 200);
    }
    public function login(LoginRequest $request)
    {
        $request->validated();
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return $this->errorApi('Make sure that your email and password are valid', 401);
        }

        $user = Auth::user();
        return response()->json([
            'message' => 'User logged in successfully',
            'user' => $user,
            'token' => $token,
        ]);
        // return $this->customApi(new LoginResource($user), 'User logged in successfully', 200);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'User logged out successfully']);
        //  $user= Auth::logout();
        // return $this->customApi(new UserResource($user), 'User logged out successfully', 200);
    }
    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => ['token' => Auth::refresh(), 'type' => 'bearer']
        ]);
    }
}

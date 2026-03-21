<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class AuthController extends Controller
{
    use HasApiTokens, Notifiable;

    public function index()
    {
        $user = User::all();
        return response()->json($user, 200);
    }
    
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Passport: generate access token
        $token = $user->createToken('authToken')->accessToken;

        return response()->json([
            'user'    => $user,
            'token'   => $token,
            'message' => 'Registration successful'
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Passport: generate access token
        $token = $user->createToken('authToken')->accessToken;

        return response()->json([
            'user'    => $user,
            'token'   => $token,
            'message' => 'Login successful'
        ]);
    }

    public function logout(Request $request)
    {
        if (!$request->user()) {
            return response()->json(['message' => 'No authenticated user'], 401);
        }

        // Passport: revoke current token
        $request->user()->token()->revoke();

        return response()->json(['message' => 'Logged out successfully']);
    }
}

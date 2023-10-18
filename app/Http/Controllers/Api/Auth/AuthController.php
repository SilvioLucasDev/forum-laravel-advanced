<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => 'Email e/ou senha inválido(s)',
            ]);
        }
        $user->tokens()->delete();

        return response()->json([
            'data' => [
                'access_token' => $user->createToken($request->device_name)->plainTextToken,
                'name' => $user->name,
            ],
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json([], 204);
    }

    public function me(Request $request): JsonResponse
    {
        return response()->json([
            'data' => [
                $request->user(),
            ],
        ], 200);
    }
}

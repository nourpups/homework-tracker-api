<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse
    {
        $request->authenticate();

        $user = $request->user();

        $user->tokens()->delete();

        $token = $user->createToken('token');

        return response()->json([
            'user' => $user,
            'token' => $token->plainTextToken,
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

//        $request->session()->invalidate();

        $request->user()->tokens()->delete();

        return response()->noContent();
    }
}

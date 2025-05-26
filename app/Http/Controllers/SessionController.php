<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Session\CreateSession;
use App\Http\Requests\CreateSessionRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function create(CreateSessionRequest $request, CreateSession $action): JsonResponse
    {
        $loginUserData = $request->validated();
        $token = $action->handle($loginUserData['email'], (string) $loginUserData['password']);

        if (!$token) {
            return Response::error('Invalid credentials', 401);
        }

        return Response::created([
            'access_token' => $token->plainTextToken,
            'expires_at' => $token->accessToken->expires_at
        ]);
    }

    public function delete(): Response
    {
        Auth::user()->tokens()->delete();
        return Response::noContent();
    }
}

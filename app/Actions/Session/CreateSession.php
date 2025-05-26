<?php

declare(strict_types=1);

namespace App\Actions\Session;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\NewAccessToken;
class CreateSession
{
    public function handle(
        string $email,
        string $password,
        array $abilities = ['*']
    ): bool|NewAccessToken {
        $user = User::where('email', $email)->first();

        if (!$user)
            return false;
        if (!Hash::check($password, $user->password))
            return false;

        return $user->createToken($user->name . '-SessionToken', $abilities, now()->addWeek());
    }
}

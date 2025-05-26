<?php

namespace App\Actions\Board;

use App\Http\Requests\StoreBoardRequest;
use App\Models\User;
class StoreBoard
{
    public function __construct()
    {
        //
    }

    public function handle(array $boardData, User $user)
    {
        return $user->boards()->create($boardData);
    }
}

<?php

namespace App\Actions\Board;

use App\Models\Board;

class UpdateBoard
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function handle(array $data, Board $board)
    {
        return $board->update($data);
    }
}

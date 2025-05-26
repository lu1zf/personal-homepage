<?php

namespace App\Http\Controllers;

use App\Actions\Board\StoreBoard;
use App\Actions\Board\UpdateBoard;
use App\Http\Requests\StoreBoardRequest;
use App\Http\Requests\UpdateBoardRequest;
use Illuminate\Http\Response;
use App\Models\Board;
use Auth;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Board::where("user_id", Auth::user()->id)->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBoardRequest $request, StoreBoard $action)
    {
        $created = $action->handle($request->validated(), Auth::user());
        if ($created)
            return Response::success($created);

        return Response::error("Could not create the board");
    }

    /**
     * Display the specified resource.
     */
    public function show(Board $board)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Board $board)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBoardRequest $request, Board $board, UpdateBoard $action)
    {
        $updated = $action->handle($request->validated(), $board);

        if ($updated)
            return Response::success(Board::find($board->id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Board $board)
    {
        //
    }
}

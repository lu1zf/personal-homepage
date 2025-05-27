<?php

use App\Models\Board;
use App\Models\User;

describe("boards", function () {
    beforeEach(function () {
        $this->user = User::factory()->create();
        $this->board = Board::factory()->create([
            "user_id" => $this->user->id,
            "name" => "Test board",
            "description" => "board description",
            "visibility" => "private"
        ]);
    });

    it("should create a new board", function () {
        $response = $this->actingAs($this->user)->post("/api/boards", [
            "name" => "test board",
            "description" => "board description",
            "visibility" => "private"
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure(["data" => ["id"]]);

        $boardId = $response->json()["data"]["id"];
        $this->assertDatabaseHas("boards", [
            "id" => $boardId,
            "user_id" => $this->user->id
        ]);
    });

    it("should fail when creating board without name", function () {
        $response = $this->actingAs($this->user)->json("post", "/api/boards", [
            "description" => "untitled board description",
            "visibility" => "private"
        ]);

        $response->assertStatus(422);
        $this->assertDatabaseMissing('boards', ['description' => 'untitled board description']);
    });

    it("should update board data", function () {
        $updatedBoardData = [
            "name" => "updated name",
            "description" => "updated description",
            "visibility" => "public"
        ];

        $response = $this->actingAs($this->user)
            ->put("/api/boards/{$this->board->id}", $updatedBoardData);

        $response->assertStatus(200);
        $this->assertDatabaseHas("boards", $updatedBoardData)
            ->assertDatabaseMissing("boards", [
                "name" => $this->board->name,
                "description" => $this->board->description
            ]);
    });
});

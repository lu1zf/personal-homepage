<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use function Pest\Laravel\postJson;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create([
        'email' => 'johndoetest@example.com',
        'password' => Hash::make('secretpassword'),
    ]);
});

it('should create a new user session', function () {

    $response = postJson('/api/session', [
        'email' => $this->user->email,
        'password' => 'secretpassword',
    ]);

    $response->assertStatus(201)
        ->assertJsonStructure([
            'data' => [
                "access_token"
            ]
        ]);
});

it("should fail when password is wrong", function () {
    $response = postJson('/api/session', [
        'email' => $this->user->email,
        'password' => 'wrong_password',
    ]);

    $response->assertUnauthorized();
});

it("should fail when email not found", function () {
    $response = postJson('/api/session', [
        'email' => 'newemail@example.com',
        'password' => 'secretpassword',
    ]);

    $response->assertUnauthorized();
});
<?php

use App\Models\User;

test('should delete user session', function () {
    $user = User::factory()->create();
    $response = $this->actingAs($user)->delete('/api/session');
    $response->assertStatus(204);
});

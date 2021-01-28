<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_not_login_if_their_account_has_not_been_activated()
    {
        User::factory()->create(['email' => 'user@test.com', 'password' => 'testPass123']);

        $response = $this->postJson("/api/auth/login", ['email' => 'user@test.com', 'password' => 'testPass123']);

        $response->assertStatus(401);
        $response->assertJsonFragment(['message' => 'You can not log in as your account has not been activated yet.']);
    }
}

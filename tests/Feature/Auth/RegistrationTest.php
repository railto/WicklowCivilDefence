<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_new_user_can_register()
    {
        $data = [
            'name' => 'Test User',
            'email' => 'user@test.com',
            'phone' => '0831221122',
            'password' => 'testPass1234',
        ];

        $response = $this->postJson('/api/auth/register', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', ['email' => $data['email']]);
        $this->assertDatabaseCount('users', 1);
    }

    /** @test */
    public function a_new_user_can_not_register_with_duplicate_email()
    {
        User::factory()->create(['name' => 'Test User', 'email' => 'user@test.com']);

        $data = [
            'name' => 'Duplicate User',
            'email' => 'user@test.com',
            'phone' => '0831221122',
            'password' => 'testPass1234',
        ];

        $response = $this->postJson('/api/auth/register', $data);

        $response->assertStatus(422);
        $response->assertJsonFragment(['email' => ['The email has already been taken.']]);
        $this->assertDatabaseMissing('users', ['name' => $data['name']]);
        $this->assertDatabaseCount('users', 1);
    }
}

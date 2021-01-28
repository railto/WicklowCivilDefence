<?php

namespace Tests\Feature\User;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserActivationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_admin_user_can_activate_a_user()
    {
        $user = User::factory()->create();
        $admin = User::factory()->admin()->create();
        $now = Carbon::now()->toDateTimeString();
        $data = [
            'activated_at' => $now,
        ];

        Sanctum::actingAs($admin);
        $response = $this->patchJson("/api/users/{$user->id}", $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', ['id' => $user->id, 'activated_at' => $now, 'activated_by' => $admin->id]);
    }

    /** @test */
    public function a_non_admin_can_not_activate_a_user()
    {
        $user = User::factory()->create();
        $user2 = User::factory()->write()->create();
        $now = Carbon::now()->toDateTimeString();
        $data = [
            'activated_at' => $now,
        ];

        Sanctum::actingAs($user2);
        $response = $this->patchJson("/api/users/{$user->id}", $data);

        $response->assertStatus(403);
        $this->assertDatabaseHas('users', ['id' => $user->id, 'activated_at' => null, 'activated_by' => null]);
    }

    /** @test */
    public function updating_non_activated_user_does_not_activate_them()
    {
        $user = User::factory()->create();
        $user2 = User::factory()->admin()->create();
        $data = [
            'name' => 'Random User',
        ];

        Sanctum::actingAs($user2);
        $response = $this->patchJson("/api/users/{$user->id}", $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', ['id' => $user->id, 'name' => 'Random User', 'activated_at' => null, 'activated_by' => null]);
    }
}

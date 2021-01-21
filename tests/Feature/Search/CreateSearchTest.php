<?php

namespace Tests\Feature\Search;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CreateSearchTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function an_admin_can_create_a_new_search()
    {
        $user = User::factory()->admin()->create();
        Sanctum::actingAs($user);

        $data = [
            'location' => $this->faker->streetName,
            'start' => Carbon::now()->toDateTimeString(),
            'type' => 'training',
            'officer_in_charge' => $this->faker->name,
            'search_manager' => $this->faker->name,
            'safety_officer' => $this->faker->name,
            'section_leader' => $this->faker->name,
            'radio_operator' => $this->faker->name,
            'scribe' => $this->faker->name,
        ];

        $response = $this->postJson('/api/search', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('searches', ['location' => $data['location'], 'type' => $data['type']]);
    }

    /** @test */
    public function a_user_with_write_access_may_not_create_a_new_search()
    {
        $user = User::factory()->write()->create();
        Sanctum::actingAs($user);

        $data = [
            'location' => $this->faker->streetName,
            'start' => Carbon::now()->toDateTimeString(),
            'type' => 'training',
            'officer_in_charge' => $this->faker->name,
            'search_manager' => $this->faker->name,
            'safety_officer' => $this->faker->name,
            'section_leader' => $this->faker->name,
            'radio_operator' => $this->faker->name,
            'scribe' => $this->faker->name,
        ];

        $response = $this->postJson('/api/search', $data);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('searches', ['location' => $data['location'], 'type' => $data['type']]);
    }
}

<?php

namespace Tests\Feature\Search;

use App\Models\Search;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class SearchTeamsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function a_user_with_write_access_can_create_a_search_team()
    {
        $user = User::factory()->write()->create();
        $search = Search::factory()->create(['created_by' => $user->id]);
        $teamData = [
            'name' => $this->faker->word,
            'leader' => $this->faker->name,
            'medic' => $this->faker->name,
            'responder_1' => $this->faker->name,
            'responder_2' => $this->faker->name,
            'responder_3' => $this->faker->name,
        ];

        Sanctum::actingAs($user);
        $response = $this->postJson("/api/search/{$search->id}/teams", $teamData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('search_teams', ['name' => $teamData['name']]);
    }

    /** @test */
    public function a_user_with_read_access_can_not_create_a_search_team()
    {
        $user = User::factory()->read()->create();
        $search = Search::factory()->create(['created_by' => $user->id]);
        $teamData = [
            'name' => $this->faker->word,
            'leader' => $this->faker->name,
            'medic' => $this->faker->name,
            'responder_1' => $this->faker->name,
            'responder_2' => $this->faker->name,
            'responder_3' => $this->faker->name,
        ];

        Sanctum::actingAs($user);
        $response = $this->postJson("/api/search/{$search->id}/teams", $teamData);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('search_teams', ['name' => $teamData['name']]);
    }
}

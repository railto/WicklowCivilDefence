<?php

namespace Tests\Feature\Search;

use App\Models\Search;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ViewSearchTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_authenticated_user_can_view_an_existing_search()
    {
        $user = User::factory()->create();
        $search = Search::factory()->create(['created_by' => $user->id]);

        Sanctum::actingAs($user);
        $response = $this->getJson("/api/searches/{$search->id}");

        $response->assertStatus(200);
        $response->assertJsonFragment($search->toArray());
    }

    /** @test */
    public function an_authenticated_user_can_not_view_a_search_that_does_not_exist()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);
        $response = $this->getJson('/api/searches/999');

        $response->assertStatus(404);
    }

    /** @test */
    public function a_guest_can_not_view_a_search()
    {
        $user = User::factory()->create();
        $search = Search::factory()->create(['created_by' => $user->id]);

        $response = $this->getJson("/api/searches/{$search->id}");

        $response->assertStatus(401);
        $response->assertJsonMissing($search->toArray());
    }

    /**
     * Expect to see a 401, don't want to leak that the route doesn't exist
     *
     * @test
     */
    public function a_guest_can_not_view_a_search_that_does_not_exist()
    {
        $response = $this->getJson('/api/searches/999');

        $response->assertStatus(401);
    }
}

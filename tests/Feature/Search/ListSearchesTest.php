<?php

namespace Tests\Feature\Search;

use App\Models\Search;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ListSearchesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_view_a_list_of_searches()
    {
        $user = User::factory()->create();
        $search1 = Search::factory()->create(['created_by' => $user->id]);
        $search2 = Search::factory()->create(['created_by' => $user->id]);

        Sanctum::actingAs($user);
        $response = $this->getJson('/api/search');

        $response->assertStatus(200);
        $response->assertJsonFragment($search1->toArray());
        $response->assertJsonFragment($search2->toArray());
    }

    /** @test */
    public function a_guest_can_not_view_list_of_searches()
    {
        $user = User::factory()->create();
        $search1 = Search::factory()->create(['created_by' => $user->id]);
        $search2 = Search::factory()->create(['created_by' => $user->id]);

        $response = $this->getJson('/api/search');

        $response->assertStatus(401);
        $response->assertJsonMissing($search1->toArray());
        $response->assertJsonMissing($search2->toArray());
    }
}

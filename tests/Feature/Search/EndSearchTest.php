<?php

namespace Tests\Feature\Search;

use App\Models\Search;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class EndSearchTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function an_admin_can_end_a_search()
    {
        $user = User::factory()->admin()->create();
        $search = Search::factory()->create(['created_by' => $user->id]);
        $data = [
            'end' => Carbon::now()->toDateTimeString(),
            'notes' => $this->faker->sentence,
        ];

        Sanctum::actingAs($user);
        $response = $this->postJson("/api/search/{$search->id}/end", $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('searches', ['id' => $search->id, 'notes' => $data['notes'], 'end' => $data['end']]);
    }

    /** @test */
    public function a_non_admin_user_can_not_end_a_search()
    {
        $user = User::factory()->write()->create();
        $search = Search::factory()->create(['created_by' => $user->id]);
        $data = [
            'end' => Carbon::now()->toDateTimeString(),
            'notes' => $this->faker->sentence,
        ];

        Sanctum::actingAs($user);
        $response = $this->postJson("/api/search/{$search->id}/end", $data);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('searches', ['id' => $search->id, 'notes' => $data['notes'], 'end' => $data['end']]);
    }
}

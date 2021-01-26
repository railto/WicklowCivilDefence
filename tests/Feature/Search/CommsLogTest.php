<?php

namespace Tests\Feature\Search;

use App\Models\Search;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CommsLogTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function write_user_can_create_new_comms_log_entry()
    {
        $user = User::factory()->write()->create();
        $search = Search::factory()->create(['created_by' => $user->id]);
        $log = [
            'time' => Carbon::now()->toDateTimeString(),
            'call_sign' => $this->faker->word,
            'message' => $this->faker->sentence,
        ];

        Sanctum::actingAs($user);
        $response = $this->postJson("/api/search/{$search->id}/logs/comms", $log);

        $response->assertStatus(201);
        $this->assertDatabaseHas('search_comms_logs', $log);
    }

    /** @test */
    public function read_user_can_not_create_new_comms_log_entry()
    {
        $user = User::factory()->read()->create();
        $search = Search::factory()->create(['created_by' => $user->id]);
        $log = [
            'time' => Carbon::now()->toDateTimeString(),
            'call_sign' => $this->faker->word,
            'message' => $this->faker->sentence,
        ];

        Sanctum::actingAs($user);
        $response = $this->postJson("/api/search/{$search->id}/logs/comms", $log);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('search_comms_logs', $log);
    }
}
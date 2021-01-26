<?php

namespace Tests\Feature\Search;

use App\Models\Search;
use App\Models\SearchLog;
use App\Models\SearchTeam;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class SearchLogTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function a_write_user_can_create_a_search_log_entry()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->write()->create();
        $search = Search::factory()->create(['created_by' => $user->id]);
        $searchTeam = SearchTeam::factory()->create(['search_id' => $search->id, 'created_by' => $user->id]);
        $logData = [
            'area' => $this->faker->streetName,
            'team' => $searchTeam->name,
            'start_time' => Carbon::now()->toDateTimeString(),
        ];

        Sanctum::actingAs($user);
        $response = $this->postJson("/api/searches/{$search->id}/logs/searches", $logData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('search_logs', $logData);
    }

    /** @test */
    public function a_read_user_can_not_create_a_search_log_entry()
    {
        $user = User::factory()->read()->create();
        $search = Search::factory()->create(['created_by' => $user->id]);
        $searchTeam = SearchTeam::factory()->create(['search_id' => $search->id, 'created_by' => $user->id]);
        $logData = [
            'area' => $this->faker->streetName,
            'team' => $searchTeam->name,
            'start_time' => Carbon::now()->toDateTimeString(),
        ];

        Sanctum::actingAs($user);
        $response = $this->postJson("/api/searches/{$search->id}/logs/searches", $logData);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('search_logs', $logData);
    }

    /** @test */
    public function a_write_user_can_update_a_search_log_entry()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->write()->create();
        $search = Search::factory()->create(['created_by' => $user->id]);
        $log = SearchLog::factory()->create(['search_id' => $search->id, 'created_by' => $user->id]);
        $updatedLog = $log->toArray();
        $updatedLog['end_time'] = Carbon::now()->toDateTimeString();
        $updatedLog['notes'] = 'Nothing found';

        Sanctum::actingAs($user);
        $response = $this->putJson("/api/searches/{$search->id}/logs/searches/{$log->id}", $updatedLog);

        $response->assertStatus(200);
        $this->assertDatabaseHas('search_logs', $updatedLog);
    }

    /** @test */
    public function a_read_user_can_not_update_a_search_log_entry()
    {
        $user = User::factory()->read()->create();
        $search = Search::factory()->create(['created_by' => $user->id]);
        $log = SearchLog::factory()->create(['search_id' => $search->id, 'created_by' => $user->id]);
        $updatedLog = $log->toArray();
        $updatedLog['end_time'] = Carbon::now()->toDateTimeString();
        $updatedLog['notes'] = 'Nothing found';

        Sanctum::actingAs($user);
        $response = $this->putJson("/api/searches/{$search->id}/logs/searches/{$log->id}", $updatedLog);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('search_logs', $updatedLog);
    }
}

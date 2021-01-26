<?php

namespace Tests\Feature\Search;

use App\Models\Search;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class RadioAssignmentTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function a_write_user_can_add_a_radio_assignment()
    {
        $user = User::factory()->write()->create();
        $search = Search::factory()->create(['created_by' => $user->id]);
        $assignmentData = [
            'name' => $this->faker->name,
            'call_sign' => $this->faker->word,
            'tetra_number' => $this->faker->numberBetween('10000', '60000'),
        ];

        Sanctum::actingAs($user);
        $response = $this->postJson("/api/searches/{$search->id}/radios", $assignmentData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('search_radio_assignments', ['name' => $assignmentData['name'], 'call_sign' => $assignmentData['call_sign']]);
    }

    /** @test */
    public function a_read_user_can_add_a_radio_assignment()
    {
        $user = User::factory()->read()->create();
        $search = Search::factory()->create(['created_by' => $user->id]);
        $assignmentData = [
            'name' => $this->faker->name,
            'call_sign' => $this->faker->word,
            'tetra_number' => $this->faker->numberBetween('10000', '60000'),
        ];

        Sanctum::actingAs($user);
        $response = $this->postJson("/api/searches/{$search->id}/radios", $assignmentData);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('search_radio_assignments', ['name' => $assignmentData['name'], 'call_sign' => $assignmentData['call_sign']]);
    }
}

<?php

namespace Database\Factories;

use App\Models\SearchTeam;
use Illuminate\Database\Eloquent\Factories\Factory;

class SearchTeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SearchTeam::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'created_by' => 1,
            'search_id' => 1,
            'name' => $this->faker->word,
            'leader' => $this->faker->name,
            'medic' => $this->faker->name,
            'responder_1' => $this->faker->name,
            'responder_2' => $this->faker->name,
            'responder_3' => $this->faker->name,
        ];
    }
}

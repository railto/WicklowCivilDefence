<?php

namespace Database\Factories;

use App\Models\SearchLog;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class SearchLogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SearchLog::class;

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
            'team' => $this->faker->word,
            'area' => $this->faker->streetName,
            'start_time' => Carbon::now()->toDateTimeString(),
            'end_time' => Carbon::now()->toDateTimeString(),
            'notes' => $this->faker->sentence,
        ];
    }
}

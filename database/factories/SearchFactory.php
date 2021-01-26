<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Search;
use Carbon\Carbon;
use Faker\Provider\DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

class SearchFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Search::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'created_by' => 1,
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
    }

    public function ended(): SearchFactory
    {
        return $this->state(function ($attributes) {
            return [
                'end' => Carbon::now()->toDateTimeString(),
                'notes' => $this->faker->paragraph,
            ];
        });
    }
}

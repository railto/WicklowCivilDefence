<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role' => 'read',
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * @return UserFactory
     */
    public function admin(): UserFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => 'admin'
            ];
        });
    }

    /**
     * @return UserFactory
     */
    public function write(): UserFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => 'write'
            ];
        });
    }

    /**
     * @return UserFactory
     */
    public function read(): UserFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => 'read'
            ];
        });
    }
}

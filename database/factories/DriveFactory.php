<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Drive>
 */
class DriveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title(),
            'description' => fake()->sentence(3),
            'file' => 'fake2',
            'file_type' => 'jpg',
            'status' => 'private', 
            'user_id' => fake()->numberBetween(2, 28),
        ];
    }
}

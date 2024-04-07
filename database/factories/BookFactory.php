<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->words(3, true),
            'author' => fake()->name(),
            'description' => fake()->realText(),
            'pages' => fake()->numberBetween(10, 500),
            'num_of_read_pages' => fake()->numberBetween(0, 10),
        ];
    }
}

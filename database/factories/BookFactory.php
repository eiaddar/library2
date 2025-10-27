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
            'name' => $this->faker->sentence(rand(3, 7)),
            'isbn' => $this->faker->isbn10(),
            'description' => $this->faker->paragraph(rand(3, 8)),
            'pages' => $this->faker->numberBetween(100, 1000),
            'published_date' => $this->faker->date(),
        ];
    }
}

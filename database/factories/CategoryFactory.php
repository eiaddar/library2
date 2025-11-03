<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Real book categories
        $categories = [
            'Fiction', 'Non-Fiction', 'Science Fiction', 'Fantasy', 'Mystery',
            'Thriller', 'Romance', 'Horror', 'Biography', 'History',
            'Science', 'Technology', 'Business', 'Self-Help', 'Philosophy',
            'Poetry', 'Drama', 'Children\'s Books', 'Young Adult', 'Classics',
            'Religion', 'Travel', 'Cookbooks', 'Art', 'Music'
        ];
        
        static $usedCategories = [];
        
        // Get unused category or fallback to random
        $availableCategories = array_diff($categories, $usedCategories);
        if (empty($availableCategories)) {
            $categoryName = fake()->words(2, true);
        } else {
            $categoryName = $availableCategories[array_rand($availableCategories)];
            $usedCategories[] = $categoryName;
        }
        
        return [
            'name' => $categoryName,
            'order' => fake()->unique()->numberBetween(1, 100),
            'is_active' => fake()->boolean(90),
        ];
    }

    /**
     * Indicate that the category is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }

    /**
     * Indicate that the category is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}

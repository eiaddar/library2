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
        $stockQuantity = fake()->numberBetween(1, 25);
        $borrowedBooks = fake()->numberBetween(0, min(5, $stockQuantity));
        
        // Real book title patterns
        $titlePatterns = [
            fake()->words(rand(2, 4), true),
            'The ' . fake()->words(rand(1, 3), true),
            fake()->words(rand(1, 2), true) . ' of ' . fake()->words(rand(1, 2), true),
            fake()->word() . ' and ' . fake()->word(),
        ];
        
        // Real publishers
        $publishers = [
            'Penguin Random House', 'HarperCollins', 'Simon & Schuster', 
            'Macmillan Publishers', 'Hachette Book Group', 'Scholastic',
            'Pearson Education', 'Wiley', 'Oxford University Press',
            'Cambridge University Press', 'McGraw-Hill Education', 'Bloomsbury'
        ];
        
        return [
            'title' => ucwords($titlePatterns[array_rand($titlePatterns)]),
            'isbn' => fake()->unique()->isbn13(),
            'description' => fake()->paragraphs(rand(3, 5), true),
            'category_id' => \App\Models\Category::factory(),
            'publisher' => fake()->randomElement($publishers),
            'published_date' => fake()->dateTimeBetween('-30 years', '-1 month')->format('Y-m-d'),
            'language' => fake()->randomElement(['English', 'Arabic', 'French', 'Spanish', 'German', 'Italian', 'Portuguese']),
            'pages' => fake()->numberBetween(80, 1200),
            'price' => fake()->randomFloat(2, 9.99, 89.99),
            'stock_quantity' => $stockQuantity,
            'available_quantity' => $stockQuantity - $borrowedBooks,
            'cover_image' => 'https://picsum.photos/seed/' . fake()->unique()->numberBetween(1000, 9999) . '/400/600',
            'format' => fake()->randomElement(['hardcover', 'paperback', 'ebook', 'audiobook']),
            'is_available' => $stockQuantity > $borrowedBooks,
        ];
    }
}

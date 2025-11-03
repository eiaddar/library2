<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all categories and authors
        $categories = Category::all();
        $authors = \App\Models\Author::all();

        // Create 50 books, distributing them across categories
        if ($categories->isNotEmpty()) {
            Book::factory()->count(50)->create([
                'category_id' => $categories->random()->id,
            ])->each(function ($book) use ($authors) {
                // Attach 1-3 random authors to each book
                if ($authors->isNotEmpty()) {
                    $book->authors()->attach(
                        $authors->random(rand(1, min(3, $authors->count())))->pluck('id')->toArray()
                    );
                }
            });
        } else {
            // If no categories exist, create books with new categories
            Book::factory()->count(50)->create()->each(function ($book) use ($authors) {
                if ($authors->isNotEmpty()) {
                    $book->authors()->attach(
                        $authors->random(rand(1, min(3, $authors->count())))->pluck('id')->toArray()
                    );
                }
            });
        }
    }
}

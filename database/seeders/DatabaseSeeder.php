<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed users
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Call all seeders in the correct order
        // Categories and Authors first (no dependencies)
        $this->call([
            CategorySeeder::class,
            AuthorSeeder::class,
            BookSeeder::class,  // Depends on categories and authors
            CustomerSeeder::class,
            BorrowingSeeder::class,  // Depends on books, customers, and users
        ]);
    }
}

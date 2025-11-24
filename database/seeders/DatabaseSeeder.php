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
        // First, seed permissions and roles
        $this->call([
            PermissionSeeder::class,
        ]);

        // Then create users
        $superAdmin = User::factory()->create([
            'id' => 1,
            'name' => 'Super Admin',
            'email' => 'eiaddar@gmail.com',
            'password' => bcrypt('password'), // You should change this in production
        ]);

        // Seed regular users
        User::factory(10)->create();

        // Create test user
        $testUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Assign Super Admin role to the first user
        if ($superAdmin) {
            $superAdmin->assignRole('Super Admin');
        }

        // Call other seeders in the correct order
        $this->call([
            CategorySeeder::class,
            AuthorSeeder::class,
            BookSeeder::class,  // Depends on categories and authors
            CustomerSeeder::class,
            BorrowingSeeder::class,  // Depends on books, customers, and users
        ]);
    }
}

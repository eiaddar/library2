<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BorrowingSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = Book::all();
        $customers = Customer::where('is_active', true)->get();
        $users = User::all();

        if ($books->isNotEmpty() && $customers->isNotEmpty() && $users->isNotEmpty()) {
            // Create 30 borrowing records
            Borrowing::factory()->count(30)->create([
                'book_id' => $books->random()->id,
                'customer_id' => $customers->random()->id,
                'issued_by' => $users->random()->id,
            ]);
        }
    }
}

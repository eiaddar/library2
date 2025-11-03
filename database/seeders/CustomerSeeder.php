<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 15 customers
        // Note: Customer table currently only has id and timestamps
        // Update this when more fields are added to the migration
        Customer::factory()->count(15)->create();
    }
}

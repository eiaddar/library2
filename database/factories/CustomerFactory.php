<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $membershipStartDate = fake()->dateTimeBetween('-3 years', 'now');
        $membershipDuration = fake()->randomElement([
            '+1 year',   // Annual membership
            '+6 months', // Semi-annual
            '+2 years',  // Biennial
        ]);
        $expiryDate = (clone $membershipStartDate)->modify($membershipDuration);
        $isExpired = $expiryDate < new \DateTime();
        
        // Realistic membership types with weighted distribution
        $membershipTypes = ['basic', 'basic', 'basic', 'premium', 'student', 'student', 'senior'];
        
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->optional(0.85)->numerify('+1-###-###-####'),
            'address' => fake()->optional(0.75)->streetAddress(),
            'city' => fake()->optional(0.75)->city(),
            'postal_code' => fake()->optional(0.75)->numerify('#####'),
            'membership_number' => 'LIB-' . fake()->unique()->numerify('######'),
            'membership_start_date' => $membershipStartDate->format('Y-m-d'),
            'membership_expiry_date' => $expiryDate->format('Y-m-d'),
            'membership_type' => $membershipTypes[array_rand($membershipTypes)],
            'is_active' => !$isExpired && fake()->boolean(95),
        ];
    }
}

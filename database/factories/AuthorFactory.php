<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $birthDate = fake()->dateTimeBetween('-90 years', '-25 years');
        $age = (new \DateTime())->diff($birthDate)->y;
        $isDeceased = $age > 70 ? fake()->boolean(40) : fake()->boolean(10);
        
        // More realistic author name patterns
        $firstName = fake()->firstName();
        $lastName = fake()->lastName();
        $namePatterns = [
            $firstName . ' ' . $lastName,
            $firstName . ' ' . fake()->lastName(),
            fake()->firstName() . ' ' . $lastName,
            $firstName[0] . '. ' . $lastName,
        ];
        
        // Real nationalities for authors
        $nationalities = [
            'American', 'British', 'Canadian', 'Australian', 'Irish',
            'French', 'German', 'Spanish', 'Italian', 'Japanese',
            'Indian', 'Egyptian', 'Nigerian', 'Brazilian', 'Mexican',
            'Russian', 'Chinese', 'South Korean', 'Swedish', 'Norwegian'
        ];
        
        $authorName = $namePatterns[array_rand($namePatterns)];
        
        return [
            'name' => $authorName,
            'biography' => fake()->realText(rand(400, 800)),
            'nationality' => fake()->randomElement($nationalities),
            'birth_date' => $birthDate->format('Y-m-d'),
            'death_date' => $isDeceased ? fake()->dateTimeBetween($birthDate, 'now')->format('Y-m-d') : null,
            'email' => fake()->optional(0.5)->safeEmail(),
            'website' => fake()->optional(0.4)->url(),
            'photo' => fake()->optional(0.6)->imageUrl(400, 400, 'people', true, $authorName),
        ];
    }
}

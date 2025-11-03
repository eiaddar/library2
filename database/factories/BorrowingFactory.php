<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Borrowing>
 */
class BorrowingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $borrowedDate = fake()->dateTimeBetween('-8 months', 'now');
        
        // Standard loan period: 14 or 21 days
        $loanPeriod = fake()->randomElement([14, 21]);
        $dueDate = (clone $borrowedDate)->modify("+{$loanPeriod} days");
        
        $now = new \DateTime();
        $isOverdue = $dueDate < $now;
        
        // 75% of books are returned, 20% still borrowed, 5% overdue/lost
        $statusWeights = [
            'returned' => 75,
            'borrowed' => 20,
            'overdue' => 4,
            'lost' => 1,
        ];
        
        $rand = fake()->numberBetween(1, 100);
        $cumulative = 0;
        $status = 'borrowed';
        foreach ($statusWeights as $s => $weight) {
            $cumulative += $weight;
            if ($rand <= $cumulative) {
                $status = $s;
                break;
            }
        }
        
        // Adjust status based on dates
        if ($status === 'borrowed' && $isOverdue) {
            $status = fake()->randomElement(['overdue', 'overdue', 'overdue', 'lost']);
        }
        
        $returnedDate = null;
        if ($status === 'returned') {
            // Return within loan period or slightly late
            $maxReturnDate = fake()->boolean(85) ? $dueDate : (clone $dueDate)->modify('+' . fake()->numberBetween(1, 7) . ' days');
            $returnedDate = fake()->dateTimeBetween($borrowedDate, min($maxReturnDate, $now))->format('Y-m-d');
        }
        
        // Calculate fines: $0.50 per day overdue
        $fineAmount = 0;
        if ($status === 'overdue') {
            $daysOverdue = $now->diff($dueDate)->days;
            $fineAmount = min($daysOverdue * 0.50, 25.00); // Max $25 fine
        } elseif ($status === 'lost') {
            $fineAmount = fake()->randomFloat(2, 30, 80); // Book replacement cost
        } elseif ($status === 'returned' && $returnedDate) {
            $returnDate = new \DateTime($returnedDate);
            if ($returnDate > $dueDate) {
                $daysLate = $returnDate->diff($dueDate)->days;
                $fineAmount = min($daysLate * 0.50, 25.00);
            }
        }
        
        $notes = null;
        if ($status === 'lost') {
            $notes = fake()->randomElement([
                'Book reported lost by member',
                'Unable to locate book after multiple attempts',
                'Member claims book was stolen',
            ]);
        } elseif ($status === 'overdue') {
            $notes = fake()->optional(0.4)->randomElement([
                'Multiple reminders sent',
                'Member contacted via phone',
                'Awaiting return',
            ]);
        }
        
        return [
            'book_id' => Book::factory(),
            'customer_id' => Customer::factory(),
            'issued_by' => User::factory(),
            'borrowed_date' => $borrowedDate->format('Y-m-d'),
            'due_date' => $dueDate->format('Y-m-d'),
            'returned_date' => $returnedDate,
            'status' => $status,
            'fine_amount' => round($fineAmount, 2),
            'fine_paid' => $fineAmount > 0 ? fake()->boolean(60) : false,
            'notes' => $notes,
        ];
    }
}

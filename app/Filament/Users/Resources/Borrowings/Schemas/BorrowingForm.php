<?php

namespace App\Filament\Users\Resources\Borrowings\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BorrowingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('book_id')
                    ->relationship('book', 'title')
                    ->required(),
                Select::make('customer_id')
                    ->relationship('customer', 'id')
                    ->required(),
                TextInput::make('issued_by')
                    ->numeric()
                    ->default(null),
                DatePicker::make('borrowed_date')
                    ->required(),
                DatePicker::make('due_date')
                    ->required(),
                DatePicker::make('returned_date'),
                Select::make('status')
                    ->options(['borrowed' => 'Borrowed', 'returned' => 'Returned', 'overdue' => 'Overdue', 'lost' => 'Lost'])
                    ->default('borrowed')
                    ->required(),
                TextInput::make('fine_amount')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                Toggle::make('fine_paid')
                    ->required(),
                Textarea::make('notes')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}

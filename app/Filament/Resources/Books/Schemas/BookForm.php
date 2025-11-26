<?php

namespace App\Filament\Resources\Books\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;

class BookForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->columnSpanFull(),
                RichEditor::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                Grid::make()
                ->schema([
                    TextInput::make('isbn')
                    ->columns(3)
                    ->default(null),
                    Select::make('category_id')
                    ->columns(3)
                    ->relationship('category', 'name')
                    ->required(),
                    TextInput::make('publisher')
                    ->columns(3)
                    ->default(null),
                ])->columns(2),
                DatePicker::make('published_date'),
                TextInput::make('language')
                    ->required()
                    ->default('English'),
                TextInput::make('pages')
                    ->numeric()
                    ->default(null),
                TextInput::make('price')
                    ->numeric()
                    ->default(null)
                    ->prefix('$'),
                TextInput::make('stock_quantity')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('available_quantity')
                    ->required()
                    ->numeric()
                    ->default(0),
                FileUpload::make('cover_image')
                    ->image(),
                Select::make('format')
                    ->options([
                        'hardcover' => 'Hardcover',
                        'paperback' => 'Paperback',
                        'ebook' => 'Ebook',
                        'audiobook' => 'Audiobook',
                    ])
                    ->default('paperback')
                    ->required(),
                Toggle::make('is_available')
                    ->required(),
            ]);
    }
}

<?php

namespace App\Filament\Users\Resources\Borrowings\Pages;

use App\Filament\Users\Resources\Borrowings\BorrowingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBorrowing extends CreateRecord
{
    protected static string $resource = BorrowingResource::class;
}

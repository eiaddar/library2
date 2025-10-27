<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Book extends Model
{
    protected $table = 'books';
    protected $guarded = ['id','created_at','updated_at'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    // public function author(): HasManyThrough
    // {
    //     return $this->hasManyThrough(Author::class,);
    // }
}

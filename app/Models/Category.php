<?php

namespace App\Models;

use App\Models\Book;
use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model implements \OwenIt\Auditing\Contracts\Auditable
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory, \OwenIt\Auditing\Auditable;

    //protected $fillable = ['name','order','is_active'];
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
    protected $casts = [
        'is_active' => 'boolean'
    ];
}

<?php

namespace App\Models;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory, Filterable;

    protected $table = 'books';

    protected $fillable = [
        'title',
        'description',
        'short_description',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'user_id');
    }

    public function userBook(): HasMany
    {
        return $this->hasMany(UserBook::class, 'book_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author', 'description', 'pages','num_of_read_pages'];

    public function readingIntervals(): HasMany
    {
        return $this->hasMany(ReadingInterval::class);
    }
}

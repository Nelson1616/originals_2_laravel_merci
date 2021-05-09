<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'photo',
        'is_thumb',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class, 'books');
    }
}

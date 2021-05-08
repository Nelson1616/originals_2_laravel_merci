<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'title',
        'description',
        'state',
        'price',
        'on_sale',
        'offer',
        'color',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'books_categories');
    }
}

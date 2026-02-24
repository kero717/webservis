<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'genre',
        'publisher',
        'year',
        'isbn',
        'copies',
        'available_copies',
    ];
}
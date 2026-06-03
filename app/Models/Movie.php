<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $table = 'movies';

    protected $fillable = [
        'title',
        'description',
        'author_id',
        'synopsis',
        'cover_image',
    ];

    // Relationship to Author
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
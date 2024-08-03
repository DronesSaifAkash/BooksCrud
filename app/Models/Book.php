<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'description',
        'published_date',
        'pages',
        'isbn',
        'status'
    ];

    // If you have relationships, define them here
    // e.g., public function user() { return $this->belongsTo(User::class); }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'bookTitle',
        'bookAuthor',
        'bookCategory',
        'comment',
        'noOfPages',
        'currentPageRead',
        'currentChapterTitle',
        'currentChapterRead',
    ];
}

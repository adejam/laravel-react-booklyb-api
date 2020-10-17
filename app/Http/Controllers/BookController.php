<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function getBooks($book_id=null)
    {
        return $book_id ? Book::where('book_id', '=', $book_id)->firstOrFail() : Book::all();
    }
}

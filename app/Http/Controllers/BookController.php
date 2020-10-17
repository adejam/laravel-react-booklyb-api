<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Webpatser\Uuid\Uuid;

class BookController extends Controller
{
    public function getBooks($book_id=null)
    {
        return $book_id ? Book::where('book_id', '=', $book_id)->firstOrFail() : Book::all();
    }

    public function add(Request $request)
    {
        $book_id = Uuid::generate();
        $this->validate(
            $request,
            [
            'bookTitle' => ['required', 'string', 'max:191'],
            'bookAuthor' => ['required', 'string', 'max:191'],
            'bookCategory' => ['required', 'string', 'max:191'],
            ]
        );

        $book = new Book;
        $book->book_id = $book_id;
        $book->book_title = $request->bookTitle;
        $book->book_author = $request->bookAuthor;
        $book->book_category = $request->bookCategory;
        $saved = $book->save();
        if ($saved) {
            return ["Result" => "Book has been added to library!"];
        } else {
            return ["Result" => "Something went wrong!"];
        }
    }

    public function update(Request $request)
    {
        $this->validate(
            $request,
            [
            'bookTitle' => ['required', 'string', 'max:191'],
            'bookAuthor' => ['required', 'string', 'max:191'],
            'bookCategory' => ['required', 'string', 'max:191'],
            ]
        );

        $book = Book::where('book_id', '=', $request->book_id)->firstOrFail();
        $book->book_title = $request->bookTitle;
        $book->book_author = $request->bookAuthor;
        $book->book_category = $request->bookCategory;
        $saved = $book->save();
        if ($saved) {
            return ["Result" => "Book has been Updated"];
        } else {
            return ["Result" => "Something went wrong!"];
        }
    }
    public function delete($id)
    {
        $book = Book::find($id);
        $delete = $book->delete();
        if ($delete) {
            return ["Result" => "Book deleted"];
        } else {
            return ["Result" => "Something went wrong"];
        }
    }
}

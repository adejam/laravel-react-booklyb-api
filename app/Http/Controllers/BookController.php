<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Webpatser\Uuid\Uuid;
use Validator;
use Auth;

class BookController extends Controller
{
    public function getBooks($book_id=null)
    {
        if (Auth::check()) {
            return $book_id ? Book::where('book_id', '=', $book_id)->firstOrFail() : Book::all();
        }
    }

    public function add(Request $request)
    {
        if (Auth::check()) {
            $rules = array(
                'bookTitle' => ['required', 'string', 'max:191'],
                'bookAuthor' => ['required', 'string', 'max:191'],
                'bookCategory' => ['required', 'string', 'max:191'],
            );
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $validator->errors();
            } else {
                $book_id = Uuid::generate();
                $book = new Book;
                $book->book_id = $book_id;
                $book->user_id = Auth::id();
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
        }
    }

    public function update(Request $request)
    {
        if (Auth::check()) {
            $rules = array(
            'bookTitle' => ['required', 'string', 'max:191'],
            'bookAuthor' => ['required', 'string', 'max:191'],
            'bookCategory' => ['required', 'string', 'max:191'],
            'comment' => ['nullable', 'string', 'max:191'],
            'noOfPages' => ['nullable', 'digits_between:1,5'],
            'currentPageRead' => ['nullable', 'digits_between:1,5'],
            'currentChapterTitle' => ['nullable', 'string', 'max:191'],
            'currentChapterRead' => ['nullable', 'digits_between:1,5'],
            );
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $validator->errors();
            } else {
                $book = Book::where('book_id', '=', $request->book_id)->firstOrFail();
                $book->book_title = $request->bookTitle;
                $book->book_author = $request->bookAuthor;
                $book->book_category = $request->bookCategory;
                $book->comment = $request->comment;
                $book->number_of_pages = $request->noOfPages;
                $book->current_page_read = $request->currentPageRead;
                $book->current_chapter_title = $request->currentChapterTitle;
                $book->current_chapter_read = $request->currentChapterRead;
                if ($book->number_of_pages && $book->current_page_read) {
                    $book->current_read_percent = (($book->current_page_read / $book->number_of_pages)*100);
                } else {
                    $book->current_read_percent = null;
                }
                
                $saved = $book->save();
                if ($saved) {
                    return ["Result" => "Book has been Updated"];
                } else {
                    return ["Result" => "Something went wrong!"];
                }
            }
        }
    }
    public function delete($id)
    {
        if (Auth::check()) {
            $book = Book::findOrFail($id);
            $delete = $book->delete();
            if ($delete) {
                return ["Result" => "Book deleted"];
            } else {
                return ["Result" => "Something went wrong"];
            }
        }
    }
}

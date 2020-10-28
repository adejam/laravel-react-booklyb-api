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
            return $book_id ? Book::select(
                'bookId',
                'bookTitle',
                'bookAuthor',
                'bookCategory',
                'comment',
                'numberOfPages',
                'currentPageRead',
                'currentChapterTitle',
                'currentChapterRead',
                'currentReadPercent'
            )
                ->where('bookId', '=', $book_id)
                ->where('userId', '=', Auth::id())
                ->firstOrFail()
                                : Book::select(
                                    'bookId',
                                    'bookTitle',
                                    'bookAuthor',
                                    'bookCategory',
                                    'comment',
                                    'numberOfPages',
                                    'currentPageRead',
                                    'currentChapterTitle',
                                    'currentChapterRead',
                                    'currentReadPercent'
                                )
                ->where('userId', '=', Auth::id())->get();
        }
    }

    public function add(Request $request)
    {
        if (Auth::check()) {
            $rules = array(
                'bookTitle' => ['required', 'string', 'max:191'],
                'bookCategory' => ['required', 'string', 'max:191'],
                'bookAuthor' => ['nullable', 'string', 'max:191'],
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
                $book_id = utf8_encode(Uuid::generate());
                $book = new Book;
                $book->bookId = $book_id;
                $book->userId = Auth::id();
                $book->bookTitle = $request->bookTitle;
                $book->bookAuthor = $request->bookAuthor;
                $book->bookCategory = $request->bookCategory;
                $book->comment = $request->comment;
                $book->numberOfPages = $request->noOfPages;
                $book->currentPageRead = $request->currentPageRead;
                $book->currentChapterTitle = $request->currentChapterTitle;
                $book->currentChapterRead = $request->currentChapterRead;
                if ($book->numberOfPages && $book->currentPageRead) {
                    $book->currentReadPercent = (($book->currentPageRead / $book->numberOfPages)*100);
                } else {
                    $book->currentReadPercent = null;
                }
                $saved = $book->save();
                if ($saved) {
                    return response()->json(
                        [
                        'status' => 200,
                        'message' => "Book Added Successfully",
                        'book' => $book,
                        ]
                    );
                } else {
                    return ["error" => "Something went wrong!"];
                }
            }
        }
    }

    public function update(Request $request)
    {
        if (Auth::check()) {
            $rules = array(
            'bookTitle' => ['required', 'string', 'max:191'],
            'bookAuthor' => ['nullable', 'string', 'max:191'],
            'bookCategory' => ['required', 'string', 'max:191'],
            'comment' => ['nullable', 'string', 'max:191'],
            'numberOfPages' => ['nullable', 'digits_between:1,5'],
            'currentPageRead' => ['nullable', 'digits_between:1,5'],
            'currentChapterTitle' => ['nullable', 'string', 'max:191'],
            'currentChapterRead' => ['nullable', 'digits_between:1,5'],
            );
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $validator->errors();
            } else {
                $book = Book::where('bookId', '=', $request->bookId)->firstOrFail();
                $book->bookTitle = $request->bookTitle;
                $book->bookAuthor = $request->bookAuthor;
                $book->bookCategory = $request->bookCategory;
                $book->comment = $request->comment;
                $book->numberOfPages = $request->numberOfPages;
                $book->currentPageRead = $request->currentPageRead;
                $book->currentChapterTitle = $request->currentChapterTitle;
                $book->currentChapterRead = $request->currentChapterRead;
                if ($book->numberOfPages && $book->currentPageRead) {
                    $book->currentReadPercent = (($book->currentPageRead / $book->numberOfPages)*100);
                } else {
                    $book->currentReadPercent = null;
                }
                $saved = $book->save();
                if ($saved) {
                    return response()->json(
                        [
                        'status' => 200,
                        'message' => "Book Updated Successfully",
                        ]
                    );
                } else {
                    return ["error" => "Something went wrong!"];
                }
            }
        }
    }
    public function delete($id)
    {
        //to delete
        if (Auth::check()) {
            $book = Book::where('bookId', '=', $id)->firstOrFail();
            $delete = $book->delete();
            if ($delete) {
                return ["message" => "Book deleted"];
            } else {
                return ["error" => "Something went wrong"];
            }
        }
    }
}

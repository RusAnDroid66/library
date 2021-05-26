<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function add(Request $req) {
        if ($req->user()->tokenCan('edit')) {
            $book = new Book;
            $book->title = $req->title;
            $book->author = $req->author;
            $book->availability = 1;
            $book->save();
        }
    }

    public function all(Request $req) {
        if ($req->user()->tokenCan('read')) {
            $booksArr = Book::all();
            return $booksArr;
        }
    }

    public function delete(Request $req) {
        if ($req->user()->tokenCan('edit')) {
            Book::destroy($req->id);
        }
    }

    public function changeAvailabilty(Request $req) {
        if ($req->user()->tokenCan('edit')) {
            $book = Book::find($req->id);
            $book->availability = ($book->availability + 1) % 2;
            $book->save();
        }
    }
}

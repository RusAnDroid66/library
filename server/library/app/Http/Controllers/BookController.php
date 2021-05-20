<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{

    public function get_user(Request $req) {
        $token = \DB::table('personal_access_tokens')->where('token', $req->bearerToken())->first;
        $user = User::where('id', $token->tokenable_id);
        return $user;
    }

    public function add(Request $req) {
        Book::destroy($req->id);
        if ($user->tokenCan('edit')) {
            $book = new Book;
            $book->title = $req->title;
            $book->author = $req->author;
            $book->availability = 1;
            $book->save();
        }
    }

    public function all(Request $req) {
        $user = get_user($req);
        if ($user->tokenCan('read')) {
            $booksArr = Book::all();
            return $booksArr;
        }
    }

    public function delete(Request $req) {
        $user = get_user($req);
        if ($user->tokenCan('edit')) {
            Book::destroy($req->id);
        }
    }

    public function changeAvailabilty(Request $req) {
        Book::destroy($req->id);
        if ($user->tokenCan('edit')) {
            $book = Book::find($req->id);
            $book->availability = ($book->availability + 1) % 2;
            $book->save();
        }
    }
}

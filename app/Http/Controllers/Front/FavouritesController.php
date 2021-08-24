<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin\Book;
use Illuminate\Http\Request;

class FavouritesController extends Controller
{
    public function index(Book $book)
    {
        $book->favourites()->updateOrCreate([
           'user_id' => auth()->id()
        ],[
            'user_id' => auth()->id()
        ]);

        return 'success';
    }

    public function remove(Book $book)
    {
        $book->favourites()->delete();

        return 'success';
    }
}

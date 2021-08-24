<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin\Book;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index(Book $book)
    {
        validator(\request()->all(), [
            'point' => 'required',
        ])->validate();

        $book->ratings()->updateOrCreate([
            'user_id' => auth()->id()
        ],[
            'user_id' => auth()->id(),
            'point' => request()->get('point')
        ]);

        return 'success';
    }
}

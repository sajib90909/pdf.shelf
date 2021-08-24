<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin\Book;
use Illuminate\Http\Request;

class ViewBookController extends Controller
{
    public function index(Book $book)
    {
        //return view('front.viewBook');
        $book->views()->updateOrCreate([
            'user_id' => auth()->id()
        ],[
            'user_id' => auth()->id()
        ]);

        return redirect()->to($book->files()->first() ? $book->files()->first()->path : '/pdf/sample.pdf');
    }
}

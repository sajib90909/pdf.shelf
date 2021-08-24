<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Comment;
use App\Models\User;
use App\Services\Admin\BookService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookAttributeController extends Controller
{
    public function __construct(BookService $service)
    {
        $this->service = $service;
    }

    public function rating()
    {

    }

    public function favourite()
    {

    }

    public function view()
    {

    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use Illuminate\Http\Request;

class SelectableController extends Controller
{
    public function categories()
    {
        return Category::query()->select('id', 'name')->get();
    }
}

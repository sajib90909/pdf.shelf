<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::query()
            ->withCount('books')
            ->latest()
            ->paginate(\request()->get('per_page', 10));
    }

    public function show(Category $category)
    {
        return $category;
    }

    public function update(Category $category)
    {
        validator(\request()->all(), [
            'name' => 'required|unique:categories,name,'.$category->id,
        ])->validate();

        return $category->update([
            'name' => \request()->get('name'),
            'alias' => str_replace(' ', '_', strtolower(\request()->get('name')))
        ]);
    }

    public function store()
    {
        validator(\request()->all(), [
            'name' => 'required|unique:categories',
        ])->validate();

        Category::query()->create([
            'name' => \request()->get('name'),
            'alias' => str_replace(' ', '_', strtolower(\request()->get('name')))
        ]);

        return "category created successfully";
    }

    public function destroy(Category $category)
    {
        $books = $category->books()->count();
        if ($books) {
            return false;
        }

        $category->delete();

        return "category deleted successfully";
    }
}

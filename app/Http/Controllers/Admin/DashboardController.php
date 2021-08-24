<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Book;
use App\Models\Admin\Comment;
use App\Models\Admin\Rating;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::query()->count();
        $activeUser = User::query()->where('status', 'active')->count();
        $adminUser = User::query()->whereHas('role', fn(Builder $builder) => $builder->where('alias', 'admin'))->count();
        $userRoleUser = User::query()->whereHas('role', fn(Builder $builder) => $builder->where('alias', 'user'))->count();

        $books = Book::query()->count();
        $fiveStarBook = count(array_unique(Rating::query()->where('point', 5)->pluck('book_id')->toArray()));
        $uploadedUser = count(array_unique(Book::query()->pluck('upload_by')->toArray()));
        $comments = Comment::query()->count();

        return [
            'total_user' => $users,
            'admin_role_user' => $adminUser,
            'user_role_user' => $userRoleUser,
            'active_user' => $activeUser,
            'total_book' => $books,
            'five_star_book' => $fiveStarBook,
            'uploaded_user' => $uploadedUser,
            'comments' => $comments
        ];
    }
}

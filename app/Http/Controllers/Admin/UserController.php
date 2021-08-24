<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Core\Traits\FileHandler;
use App\Http\Controllers\Controller;
use App\Models\Admin\Book;
use App\Models\Admin\Favourite;
use App\Models\Admin\Rating;
use App\Models\Admin\View;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    use FileHandler;

    public function index()
    {
        return User::query()
            ->withCount('books')
            ->with('role', 'profilePicture')
            ->paginate(\request()->get('per_page', 10));
    }

    public function show(User $user)
    {
        $user->load('profilePicture');

        $favourite = Favourite::query()->whereHas('book', function (Builder $builder) use($user){
            $builder->where('upload_by', $user->id);
        })->count();

        $read = View::query()->where('user_id', $user->id)->count();

        $rating = Book::query()
            ->where('upload_by', $user->id)
            ->addSelect([
                'rating' => Rating::whereColumn('book_id', 'books.id')
                    ->selectRaw(DB::raw('AVG(point) AS points')),
            ])->get()->pluck('rating')->average();

        $user->favourite = $favourite;
        $user->read = $read;
        $user->rating = $rating;

        return $user;
    }

    public function update(User $user)
    {
        validator(\request()->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role_id' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000'
        ])->validate();

        $user->update([
            'name' => request()->get('name'),
            'email' => request()->get('email'),
            'role_id' => request()->get('role_id'),
            'bio' => request()->get('bio', ''),
        ]);

        if (request()->file('image')){
            $user->profilePicture()->delete();
            $user->profilePicture()->updateOrCreate([
                'type' => 'image',
                'name' => 'image',
                'path' => $this->storeFile(request()->file('image'), 'images')
            ]);
        }

        return 'success';
    }

}

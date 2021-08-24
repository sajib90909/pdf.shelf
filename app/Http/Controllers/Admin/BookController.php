<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Core\Traits\HasWhen;
use App\Http\Controllers\Controller;
use App\Models\Admin\Book;
use App\Models\Admin\Rating;
use App\Services\Admin\BookService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    use HasWhen;

    public function __construct(BookService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return Book::query()
            ->addSelect([
                'rating' => Rating::whereColumn('book_id', 'books.id')
                    ->selectRaw(DB::raw('AVG(point) AS points')),
            ])->withCount(['views', 'favourites', 'comments'])
            ->with([
                'uploader:id,name',
                'category:id,name',
                'images',
                'ratings' => function($builder){
                    $builder->where('user_id', request()->get('user', auth()->id()));
                },
                'favourites' => function($builder){
                    $builder->where('user_id', request()->get('user', auth()->id()));
                }
            ])
            ->where('is_published', true)
            ->when(request()->get('by') && request()->get('by') == 'uploaded', function (Builder $builder){
                $builder->where('upload_by', request()->get('user', auth()->id()));
            })->when(request()->get('by') && request()->get('by') == 'favourite', function (Builder $builder){
                $builder->whereHas('favourites', function (Builder $builder){
                    $builder->where('user_id', request()->get('user', auth()->id()));
                });
            })->when(request()->get('by') && request()->get('by') == 'top', function (Builder $builder){
                $builder->orderByDesc('favourites_count');
            })->when(request()->get('by') && request()->get('by') == 'featured', function (Builder $builder){
                $builder->orderByDesc('views_count');
            })->when(request()->get('by') && request()->get('by') == 'related', function (Builder $builder){
                $builder->inRandomOrder();
            })->when(request()->get('category'), function (Builder $builder){
                $builder->where('category_id', request()->get('category'));
            })->when(request()->get('search'), function (Builder $builder){
                $builder->where('name','like' , '%'.request()->get('search').'%');
            })->when(request()->get('short_by') && request()->get('short_by') == 'oldest', function (Builder $builder){
                $builder->oldest();
            }, function (Builder $builder){
                $builder->latest();
            })->paginate(request()->get('per_page', 10));
    }

    public function store(Request $request)
    {
        DB::transaction(function (){
            $this->service
                ->setAttrs(request()->only('name', 'description', 'writer', 'publisher', 'category_id', 'pdf', 'image'))
                ->setAttr('upload_by', Auth::id())
                ->validationsForSave()
                ->setBook(new Book())
                ->save();
        });

        return 'success';
    }

    public function show(Book $book)
    {
        return Book::query()
            ->where('id', $book->id)
            ->addSelect([
                'rating' => Rating::whereColumn('book_id', 'books.id')
                    ->selectRaw(DB::raw('AVG(point) AS points')),
            ])->withCount(['views', 'favourites', 'comments'])
            ->with([
                'uploader:id,name',
                'category:id,name',
                'images',
                'ratings' => function($builder){
                    $builder->where('user_id', \auth()->id());
                },
                'favourites' => function($builder){
                    $builder->where('user_id', \auth()->id());
                }
            ])
            ->where('is_published', true)
            ->first();
    }

    public function update(Request $request, Book $book)
    {
        DB::transaction(function () use($book){
            $this->service
                ->setAttrs(\request()->only('name', 'description', 'writer', 'publisher', 'category_id', 'pdf', 'image'))
                ->setAttr('upload_by', Auth::id())
                ->validationsForUpdate()
                ->setBook($book)
                ->update();
        });
    }

    public function destroy(Book $book)
    {
        $this->service
            ->setBook($book)
            ->delete();
    }
}

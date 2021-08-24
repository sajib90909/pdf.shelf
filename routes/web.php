<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SelectableController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Front\FavouritesController;
use App\Http\Controllers\Front\RatingController;
use App\Http\Controllers\Front\UserInfoController;
use App\Http\Controllers\Front\ViewBookController;
use App\Http\Controllers\HomeController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Auth::loginUsingId(1);

Auth::routes();

//admin panels route
Route::prefix('/admin-panel')->middleware(['auth', 'authenticate.role'])->group(function (Router $router) {
    $router->get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    $router->any('/{slug?}', [HomeController::class, 'index'])->where('slug', '[\/\w\.-]*')->name('admin.panel');
});

//api admin-panel route
Route::prefix('app/admin-panel')->middleware('auth')->group(function (Router $router) {
    $router->apiResource('books', BookController::class)->except('update');
    $router->post('books/update/{book}', [BookController::class , 'update'])->name('book.update');

    $router->apiResource('users', UserController::class)->except('update');
    $router->post('users/update/{user}', [UserController::class , 'update'])->name('user.update');
    $router->get('dashboard', [DashboardController::class , 'index'])->name('dashboard.view');

    $router->apiResource('categories', CategoryController::class);
});

Route::prefix('app/selectable')->group(function (Router $router) {

    $router->get('categories', [SelectableController::class, 'categories'])
        ->name('selectable.categories');
});

Route::prefix('app')->group(function (Router $router) {
    $router->get('books', [BookController::class, 'index'])
        ->name('books.view');

    $router->get('book/{book}', [BookController::class, 'show'])
        ->name('book.view');

    $router->get('comments/{book}', [CommentController::class, 'comments'])
        ->name('comments.view');

    $router->get('authenticate-user', [UserInfoController::class, 'index'])
        ->name('authenticate.user');

    $router->middleware('auth')->group(function (Router $router) {

        $router->get('user/{user}', [UserController::class, 'show'])
            ->name('profile.view');

        $router->get('view-book/{book}', [ViewBookController::class, 'index'])
            ->name('book.view');

        $router->post('add/comment/{book}', [CommentController::class, 'store'])
            ->name('comments.add');

        $router->post('add/favourite/{book}', [FavouritesController::class, 'index'])
            ->name('favourite.add');

        $router->post('remove/favourite/{book}', [FavouritesController::class, 'remove'])
            ->name('favourite.remove');

        $router->post('add/rating/{book}', [RatingController::class, 'index'])
            ->name('rating.add');

        $router->post('comment-like/add/{comment}', [CommentController::class, 'commentLike'])
            ->name('comment_like.add');

        $router->post('comment-like/remove/{comment}', [CommentController::class, 'removeCommentLike'])
            ->name('comment_like.remove');
    });
});


Route::get('/{slug?}', function () { return view('front.master'); })
    ->where('slug', '[\/\w\.-]*')
    ->name('home');

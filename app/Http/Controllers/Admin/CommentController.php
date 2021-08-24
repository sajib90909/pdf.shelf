<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Book;
use App\Models\Admin\Comment;
use App\Models\User;
use App\Services\Admin\CommentService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct(CommentService $service)
    {
        $this->service = $service;
    }

    public function comments(Book $book)
    {
        return $book
            ->load([
                'comments',
                'comments.replies',
                'comments.user',
                'comments.user.profilePicture',
            ])
            ->comments
            ->load(['likes' => fn($builder) => $builder->where('user_id', auth()->id())])
            ->loadCount('likes');
    }

    public function store(Book $book)
    {
        $this->service
            ->setModel(User::query()->find(\auth()->id()))
            ->setBook($book)
            ->setAttr('text', \request()->get('text'))
            ->validations()
            ->saveComments();
    }

    public function addReplies(Comment $comment)
    {
        $this->service
            ->setModel(User::query()->find(Auth::id()))
            ->setComment($comment)
            ->setAttr('text', \request()->get('text'))
            ->validations()
            ->addCommentReplies();
    }

    public function commentLike(Comment $comment)
    {
        $this->service
            ->setModel(User::query()->find(Auth::id()))
            ->setComment($comment)
            ->addLike();
    }

    public function removeCommentLike(Comment $comment)
    {
        $this->service
            ->setModel(User::query()->find(Auth::id()))
            ->setComment($comment)
            ->removeLike();
    }

    public function delete(Comment $comment)
    {
        $comment->replies()->delete();
        $comment->delete();

        return 'Comment successfully deleted';
    }
}

<?php

namespace App\Services\Admin;

use App\Models\Admin\Book;
use App\Models\Admin\Comment;

class CommentService extends BookService
{
    public function saveComments(): self
    {
        $this->book->comments()->save(new Comment([
            'text' => $this->getAttr('text'),
            'user_id' => $this->model->id,
        ]));

        return $this;
    }

    public function setComment(Comment $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function addCommentReplies()
    {
        $this->comment->replies()->save(new Comment([
            'text' => $this->getAttr('text'),
            'user_id' => $this->model->id,
        ]));
    }

    public function addLike(){
        $this->comment->likes()->updateOrCreate([
            'user_id' => $this->model->id
        ],[
            'user_id' => $this->model->id
        ]);
    }

    public function removeLike(){
        $this->comment->likes()->delete();
    }

    public function validations(): self
    {
        validator($this->getAttrs(), [
            'text' => 'required',
        ])->validate();

        return $this;
    }
}

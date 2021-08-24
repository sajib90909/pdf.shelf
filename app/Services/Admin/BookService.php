<?php

namespace App\Services\Admin;

use App\Helpers\Core\Traits\FileHandler;
use App\Models\Admin\Book;
use App\Models\Admin\Comment;
use App\Models\Admin\Favourite;
use App\Models\Admin\Rating;
use App\Models\Admin\View;
use App\Services\Core\BaseService;

class BookService extends BaseService
{
    use FileHandler;
    public Book $book;
    public Comment $comment;

    public function saveRating(): self
    {
        $this->book->ratings()->save(new Rating([
            'point' => $this->getAttr('point'),
            'user_id' => $this->model->id,
        ]));

        return $this;
    }

    public function saveFavourite(): self
    {
        $this->book->favourites()->save(new Favourite([
            'user_id' => $this->model->id,
        ]));

        return $this;
    }

    public function saveView(): self
    {
        $this->book->views()->save(new View([
            'user_id' => $this->model->id,
        ]));

        return $this;
    }

    public function setBook(Book $book): self
    {
        $this->book = $book;

        return $this;
    }

    public function save(): self
    {
        $this->book
            ->fill($this->getFillAble())
            ->save();

        $this->savePdf()
            ->saveImage();

        return $this;
    }

    public function savePdf(): self
    {
        if ($this->hasAttr('pdf') && $this->getAttr('pdf')){
            $this->book->files()->delete();
            $this->book->attachments()->updateOrCreate([
                'type' => 'pdf',
                'name' => 'image',
                'path' => $this->storeFile($this->getAttr('pdf'), 'pdf')
            ]);
        }

        return $this;
    }

    public function saveImage(): self
    {
        if ($this->hasAttr('image') && $this->getAttr('image')){
            $this->book->images()->delete();
            $this->book->attachments()->updateOrCreate([
                'type' => 'image',
                'name' => 'image',
                'path' => $this->storeFile($this->getAttr('image'), 'images')
            ]);
        }

        return $this;
    }

    public function update(): self
    {
        $this->book->update($this->getFillAble());

        $this->savePdf()
            ->saveImage();

        return $this;
    }

    public function delete(): self
    {
        $this->book->ratings()->delete();
        $this->book->views()->delete();
        $this->book->favourites()->delete();
        $this->book->attachments()->delete();
        $this->book->comments()->delete();
        $this->book->delete();

        return $this;
    }

    public function validationsForSave(): self
    {
        validator($this->getAttrs(), [
            'name' => 'required',
            'description' => 'required',
            'writer' => 'required',
            'publisher' => 'required',
            'upload_by' => 'required',
            'category_id' => 'required',
            'pdf' => 'required|mimes:pdf',
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:10000'
        ])->validate();

        return $this;
    }

    public function validationsForUpdate(): self
    {
        validator($this->getAttrs(), [
            'name' => 'required',
            'description' => 'required',
            'writer' => 'required',
            'publisher' => 'required',
            'upload_by' => 'required',
            'category_id' => 'required',
            'pdf' => 'nullable|mimes:pdf',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000'
        ])->validate();

        return $this;
    }
}

<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'writer', 'publisher', 'upload_by', 'category_id'];
    /**
     * @var mixed
     */
    public $rating;

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function avgRating()
    {
        return $this->ratings()->average('point');
    }

    public function views(): HasMany
    {
        return $this->hasMany(View::class);
    }

    public function favourites(): HasMany
    {
        return $this->hasMany(Favourite::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function attachments(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function files(): MorphMany
    {
        return $this->attachments()
            ->where('type','pdf');
    }

    public function images(): MorphMany
    {
        return $this->attachments()
            ->where('type','image');
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'upload_by');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}

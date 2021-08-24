<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['text', 'user_id', 'book_id', 'comment_id'];

    public function parentComment(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'comment_id','id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'id','comment_id');
    }

    public function likes(): HasMany
    {
        return $this->hasMany(CommentLike::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

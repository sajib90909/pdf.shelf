<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['name', 'alias', 'category_id'];

    use HasFactory;

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}

<?php

namespace App\Models\Administration;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'alias'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}

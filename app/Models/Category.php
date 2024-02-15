<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['label'];

    public function tools(): HasMany
    {
        return $this->hasMany(Tool::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'category_user', 'user_id', 'category_id');
    }
}

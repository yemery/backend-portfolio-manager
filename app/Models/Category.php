<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['label','user_id'];

    public function tools(): HasMany
    {
        return $this->hasMany(Tool::class);
    }
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['title','sub_title','github_repo','host_url','user_id'];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function tools(): BelongsToMany
    {
        return $this->belongsToMany(Tool::class, 'project_tool', 'project_id', 'tool_id');
    }
}

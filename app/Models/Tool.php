<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tool extends Model
{
    use HasFactory;
    protected $fillable = ['label','toolcategory_id'];

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class,'project_tool', 'project_id', 'tool_id');
    }
    public function toolCategory(): BelongsTo
    {
        return $this->belongsTo(ToolCategory::class);
    }
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}

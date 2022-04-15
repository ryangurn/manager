<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Project extends Model
{
    /**
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    /**
     * @return HasManyThrough
     */
    public function users(): HasManyThrough
    {
        return $this->hasManyThrough(
            User::class,
            ProjectMember::class,
            'project_id',
            'id',
            'id',
            'user_id');
    }

    /**
     * @return HasMany
     */
    public function members(): HasMany
    {
        return $this->hasMany(ProjectMember::class, 'project_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function taskLists(): HasMany
    {
        return $this->hasMany(TaskList::class, 'project_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Note extends Model
{
    protected $fillable = ['category_id', 'title', 'content', 'type', 'view_count'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function viewers(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
                    ->withPivot('viewed_at')
                    ->withTimestamps();
    }

    public function cartedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'cart_items')
                    ->withTimestamps();
    }
}

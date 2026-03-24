<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'profile_picture',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    /**
     * Recently viewed notes.
     */
    public function viewedNotes(): BelongsToMany
    {
        return $this->belongsToMany(Note::class)
                    ->withPivot('viewed_at')
                    ->withTimestamps()
                    ->orderByPivot('viewed_at', 'desc');
    }

    /**
     * Notes added to the cart.
     */
    public function cartNotes(): BelongsToMany
    {
        return $this->belongsToMany(Note::class, 'cart_items')
                    ->withTimestamps();
    }

    /**
     * Check if a note is in the user's cart.
     */
    public function isInCart(Note $note): bool
    {
        return $this->cartNotes()->where('note_id', $note->id)->exists();
    }
}

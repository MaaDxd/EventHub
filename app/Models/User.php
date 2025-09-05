<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function createdEvents()
    {
        return $this->hasMany(Event::class, 'creator_id');
    }

    // Relación con favoritos
    public function favorites()
    {
        return $this->hasMany(UserFavorite::class);
    }

    // Relación many-to-many con eventos favoritos
    public function favoriteEvents()
    {
        return $this->belongsToMany(Event::class, 'user_favorites')->withTimestamps()->whereNull('events.deleted_at');
    }

    // Método para verificar si un evento es favorito del usuario
    public function hasFavorite($eventId)
    {
        return $this->favoriteEvents()->where('event_id', $eventId)->exists();
    }
}

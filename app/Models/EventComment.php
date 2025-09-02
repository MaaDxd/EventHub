<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EventComment extends Model
{
    protected $fillable = [
        'event_id',
        'user_id',
        'parent_id',
        'content',
        'is_creator_response'
    ];

    protected $casts = [
        'is_creator_response' => 'boolean',
    ];

    // Relación con el evento
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    // Relación con el usuario que escribió el comentario
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relación con el comentario padre (para respuestas)
    public function parent(): BelongsTo
    {
        return $this->belongsTo(EventComment::class, 'parent_id');
    }

    // Relación con las respuestas (comentarios hijos)
    public function replies(): HasMany
    {
        return $this->hasMany(EventComment::class, 'parent_id')->orderBy('created_at', 'asc');
    }

    // Scope para obtener solo comentarios principales (no respuestas)
    public function scopeMainComments($query)
    {
        return $query->whereNull('parent_id');
    }

    // Scope para obtener solo respuestas del creador del evento
    public function scopeCreatorResponses($query)
    {
        return $query->where('is_creator_response', true);
    }
}

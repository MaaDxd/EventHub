<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'date',
        'time',
        'location',
        'image',
        'category_id',
        'category_type',
        'creator_id',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
        'time' => 'datetime:H:i',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function comments()
    {
        return $this->hasMany(EventComment::class)->orderBy('created_at', 'desc');
    }

    public function mainComments()
    {
        return $this->hasMany(EventComment::class)->mainComments()->with(['user', 'replies.user'])->orderBy('created_at', 'desc');
    }
}

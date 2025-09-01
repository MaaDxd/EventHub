<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class QrLoginToken extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'token',
        'user_id',
        'is_used',
        'expires_at'
    ];

    /**
     * Los atributos que deben ser casteados a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'expires_at' => 'datetime',
        'is_used' => 'boolean'
    ];

    /**
     * Obtiene el usuario asociado con este token de login QR.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Comprueba si el token ha expirado.
     *
     * @return bool
     */
    public function isExpired()
    {
        return $this->expires_at->isPast();
    }

    /**
     * Comprueba si el token todavía es válido (no ha sido usado y no ha expirado).
     *
     * @return bool
     */
    public function isValid()
    {
        return !$this->is_used && !$this->isExpired();
    }
}

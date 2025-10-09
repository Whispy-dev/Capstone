<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'password',
        'is_manager',
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
            'is_manager' => 'boolean',
        ];
    }
    
    public function area()
    {
        return $this->belongsTo(Area::class);
    }
    
    public function positions()
    {
        return $this->belongsToMany(Position::class, 'user_positions')
                    ->withPivot('assigned_at', 'ended_at')
                    ->withTimestamps();
    }
    
    public function deviceTokens()
    {
        return $this->hasMany(DeviceToken::class);
    }
    
    public function municipality()
    {
        return $this->belongsTo(\App\Models\Municipality::class);
    }
}

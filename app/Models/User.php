<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['email', 'password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['avatar'];

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function getAvatarAttribute()
    {
        return asset('images/avatars/default-avatar-1.png');
    }
}

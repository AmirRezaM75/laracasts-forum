<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = ['username', 'email', 'password', 'avatar'];

    protected $hidden = ['email', 'password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['avatar'];

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function recentReply()
    {
        return $this->hasOne(Reply::class)->latest();
    }

    public function getAvatarAttribute($avatar)
    {
        return asset($avatar ? "storage/avatars/{$avatar}"  : 'images/avatars/default-avatar-1.png');
    }

    public function read($thread)
    {
        cache()->forever(
            $this->visitedThreadCacheKey($thread->id),
            Carbon::now()
        );
    }

    public function isAdmin()
    {
        return in_array($this->email, explode(',', env('ADMIN_EMAIL')));
    }

    public function visitedThreadCacheKey($threadId)
    {
        return sprintf("user.%s.visited.%s", $this, $threadId);
    }
}

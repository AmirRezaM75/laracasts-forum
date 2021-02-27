<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favoritable');
    }

    public function favorite()
    {
        $attributes = ['user_id' => auth()->id()];
        if (! $this->favorites()->where($attributes)->exists())
            $this->favorites()->create($attributes);
    }

    public function isFavorited()
    {
        return $this->favorites->where(['user_id' => auth()->id()])->count() > 0;
    }
}

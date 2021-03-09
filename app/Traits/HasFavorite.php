<?php


namespace App\Traits;


use App\Models\Favorite;

trait HasFavorite
{
    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }

    public function getIsFavoritedAttribute()
    {
        return $this->isFavorited();
    }

    public function isFavorited()
    {
        return (bool) $this->favorites->where('user_id', auth()->id())->count();
    }

    public function favorite()
    {
        $attributes = ['user_id' => auth()->id()];
        if (!$this->favorites()->where($attributes)->exists())
            $this->favorites()->create($attributes);
    }

    public function unfavorite()
    {
        $this->favorites()->where(['user_id' => auth()->id()])->delete();
    }

    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favoritable');
    }
}

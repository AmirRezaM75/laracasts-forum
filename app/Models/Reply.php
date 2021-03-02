<?php

namespace App\Models;

use App\Traits\HasActivity;
use App\Traits\HasFavorite;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory, HasFavorite, HasActivity;

    protected $guarded = [];

    protected $with = ['user', 'favorites'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

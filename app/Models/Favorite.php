<?php

namespace App\Models;

use App\Traits\HasActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory, HasActivity;

    protected $guarded = [];

    public function favorited()
    {
        return $this->morphTo('favoritable');
    }
}

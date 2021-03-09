<?php

namespace App\Http\Controllers;

use App\Models\Reply;

class FavoriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Reply $reply)
    {
        $reply->favorite();

        return response()->noContent();
    }

    public function destroy(Reply $reply)
    {
        $reply->unfavorite();

        return response()->noContent();
    }
}

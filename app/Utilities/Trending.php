<?php

namespace App\Utilities;

use Illuminate\Support\Facades\Redis;

class Trending
{
    public static $key = 'trending';

    public static function get()
    {
        return Redis::zrevrange(static::$key, 0, -1);
    }

    public static function score($threadId)
    {
        return Redis::zscore(static::$key, $threadId) ?? 0;
    }

    public static function push($threadId)
    {
        Redis::zincrby(static::$key, 1, $threadId);
    }

    public static function flush()
    {
        Redis::del(static::$key);
    }
}

<?php

namespace App\Filters;


use App\Models\User;
use App\Utilities\Trending;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Redis;

class ThreadFilters extends Filters
{
    public static $filters = ['by', 'popular', 'unanswered', 'trending'];

    /**
     * @param string $username
     * @return Builder
     */
    protected function by($username)
    {
        $user = User::where('name', $username)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
    }

    protected function popular()
    {
        // $this->builder->toSql()

        return $this->builder->orderBy('replies_count', 'desc');
    }

    protected function unanswered()
    {
        return $this->builder->whereHas('replies', null, '=', 0);
    }

    protected function trending()
    {
        $this->builder->getQuery()->orders = [];

        $ids = Trending::get();

        return $this->builder->whereIn('id', $ids)
            ->orderByRaw("FIELD(id," . implode(',', $ids) . ")");
    }
}

<?php

namespace App\Filters;


use App\Models\User;
use App\Utilities\Trending;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class ThreadFilters extends Filters
{
    public static $filters = ['by', 'popular', 'fresh', 'trending', 'answered'];

    /**
     * @param string $username
     * @return Builder
     */
    protected function by($username)
    {
        $user = User::where('username', $username)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
    }

    protected function popular()
    {
        // $this->builder->toSql()

        return $this->builder->orderBy('replies_count', 'desc');
    }

    protected function fresh()
    {
        return $this->builder->whereHas('replies', null, '=', 0);
    }

    protected function trending()
    {
        $this->builder->getQuery()->orders = [];

        $ids = Trending::get();

        return $this->builder->whereIn('id', $ids)
            ->orderByRaw("FIELD(id," . implode(',', $ids) . ")")
            ->whereDate('created_at', '>=', Carbon::today()->startOfWeek());
    }


    protected function answered($state)
    {
        return $this->builder->{$state ? 'whereNotNull' : 'whereNull'}('answer_id');
    }
}

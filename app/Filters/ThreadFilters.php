<?php

namespace App\Filters;


use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class ThreadFilters extends Filters
{
    protected $filters = ['by', 'popular'];

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

        /*
            select "threads".*,
            (select count(*) from "replies" where "threads"."id" = "replies"."thread_id") as "replies_count" from "threads"
            order by "created_at" desc, "replies_count" desc
        */

        // $this->builder->getQuery()->orders = [];

        return $this->builder->orderBy('replies_count', 'desc');
    }
}

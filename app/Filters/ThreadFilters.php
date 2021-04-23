<?php

namespace App\Filters;


use App\Models\User;
use App\Utilities\Trending;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ThreadFilters extends Filters
{
    public static $filters = ['by', 'popular', 'fresh', 'trending', 'answered', 'contributed', 'besties'];

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

    protected function contributed()
    {
        return $this->builder->whereHas('replies', function($query) {
                return $query->where('user_id', auth()->id());
            });
    }

    protected function besties()
    {
        return $this->builder->whereIn('answer_id', array_column(
            DB::table('replies')->select('id')->where('user_id', auth()->id())->get()->toArray(),
            'id'
        ));
    }
}

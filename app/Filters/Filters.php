<?php


namespace App\Filters;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class Filters
{

    protected $request, $builder;
    protected $filters = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        /* Functional Approach
         *
        $this->getFilters()
            ->filter(function($filter) {
                return method_exists($this, $filter);
            })
            ->each(function($filter, $value) {
                $this->$filter($value);
            });
        */

        foreach($this->getFilters() as $filter => $value) {
            if (method_exists($this, $filter))
                $this->$filter($value);
        }

        return $builder;
    }

    protected function getFilters()
    {
        return $this->request->only($this->filters);
//        return collect($this->request->only($this->filters))->flip();
    }
}

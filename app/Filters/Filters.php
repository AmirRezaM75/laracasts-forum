<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class Filters
{

    protected $request, $builder;

    public static $filters = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach($this->getFilters() as $filter => $value) {
            if (method_exists($this, $filter))
                $this->$filter($value);
        }

        return $builder;
    }

    protected function getFilters()
    {
        return $this->request->only(static::$filters);
    }
}

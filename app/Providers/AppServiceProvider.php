<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // View::share('categories', Category::all());
        // It runs before database migration in tests

        View::composer('*', function($view) {
            $view->with('categories', Category::all());
        });
    }
}

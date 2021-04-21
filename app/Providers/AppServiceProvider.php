<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;
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
            $categories = Cache::rememberForever('categories', function() {
                return Category::all();
            });

            $view->with(compact('categories'));
        });

        View::composer('threads.index', function($view) {
            $menu = collect([
                [
                    'query' => '',
                    'isActive' => request()->is('threads') and empty(request()->query()),
                    'order' => 1,
                    'svg' => '
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" class="mr-4 fill-current">
                            <g fill-rule="nonzero">
                                <path
                                    d="M2.998 13.622l-.92-9.799a1.023 1.023 0 0 1 .65-1.053.346.346 0 0 0-.087-.664l-.873-.103a.346.346 0 0 0-.383.3L.003 13.348a.346.346 0 0 0 .304.386l2.308.264a.346.346 0 0 0 .384-.376z"
                                ></path>
                                <path
                                    d="M15.998 13.3L14.81 3.62a.33.33 0 0 0-.237-.28.32.32 0 0 0-.344.121c-.554.746-1.45 1.101-2.39.843a.324.324 0 0 0-.314.086l-1.012 1.032a.984.984 0 0 1-1.378 0 .998.998 0 0 1-.286-.704 1 1 0 0 1 .285-.704l.44-.448a.339.339 0 0 0 .063-.38.325.325 0 0 0-.331-.183l-6.02.723a.33.33 0 0 0-.285.36L3.976 14.7c.009.088.052.17.12.226a.32.32 0 0 0 .241.072l11.375-1.327a.322.322 0 0 0 .218-.124.338.338 0 0 0 .068-.247z"
                                ></path>
                                <path
                                    d="M12.214 0c-.985 0-1.785.801-1.785 1.786 0 .363.11.7.297.983L9.104 4.39a.357.357 0 0 0 .506.506l1.622-1.622c.282.187.619.297.982.297C13.2 3.571 14 2.77 14 1.786 14 .8 13.2 0 12.214 0z"
                                ></path>
                            </g>
                        </svg>
                        ',
                    'name' => 'All Threads'
                ],
                [
                    'query' => '?trending=1',
                    'isActive' => request()->has('trending'),
                    'order' => 3,
                    'svg' => '
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="13" viewBox="0 0 19 13" class="mr-4 fill-current">
                            <g fill="none" fill-rule="evenodd">
                                <path d="M0-3h19v19H0z"></path>
                                <path
                                    fill="currentColor"
                                    d="M9.5.562C5.542.562 2.161 3.025.792 6.5c1.37 3.475 4.75 5.937 8.708 5.937s7.339-2.462 8.708-5.937C16.838 3.025 13.458.562 9.5.562zm0 9.896A3.96 3.96 0 0 1 5.542 6.5 3.96 3.96 0 0 1 9.5 2.542 3.96 3.96 0 0 1 13.458 6.5 3.96 3.96 0 0 1 9.5 10.458zm0-6.333A2.372 2.372 0 0 0 7.125 6.5 2.372 2.372 0 0 0 9.5 8.875 2.372 2.372 0 0 0 11.875 6.5 2.372 2.372 0 0 0 9.5 4.125z"
                                ></path>
                            </g>
                        </svg>
                        ',
                    'name' => 'Popular This Week'
                ],
                [
                    'query' => '?popular=1',
                    'isActive' => request()->has('popular'),
                    'order' => 4,
                    'svg' => '
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" class="mr-4 fill-current">
                            <path
                                fill-rule="nonzero"
                                d="M3.277 15a.46.46 0 0 1-.192-.063.347.347 0 0 1-.128-.347l1.409-5.168L.14 6.05c-.128-.063-.16-.22-.128-.346a.307.307 0 0 1 .288-.22L5.743 5.2 7.696.19c.064-.095.192-.19.32-.19s.256.095.288.19l1.953 5.01 5.443.283c.128 0 .256.095.288.22a.352.352 0 0 1-.096.347l-4.226 3.372 1.408 5.168a.312.312 0 0 1-.128.347c-.096.063-.256.095-.352 0l-4.578-2.9-4.579 2.9c-.064.063-.096.063-.16.063z"
                            ></path>
                        </svg>
                        ',
                    'name' => 'Popular All Time'
                ],
                [
                    'query' => '?answered=1',
                    'isActive' => request()->get('answered') === '1',
                    'order' => 5,
                    'svg' => '
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" class="mr-4 fill-current">
                            <g fill="none" fill-rule="evenodd">
                                <circle cx="8" cy="8" r="8" class="fill-current"></circle>
                                <path fill="#FFF" d="M6.997 9.562L5.207 7.78a.386.386 0 0 0-.557 0 .382.382 0 0 0 0 .554l2.347 2.337 4.494-4.476a.382.382 0 0 0 0-.554.386.386 0 0 0-.556 0L6.997 9.56z"></path>
                            </g>
                        </svg>
                        ',
                    'name' => 'Solved'
                ],
                [
                    'query' => '?answered=0',
                    'isActive' => request()->get('answered') === '0',
                    'order' => 6,
                    'svg' => '
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" class="mr-4 fill-current">
                            <g fill="none" fill-rule="evenodd">
                                <circle cx="8" cy="8" r="8" class="fill-current"></circle>
                                <path fill="#FFF" d="M5.667 5L5 5.667 7.333 8 5 10.333l.667.667L8 8.667 10.333 11l.667-.667L8.667 8 11 5.667 10.333 5 8 7.334z"></path>
                            </g>
                        </svg>
                        ',
                    'name' => 'Unsolved'
                ],
                [
                    'query' => '?fresh=1',
                    'isActive' => request()->has('fresh'),
                    'order' => 7,
                    'svg' => '
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" class="mr-4 fill-current">
                            <path fill-rule="nonzero" d="M15.206 7.366v4.401s-1.882-4.202-4.203-4.202h-4.5v3.602L0 5.664l6.503-5.5v2.999h4.5a4.204 4.204 0 0 1 4.203 4.203z"></path>
                        </svg>
                        ',
                    'name' => 'No Replies Yet'
                ],
            ]);

            if (auth()->check())
                $menu->push([
                    'query' => '?by=' . auth()->user()->username,
                    'isActive' => request()->has('by'),
                    'order' => 2,
                    'svg' => '
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" class="mr-4 fill-current">
                                <path
                                    fill-rule="nonzero"
                                    d="M7.893 0a8 8 0 1 0 .216 16 8 8 0 0 0-.216-16zM7.87 12.87l-.045-.001c-.68-.02-1.16-.522-1.14-1.192.019-.659.51-1.137 1.168-1.137h.04c.699.022 1.173.518 1.153 1.207-.02.661-.503 1.123-1.176 1.123zm2.861-5.68c-.16.227-.512.51-.955.855l-.488.337c-.268.208-.43.404-.49.597-.048.152-.072.192-.076.5v.08H6.856l.006-.158c.023-.649.039-1.03.307-1.345.422-.495 1.352-1.094 1.391-1.12.133-.1.246-.214.33-.336.195-.27.282-.482.282-.691 0-.29-.086-.557-.256-.796-.163-.23-.474-.346-.922-.346-.445 0-.75.14-.932.43a1.73 1.73 0 0 0-.283.931v.08H4.858l.004-.083c.05-1.178.47-2.025 1.248-2.52.49-.315 1.098-.475 1.808-.475.93 0 1.715.226 2.333.672.626.451.944 1.128.944 2.01a2.3 2.3 0 0 1-.464 1.378z"
                                ></path>
                            </svg>
                        ',
                    'name' => 'My Questions'
                ]);

            $view->with(['menu' => $menu->sortBy('order')]);
        });
    }
}

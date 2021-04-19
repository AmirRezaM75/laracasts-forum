@extends('layouts.master')

@section('content')
    <threads-view inline-template :categories="{{ $categories }}">
        <div class="flex flex-col flex-col-reverse md:flex-row mx-auto" style="max-width: 1070px;">
            <div class="hidden lg:block lg:sticky lg:self-start flex-none mr-9" style="min-width: 200px; top: 40px;">
                <div class="lg:sticky lg:text-center">
                    <a class="btn btn-blue mb-8 w-full"
                       style="box-shadow: rgb(215, 232, 253) 0px 4px 10px 1px;"
                       @click.prevent="create">
                        New Discussion
                    </a>
                    @include('partials.sidebar')
                </div>
            </div>
            <div class="flex-1">
                <div class="forum-main lg:flex">
                    <div class="lg:flex-1">
                        <div class="flex justify-center md:justify-between mb-8">
                            <div class="flex flex-1">
                                <div class="mobile:mr-4 md:hidden lg:block mr-6">
                                    <div class="select-wrap">
                                        <select
                                            @change="filter"
                                            class="text-grey-darker text-sm bg-grey-panel rounded-full px-5 py-3 flex items-center cursor-pointer leading-none"
                                            style="width: 115px;">
                                            <option value="">Latest</option>
                                            <option value="?trending=1">Popular This Week</option>
                                            <option value="?popular=1">Popular All Time</option>
                                            <option value="?answered=1">Solved</option>
                                            <option value="?answered=0">Unsolved</option>
                                            <option value="?fresh=1">No Replies Yet</option>
                                            <option value="?me">My Questions</option>
                                            <option value="?filter_by=contributed_to">My Participation</option>
                                            <option value="?filter_by=best_answers">My Best Answers</option>
                                            <option value="?favorites=1">Following</option>
                                        </select>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="16" viewBox="0 0 10 16" class="fill-current text-grey-dark">
                                            <path d="M5 11L0 6l1.5-1.5L5 8.25 8.5 4.5 10 6z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <div class="select-wrap">
                                        <select
                                            @change="filter"
                                            class="text-grey-darker text-sm bg-grey-panel rounded-full px-5 cursor-pointer"
                                            style="width: 92px;">
                                            <option value="all">All</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->slug }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="16" viewBox="0 0 10 16" class="fill-current text-grey-darker"><path d="M5 11L0 6l1.5-1.5L5 8.25 8.5 4.5 10 6z"></path></svg>
                                    </div>
                                </div>
                            </div>

                            <excerpt-buttons></excerpt-buttons>

                            <form action="{{ route('threads.index') }}"
                                  autocomplete="off"
                                  class="search-form bg-grey-panel rounded-full hidden md:block md:w-52"
                            >
                                <input name="q" placeholder="Whatcha Looking For?" value="{{ Request::get('q', '') }}" class="px-5 pt-0 text-sm w-full h-full" />
                            </form>
                        </div>
                        <div class="conversation-list">
                            @include('threads._list')
                        </div>
                        <div class="mt-6">
                            {{ $threads->appends(Request::only(\App\Filters\ThreadFilters::$filters))->links() }}
                        </div>
                        <div class="participate-button fixed z-40" style="display: none;">
                            <a class="bg-blue hover:bg-blue-dark rounded-full w-16 h-16 text-center flex items-center justify-center shadow-lg">
                                <img src="{{ asset('images/icons/reply-mobile-button.svg') }}" alt="Create a New Discussion Button" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </threads-view>
@endsection

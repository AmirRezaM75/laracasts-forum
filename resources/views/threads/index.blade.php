@extends('layouts.master')

@section('content')
    <threads-view inline-template :categories="{{ $categories }}">
        <div class="flex flex-col flex-col-reverse md:flex-row mx-auto" style="max-width: 1070px;">
            <div class="hidden lg:block lg:sticky lg:self-start flex-none mr-9" style="min-width: 200px; top: 40px;">
                <div class="lg:sticky lg:text-center">
                    <a class="btn btn-blue mb-8 w-full"
                       @if(auth()->check() && auth()->user()->hasVerifiedEmail())
                       :class="['btn-unique']"
                       @else
                       style="box-shadow: rgb(215, 232, 253) 0 4px 10px 1px;"
                       @endif
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
                                    <thread-filters :items="{{ $menu }}"></thread-filters>
                                </div>
                                <div>
                                    <thread-categories
                                        :items="{{ $categories }}"
                                        :selected="{{ json_encode(Request::route('category')) }}"></thread-categories>
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

@extends('layouts.master')

@section('content')
    <div class="flex flex-col flex-col-reverse md:flex-row mx-auto" style="max-width: 1070px;">
        <div class="hidden lg:block lg:sticky lg:self-start flex-none mr-9" style="min-width: 200px; top: 40px;">
            <div class="lg:sticky lg:text-center">
                <a data-toggle="modal" data-target="thread-modal" class="btn btn-blue mb-8 w-full" style="box-shadow: rgb(215, 232, 253) 0px 4px 10px 1px;">
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
                                    <select class="text-grey-darker text-sm bg-grey-panel rounded-full px-5 py-3 flex items-center cursor-pointer leading-none" style="width: 115px;">
                                        <option value="">Latest</option>
                                        <option value="?trending=1">Popular This Week</option>
                                        <option value="?popular=1">Popular All Time</option>
                                        <option value="?answered=1">Solved</option>
                                        <option value="?answered=0">Unsolved</option>
                                        <option value="?fresh=1">No Replies Yet</option>
                                        <option value="?me">My Questions</option>
                                        <option value="/leaderboard">Leaderboard</option>
                                        <option value="?filter_by=contributed_to">My Participation</option>
                                        <option value="?filter_by=best_answers">My Best Answers</option>
                                        <option value="?favorites=1">Following</option>
                                    </select>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="16" viewBox="0 0 10 16" class="fill-current text-grey-dark"><path d="M5 11L0 6l1.5-1.5L5 8.25 8.5 4.5 10 6z"></path></svg>
                                </div>
                            </div>
                            <div>
                                <div class="select-wrap">
                                    <select class="text-grey-darker text-sm bg-grey-panel rounded-full px-5 cursor-pointer" style="width: 92px;">
                                        <option value="all">All</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->slug }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="16" viewBox="0 0 10 16" class="fill-current text-grey-darker"><path d="M5 11L0 6l1.5-1.5L5 8.25 8.5 4.5 10 6z"></path></svg>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center md:px-4">
                            <button class="forum-excerpt-toggle">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" class="mx-2">
                                    <g fill="#78909C" fill-rule="evenodd" class="forum-excerpt-toggle-lines">
                                        <rect width="15" height="6" rx="2" class="forum-excerpt-toggle-line"></rect>
                                        <rect width="15" height="6" y="9" rx="2" class="forum-excerpt-toggle-line"></rect>
                                    </g>
                                </svg>
                            </button>
                            <button disabled="disabled" class="forum-excerpt-toggle is-active">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" class="mx-2">
                                    <g fill="#78909C" fill-rule="evenodd" class="forum-excerpt-toggle-lines">
                                        <rect width="15" height="4" rx="2" class="forum-excerpt-toggle-line"></rect>
                                        <rect width="8" height="4" y="11" rx="2" class="forum-excerpt-toggle-line"></rect>
                                        <rect width="15" height="4" y="5.5" rx="2" class="forum-excerpt-toggle-line"></rect>
                                    </g>
                                </svg>
                            </button>
                        </div>
                        <form action="/discuss" autocomplete="off" class="search-form bg-grey-panel rounded-full hidden md:block md:w-52">
                            <input name="q" placeholder="Whatcha Looking For?" value="" class="px-5 pt-0 text-sm w-full h-full" />
                        </form>
                    </div>
                    <div class="conversation-list">
                        @foreach($threads as $thread)
                            <div class="conversation-list-item bg-black-transparent-1 border border-solid border-black-transparent-3 flex cursor-pointer flex-col md:flex-row md:hover:bg-grey-panel mb-4 md:mb-3 transition-all px-6 py-4 rounded-xl">
                                <div class="conversation-list-avatar self-start w-full md:w-auto md:mr-5 flex items-center md:block mb-4 md:mb-0">
                                    <div class="flex items-center">
                                        <a href="#" class="relative inline-flex items-start mb-2 mr-3 md:mr-0" style="width: 56px; height: 56px; padding: 2px;">
                                            <img
                                                loading="lazy"
                                                alt="CheshireC4t"
                                                width="56"
                                                height="56"
                                                class="bg-white relative lazyloaded"
                                                style="width: 100%; border-radius: 9px;"
                                                src="{{ $thread->user->avatar }}"
                                            />
                                        </a>

                                        <strong class="uppercase md:hidden">{{ $thread->user->name }}</strong>
                                    </div>
                                    <div class="flex items-center justify-center md:hidden ml-auto mr-3 md:mr-4 bg-grey-panel rounded-xl py-2">
                                        <div class="md:bg-grey-panel md:py-2 px-3 md:rounded-full flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="12" viewBox="0 0 15 14" class="mr-2">
                                                <path
                                                    fill="#78909C"
                                                    fill-rule="evenodd"
                                                    d="M7.5 0C3.344 0 0 2.818 0 6.286c0 1.987 1.094 3.757 2.781 4.914l.117 2.35c.022.438.338.58.704.32l2.023-1.442c.594.144 1.219.18 1.875.18 4.156 0 7.5-2.817 7.5-6.285C15 2.854 11.656 0 7.5 0z"
                                                    opacity=".5"
                                                ></path>
                                            </svg>
                                            <span class="text-xs text-grey-dark font-semibold leading-none">0</span>
                                        </div>
                                    </div>
                                    <div class="conversation-list-channel-button md:hidden">
                                        <a href="https://laracasts.com/discuss/channels/site-improvements" class="btn btn-channel is-site-improvements py-2 px-4 text-2xs block text-center">
                                            Feedback
                                        </a>
                                    </div>
                                </div>
                                <div class="w-full md:mb-0">
                                    <div class="conversation-list-title h-full flex flex-col justify-between">
                                        <div class="md:flex md:items-start lg:-mt-1">
                                            <h4 class="mb-4 lg:mb-0 md:pr-6 text-base lg:clamp one-line" style="word-break: break-word;">
                                                <a
                                                    href="{{ $thread->path() }}"
                                                    class="conversation-list-link text-lg text-black hover:text-black link font-semibold"
                                                >
                                                    {{ $thread->title }}
                                                </a>
                                            </h4>
                                            <div class="hidden md:flex md:items-center md:flex-row-reverse text-center md:ml-auto relative">
                                                <a
                                                    href="https://laracasts.com/discuss/channels/site-improvements"
                                                    class="btn btn-channel is-site-improvements py-2 px-4 text-2xs block text-center ml-5 w-24"
                                                >
                                                    Feedback
                                                </a>
                                                <div class="flex items-center justify-center ml-4">
                                                    <div class="mr-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="19" viewBox="0 0 15 10" class="relative" style="top: -2px;">
                                                            <path
                                                                fill="#78909C"
                                                                fill-rule="evenodd"
                                                                d="M7.5 0C3.344 0 0 2.818 0 6.286c0 1.987 1.094 3.757 2.781 4.914l.117 2.35c.022.438.338.58.704.32l2.023-1.442c.594.144 1.219.18 1.875.18 4.156 0 7.5-2.817 7.5-6.285C15 2.854 11.656 0 7.5 0z"
                                                                opacity=".5"
                                                            ></path>
                                                        </svg>
                                                    </div>
                                                    <span class="text-xs text-grey-dark font-semibold text-left leading-none relative">{{ $thread->replies_count }}</span>
                                                </div>
                                                <div class="flex items-center justify-center">
                                                    <div class="mr-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="13" viewBox="0 0 19 13">
                                                            <g fill="none" fill-rule="evenodd">
                                                                <path d="M0-3h19v19H0z"></path>
                                                                <path
                                                                    fill="#78909C"
                                                                    d="M9.5.562C5.542.562 2.161 3.025.792 6.5c1.37 3.475 4.75 5.937 8.708 5.937s7.339-2.462 8.708-5.937C16.838 3.025 13.458.562 9.5.562zm0 9.896A3.96 3.96 0 0 1 5.542 6.5 3.96 3.96 0 0 1 9.5 2.542 3.96 3.96 0 0 1 13.458 6.5 3.96 3.96 0 0 1 9.5 10.458zm0-6.333A2.372 2.372 0 0 0 7.125 6.5 2.372 2.372 0 0 0 9.5 8.875 2.372 2.372 0 0 0 11.875 6.5 2.372 2.372 0 0 0 9.5 4.125z"
                                                                    opacity=".5"
                                                                ></path>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                    <span class="text-xs text-grey-dark font-semibold text-left leading-none">4</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="conversation-list-excerpt mb-6 lg:mb-0 lg:pr-8 lg:clamp two-lines break-words text-black phone:leading-loose" data-conversation-excerpt="">
                                            {{ $thread->body }}
                                        </div>
                                        <div class="text-grey-dark text-xs leading-none">
                                            <a href="#" class="font-bold link hover:text-blue uppercase">
                                                {{ $thread->user->name }}
                                            </a>
                                            posted
                                            <a href="" class="inherits-color link"><time class="font-bold">{{ $thread->created_at->diffForHumans() }}</time></a>
                                            @if($thread->hasUpdates())
                                                <div class="border-solid border border-red text-red px-2 h-4 text-3xs rounded-full ml-2 inline-flex items-center leading-off">
                                                    Updated
                                                </div>
                                            @endif
                                            {{--TODO: Solved Questions
                                            <div class="border-solid border border-blue text-blue px-2 h-4 text-3xs rounded-full ml-2 inline-flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="8" viewBox="0 0 21 16" class="hidden md:block mr-1"><g fill="#FFF" fill-rule="evenodd">
                                                        <path fill="none" d="M-3-5h27v27H-3z"></path>
                                                        <path d="M7.439 12.152l-5.037-5.36c-.447-.477-1.119-.477-1.566 0a1.204 1.204 0 0 0 0 1.667l6.603 7.03L20.086 2.025a1.204 1.204 0 0 0 0-1.668c-.447-.476-1.12-.476-1.567 0L7.44 12.152z" class="fill-current"></path>
                                                    </g>
                                                </svg>
                                                Solved
                                            </div>
                                            --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-6">
                        <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
                                        <span
                                            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md"
                                        >
                                            « Previous
                                        </span>
                            <a
                                href="https://laracasts.com/discuss?page=2"
                                rel="next"
                                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                            >
                                More »
                            </a>
                        </nav>
                    </div>
                    <div class="participate-button fixed z-40" style="display: none;">
                        <a class="bg-blue hover:bg-blue-dark rounded-full w-16 h-16 text-center flex items-center justify-center shadow-lg">
                            <img src="{{ asset('images/icons/reply-mobile-button.svg') }}" alt="Create a New Discussion Button" />
                        </a>
                    </div>
{{--                    @includeWhen(auth()->check(), 'partials.modal', ['id' => 'thread-modal', 'action' => route('threads.store') ])--}}
                </div>
            </div>
        </div>
    </div>
@endsection

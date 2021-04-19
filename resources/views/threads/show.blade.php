@extends('layouts.master')

@section('content')
    <thread-view inline-template :categories="{{ $categories }}" :thread="{{ $thread }}">
        <div class="flex flex-col flex-col-reverse md:flex-row mx-auto" style="max-width: 1070px;">
            <div class="hidden lg:block lg:sticky lg:self-start flex-none mr-9" style="min-width: 200px; top: 40px;">
                <div class="lg:sticky lg:text-center">
                    <a class="btn btn-blue block mb-4 max-w-2xs mx-auto"
                       style="box-shadow: rgb(215, 232, 253) 0 4px 10px 1px;">
                        Reply
                    </a>

                    @auth
                        @if(auth()->user()->isAdmin()){{--TOOD: User Policy--}}
                            <lock-button :is-locked="{{ json_encode($thread->locked) }}"></lock-button>
                        @endif
                        <subscription-button :is-active="{{ json_encode($thread->isSubscribedTo) }}"></subscription-button>
                    @endauth

                    @include('partials.sidebar')
                </div>
            </div>
            <div class="flex-1">
                <div class="forum-main lg:flex">
                    <div class="lg:flex-1">
                        <div
                            id="conversation-stats"
                            class="flex justify-between items-center pl-5 pr-6 py-4 mb-2 border border-solid border-black-transparent-3 hover:border-black-transparent-10 bg-black-transparent-2 hover:bg-black-transparent-3 rounded-lg"
                            style="border-radius: 12px; height: 49px;"
                        >
                            <div>
                                <p class="hidden lg:block text-grey-40 text-2xs font-semibold">
                                    {{ $thread->user->username }} started this conversation {{ $thread->created_at->diffForHumans() }}. 3 people have replied.
                                </p>
                            </div>
                            <div class="flex items-center flex-1 justify-around lg:justify-end">
                                <div class="flex items-center bg-black-transparent-1 mr-2 border border-solid border-black-transparent-3 rounded-xl px-2 py-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="13" viewBox="0 0 19 13" class="mr-1">
                                        <g fill="none" fill-rule="evenodd">
                                            <path d="M0-3h19v19H0z"></path>
                                            <path
                                                fill="#78909C"
                                                d="M9.5.562C5.542.562 2.161 3.025.792 6.5c1.37 3.475 4.75 5.937 8.708 5.937s7.339-2.462 8.708-5.937C16.838 3.025 13.458.562 9.5.562zm0 9.896A3.96 3.96 0 0 1 5.542 6.5 3.96 3.96 0 0 1 9.5 2.542 3.96 3.96 0 0 1 13.458 6.5 3.96 3.96 0 0 1 9.5 10.458zm0-6.333A2.372 2.372 0 0 0 7.125 6.5 2.372 2.372 0 0 0 9.5 8.875 2.372 2.372 0 0 0 11.875 6.5 2.372 2.372 0 0 0 9.5 4.125z"
                                                opacity=".5"
                                            ></path>
                                        </g>
                                    </svg>
                                    <span class="text-xs text-grey-dark font-semibold">{{ $thread->visits }}</span>
                                </div>
                                <div class="flex items-center bg-black-transparent-1 mr-2 border border-solid border-black-transparent-3 rounded-xl px-2 py-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="12" viewBox="0 0 15 14" class="mr-1">
                                        <path
                                            fill="#78909C"
                                            fill-rule="evenodd"
                                            d="M7.5 0C3.344 0 0 2.818 0 6.286c0 1.987 1.094 3.757 2.781 4.914l.117 2.35c.022.438.338.58.704.32l2.023-1.442c.594.144 1.219.18 1.875.18 4.156 0 7.5-2.817 7.5-6.285C15 2.854 11.656 0 7.5 0z"
                                            opacity=".5"
                                        ></path>
                                    </svg>
                                    <span class="text-xs text-grey-dark font-semibold" v-text="repliesCount"></span>
                                </div>
                                <a href="{{ route('threads.index', $thread->category) }}"
                                   class="btn btn-channel is-{{ $thread->category->slug }} py-2 px-6 text-2xs block text-center">
                                    {{ $thread->category->name }}
                                </a>
                            </div>
                        </div>

                        <thread></thread>

                        <replies></replies>
                        {{--
                        <div class="participate-button fixed z-40" style="">
                            <a class="bg-blue hover:bg-blue-dark rounded-full w-16 h-16 text-center flex items-center justify-center shadow-lg">
                                <img src="{{ asset('images/icons/reply-mobile-button.svg') }}" alt="Post Reply Button" />
                            </a>
                        </div>
                        <a
                            href="https://laracasts.com/discuss"
                            class="lg:hidden rounded-full w-16 h-16 z-50 text-center flex items-center justify-center shadow-lg fixed bottom-0 mb-6 ml-6 left-0"
                        >
                            <img src="{{ asset('images/icons/mobile-back-button.svg') }}" alt="Back to Discussions Button" class="rounded-full bg-white" />
                        </a>
                        --}}
                    </div>
                </div>
            </div>
        </div>
    </thread-view>
@endsection

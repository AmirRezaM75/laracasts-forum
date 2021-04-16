@forelse($threads as $thread)
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

                <strong class="uppercase md:hidden">{{ $thread->user->username }}</strong>
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
                            href="{{ url('threads/' . $thread->category->slug) }}"
                            class="btn btn-channel is-site-improvements py-2 px-4 text-2xs block text-center ml-5 w-24"
                        >
                            {{ $thread->category->name }}
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
                            <span class="text-xs text-grey-dark font-semibold text-left leading-none">{{ $thread->visits }}</span>
                        </div>
                    </div>
                </div>
                <div class="conversation-list-excerpt mb-6 lg:mb-0 lg:pr-8 lg:clamp two-lines break-words text-black phone:leading-loose" data-conversation-excerpt="">
                    {!! $thread->body !!}
                    {{--TODO: How to handle if it start with <code> --}}
                </div>
                <div class="text-grey-dark text-xs leading-none">
                    <a href="#" class="font-bold link hover:text-blue uppercase">
                        {{ $thread->user->username }}
                    </a>
                    posted
                    <a href="" class="inherits-color link"><time class="font-bold">{{ $thread->created_at->diffForHumans() }}</time></a>
                    @if($thread->hasUpdates())
                        <div class="border-solid border border-red text-red px-2 h-4 text-3xs rounded-full ml-2 inline-flex items-center leading-off">
                            Updated
                        </div>
                    @endif
                    @if($thread->isSolved())
                        <div class="border-solid border border-blue text-blue px-2 h-4 text-3xs rounded-full ml-2 inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="8" viewBox="0 0 21 16" class="hidden md:block mr-1"><g fill="#FFF" fill-rule="evenodd">
                                    <path fill="none" d="M-3-5h27v27H-3z"></path>
                                    <path d="M7.439 12.152l-5.037-5.36c-.447-.477-1.119-.477-1.566 0a1.204 1.204 0 0 0 0 1.667l6.603 7.03L20.086 2.025a1.204 1.204 0 0 0 0-1.668c-.447-.476-1.12-.476-1.567 0L7.44 12.152z" class="fill-current"></path>
                                </g>
                            </svg>
                            Solved
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@empty
    <p class="font-bold text-center text-lg lg:p-5">There are no relevant results at this time.</p>
@endforelse

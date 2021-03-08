<reply
    inline-template
    :model="{{ $reply }}"
    class="forum-comment relative rounded-xl bg-black-transparent-1 border border-solid border-black-transparent-3 mb-2 is-reply"
    id="reply-{{ $reply->id }}"
>
    <div class="flex px-6 py-4 lg:p-5">
        <div class="hidden md:block mr-5 text-left">
            <a href="{{ url('users/' . $reply->user->id) }}" class="block relative rounded-lg overflow-hidden mb-1">
                <div class="flex items-start">
                    <img
                        alt="{{ $reply->user->name }}"
                        loading="lazy"
                        class="is-circle bg-white w-8 md:w-18 lazyloaded"
                        src="{{ $reply->user->avatar }}"
                        style="border-radius: 9px;"
                    />
                </div>
            </a>
        </div>
        <div class="flex-1 relative">
            <header class="flex mb-4 justify-between">
                <div class="md:hidden">
                    <a href="{{ url('users/' . $reply->user->id) }}" class="block relative rounded-lg overflow-hidden mr-4">
                        <img
                            src="{{ $reply->user->avatar }}"
                            alt="{{ $reply->user->name }}"
                            class="lazyload is-circle bg-white w-8 md:w-18"
                            style="border-radius: 9px;"
                        />
                    </a>
                </div>
                <div class="flex-1 leading-none text-left">
                    <div class="flex items-center">
                        <a href="{{ url('users/' . $reply->user->id) }}" class="font-bold block font-lg mr-2 text-black">{{ $reply->user->name }}</a>
                    </div>
                    <a href="#" class="font-semibold pt-1 md:pt-0 text-3xs text-grey-dark link">
                        <span class="text-grey-dark">Posted {{ $reply->created_at->diffForHumans() }}</span>
                    </a>
                </div>
            </header>
            <div class="content user-content text-black md:text-sm">
                <p v-text="reply.body"></p>
            </div>
            <div class="forum-comment-edit-links flex justify-end lg:justify-start relative mt-4 -mb-1 md:leading-none justify-start" style="height: 34px;">
                <form class="inline-flex" action="{{ url('/replies/' . $reply->id . '/favorites') }}" method="POST">
                    @csrf
                    <button
                        class="transition-all border border-solid border-black-transparent-3 hover:border-black-transparent-10 bg-black-transparent-2 hover:bg-black-transparent-3 font-semibold inline-flex items-center px-3 md:text-xs mobile:text-sm mobile:p-2 mobile:flex mobile:items-center reply-likes mobile:text-sm mr-2 {{ $reply->isFavorited() ? 'has-likes border-blue-light bg-blue-lighter' : 'has-none border-black-transparent-3 bg-black-transparent-1' }}"
                        style="border-radius: 12px;"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 14 13" class="fill-current cursor-pointer {{ $reply->isFavorited() ? 'text-blue' : 'text-grey' }}">
                            <path
                                fill-rule="nonzero"
                                d="M13.59 1.778c-.453-.864-3.295-3.755-6.59.431C3.54-1.977.862.914.41 1.778c-.825 1.596-.33 4.014.823 5.18L7.001 13l5.767-6.043c1.152-1.165 1.647-3.582.823-5.18z"
                            >
                                <title>Like this reply.</title>
                            </path>
                        </svg>
                        @if($reply->favorites_count > 0)
                            <span class="text-xs font-semibold text-blue" style="margin-left: 6px; cursor: help;">{{ $reply->favorites_count }}</span>
                        @endif
                    </button>
                </form>
                <div class="flex show-on-hover">
                    <a
                        class="transition-all border border-solid border-black-transparent-3 hover:border-black-transparent-10 bg-black-transparent-2 hover:bg-black-transparent-3 font-semibold inline-flex items-center px-3 md:text-xs mobile:text-sm mobile:p-2 mobile:flex mobile:items-center mr-2 text-black"
                        style="border-radius: 12px;"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" viewBox="0 0 12 13" class="mr-1 lg:hidden">
                            <path
                                fill="#78909C"
                                fill-rule="evenodd"
                                stroke="#78909C"
                                stroke-width=".5"
                                d="M6.96 1.877L4.34.542l.435 1.413a5.196 5.196 0 0 0-3.161 2.64C.32 7.133 1.267 10.2 3.73 11.455s5.5.218 6.794-2.32a5.203 5.203 0 0 0 .316-3.989l-1.145.369c.338.955.29 2.087-.22 3.086-.99 1.944-3.308 2.735-5.194 1.774-1.887-.962-2.61-3.302-1.619-5.246a4.085 4.085 0 0 1 2.461-2.045l.46 1.493 1.377-2.7z"
                            ></path>
                        </svg>

                        Reply
                    </a>
                    <!---->
                </div>
                <div data-toggle="dropdown" class="dropdown relative show-on-hover lg:ml-auto">
                    <div aria-haspopup="true" class="dropdown-toggle h-full">
                        <button
                            class="transition-all border border-solid border-black-transparent-3 hover:border-black-transparent-10 bg-black-transparent-2 hover:bg-black-transparent-3 font-semibold inline-flex items-center px-3 md:text-xs mobile:text-sm mobile:p-2 mobile:flex mobile:items-center h-full text-black-transparent-50 font-bold hover:text-blue text-sm"
                            style="border-radius: 12px;"
                        >
                            <span class="relative" style="top: -3px;">...</span>
                        </button>
                    </div>
                    <div class="dropdown-menu absolute z-10 py-2 rounded-lg shadow mt-2 right-0 is-light hidden" style="width: 200px;">
                        <li class="dropdown-menu-link" @click="edit"><a>Edit</a></li>
                        <li class="dropdown-menu-link"><a>Report Spam</a></li>
                    </div>
                </div>
            </div>
        </div>
    </div>
</reply>

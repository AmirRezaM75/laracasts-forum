@extends('layouts.master')

@section('content')
    <div class="flex flex-col flex-col-reverse md:flex-row mx-auto" style="max-width: 1070px;">
        <div class="hidden lg:block lg:sticky lg:self-start flex-none mr-9" style="min-width: 200px; top: 40px;">
            <div class="lg:sticky lg:text-center">
                <a data-toggle="modal" data-target="thread-modal" class="btn btn-blue mb-8 w-full" style="box-shadow: rgb(215, 232, 253) 0px 4px 10px 1px;">
                    New Discussion
                </a>
                <ul class="mobile:hidden">
                    <li>
                        <a
                            href="{{ url('/threads') }}"
                            class="flex items-center mb-2 text-grey-dark text-sm mb-1 hover:text-blue hover:border-blue-light hover:bg-blue-lighter py-2 px-6 border border-solid border-black-transparent-3 rounded-xl text-blue font-semibold border-blue-light bg-blue-lighter"
                            style="height: 41px;"
                        >
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
                            All Threads
                        </a>
                    </li>
                    @auth
                        <li>
                            <a
                                href="{{ url('/threads?by=' . auth()->user()->name) }}"
                                class="flex items-center mb-2 text-grey-dark text-sm mb-1 hover:text-blue hover:border-blue-light hover:bg-blue-lighter py-2 px-6 border border-solid border-black-transparent-3 rounded-xl"
                                style="height: 41px;"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" class="mr-4 fill-current">
                                    <path
                                        fill-rule="nonzero"
                                        d="M7.893 0a8 8 0 1 0 .216 16 8 8 0 0 0-.216-16zM7.87 12.87l-.045-.001c-.68-.02-1.16-.522-1.14-1.192.019-.659.51-1.137 1.168-1.137h.04c.699.022 1.173.518 1.153 1.207-.02.661-.503 1.123-1.176 1.123zm2.861-5.68c-.16.227-.512.51-.955.855l-.488.337c-.268.208-.43.404-.49.597-.048.152-.072.192-.076.5v.08H6.856l.006-.158c.023-.649.039-1.03.307-1.345.422-.495 1.352-1.094 1.391-1.12.133-.1.246-.214.33-.336.195-.27.282-.482.282-.691 0-.29-.086-.557-.256-.796-.163-.23-.474-.346-.922-.346-.445 0-.75.14-.932.43a1.73 1.73 0 0 0-.283.931v.08H4.858l.004-.083c.05-1.178.47-2.025 1.248-2.52.49-.315 1.098-.475 1.808-.475.93 0 1.715.226 2.333.672.626.451.944 1.128.944 2.01a2.3 2.3 0 0 1-.464 1.378z"
                                    ></path>
                                </svg>
                                My Questions
                            </a>
                        </li>
                    @endauth
                    <li>
                        <a
                            href="/discuss?filter_by=contributed_to"
                            class="flex items-center mb-2 text-grey-dark text-sm mb-1 hover:text-blue hover:border-blue-light hover:bg-blue-lighter py-2 px-6 border border-solid border-black-transparent-3 rounded-xl"
                            style="height: 41px;"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" class="mr-4 fill-current">
                                <g fill-rule="nonzero">
                                    <path
                                        d="M16.571 10.636a.476.476 0 0 1-.476.478l-2.385.006a.476.476 0 0 1-.002-.954l2.385-.006c.264 0 .478.212.478.476M15.814 8.017a.477.477 0 0 1-.227.636l-2.154 1.023a.476.476 0 0 1-.41-.863l2.155-1.022a.477.477 0 0 1 .636.226M15.828 13.259a.477.477 0 0 0-.229-.635l-2.16-1.012a.476.476 0 1 0-.405.863l2.16 1.013c.238.112.523.01.634-.23M12.823 6.686c-.678-.2-1.285-.738-1.497-1.073-.362-.576.075-.726-.073-2.333C11.118 1.81 9.093.228 6.63.067 5.512-.006 4.348.223 3.155.875.092 2.55-1.122 6.09 1.244 9.509c2.132 3.082.132 4.474.132 4.474s.079.649 1.39 1.521c1.311.872 2.92.28 2.92.28s.53-1.886 2.265-1.712c1.244.183 2.99-.061 3.43-.489.414-.399-.072-.9.258-2.015-1.129-.11-1.748-.648-1.808-1.406 1.252.122 1.768-.276 2.126-.713a49.53 49.53 0 0 0-.06-1.171c1.107-.32 1.531-1.413.926-1.592"
                                    ></path>
                                </g>
                            </svg>
                            My Participation
                        </a>
                    </li>
                    <li>
                        <a
                            href="/discuss?filter_by=best_answers"
                            class="flex items-center mb-2 text-grey-dark text-sm mb-1 hover:text-blue hover:border-blue-light hover:bg-blue-lighter py-2 px-6 border border-solid border-black-transparent-3 rounded-xl"
                            style="height: 41px;"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" class="mr-4 fill-current">
                                <g fill="none" fill-rule="evenodd">
                                    <circle cx="8" cy="8" r="8" class="fill-current"></circle>
                                    <path fill="#FFF" d="M6.997 9.562L5.207 7.78a.386.386 0 0 0-.557 0 .382.382 0 0 0 0 .554l2.347 2.337 4.494-4.476a.382.382 0 0 0 0-.554.386.386 0 0 0-.556 0L6.997 9.56z"></path>
                                </g>
                            </svg>
                            My Best Answers
                        </a>
                    </li>
                    <li>
                        <a
                            href="/discuss?favorites=1"
                            class="flex items-center mb-2 text-grey-dark text-sm mb-1 hover:text-blue hover:border-blue-light hover:bg-blue-lighter py-2 px-6 border border-solid border-black-transparent-3 rounded-xl"
                            style="height: 41px;"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" class="mr-4 fill-current">
                                <path
                                    fill-rule="nonzero"
                                    d="M3.277 15a.46.46 0 0 1-.192-.063.347.347 0 0 1-.128-.347l1.409-5.168L.14 6.05c-.128-.063-.16-.22-.128-.346a.307.307 0 0 1 .288-.22L5.743 5.2 7.696.19c.064-.095.192-.19.32-.19s.256.095.288.19l1.953 5.01 5.443.283c.128 0 .256.095.288.22a.352.352 0 0 1-.096.347l-4.226 3.372 1.408 5.168a.312.312 0 0 1-.128.347c-.096.063-.256.095-.352 0l-4.578-2.9-4.579 2.9c-.064.063-.096.063-.16.063z"
                                ></path>
                            </svg>
                            Following
                        </a>
                    </li>
                    <li>
                        <a
                            href="/discuss?trending=1"
                            class="flex items-center mb-2 text-grey-dark text-sm mb-1 hover:text-blue hover:border-blue-light hover:bg-blue-lighter py-2 px-6 border border-solid border-black-transparent-3 rounded-xl"
                            style="height: 41px;"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" class="mr-4 fill-current">
                                <path
                                    fill-rule="nonzero"
                                    d="M3.277 15a.46.46 0 0 1-.192-.063.347.347 0 0 1-.128-.347l1.409-5.168L.14 6.05c-.128-.063-.16-.22-.128-.346a.307.307 0 0 1 .288-.22L5.743 5.2 7.696.19c.064-.095.192-.19.32-.19s.256.095.288.19l1.953 5.01 5.443.283c.128 0 .256.095.288.22a.352.352 0 0 1-.096.347l-4.226 3.372 1.408 5.168a.312.312 0 0 1-.128.347c-.096.063-.256.095-.352 0l-4.578-2.9-4.579 2.9c-.064.063-.096.063-.16.063z"
                                ></path>
                            </svg>
                            Popular This Week
                        </a>
                    </li>
                    <li>
                        <a
                            href="{{ url("/threads?popular=1") }}"
                            class="flex items-center mb-2 text-grey-dark text-sm mb-1 hover:text-blue hover:border-blue-light hover:bg-blue-lighter py-2 px-6 border border-solid border-black-transparent-3 rounded-xl"
                            style="height: 41px;"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" class="mr-4 fill-current">
                                <path
                                    fill-rule="nonzero"
                                    d="M3.277 15a.46.46 0 0 1-.192-.063.347.347 0 0 1-.128-.347l1.409-5.168L.14 6.05c-.128-.063-.16-.22-.128-.346a.307.307 0 0 1 .288-.22L5.743 5.2 7.696.19c.064-.095.192-.19.32-.19s.256.095.288.19l1.953 5.01 5.443.283c.128 0 .256.095.288.22a.352.352 0 0 1-.096.347l-4.226 3.372 1.408 5.168a.312.312 0 0 1-.128.347c-.096.063-.256.095-.352 0l-4.578-2.9-4.579 2.9c-.064.063-.096.063-.16.063z"
                                ></path>
                            </svg>
                            Popular All Time
                        </a>
                    </li>
                    <li>
                        <a
                            href="/discuss?answered=1"
                            class="flex items-center mb-2 text-grey-dark text-sm mb-1 hover:text-blue hover:border-blue-light hover:bg-blue-lighter py-2 px-6 border border-solid border-black-transparent-3 rounded-xl"
                            style="height: 41px;"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" class="mr-4 fill-current">
                                <g fill="none" fill-rule="evenodd">
                                    <circle cx="8" cy="8" r="8" class="fill-current"></circle>
                                    <path fill="#FFF" d="M6.997 9.562L5.207 7.78a.386.386 0 0 0-.557 0 .382.382 0 0 0 0 .554l2.347 2.337 4.494-4.476a.382.382 0 0 0 0-.554.386.386 0 0 0-.556 0L6.997 9.56z"></path>
                                </g>
                            </svg>
                            Solved
                        </a>
                    </li>
                    <li>
                        <a
                            href="/discuss?answered=0"
                            class="flex items-center mb-2 text-grey-dark text-sm mb-1 hover:text-blue hover:border-blue-light hover:bg-blue-lighter py-2 px-6 border border-solid border-black-transparent-3 rounded-xl"
                            style="height: 41px;"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" class="mr-4 fill-current">
                                <g fill="none" fill-rule="evenodd">
                                    <circle cx="8" cy="8" r="8" class="fill-current"></circle>
                                    <path fill="#FFF" d="M5.667 5L5 5.667 7.333 8 5 10.333l.667.667L8 8.667 10.333 11l.667-.667L8.667 8 11 5.667 10.333 5 8 7.334z"></path>
                                </g>
                            </svg>
                            Unsolved
                        </a>
                    </li>
                    <li>
                        <a
                            href="/discuss?fresh=1"
                            class="flex items-center mb-2 text-grey-dark text-sm mb-1 hover:text-blue hover:border-blue-light hover:bg-blue-lighter py-2 px-6 border border-solid border-black-transparent-3 rounded-xl"
                            style="height: 41px;"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12" class="mr-4 fill-current">
                                <path fill-rule="nonzero" d="M15.206 7.366v4.401s-1.882-4.202-4.203-4.202h-4.5v3.602L0 5.664l6.503-5.5v2.999h4.5a4.204 4.204 0 0 1 4.203 4.203z"></path>
                            </svg>
                            No Replies Yet
                        </a>
                    </li>
                    <li>
                        <a
                            href="/discuss/leaderboard"
                            class="flex items-center mb-2 text-grey-dark text-sm mb-1 hover:text-blue hover:border-blue-light hover:bg-blue-lighter py-2 px-6 border border-solid border-black-transparent-3 rounded-xl"
                            style="height: 41px;"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 12 16" class="mr-4 fill-current">
                                <path
                                    fill-rule="nonzero"
                                    d="M10.08 1.6L9.12 4H2.08l-.96-2.4C.504 1.6 0 2.104 0 2.72v12.16C0 15.496.504 16 1.12 16h8.96c.616 0 1.12-.504 1.12-1.12V2.72c0-.616-.504-1.12-1.12-1.12zm-1.6 1.6l.72-1.6H7.456L6.88 0H4.32l-.576 1.6H2l.72 1.6h5.76z"
                                ></path>
                            </svg>
                            Leaderboard
                        </a>
                    </li>
                </ul>
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
                            <div
                                data-conversation-item=""
                                class="conversation-list-item bg-black-transparent-1 border border-solid border-black-transparent-3 flex cursor-pointer flex-col md:flex-row md:hover:bg-grey-panel mb-4 md:mb-3 transition-all px-6 py-4 rounded-xl"
                            >
                                <div class="conversation-list-avatar self-start w-full md:w-auto md:mr-5 flex items-center md:block mb-4 md:mb-0">
                                    <div class="flex items-center">
                                        <a href="/@CheshireC4t" class="relative inline-flex items-start mb-2 mr-3 md:mr-0" style="width: 56px; height: 56px; padding: 2px;">
                                            <img
                                                data-src="//www.gravatar.com/avatar/edfd4334ac9c0b683d60127979949fe9?s=100&amp;d=https%3A%2F%2Fs3.amazonaws.com%2Flaracasts%2Fimages%2Fforum%2Favatars%2Fdefault-avatar-30.png"
                                                loading="lazy"
                                                alt="CheshireC4t"
                                                width="56"
                                                height="56"
                                                class="bg-white relative lazyloaded"
                                                style="width: 100%; border-radius: 9px;"
                                                src="../dist/images/default-avatar-25.png"
                                            />
                                        </a>
                                        <strong class="uppercase md:hidden">CheshireC4t</strong>
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
                                                    class="conversation-list-link text-lg text-black font-semibold hover:text-black link"
                                                    title="Pressing TAB perm deletes text"
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
                                            <a href="https://laracasts.com/@CheshireC4t" class="font-bold link hover:text-blue uppercase">
                                                CheshireC4t
                                            </a>
                                            posted
                                            <a href="/discuss/channels/site-improvements/pressing-tab-perm-deletes-text" class="inherits-color link"><time class="font-bold">17 minutes ago</time></a>
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

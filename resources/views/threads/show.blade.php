@extends('layouts.master')

@section('content')
    <thread :initial-replies-count="{{ $thread->replies_count }}" inline-template>
        <div class="flex flex-col flex-col-reverse md:flex-row mx-auto" style="max-width: 1070px;">
            <div class="hidden lg:block lg:sticky lg:self-start flex-none mr-9" style="min-width: 200px; top: 40px;">
                <div class="lg:sticky lg:text-center">
                    <a class="btn btn-blue block mb-4 max-w-2xs mx-auto"
                       style="box-shadow: rgb(215, 232, 253) 0 4px 10px 1px;">
                        Reply
                    </a>
                    <form class="text-white text-center">
                        <button
                            type="submit"
                            title="Want an email each time this conversation receives a new reply?"
                            class="btn btn-outlined bg-transparent border-grey-dark text-grey-dark w-full mb-8 max-w-2xs"
                        >
                            Follow
                        </button>
                    </form>
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
                                    {{ $thread->user->name }} started this conversation {{ $thread->created_at->diffForHumans() }}. 3 people have replied.
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
                                    <span class="text-xs text-grey-dark font-semibold">212</span>
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
                                   class="btn btn-channel is-laravel py-2 px-6 text-2xs block text-center">
                                    {{ $thread->category->name }}
                                </a>
                            </div>
                        </div>
                        <div class="forum-comment relative rounded-xl bg-black-transparent-1 border border-solid border-black-transparent-3 mb-2 is-reply">
                            <div class="flex px-6 py-4 lg:p-5">
                                <div class="hidden md:block mr-5 text-left">
                                    <a href="/@jjmu15" class="block relative rounded-lg overflow-hidden mb-1">
                                        <div class="flex items-start">
                                            <img
                                                data-src="//unavatar.now.sh/twitter/jjmu15?fallback=https://s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-17.png"
                                                alt="jjmu15"
                                                loading="lazy"
                                                class="is-circle bg-white w-8 md:w-18 ls-is-cached lazyloaded"
                                                src="//unavatar.now.sh/twitter/jjmu15?fallback=https://s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-17.png"
                                                style="border-radius: 9px;"
                                            />
                                        </div>
                                    </a>
                                    <div class="text-center leading-none">
                                        <div class="text-grey-dark font-semibold text-2xs">
                                            Level 6
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-1 relative">
                                    <header class="flex mb-4 justify-between">
                                        <div class="md:hidden">
                                            <a href="/@jjmu15" class="block relative rounded-lg overflow-hidden mr-4">
                                                <img
                                                    data-src="//unavatar.now.sh/twitter/jjmu15?fallback=https://s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-17.png"
                                                    alt="jjmu15"
                                                    loading="lazy"
                                                    class="lazyload is-circle bg-white w-8 md:w-18"
                                                    style="border-radius: 9px;"
                                                />
                                            </a>
                                        </div>
                                        <div class="flex-1 leading-none text-left">
                                            <div class="flex items-center">
                                                <a href="/@jjmu15" class="font-bold block font-lg mr-2 text-black">{{ $thread->user->name }}</a>
                                                <a
                                                    class="transition-all border border-solid border-black-transparent-3 hover:border-black-transparent-10 bg-black-transparent-2 hover:bg-black-transparent-3 font-semibold inline-flex items-center px-3 md:text-xs mobile:text-sm mobile:p-2 mobile:flex mobile:items-center text-black-transparent-50"
                                                    title="Original Poster"
                                                    style="border-radius: 12px; height: 24px;"
                                                >
                                                    OP
                                                </a>
                                            </div>
                                            <a href="?reply=144531" class="font-semibold pt-1 md:pt-0 text-3xs text-grey-dark link"><span class="text-grey-dark">Posted {{ $thread->created_at->diffForHumans() }}</span></a>
                                        </div>
                                        <div class="flex relative" style="top: -5px;">
                                            <div class="hidden md:block ml-4">
                                                <div class="achievement-list flex">
                                                    <li
                                                        title="Earned once your experience points hits 10,000."
                                                        class="achievement has-been-awarded md:ml-1 flex-1 flex items-center justify-center is-intermediate"
                                                    >
                                                        <div class="border border-black-transparent-3 border-solid p-1 rounded-lg" style="background: rgba(0, 0, 0, 0.02);">
                                                            <div>
                                                                <svg width="24px" height="24px" viewBox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                                    <g id="Laracasts-Website" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <g id="Settings" transform="translate(-590.000000, -543.000000)">
                                                                            <g id="10k-strong" transform="translate(590.000000, 543.000000)">
                                                                                <circle id="color-base" class="fill-current transition-all" cx="25" cy="25" r="25"></circle>
                                                                                <g id="10kstrong-icon" transform="translate(13.000000, 8.000000)" fill="#FFFFFF" fill-rule="nonzero" class="achievement-badge-icon">
                                                                                    <path
                                                                                        d="M19.0211613,21.95089 C19.2949042,22.3730657 19.8161458,23.3975044 20.5848861,25.024206 L19.806586,22.6139439 L19.4390076,21.7516934 L19.7044444,21.6251538 C20.1697778,21.4033144 20.366,20.8487157 20.1426667,20.3863846 L19.299,18.6403645 C19.1917778,18.4183043 19.0001111,18.247786 18.7662222,18.1661137 C18.5323333,18.0845518 18.2753333,18.0985686 18.0518889,18.2050736 L17.5243029,18.4565962 L13.3955426,14.3715289 L14.842467,17.2269882 C15.7627521,17.4662541 16.4167347,17.9905237 16.8044149,18.7997973 L14.477,19.9093746 C14.0445556,20.1155418 13.7694444,20.5497291 13.7694444,21.0261873 L13.7694444,25.6393445 C13.7694444,25.7319431 13.7403333,25.8223344 13.6861111,25.8977157 L12.8605556,27.0456522 C12.7764444,27.1625318 12.6408889,27.2318428 12.4963333,27.2318428 C12.3517778,27.2318428 12.2161111,27.1625318 12.1321111,27.0456522 L11.3065556,25.8977157 C11.2523333,25.8223344 11.2232222,25.7319431 11.2232222,25.6393445 L11.2232222,21.0262977 C11.2232222,20.5498395 10.9482222,20.1156522 10.5157778,19.9094849 L6.94088889,18.2051839 C6.71744444,18.0985686 6.46044444,18.0845518 6.22655556,18.1662241 C5.99266667,18.2478963 5.801,18.4184147 5.69377778,18.6404749 L4.85022222,20.386495 C4.62677778,20.8488261 4.823,21.4034247 5.28844444,21.6252642 L8.832,23.3145552 C9.29055556,23.533194 9.56955556,24.0064515 9.537,24.510612 L9.06466667,31.8331906 C9.03988889,32.2167191 8.83744444,32.5671371 8.51644444,32.7816923 C8.19544444,32.9962475 7.79244444,33.0507692 7.42544444,32.9291438 L0.9996809,27.2318428 C1.62286851,26.6274335 2.12331088,25.9005986 2.50100799,25.0513383 C3.83716887,22.0469511 3.34209973,19.165338 3.55677778,17.4216823 C4.30822222,11.3185585 7.55922222,8.54181271 12.4964444,8.54181271 C17.4336667,8.54181271 20.6846667,11.3185585 21.4361111,17.4215719 C21.6559198,19.2068996 21.2230922,22.5323042 22.6186294,25.6393445 C22.9821871,26.4487735 23.5193501,27.1516643 24.2301185,27.748017 L17.5674444,32.9290334 C17.2004444,33.0506589 16.7973333,32.9961371 16.4764444,32.7815819 C16.1554444,32.5669164 15.953,32.2166087 15.9282222,31.8330803 L15.4558889,24.5105017 C15.4234444,24.0063411 15.7023333,23.5330836 16.1608889,23.3144448 L19.0211613,21.95089 Z"
                                                                                        id="Combined-Shape"
                                                                                    ></path>
                                                                                    <path
                                                                                        d="M22.110783,2.86333561 C21.8158042,2.68973488 20.3989014,4.50276774 20.0930894,4.34379235 C19.7268392,4.1533984 20.469685,1.99420316 20.0930894,1.82523539 C18.4699481,1.09697797 16.7770005,0.570002797 15.2408235,0.263889632 C14.8316391,0.182351694 14.8640957,2.87107359 14.4510642,2.81800467 C14.1138614,2.77467872 14.1413589,0.0712222823 13.8025771,0.0468714937 C12.3362466,-0.0585246616 10.8592721,0.0138161594 9.40755556,0.263889632 C9.302,0.282100334 9.22711111,0.37558194 9.23344444,0.481866221 L9.33066667,2.11928428 C9.33177778,2.13782609 9.31877778,2.15438127 9.30033333,2.15769231 C9.28188889,2.16111371 9.26388889,2.15029766 9.25822222,2.13252843 L8.757,0.550183946 C8.72622222,0.452949833 8.62911111,0.392137124 8.52744444,0.406153846 C7.93244444,0.488046823 7.53588889,0.550294314 6.94044444,0.813742475 C6.85322222,0.852371237 6.80322222,0.944638796 6.81855556,1.03823077 L7.27066667,3.79599331 C7.278,3.84058194 7.256,3.88483946 7.21588889,3.90614047 C7.17577778,3.92744147 7.12655556,3.9211505 7.09322222,3.89035786 L4.86266667,1.83100334 C4.799,1.77217726 4.70533333,1.75838127 4.62722222,1.79623746 C3.04866667,2.55998328 1.56033333,3.56731104 0.219888889,4.81811037 C0.111444444,4.91931773 0.0487777778,5.05981605 0.0462655595,5.20770903 C0.044,5.35560201 0.102,5.49797659 0.207333333,5.60260535 L3.98966667,9.3596388 C4.19744444,9.56602676 4.532,9.57320067 4.749,9.37641472 C9.12477778,5.4058194 15.8681111,5.4058194 20.2438889,9.37641472 C20.4611111,9.57353177 20.7952222,9.56635786 21.0032222,9.3596388 L24.7855556,5.60260535 C24.8907778,5.49808696 24.9486667,5.35549164 24.9464012,5.20770903 C24.944,5.05981605 24.8814444,4.91931773 24.773,4.81811037 C23.9935659,4.09075337 23.0862987,3.43744545 22.110783,2.86333561 Z"
                                                                                        id="Shape"
                                                                                    ></path>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </div>
                                            </div>
                                        </div>
                                    </header>
                                    <h1
                                        id="conversation-title"
                                        class="bg-blue-lightest font-bold text-black-transparent-75 px-6 py-4 rounded mb-2 md:mb-6 rounded-lg"
                                        style="word-break: break-word;"
                                    >
                                        {{ $thread->title }}
                                    </h1>
                                    <div class="content user-content text-black md:text-sm">
                                        {{ $thread->body }}
                                    </div>
                                    <div class="forum-comment-edit-links flex justify-end lg:justify-start relative mt-4 -mb-1 md:leading-none justify-start" style="height: 34px;">
                                        <div class="dropdown relative" data-toggle="dropdown">
                                            <div aria-haspopup="true" class="dropdown-toggle h-full">
                                                <button
                                                    class="transition-all border border-solid border-black-transparent-3 hover:border-black-transparent-10 bg-black-transparent-2 hover:bg-black-transparent-3 font-semibold inline-flex items-center px-3 md:text-xs mobile:text-sm mobile:p-2 mobile:flex mobile:items-center h-full text-black-transparent-50 font-bold hover:text-blue text-sm"
                                                    style="border-radius: 12px;"
                                                >
                                                    <span class="relative" style="top: -3px;">...</span>
                                                </button>
                                            </div>
                                            <div class="dropdown-menu absolute z-10 py-2 rounded-lg shadow mt-2 left-0 is-light hidden" style="width: 200px;">
                                                @can('update', $thread)
                                                    <li class="dropdown-menu-link">
                                                        <a href="#" class="js-delete-thread" data-thread="{{ $thread->id }}">Delete</a>
                                                    </li>
                                                @endcan
                                            </div>
                                        </div>
                                        <!---->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <replies
                            :collection="{{ $thread->replies }}"
                            @removed="repliesCount--"
                            @added="repliesCount++"
                        ></replies>
                        {{--<div class="participate-button fixed z-40" style="">
                            <a class="bg-blue hover:bg-blue-dark rounded-full w-16 h-16 text-center flex items-center justify-center shadow-lg">
                                <img src="{{ asset('images/icons/reply-mobile-button.svg') }}" alt="Post Reply Button" />
                            </a>
                        </div>
                        <a
                            href="https://laracasts.com/discuss"
                            class="lg:hidden rounded-full w-16 h-16 z-50 text-center flex items-center justify-center shadow-lg fixed bottom-0 mb-6 ml-6 left-0"
                        >
                            <img src="{{ asset('images/icons/mobile-back-button.svg') }}" alt="Back to Discussions Button" class="rounded-full bg-white" />
                        </a>--}}
                    </div>
                </div>
            </div>
        </div>
    </thread>
@endsection
{{--TODO: Delete thread--}}

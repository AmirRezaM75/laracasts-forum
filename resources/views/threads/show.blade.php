@extends('layouts.master')

@section('content')
    <div class="flex flex-col flex-col-reverse md:flex-row mx-auto" style="max-width: 1070px;">
        <div class="hidden lg:block lg:sticky lg:self-start flex-none mr-9" style="min-width: 200px; top: 40px;">
            <div class="lg:sticky lg:text-center">
                <a id="js-forum-reply-button" class="btn btn-blue block mb-4 max-w-2xs mx-auto" style="box-shadow: rgb(215, 232, 253) 0px 4px 10px 1px;">
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
                <ul class="mobile:hidden">
                    <li>
                        <a
                            href="/discuss"
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
                    <li>
                        <a
                            href="/discuss?me"
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
                            href="/discuss?popular=1"
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
                    <!---->
                    <div
                        id="conversation-stats"
                        class="flex justify-between items-center pl-5 pr-6 py-4 mb-2 border border-solid border-black-transparent-3 hover:border-black-transparent-10 bg-black-transparent-2 hover:bg-black-transparent-3 rounded-lg"
                        style="border-radius: 12px; height: 49px;"
                    >
                        <div>
                            <p class="hidden lg:block text-grey-40 text-2xs font-semibold">
                                Jjmu15 started this conversation 3 months ago. 3 people have replied.
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
                                <span class="text-xs text-grey-dark font-semibold">
                                                        212
                                                    </span>
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
                                <span class="text-xs text-grey-dark font-semibold">4</span>
                            </div>
                            <a href="https://laracasts.com/discuss/channels/laravel" class="btn btn-channel is-laravel py-2 px-6 text-2xs block text-center">
                                Laravel
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
                                            <a href="/@jjmu15" class="font-bold block font-lg mr-2 text-black">jjmu15</a>
                                            <a
                                                class="transition-all border border-solid border-black-transparent-3 hover:border-black-transparent-10 bg-black-transparent-2 hover:bg-black-transparent-3 font-semibold inline-flex items-center px-3 md:text-xs mobile:text-sm mobile:p-2 mobile:flex mobile:items-center text-black-transparent-50"
                                                title="Original Poster"
                                                style="border-radius: 12px; height: 24px;"
                                            >
                                                OP
                                            </a>
                                        </div>
                                        <!---->
                                        <a href="?reply=144531" class="font-semibold pt-1 md:pt-0 text-3xs text-grey-dark link"><span class="text-grey-dark">Posted 3 months ago</span></a>
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
                                    <div class="dropdown relative">
                                        <div aria-haspopup="true" class="dropdown-toggle h-full">
                                            <button
                                                class="transition-all border border-solid border-black-transparent-3 hover:border-black-transparent-10 bg-black-transparent-2 hover:bg-black-transparent-3 font-semibold inline-flex items-center px-3 md:text-xs mobile:text-sm mobile:p-2 mobile:flex mobile:items-center h-full text-black-transparent-50 font-bold hover:text-blue text-sm"
                                                style="border-radius: 12px;"
                                            >
                                                <span class="relative" style="top: -3px;">...</span>
                                            </button>
                                        </div>
                                        <div class="dropdown-menu absolute z-10 py-2 rounded-lg shadow mt-2 left-0 is-light" style="width: 200px; display: none;">
                                            <!---->
                                            <!---->
                                            <li class="dropdown-menu-link">
                                                <a>
                                                    Report Spam
                                                </a>
                                            </li>
                                        </div>
                                    </div>
                                    <!---->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="js-conversation-replies" class="relative">
                        <div>
                            <div>
                                <!---->
                                <!---->
                                <div class="forum-comment relative rounded-xl bg-black-transparent-1 border border-solid border-black-transparent-3 mb-2 is-reply" id="reply-682056" data-index="1">
                                    <div class="flex px-6 py-4 lg:p-5">
                                        <div class="hidden md:block mr-5 text-left">
                                            <a href="/@WeAreModus" class="block relative rounded-lg overflow-hidden mb-1">
                                                <div class="flex items-start">
                                                    <img
                                                        data-src="//www.gravatar.com/avatar/686525dcd9e911a8871dc392a0bda439?s=100&amp;d=https%3A%2F%2Fs3.amazonaws.com%2Flaracasts%2Fimages%2Fforum%2Favatars%2Fdefault-avatar-9.png"
                                                        alt="WeAreModus"
                                                        loading="lazy"
                                                        class="is-circle bg-white w-8 md:w-18 lazyloaded"
                                                        src="//www.gravatar.com/avatar/686525dcd9e911a8871dc392a0bda439?s=100&amp;d=https%3A%2F%2Fs3.amazonaws.com%2Flaracasts%2Fimages%2Fforum%2Favatars%2Fdefault-avatar-9.png"
                                                        style="border-radius: 9px;"
                                                    />
                                                </div>
                                            </a>
                                            <div class="text-center leading-none">
                                                <div class="text-grey-dark font-semibold text-2xs">
                                                    Level 3
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-1 relative">
                                            <header class="flex mb-4 justify-between">
                                                <div class="md:hidden">
                                                    <a href="/@WeAreModus" class="block relative rounded-lg overflow-hidden mr-4">
                                                        <img
                                                            data-src="//www.gravatar.com/avatar/686525dcd9e911a8871dc392a0bda439?s=100&amp;d=https%3A%2F%2Fs3.amazonaws.com%2Flaracasts%2Fimages%2Fforum%2Favatars%2Fdefault-avatar-9.png"
                                                            alt="WeAreModus"
                                                            loading="lazy"
                                                            class="lazyload is-circle bg-white w-8 md:w-18"
                                                            style="border-radius: 9px;"
                                                        />
                                                    </a>
                                                </div>
                                                <div class="flex-1 leading-none text-left">
                                                    <div class="flex items-center">
                                                        <a href="/@WeAreModus" class="font-bold block font-lg mr-2 text-black">WeAreModus</a>
                                                        <!---->
                                                    </div>
                                                    <!---->
                                                    <a href="?reply=682056" class="font-semibold pt-1 md:pt-0 text-3xs text-grey-dark link"><span class="text-grey-dark">Posted 2 weeks ago</span></a>
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
                                            <div class="content user-content text-black md:text-sm"><p>I'm also having this problem now. Did you ever find a solution?</p></div>
                                            <div class="forum-comment-edit-links flex justify-end lg:justify-start relative mt-4 -mb-1 md:leading-none justify-start" style="height: 34px;">
                                                <button
                                                    class="transition-all border border-solid border-black-transparent-3 hover:border-black-transparent-10 bg-black-transparent-2 hover:bg-black-transparent-3 font-semibold inline-flex items-center px-3 md:text-xs mobile:text-sm mobile:p-2 mobile:flex mobile:items-center reply-likes mobile:text-sm mr-2 has-none border-black-transparent-3 bg-black-transparent-1"
                                                    style="border-radius: 12px;"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 14 13" class="fill-current cursor-pointer text-grey">
                                                        <path
                                                            fill-rule="nonzero"
                                                            d="M13.59 1.778c-.453-.864-3.295-3.755-6.59.431C3.54-1.977.862.914.41 1.778c-.825 1.596-.33 4.014.823 5.18L7.001 13l5.767-6.043c1.152-1.165 1.647-3.582.823-5.18z"
                                                        >
                                                            <title>Like this reply.</title>
                                                        </path>
                                                    </svg>
                                                    <!---->
                                                </button>
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
                                                <div class="dropdown relative show-on-hover lg:ml-auto">
                                                    <div aria-haspopup="true" class="dropdown-toggle h-full">
                                                        <button
                                                            class="transition-all border border-solid border-black-transparent-3 hover:border-black-transparent-10 bg-black-transparent-2 hover:bg-black-transparent-3 font-semibold inline-flex items-center px-3 md:text-xs mobile:text-sm mobile:p-2 mobile:flex mobile:items-center h-full text-black-transparent-50 font-bold hover:text-blue text-sm"
                                                            style="border-radius: 12px;"
                                                        >
                                                            <span class="relative" style="top: -3px;">...</span>
                                                        </button>
                                                    </div>
                                                    <div class="dropdown-menu absolute z-10 py-2 rounded-lg shadow mt-2 right-0 is-light" style="width: 200px; display: none;">
                                                        <!---->
                                                        <li class="dropdown-menu-link">
                                                            <a>
                                                                Report Spam
                                                            </a>
                                                        </li>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!----><!---->
                                <div class="reply-with-responses">
                                    <div
                                        class="forum-comment relative rounded-xl bg-black-transparent-1 border border-solid border-black-transparent-3 mb-2 is-reply"
                                        id="reply-682188"
                                        data-index="2"
                                    >
                                        <div class="flex px-6 py-4 lg:p-5">
                                            <div class="hidden md:block mr-5 text-left">
                                                <a href="/@WeAreModus" class="block relative rounded-lg overflow-hidden mb-1">
                                                    <div class="flex items-start">
                                                        <img
                                                            data-src="//www.gravatar.com/avatar/686525dcd9e911a8871dc392a0bda439?s=100&amp;d=https%3A%2F%2Fs3.amazonaws.com%2Flaracasts%2Fimages%2Fforum%2Favatars%2Fdefault-avatar-9.png"
                                                            alt="WeAreModus"
                                                            loading="lazy"
                                                            class="is-circle bg-white w-8 md:w-18 lazyloaded"
                                                            src="//www.gravatar.com/avatar/686525dcd9e911a8871dc392a0bda439?s=100&amp;d=https%3A%2F%2Fs3.amazonaws.com%2Flaracasts%2Fimages%2Fforum%2Favatars%2Fdefault-avatar-9.png"
                                                            style="border-radius: 9px;"
                                                        />
                                                    </div>
                                                </a>
                                                <div class="text-center leading-none">
                                                    <div class="text-grey-dark font-semibold text-2xs">
                                                        Level 3
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-1 relative">
                                                <header class="flex mb-4 justify-between">
                                                    <div class="md:hidden">
                                                        <a href="/@WeAreModus" class="block relative rounded-lg overflow-hidden mr-4">
                                                            <img
                                                                data-src="//www.gravatar.com/avatar/686525dcd9e911a8871dc392a0bda439?s=100&amp;d=https%3A%2F%2Fs3.amazonaws.com%2Flaracasts%2Fimages%2Fforum%2Favatars%2Fdefault-avatar-9.png"
                                                                alt="WeAreModus"
                                                                loading="lazy"
                                                                class="lazyload is-circle bg-white w-8 md:w-18"
                                                                style="border-radius: 9px;"
                                                            />
                                                        </a>
                                                    </div>
                                                    <div class="flex-1 leading-none text-left">
                                                        <div class="flex items-center">
                                                            <a href="/@WeAreModus" class="font-bold block font-lg mr-2 text-black">WeAreModus</a>
                                                            <!---->
                                                        </div>
                                                        <!---->
                                                        <a href="?reply=682188" class="font-semibold pt-1 md:pt-0 text-3xs text-grey-dark link"><span class="text-grey-dark">Posted 2 weeks ago</span></a>
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
                                                                                            <g
                                                                                                id="10kstrong-icon"
                                                                                                transform="translate(13.000000, 8.000000)"
                                                                                                fill="#FFFFFF"
                                                                                                fill-rule="nonzero"
                                                                                                class="achievement-badge-icon"
                                                                                            >
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
                                                <div class="content user-content text-black md:text-sm"><p>It seems to have randomly started working again, without any obvious intervention from me. Weird.</p></div>
                                                <div class="forum-comment-edit-links flex justify-end lg:justify-start relative mt-4 -mb-1 md:leading-none justify-start" style="height: 34px;">
                                                    <button
                                                        class="transition-all border border-solid border-black-transparent-3 hover:border-black-transparent-10 bg-black-transparent-2 hover:bg-black-transparent-3 font-semibold inline-flex items-center px-3 md:text-xs mobile:text-sm mobile:p-2 mobile:flex mobile:items-center reply-likes mobile:text-sm mr-2 has-likes border-black-transparent-3 bg-black-transparent-1"
                                                        style="border-radius: 12px;"
                                                    >
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 14 13" class="fill-current cursor-pointer text-grey">
                                                            <path
                                                                fill-rule="nonzero"
                                                                d="M13.59 1.778c-.453-.864-3.295-3.755-6.59.431C3.54-1.977.862.914.41 1.778c-.825 1.596-.33 4.014.823 5.18L7.001 13l5.767-6.043c1.152-1.165 1.647-3.582.823-5.18z"
                                                            >
                                                                <title>Like this reply.</title>
                                                            </path>
                                                        </svg>
                                                        <span title="Liked by jjmu15" class="text-xs font-semibold text-blue" style="margin-left: 6px; cursor: help;">1</span>
                                                    </button>
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
                                                    <div class="dropdown relative show-on-hover lg:ml-auto">
                                                        <div aria-haspopup="true" class="dropdown-toggle h-full">
                                                            <button
                                                                class="transition-all border border-solid border-black-transparent-3 hover:border-black-transparent-10 bg-black-transparent-2 hover:bg-black-transparent-3 font-semibold inline-flex items-center px-3 md:text-xs mobile:text-sm mobile:p-2 mobile:flex mobile:items-center h-full text-black-transparent-50 font-bold hover:text-blue text-sm"
                                                                style="border-radius: 12px;"
                                                            >
                                                                <span class="relative" style="top: -3px;">...</span>
                                                            </button>
                                                        </div>
                                                        <div class="dropdown-menu absolute z-10 py-2 rounded-lg shadow mt-2 right-0 is-light" style="width: 200px; display: none;">
                                                            <!---->
                                                            <li class="dropdown-menu-link">
                                                                <a>
                                                                    Report Spam
                                                                </a>
                                                            </li>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="responses">
                                        <div class="forum-comment relative rounded-xl bg-black-transparent-1 border border-solid border-black-transparent-3 mb-2 is-reply" id="reply-682267">
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
                                                                <a href="/@jjmu15" class="font-bold block font-lg mr-2 text-black">jjmu15</a>
                                                                <a
                                                                    class="transition-all border border-solid border-black-transparent-3 hover:border-black-transparent-10 bg-black-transparent-2 hover:bg-black-transparent-3 font-semibold inline-flex items-center px-3 md:text-xs mobile:text-sm mobile:p-2 mobile:flex mobile:items-center text-black-transparent-50"
                                                                    title="Original Poster"
                                                                    style="border-radius: 12px; height: 24px;"
                                                                >
                                                                    OP
                                                                </a>
                                                            </div>
                                                            <!---->
                                                            <a href="?reply=682267" class="font-semibold pt-1 md:pt-0 text-3xs text-grey-dark link">
                                                                <span class="text-grey-dark">Posted 2 weeks ago</span>
                                                            </a>
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
                                                                                <svg
                                                                                    width="24px"
                                                                                    height="24px"
                                                                                    viewBox="0 0 50 50"
                                                                                    version="1.1"
                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                >
                                                                                    <g id="Laracasts-Website" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                        <g id="Settings" transform="translate(-590.000000, -543.000000)">
                                                                                            <g id="10k-strong" transform="translate(590.000000, 543.000000)">
                                                                                                <circle id="color-base" class="fill-current transition-all" cx="25" cy="25" r="25"></circle>
                                                                                                <g
                                                                                                    id="10kstrong-icon"
                                                                                                    transform="translate(13.000000, 8.000000)"
                                                                                                    fill="#FFFFFF"
                                                                                                    fill-rule="nonzero"
                                                                                                    class="achievement-badge-icon"
                                                                                                >
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
                                                    <div class="content user-content text-black md:text-sm">
                                                        <p>Weird! I'm glad it is working again for you.</p>
                                                        <p>I did find a solution for this but it was a couple of months ago now and I forgot to post my solution at the time and now I cannot remember it.</p>
                                                        <p>Apologies for not being a good community member and sharing my solution for anyone to comes across this!</p>
                                                    </div>
                                                    <div class="forum-comment-edit-links flex justify-end lg:justify-start relative mt-4 -mb-1 md:leading-none justify-start" style="height: 34px;">
                                                        <button
                                                            class="transition-all border border-solid border-black-transparent-3 hover:border-black-transparent-10 bg-black-transparent-2 hover:bg-black-transparent-3 font-semibold inline-flex items-center px-3 md:text-xs mobile:text-sm mobile:p-2 mobile:flex mobile:items-center reply-likes mobile:text-sm mr-2 has-none border-black-transparent-3 bg-black-transparent-1"
                                                            style="border-radius: 12px;"
                                                        >
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 14 13" class="fill-current cursor-pointer text-grey">
                                                                <path
                                                                    fill-rule="nonzero"
                                                                    d="M13.59 1.778c-.453-.864-3.295-3.755-6.59.431C3.54-1.977.862.914.41 1.778c-.825 1.596-.33 4.014.823 5.18L7.001 13l5.767-6.043c1.152-1.165 1.647-3.582.823-5.18z"
                                                                >
                                                                    <title>Like this reply.</title>
                                                                </path>
                                                            </svg>
                                                            <!---->
                                                        </button>
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
                                                        <div class="dropdown relative show-on-hover lg:ml-auto">
                                                            <div aria-haspopup="true" class="dropdown-toggle h-full">
                                                                <button
                                                                    class="transition-all border border-solid border-black-transparent-3 hover:border-black-transparent-10 bg-black-transparent-2 hover:bg-black-transparent-3 font-semibold inline-flex items-center px-3 md:text-xs mobile:text-sm mobile:p-2 mobile:flex mobile:items-center h-full text-black-transparent-50 font-bold hover:text-blue text-sm"
                                                                    style="border-radius: 12px;"
                                                                >
                                                                    <span class="relative" style="top: -3px;">...</span>
                                                                </button>
                                                            </div>
                                                            <div class="dropdown-menu absolute z-10 py-2 rounded-lg shadow mt-2 right-0 is-light" style="width: 200px; display: none;">
                                                                <!---->
                                                                <li class="dropdown-menu-link">
                                                                    <a>
                                                                        Report Spam
                                                                    </a>
                                                                </li>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!----><!---->
                                <div class="forum-comment relative rounded-xl bg-black-transparent-1 border border-solid border-black-transparent-3 mb-2 is-reply" id="reply-687378" data-index="3">
                                    <div class="flex px-6 py-4 lg:p-5">
                                        <div class="hidden md:block mr-5 text-left">
                                            <a href="/@77trombones" class="block relative rounded-lg overflow-hidden mb-1">
                                                <div class="flex items-start">
                                                    <img
                                                        data-src="//www.gravatar.com/avatar/705ca76de04a72076bf7242d47ecadcd?s=100&amp;d=https%3A%2F%2Fs3.amazonaws.com%2Flaracasts%2Fimages%2Fforum%2Favatars%2Fdefault-avatar-1.png"
                                                        alt="77trombones"
                                                        loading="lazy"
                                                        class="is-circle bg-white w-8 md:w-18 lazyloaded"
                                                        src="//www.gravatar.com/avatar/705ca76de04a72076bf7242d47ecadcd?s=100&amp;d=https%3A%2F%2Fs3.amazonaws.com%2Flaracasts%2Fimages%2Fforum%2Favatars%2Fdefault-avatar-1.png"
                                                        style="border-radius: 9px;"
                                                    />
                                                </div>
                                            </a>
                                            <div class="text-center leading-none">
                                                <div class="text-grey-dark font-semibold text-2xs">
                                                    Level 1
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-1 relative">
                                            <header class="flex mb-4 justify-between">
                                                <div class="md:hidden">
                                                    <a href="/@77trombones" class="block relative rounded-lg overflow-hidden mr-4">
                                                        <img
                                                            data-src="//www.gravatar.com/avatar/705ca76de04a72076bf7242d47ecadcd?s=100&amp;d=https%3A%2F%2Fs3.amazonaws.com%2Flaracasts%2Fimages%2Fforum%2Favatars%2Fdefault-avatar-1.png"
                                                            alt="77trombones"
                                                            loading="lazy"
                                                            class="lazyload is-circle bg-white w-8 md:w-18"
                                                            style="border-radius: 9px;"
                                                        />
                                                    </a>
                                                </div>
                                                <div class="flex-1 leading-none text-left">
                                                    <div class="flex items-center">
                                                        <a href="/@77trombones" class="font-bold block font-lg mr-2 text-black">77trombones</a>
                                                        <!---->
                                                    </div>
                                                    <!---->
                                                    <a href="?reply=687378" class="font-semibold pt-1 md:pt-0 text-3xs text-grey-dark link"><span class="text-grey-dark">Posted 8 minutes ago</span></a>
                                                </div>
                                                <div class="flex relative" style="top: -5px;">
                                                    <div class="hidden md:block ml-4"><div class="achievement-list flex"></div></div>
                                                </div>
                                            </header>
                                            <div class="content user-content text-black md:text-sm">
                                                <p>
                                                    For anyone encountering this error, in my case it was because I was using the incorrect STRIPE_WEBHOOK_SECRET signature in my .env. To verify, go to stripe dashboard
                                                    &gt; developers &gt; webhooks, select the endpoint you're testing and reveal/copy the "Signing secret" to your .env
                                                </p>
                                                <p>Good luck!</p>
                                            </div>
                                            <div class="forum-comment-edit-links flex justify-end lg:justify-start relative mt-4 -mb-1 md:leading-none justify-start" style="height: 34px;">
                                                <button
                                                    class="transition-all border border-solid border-black-transparent-3 hover:border-black-transparent-10 bg-black-transparent-2 hover:bg-black-transparent-3 font-semibold inline-flex items-center px-3 md:text-xs mobile:text-sm mobile:p-2 mobile:flex mobile:items-center reply-likes mobile:text-sm mr-2 has-none border-black-transparent-3 bg-black-transparent-1"
                                                    style="border-radius: 12px;"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 14 13" class="fill-current cursor-pointer text-grey">
                                                        <path
                                                            fill-rule="nonzero"
                                                            d="M13.59 1.778c-.453-.864-3.295-3.755-6.59.431C3.54-1.977.862.914.41 1.778c-.825 1.596-.33 4.014.823 5.18L7.001 13l5.767-6.043c1.152-1.165 1.647-3.582.823-5.18z"
                                                        >
                                                            <title>Like this reply.</title>
                                                        </path>
                                                    </svg>
                                                    <!---->
                                                </button>
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
                                                <div class="dropdown relative show-on-hover lg:ml-auto">
                                                    <div aria-haspopup="true" class="dropdown-toggle h-full">
                                                        <button
                                                            class="transition-all border border-solid border-black-transparent-3 hover:border-black-transparent-10 bg-black-transparent-2 hover:bg-black-transparent-3 font-semibold inline-flex items-center px-3 md:text-xs mobile:text-sm mobile:p-2 mobile:flex mobile:items-center h-full text-black-transparent-50 font-bold hover:text-blue text-sm"
                                                            style="border-radius: 12px;"
                                                        >
                                                            <span class="relative" style="top: -3px;">...</span>
                                                        </button>
                                                    </div>
                                                    <div class="dropdown-menu absolute z-10 py-2 rounded-lg shadow mt-2 right-0 is-light" style="width: 200px; display: none;">
                                                        <!---->
                                                        <li class="dropdown-menu-link">
                                                            <a>
                                                                Report Spam
                                                            </a>
                                                        </li>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!---->
                            </div>
                            <!---->
                            <div aria-expanded="true" data-modal="reply-modal" class="v--modal-overlay">
                                <div class="v--modal-background-click">
                                    <div class="v--modal-top-right"></div>
                                    <div role="dialog" aria-modal="true" class="v--modal-box v--modal conversation-modal" style="top: 636px; left: 552px; width: 800px; height: auto;">
                                        <div class="pointer-events-auto flex py-8 px-10 md:px-8 md:py-6">
                                            <div class="flex-1">
                                                <form action="">
                                                    <div class="control flex items-center">
                                                        <svg
                                                            height="16px"
                                                            version="1.1"
                                                            viewBox="0 0 16 16"
                                                            width="16px"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                            class="fill-current text-grey-dark mr-2"
                                                        >
                                                            <g fill="none" fill-rule="evenodd" id="Icons with numbers" stroke="none" stroke-width="1">
                                                                <g id="Group" transform="translate(0.000000, -336.000000)" class="fill-current">
                                                                    <path d="M0,344 L6,339 L6,342 C10.5,342 14,343 16,348 C13,345.5 10,345 6,346 L6,349 L0,344 L0,344 Z M0,344"></path>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <p class="font-bold">
                                                            Reply to
                                                            <strong class="text-blue uppercase">WeAreModus</strong>
                                                        </p>
                                                    </div>
                                                    <div class="control">
                                                                            <textarea
                                                                                name="body"
                                                                                id="body"
                                                                                data-autosize=""
                                                                                required="required"
                                                                                class="textarea mb-1 border-l-0 border-r-0 px-0 py-4 text-sm focus:border-grey-light"
                                                                                data-tribute="true"
                                                                                style="min-height: 150px; max-height: 45vh; overflow: hidden; overflow-wrap: break-word; resize: none; height: 150px;"
                                                                            ></textarea>
                                                    </div>
                                                    <div class="flex items-center justify-between">
                                                        <div>
                                                            <div class="mobile:hidden flex items-center text-xs mb-2">
                                                                <label for="show_profile" class="switch mr-2">
                                                                    <input id="show_profile" name="show_profile" type="checkbox" disabled="disabled" />
                                                                    <div class="slider round cursor-not-allowed"></div>
                                                                </label>
                                                                <span class="mr-3 font-semibold text-2xs text-grey-30">Markdown Preview OFF</span>
                                                            </div>
                                                            <div class="flex">
                                                                <div class="flex-1 help">
                                                                    <p class="mobile:hidden text-grey-30 text-2xs">
                                                                        * You may use Markdown with
                                                                        <a href="https://help.github.com/articles/creating-and-highlighting-code-blocks/" target="_blank" rel="noreferrer noopener">
                                                                            GitHub-flavored
                                                                        </a>
                                                                        code blocks.
                                                                    </p>
                                                                    <!---->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mobile:flex mobile:w-full mobile:justify-center">
                                                            <button class="btn mr-4 md:py-25">
                                                                Cancel
                                                            </button>
                                                            <button type="submit" title="Cmd + Enter" class="md:py-25 mobile:flex-1 btn btn-blue">
                                                                Post
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!---->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="participate-button fixed z-40" style="">
                            <a class="bg-blue hover:bg-blue-dark rounded-full w-16 h-16 text-center flex items-center justify-center shadow-lg">
                                <img src="/images/forum/reply-mobile-button.svg" alt="Post Reply Button" />
                            </a>
                        </div>
                        <a
                            href="https://laracasts.com/discuss"
                            class="lg:hidden rounded-full w-16 h-16 z-50 text-center flex items-center justify-center shadow-lg fixed bottom-0 mb-6 ml-6 left-0"
                        >
                            <img src="/images/mobile-back-button.svg?v=2" alt="Back to Discussions Button" class="rounded-full bg-white" />
                        </a>
                    </div>
                    <div class="border border-grey-light hover:border-blue transition-all border-dashed text-grey-darkest text-sm rounded-xl">
                        <a class="block flex items-center inherits-color p-8">
                            <div class="mr-4">
                                <img src="//unavatar.now.sh/github/amirrezam75?fallback=https://s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-1.png" alt="amirrezam75" width="37.5" class="is-circle" />
                            </div>
                            Write a reply.
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<nav class="section new-nav z-50 py-4 bg-bg-blue-darkest lg:py-3">
    <div class="flex justify-between h-full items-center relative">
        <div id="header-logo-arrow" class="has-animation xl:flex-1 mr-4 xl:mr-0">
            <a href="/" class="cursor-pointer leading-none inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27">
                    <g fill="none" fill-rule="evenodd">
                        <g fill="#FFF">
                            <path
                                d="M4.608 6.721l3.798 3.799a1.948 1.948 0 0 1-2.754 2.754L1.853 9.476A1.948 1.948 0 0 1 4.608 6.72zM12.631 14.745l8.086 8.085a1.948 1.948 0 1 1-2.755 2.754L9.877 17.5a1.948 1.948 0 0 1 2.754-2.754z"
                            ></path>
                            <path d="M2.755 6.22L24.105.836a2.057 2.057 0 0 1 2.483 1.433 1.94 1.94 0 0 1-1.392 2.411l-21.35 5.385a2.057 2.057 0 0 1-2.483-1.434 1.94 1.94 0 0 1 1.392-2.41z"></path>
                            <path d="M17.384 23.604l5.385-21.35A1.94 1.94 0 0 1 25.179.86a2.057 2.057 0 0 1 1.434 2.483l-5.384 21.35a1.94 1.94 0 0 1-2.411 1.392 2.057 2.057 0 0 1-1.434-2.482z"></path>
                        </g>
                        <path
                            d="M16.541 13.778l-7.63 7.631a2.015 2.015 0 1 1-2.85-2.849l7.631-7.63a2.015 2.015 0 1 1 2.85 2.848zM5.111 25.208l-1.108 1.109a2.015 2.015 0 1 1-2.85-2.85l1.11-1.108a2.015 2.015 0 1 1 2.848 2.85z"
                            class="fill-current"
                        ></path>
                    </g>
                </svg>
            </a>
        </div>
        <div class="md:hidden flex items-center">
            <button title="Tip: press / or s anywhere to instantly activate me." class="leading-none mr-4 inline-flex" id="mobile-search">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 15 15" class="text-white">
                    <g fill="none" fill-rule="evenodd">
                        <path d="M-2-2h20v20H-2z"></path>
                        <path
                            d="M10.443 9.232h-.638l-.226-.218A5.223 5.223 0 0 0 10.846 5.6 5.247 5.247 0 1 0 5.6 10.846c1.3 0 2.494-.476 3.414-1.267l.218.226v.638l4.036 4.028 1.203-1.203-4.028-4.036zm-4.843 0A3.627 3.627 0 0 1 1.967 5.6 3.627 3.627 0 0 1 5.6 1.967 3.627 3.627 0 0 1 9.232 5.6 3.627 3.627 0 0 1 5.6 9.232z"
                            class="fill-current"
                        ></path>
                    </g>
                </svg>
            </button>
            <div class="mr-4">
                @auth
                    <a class="block leading-none">
                        <img
                            src="{{ auth()->user()->avatar }}"
                            alt="mehdi_ahd23"
                            width="27.5"
                            class="is-circle bg-white relative"
                        />
                    </a>
                @endauth
            </div>
            <div>
                <div class="v-portal" style="display: none;"></div>
                <a class="block leading-none">
                    <div class="hamburger-nav"><span></span> <span></span> <span></span> <span></span></div>
                </a>
            </div>
        </div>
        <div class="hidden md:block relative flex-1">
            <div class="flex items-center justify-end leading-none">
                <button
                    title="Tip: press / or s anywhere to instantly activate me."
                    class="leading-none inline-flex mr-1 leading-none bg-transparent-10 hover:bg-transparent-25 p-3 rounded-xl"
                    id="search-trigger"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" viewBox="0 0 15 15" class="text-white">
                        <g fill="none" fill-rule="evenodd">
                            <path d="M-2-2h20v20H-2z"></path>
                            <path
                                d="M10.443 9.232h-.638l-.226-.218A5.223 5.223 0 0 0 10.846 5.6 5.247 5.247 0 1 0 5.6 10.846c1.3 0 2.494-.476 3.414-1.267l.218.226v.638l4.036 4.028 1.203-1.203-4.028-4.036zm-4.843 0A3.627 3.627 0 0 1 1.967 5.6 3.627 3.627 0 0 1 5.6 1.967 3.627 3.627 0 0 1 9.232 5.6 3.627 3.627 0 0 1 5.6 9.232z"
                                class="fill-current"
                            ></path>
                        </g>
                    </svg>
                </button>
                <div>
                    <ul class="flex items-center cursor-pointer ml-4 relative">
                        @auth
                            <li>
                                <div>
                                    <a class="block leading-none">
                                        <img
                                            src="{{ auth()->user()->avatar }}"
                                            alt="mehdi_ahd23 avatar"
                                            width="35"
                                            class="is-circle"
                                        />
                                    </a>
                                </div>
                            </li>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

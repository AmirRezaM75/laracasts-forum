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
            @auth
                <a class="block leading-none ml-4">
                    <img
                        :src="$auth.avatar"
                        :alt="$auth.username"
                        width="27.5"
                        class="is-circle bg-white relative"
                    />
                </a>
            @endauth
        </div>
        <div class="hidden md:block relative flex-1">
            <div class="flex items-center justify-end leading-none">
                <notification></notification>

                @auth
                    <div class="flex items-center cursor-pointer ml-4 relative">
                        <a @click.prevent="$modal.show('account-slideout-menu')"
                            class="block leading-none">
                            <img
                                :src="$auth.avatar"
                                :alt="$auth.username"
                                width="35"
                                class="is-circle"
                            />
                        </a>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                       @click.prevent="$modal.show('auth-modal', { type: 'login' })"
                       class="text-white hover:text-white link font-semibold uppercase mx-6 text-xs"
                    >
                        Sign In
                    </a>

                    <a href="{{ route('register') }}"
                       @click.prevent="$modal.show('auth-modal', { type: 'register' })"
                       class="text-white hover:bg-white hover:text-blue font-semibold uppercase border rounded-full text-xs px-3 py-2 leading-tight">
                        Get Started
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

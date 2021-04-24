<div id="settings-nav-links" class="hidden md:block setting-section md:w-52  mobile:pt-8 md:border-r md:border-grey-lighter md:border-solid pr-8">
    <aside class="menu">
        <a href="{{ url('profile/account') }}"
           class="{{ Request::is('profile/account') ? 'text-blue font-semibold border-blue-light bg-blue-lighter' : 'text-grey-dark border-black-transparent-3' }} flex items-center mb-2 text-sm mb-1 hover:text-blue hover:border-blue-light hover:bg-blue-lighter py-2 px-6 border border-solid rounded-xl"
           style="height: 41px;">
            Account
        </a>
        <a href="{{ url('profile/subscriptions') }}"
           class="{{ Request::is('profile/subscriptions') ? 'text-blue font-semibold border-blue-light bg-blue-lighter' : 'text-grey-dark border-black-transparent-3' }} flex items-center mb-2 text-sm mb-1 hover:text-blue hover:border-blue-light hover:bg-blue-lighter py-2 px-6 border border-solid rounded-xl " style="height: 41px;">
            Notifications
        </a>
    </aside>
</div>

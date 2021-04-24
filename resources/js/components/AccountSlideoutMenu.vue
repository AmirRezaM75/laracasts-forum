<template>
    <modal
        name='account-slideout-menu'
        :pivot-x='.97'
        :pivot-y="0"
        height="90%"
        width="300"
        transition="modal-slide-right"
        classes="account-slideout-menu v--modal-box v--modal m-6"
    >
        <div class="px-6 pb-8">
            <header class="text-center pt-8 mb-6">
                <div class="flex justify-center mb-8">
                    <a :href="'/@' + $auth.username">
                        <img
                            :src="$auth.avatar"
                            :alt="'Avatar of ' + $auth.username"
                            width="100"
                            height="100"
                            class="rounded-full">
                    </a>
                </div>
                <div class="tabs relative flex justify-center mx-8">
                    <a class="tab flex-1 text-sm relative pb-4 font-semibold hover:text-black current-tab text-black">Me</a>
                    <a class="tab text-sm relative pb-4 font-semibold hover:text-black flex-1 inline-flex items-center px-2 text-grey">Notifications</a>
                </div>
            </header>
            <div class="text-center">
                <div>
                    <div class="flex flex-col items-center text-center">
                        <ul class="text-center w-full">
                            <li class="py-2">
                                <a :href="'/threads?by=' + $auth.username"
                                   class="block hover:text-blue border border-solid border-transparent hover:border-blue hover:bg-blue-lighter rounded-full py-2 text-grey-dark font-semibold">
                                Questions
                                </a>
                            </li>
                            <li class="py-2">
                                <a :href="'/@' + $auth.username"
                                   class="block hover:text-blue border border-solid border-transparent hover:border-blue hover:bg-blue-lighter rounded-full py-2 text-grey-dark font-semibold">
                                    Profile
                                </a>
                            </li>
                            <li class="py-2">
                                <a href="/profile/account"
                                    class="block hover:text-blue border border-solid border-transparent hover:border-blue hover:bg-blue-lighter rounded-full py-2 text-grey-dark font-semibold">
                                Settings
                                </a>
                            </li>
                            <li class="py-2">
                                <a href="/logout"
                                   @click.prevent="logout"
                                   class="block hover:text-blue border border-solid border-transparent hover:border-blue hover:bg-blue-lighter rounded-full py-2 text-grey-dark font-semibold">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div style="display: none;">
                <div class="overflow-y-auto pb-6">
                    <p class="text-center">You have no notifications at this time.</p>
                    <div class="pt-8 px-4">
                    </div>
                </div>
            </div>
        </div>
    </modal>
</template>

<script>
export default {
    name: "AccountSlideoutMenu",
    methods: {
        logout() {
            axios.post('/logout').then(() => location.reload())
        }
    }
}
</script>


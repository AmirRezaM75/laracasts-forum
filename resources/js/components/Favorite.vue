<template>
    <button
        @click="toggle"
        class="transition-all border border-solid border-black-transparent-3 hover:border-black-transparent-10 bg-black-transparent-2 hover:bg-black-transparent-3 font-semibold inline-flex items-center px-3 md:text-xs mobile:text-sm mobile:p-2 mobile:flex mobile:items-center reply-likes mobile:text-sm mr-2"
        :class="active ? 'has-likes border-blue-light bg-blue-lighter' : 'has-none border-black-transparent-3 bg-black-transparent-1'"
        style="border-radius: 12px;"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="17"
            height="16"
            viewBox="0 0 14 13"
            class="fill-current cursor-pointer"
            :class="active ? 'text-blue' : 'text-grey'"
        >
            <path
                fill-rule="nonzero"
                d="M13.59 1.778c-.453-.864-3.295-3.755-6.59.431C3.54-1.977.862.914.41 1.778c-.825 1.596-.33 4.014.823 5.18L7.001 13l5.767-6.043c1.152-1.165 1.647-3.582.823-5.18z"
            >
                <title>Like this reply.</title>
            </path>
        </svg>
        <span
            v-if="count"
            v-text="count"
            class="text-xs font-semibold text-blue"
            style="margin-left: 6px; cursor: help;"></span>
    </button>
</template>

<script>
export default {
    name: "Favorite",
    props: ['reply'],
    data() {
        return {
            active: this.reply.isFavorited,
            count: this.reply.favoritesCount
        }
    },
    methods: {
        toggle() {
            return this.active ? this.destroy() : this.store()
        },
        store() {
            axios.post(this.endpoint)
                .then(res => {
                    this.count++
                    this.active = true
                })
        },
        destroy() {
            axios.delete(this.endpoint)
                .then(res => {
                    this.count--
                    this.active = false
                })
        }
    },
    computed: {
        endpoint() {
            return '/replies/' + this.reply.id + '/favorites'
        }
    }
}
</script>

<template>
    <button
        type="submit"
        title="Want an email each time this conversation receives a new reply?"
        class="btn btn-outlined bg-transparent w-full mb-8 max-w-2xs"
        :class="active ? 'border-blue text-blue' : 'border-grey-dark text-grey-dark' "
        @click="toggle"
    >
        <svg v-if="active"
             xmlns="http://www.w3.org/2000/svg"
             width="10"
             height="8"
             viewBox="0 0 10 8"
             class="fill-current mr-1 inline-block">
            <path fill-rule="nonzero" d="M.115 4.4A.441.441 0 0 1 0 4.12c0-.08.038-.2.115-.28l.539-.56a.362.362 0 0 1 .538 0l.039.04 2.115 2.36c.077.08.192.08.27 0L8.768.12h.039a.362.362 0 0 1 .538 0l.539.56c.153.16.153.4 0 .56L3.73 7.88a.343.343 0 0 1-.27.12.343.343 0 0 1-.269-.12l-3-3.36-.077-.12z"></path>
        </svg>
        {{ active ? 'Following' : 'Follow'}}
    </button>
</template>

<script>
export default {
    name: "SubscriptionButton",
    props: ['active'],
    computed: {
        endpoint() {
            return '/threads/' + window.location.pathname.match(/\/threads\/\w+\/(\w+)/)[1] + '/subscriptions'
        }
    },
    methods: {
        toggle() {
            return this.active ? this.unsubscribe() : this.subscribe()
        },
        subscribe() {
            axios.post(this.endpoint).then(res => {
                this.active = true
                flash('Okay, we will email you each time this conversation is updated.')
            })
        },
        unsubscribe() {
            axios.delete(this.endpoint).then(res => {
                this.active = false
                flash('You are no longer following this conversation.')
            })
        },
    }
}
</script>

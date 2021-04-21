<template>
    <a
        type="submit"
        title="Want to lock this conversation and stop it from receiving a new reply?"
        class="btn btn-outlined bg-transparent block w-full mb-4 max-w-2xs mx-auto"
        :class="locked ? 'border-red text-red' : 'border-grey-dark text-grey-dark' "
        @click="toggle"
    >
        {{ locked ? 'Unlock' : 'Lock'}}
    </a>
</template>

<script>
export default {
    name: "LockButton",
    props: ['isLocked'],
    data() {
        return {
            locked: this.isLocked
        }
    },
    computed: {
        endpoint() {
            return '/threads/' + window.location.pathname.match(/\/threads\/\w+\/(\w+)/)[1] + '/lock'
        }
    },
    methods: {
        toggle() {
            this.locked ? this.unlock() : this.lock()
        },
        lock() {
            axios.post(this.endpoint).then(response => {
                this.locked = true
                this.$store.commit('LOCK_THREAD');
            })
        },
        unlock() {
            axios.delete(this.endpoint).then(response => {
                this.locked = false
                this.$store.commit('LOCK_THREAD', false);
            })
        }
    }
}
</script>

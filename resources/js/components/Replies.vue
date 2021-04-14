<template>
    <div>
        <div class="relative">
            <div>
                <reply
                    v-for="(reply, index) in replies"
                    :key="reply.id"
                    :index="index"
                    :model="reply"
                ></reply>
                <div class="my-4">
                    <paginator :data="pagination" @changed="fetch"></paginator>
                </div>
            </div>
        </div>
        <p v-if="$store.state.thread['locked']"
           class="mt-8 font-bold text-center">Thread is locked and you can not reply.</p>
        <div
            v-else-if="$auth"
            class="border border-grey-light hover:border-blue transition-all border-dashed text-grey-darkest text-sm rounded-xl">
            <a class="block flex items-center inherits-color p-8" @click.prevent="create">
                <div class="mr-4">
                    <img :src="$auth.avatar"
                         :alt="$auth.username"
                         width="37.5"
                         class="is-circle" />
                </div>
                Write a reply.
            </a>
        </div>
        <p v-else class="mt-8 font-bold text-center">
            Please <a href="/login">sign in</a> or <a href="/register">create an account</a> to participate in this conversation.
        </p>
    </div>
</template>

<script>
import Reply from "./Reply";
import ReplyModal from "./ReplyModal";
import { mapState } from 'vuex'

export default {
    name: "Replies",
    components: { Reply },
    data() {
        return {
            pagination: null
        }
    },
    computed: {
        ...mapState(['replies']),
    },
    methods: {
        create() {
            this.$modal.show(ReplyModal,{}, { name: "create-reply", classes: ['v--modal', 'conversation-modal'] });
        },
        fetch(page) {
            axios.get(this.endpoint(page)).then(response => {
                this.$store.commit('SET_REPLIES', response.data.data)
                this.$store.commit('SET_REPLIES_COUNT', response.data.total)
                this.pagination = response.data
                window.scrollTo(0, 0) // TODO: scroll to first reply smoothly
            })
        },
        endpoint(page) {
            if (! page) {
                let query = window.location.search.match(/page=(\d+)/)
                page = query ? query[1] : 1
            }

            return '/threads/' + window.location.pathname.match(/\/threads\/\w+\/(\w+)/)[1] + '/replies?page=' + page
        }
    },
    mounted() {
        this.fetch()
    }
}
</script>

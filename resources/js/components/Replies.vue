<template>
    <div>
        <div class="relative">
            <div>
                <reply
                    v-for="(reply, index) in replies"
                    :key="reply.id"
                    :model="reply"
                    @destroyed="remove(index)"
                ></reply>
                <div class="my-4">
                    <!--TODO: pagination -->
                </div>
            </div>
        </div>
        <div
            v-if="$auth"
            class="border border-grey-light hover:border-blue transition-all border-dashed text-grey-darkest text-sm rounded-xl">
            <a class="block flex items-center inherits-color p-8" @click.prevent="create">
                <div class="mr-4">
                    <img :src="$auth.avatar"
                         alt="amirrezam75"
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

export default {
    name: "Replies",
    props: ['collection'],
    data() {
        return {
            replies: this.collection
        }
    },
    components: { Reply },
    methods: {
        create() {
            // TODO: popup reply modal
        },
        remove(index) {
            this.replies.splice(index, 1)

            this.$emit('removed')

            flash('Reply was removed')
        }

    }
}
</script>

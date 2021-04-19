<template>
    <modal
        name="conversation-modal"
        shiftY="1"
        :pivot-y="1"
        width="800"
        height="auto"
        :adaptive="true"
        :click-to-close="false"
        transition="modal-slide-up"
        classes="v--modal conversation-modal"
        @before-open="beforeOpen"
        @close="close"
    >
        <reply-form v-if="type === 'reply'" :reply="this.model"></reply-form>
        <thread-form v-else :thread="this.model"></thread-form>
    </modal>
</template>

<script>
import ThreadForm from "./ThreadForm";
import ReplyForm from "./ReplyForm";

export default {
    name: "ConversationModal",
    components: { ReplyForm, ThreadForm },
    data() {
        return {
            type: 'thread',
            model: null
        }
    },
    methods: {
        beforeOpen(event) {
            this.type = event.params.type
            this.model = event.params.model ?? null
        },
        close() {
            let element = document.querySelector(".v--modal-box");
            element.style.transition = "top .4s";
            element.style.top = "100vh";
            setTimeout(e => this.$modal.hide('conversation-modal'), 500)
        },
    }
}
</script>

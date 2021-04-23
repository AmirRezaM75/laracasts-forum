<script>
    import Replies from "../components/Replies";
    import Thread from "../components/Thread";
    import SubscriptionButton from "../components/SubscriptionButton";
    import LockButton from "../components/LockButton";

    export default {
        name: "ThreadView",
        props: ['categories', 'thread'],
        components: { Replies, SubscriptionButton, Thread, LockButton },
        computed: {
            repliesCount() {
                return this.$store.state.replies_count
            },
            isLocked() {
                return this.$store.state.thread['locked']
            }
        },
        methods: {
            showReplyModal() {
                this.$authorize(() => {
                    this.$modal.show('conversation-modal', { type: 'reply' })
                })
            }
        },
        created() {
            this.$store.commit('SET_THREAD', this.thread)
            this.$store.commit('SET_CATEGORIES', this.categories)
        }
    }
</script>

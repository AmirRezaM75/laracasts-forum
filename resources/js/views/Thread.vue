<script>
    import Replies from "../components/Replies";
    import Thread from "../components/Thread";
    import SubscriptionButton from "../components/SubscriptionButton";

    export default {
        name: "ThreadView",
        props: ['categories', 'thread'],
        components: { Replies, SubscriptionButton, Thread },
        computed: {
            repliesCount() {
                return this.$store.state.count
            }
        },
        created() {
            this.$store.commit('SET_THREAD', this.thread)
            this.$store.commit('SET_CATEGORIES', this.categories)
        }
    }
</script>

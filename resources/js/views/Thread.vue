<script>
    import Replies from "../components/Replies";
    import Thread from "../components/Thread";
    import SubscriptionButton from "../components/SubscriptionButton";

    export default {
        computed: {
            repliesCount() {
                return this.$store.state.count
            }
        },
        name: "ThreadView",
        components: { Replies, SubscriptionButton, Thread }
    }
</script>

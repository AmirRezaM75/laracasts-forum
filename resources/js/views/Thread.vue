<script>
    import Replies from "../components/Replies";
    import SubscriptionButton from "../components/SubscriptionButton";

    export default {
        computed: {
            repliesCount() {
                return this.$store.state.count
            }
        },
        name: "Thread",
        components: { Replies, SubscriptionButton }
    }
</script>

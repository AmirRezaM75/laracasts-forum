<script>
    import Replies from "../components/Replies";

    export default {
        computed: {
            repliesCount() {
                return this.$store.state.count
            }
        },
        name: "Thread",
        components: { Replies }
    }
</script>

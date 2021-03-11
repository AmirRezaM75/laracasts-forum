<script>
    import Replies from "../components/Replies";

    export default {
        computed: {
            repliesCount() {
                return this.$store.getters.repliesCount;
            }
        },
        name: "Thread",
        components: { Replies }
    }
</script>

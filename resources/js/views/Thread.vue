<script>
    import Replies from "../components/Replies";

    export default {
        props: ['initialRepliesCount'],
        data() {
            return {
                repliesCount: this.initialRepliesCount
            }
        },
        name: "Thread",
        components: { Replies }
    }
</script>

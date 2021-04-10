<script>
    import ThreadModal from "../components/ThreadModal";

    export default {
        name: "Threads",
        props: ['categories'],
        methods: {
            create() {
                this.$modal.show(
                    ThreadModal,
                    {
                        categories: this.categories
                    },
                    { name: "create-thread", classes: ['v--modal', 'conversation-modal'] }
                );
            }
        },
        mounted() {
            this.$store.commit('SET_CATEGORIES', this.categories)
        }
    }
</script>

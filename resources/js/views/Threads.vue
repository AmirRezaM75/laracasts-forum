<script>
    import ThreadModal from "../components/ThreadModal";
    import ExcerptButtons from "../components/ExcerptButtons";

    export default {
        name: "Threads",
        props: ['categories'],
        components: {
            'excerpt-buttons': ExcerptButtons
        },
        methods: {
            create() {
                this.$modal.show(
                    ThreadModal,
                    {
                        categories: this.categories
                    },
                    { name: "create-thread", classes: ['v--modal', 'conversation-modal'] }
                );
            },
            filter(e) {
                const value = e.target.value
                location.href = '/threads' + (value.charAt(0) === '?' ? '' : '/') + value
            }
        },
        mounted() {
            this.$store.commit('SET_CATEGORIES', this.categories)
        }
    }
</script>

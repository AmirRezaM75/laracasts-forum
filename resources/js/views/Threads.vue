<script>
    import ExcerptButtons from "../components/ExcerptButtons";
    import ThreadFilters from "../components/ThreadFilters";
    import ThreadCategories from "../components/ThreadCategories";

    export default {
        name: "Threads",
        props: ['categories'],
        components: {
            ThreadCategories,
            ExcerptButtons,
            ThreadFilters
        },
        methods: {
            create() {
                this.$authorize(() => {
                    this.$modal.show('conversation-modal', { type: 'thread' });
                })
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

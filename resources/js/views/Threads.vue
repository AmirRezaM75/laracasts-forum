<script>
    import ExcerptButtons from "../components/ExcerptButtons";

    export default {
        name: "Threads",
        props: ['categories'],
        components: {
            'excerpt-buttons': ExcerptButtons
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

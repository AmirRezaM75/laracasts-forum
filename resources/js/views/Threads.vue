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
                if (this.$auth) {
                    this.$modal.show(
                        ThreadModal,
                        { categories: this.categories },
                        {
                            name: "create-thread",
                            shiftY: 1,
                            'pivot-y': 1,
                            width: "800",
                            height: "auto",
                            adaptive: true,
                            'click-to-close': false,
                            transition: "modal-slide-up",
                            classes: ['v--modal', 'conversation-modal']
                        }
                    );
                } else {
                    this.$modal.show('auth-modal', { 'type': 'register' })
                }
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

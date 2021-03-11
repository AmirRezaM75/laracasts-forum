export default {
    computed: {
        $auth() {
            return window.App.user
        }
    },
    methods: {
        authorize(handler) {
            return this.$auth ? handler(this.$auth) : false
        }
    }
}

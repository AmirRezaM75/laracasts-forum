export default {
    computed: {
        $auth() {
            return window.App.user
        }
    },
    methods: {
        $authorize(handler) {
            return this.$auth ? handler(this.$auth) : false
        },
        $owns(model, prop = 'user_id') {
            return model[prop] === this.$auth.id
        }
    }
}

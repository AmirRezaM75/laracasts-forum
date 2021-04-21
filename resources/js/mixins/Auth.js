import User from "../utilities/User";

export default {
    computed: {
        $auth() {
            return new User(this.$store.state.user)
        }
    },
    methods: {
        $authorize(handler) {
            if (! this.$auth.check())
                this.$modal.show('auth-modal', { 'type': 'register' })
            else if (! this.$auth.hasVerifiedEmail())
                this.$auth.confirmEmailAddress()
            else
                handler()
        }
    }
}

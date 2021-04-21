export default {
    computed: {
        $auth() {
            return window.App.user
        }
    },
    methods: {
        $authorize(handler) {
            if (! this.$auth)
                this.$modal.show('auth-modal', { 'type': 'register' })
            else if (! this.$auth.email_verified_at)
                this.confirmEmailAddress()
            else
                handler()
        },
        $owns(model, prop = 'user_id') {
            return model[prop] === this.$auth.id
        },
        confirmEmailAddress() {
            swal({
                title: "One Last Step",
                text: "Please confirm your email address to verify that you're human. Sorry - spammers ruin it for the rest of us, right?",
                buttons: {
                    resend: "Resend Email",
                    close: true
                }
            }).then((function(t) {
                    "resend" === t && (axios.post("/email/verification-notification"),
                        swal("Check Your Email!", "We just fired off your email confirmation again."))
                }
            ))
        }
    }
}

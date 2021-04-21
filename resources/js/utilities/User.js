class User {
    constructor(user) {
        this.user = user
    }

    id() {
        return this.user.id
    }

    hasVerifiedEmail() {
        return this.user.email_verified_at !== null
    }

    check() {
        return this.user !== null
    }

    owns(model, prop = 'user_id') {
        return model[prop] === this.id()
    }

    confirmEmailAddress() {
        swal({
            title: "One Last Step",
            text: "Please confirm your email address to verify that you're human. Sorry - spammers ruin it for the rest of us, right?",
            buttons: {
                resend: "Resend Email",
                close: true
            }
        }).then((function(button) {
            if (button === "resend")
                axios.post("/email/verification-notification")
                    .then( () => swal("Check Your Email!", "We just fired off your email confirmation again."))
                // TODO: show throttle error message
            }
        ))
    }
}

export default User;

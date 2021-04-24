class User {
    constructor(user) {
        this.user = user

        return new Proxy(this, this)
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
        return this.check() ? model[prop] === this.id() : false
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

    get(target, prop) {
        return typeof target[prop] === 'undefined'
            ? target.user[prop]
            : target[prop]
    }

    update(column, value) {
        this.user[column] = value
    }
}

export default User;

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

    /*
    * The set method should return a boolean value.
    * Return true to indicate that assignment succeeded.
    * If the set method returns false, and the assignment happened in strict-mode code, a TypeError will be thrown."
    */
    set(target, prop, value) {
        if (target.user.hasOwnProperty(prop))
            target.user[prop] = value

        return true;
    }
}

export default User;

import Errors from '../utilities/Errors'

export default {
    data() {
        return {
            errors: new Errors()
        }
    },
    methods: {
        handler(error, flashMessage = true) {

            // TODO: any better single word method name?
            // TODO: Support for showing multiple flash messages
            let data = error.response.data
            if (data.hasOwnProperty('errors')) {

                this.errors.save(data['errors'])

                if (flashMessage)
                    Object.keys(data['errors']).forEach(function (key) {
                        flash(data['errors'][key][0], 'danger')
                    })
            }
            else {
                flash(data.message, 'danger')
            }
        }
    }
}

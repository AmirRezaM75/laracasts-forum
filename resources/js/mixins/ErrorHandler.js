export default {
    methods: {
        handler(error) {
            // TODO: any better single word method name?
            // TODO: Support for showing multiple flash messages
            let data = error.response.data
            if (data.hasOwnProperty('errors')) {
                Object.keys(data['errors']).forEach(function (key) {
                    flash(data['errors'][key][0], 'danger')
                })
            } else {
                flash(data.message, 'danger')
            }
        }
    }
}

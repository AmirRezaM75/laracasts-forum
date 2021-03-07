<template>
    <div class="notification is-primary" :class="{ 'for-user': show }">
        <a href="#"
           class="notification-body inherits-color"
           target="_blank"
           rel="noreferrer noopener">{{ text }}</a>
    </div>
</template>

<script>
    export default {
        props: ['message'],
        data() {
            return {
                text: '',
                show: false
            }
        },
        created() {
            if (this.message)
                this.flash(this.message);

            window.events.$on('flash', message => this.flash(message))
        },
        methods: {
            flash(message) {
                this.show = true
                this.text = message
                this.hide()
            },
            hide() {
                setTimeout(() => {
                    this.show = false
                }, 5000)
            }
        }
    }
</script>

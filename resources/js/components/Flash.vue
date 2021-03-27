<template>
    <div v-if="show" class="notification" :class="[{ 'for-user': show }, 'is-' + level]">
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
                level: 'primary',
                show: false
            }
        },
        created() {
            if (this.message)
                this.flash({
                    message: this.message,
                    level: 'info'
                });

            window.events.$on('flash', data => this.flash(data))
        },
        methods: {
            flash(data) {
                this.show = true
                this.text = data.message
                this.level = data.level
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

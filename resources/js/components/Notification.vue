<template>
    <div class="overflow-y-auto pb-6">
        <template v-if="notifications.length">
            <a v-for="notification in notifications"
               :href="notification.data.link"
               @click="markAsRead(notification.id)"
               class="block text-sm py-4 px-6 text-black hover:text-black hover:bg-grey-panel rounded-xl">
                <strong class="block text-grey-dark font-bold text-2xs mb-1">
                    {{ notification.created_at | diffForHumans }}
                </strong>
                <span class="text-blue" v-text="'@' + notification.data.username"></span>
                <span v-text="notification.data.message"></span>
                <cite>"{{ notification.data.title }}"</cite>
            </a>
            <div class="pt-8 px-4 text-center">
                <button type="submit" class="btn mx-auto text-black border-grey border-solid border">Clear All</button>
            </div>
        </template>
        <p v-else class="text-center">You have no notifications at this time.</p>
    </div>
</template>

<script>
export default {
    name: "Notification",
    data() {
        return {
            notifications: []
        }
    },
    methods: {
        markAsRead(notificationId) {
            axios.delete('/users/notifications/' + notificationId)
        }
    },
    mounted() {
        if (! this.$auth.check()) return

        axios.get('/users/notifications').then(response => {
            this.notifications = response.data
        })
    }
}
</script>

<template>
    <div class="mb-10">
        <div v-if="subscriptions.length">
            <h2 class="text-black text-xl font-semibold md:mr-2 mb-6 mb-6">
                Forum Notifications
            </h2>
            <ul class="ml-6">
                <li v-for="(subscription, index) in subscriptions"
                    :key="index"
                    class="flex items-center font-semibold mb-5"
                >
                    <button @click="unsubscribe(subscription.id, index)"
                            class="text-lg text-black hover:text-blue font-bold mr-6">×</button>
                    <a :href="threadPath(subscription)" class="flex-1 link" v-text="subscription.title"></a>
                </li>
            </ul>

            <button @click="unsubscribeAll" class="btn btn-blue text-2xs py-25 px-4 mt-8">
                Don't Send Any Notifications
            </button>
        </div>
        <div v-else class="user-content">
            <blockquote class="p-4 rounded-xl text-sm">
                <strong class="text-black font-bold inline-block">Tip:</strong>
                Visit any forum thread, and press the "Follow" button in the sidebar.
                Once clicked, you'll receive an email each time a reply is posted. The same goes for all video
                courses: click "Subscribe to Series," and we'll shoot you an email each time we publish a new
                lesson in that series.
            </blockquote>
        </div>
    </div>
</template>

<script>
export default {
    name: "ProfileSubscriptions",
    props: ['data'],
    data() {
        return {
            subscriptions: this.data
        }
    },
    methods: {
        unsubscribe(threadId, index) {
            axios.delete(`/threads/${threadId}/subscriptions`)
                .then(response => {
                    if (response.status === 204) {
                        this.subscriptions.splice(index, 1)
                        flash('Unsubscribed.')
                    }
                })
        },
        unsubscribeAll() {
            swal({
                title: "Are you sure?",
                text: "This will remove all email notifications for your account.",
                buttons: ["Cancel", "Delete"],
                dangerMode: true
            }).then( t => {
                t && axios.delete('/profile/subscriptions')
                    .then( () => {
                        this.subscriptions = []
                        swal.close()
                        flash('Unsubscribed.')
                    })
            })
        },
        threadPath(thread) {
            return '/threads/' + thread.category.slug + '/' + thread.id
        }
    }

}
</script>

<style scoped>

</style>

<template>
    <div v-show="notifications.length" @keydown.escape="open = false"
         class="relative inline-block text-left">
        <div>
            <button
                @click="open = !open"
                type="button"
                aria-haspopup="true"
                :aria-expanded="open"
                class="leading-none inline-flex mr-4 leading-none bg-transparent-10 hover:bg-transparent-25 p-3 rounded-xl focus:outline-none">
                <svg viewBox="0 0 16 16" width="16" height="16" aria-hidden="true" class="text-white">
                    <path class="fill-current" d="M8 16a2 2 0 001.985-1.75c.017-.137-.097-.25-.235-.25h-3.5c-.138 0-.252.113-.235.25A2 2 0 008 16z"></path>
                    <path class="fill-current" fill-rule="evenodd" d="M8 1.5A3.5 3.5 0 004.5 5v2.947c0 .346-.102.683-.294.97l-1.703 2.556a.018.018 0 00-.003.01l.001.006c0 .002.002.004.004.006a.017.017 0 00.006.004l.007.001h10.964l.007-.001a.016.016 0 00.006-.004.016.016 0 00.004-.006l.001-.007a.017.017 0 00-.003-.01l-1.703-2.554a1.75 1.75 0 01-.294-.97V5A3.5 3.5 0 008 1.5zM3 5a5 5 0 0110 0v2.947c0 .05.015.098.042.139l1.703 2.555A1.518 1.518 0 0113.482 13H2.518a1.518 1.518 0 01-1.263-2.36l1.703-2.554A.25.25 0 003 7.947V5z"></path>
                </svg>
            </button>
        </div>

        <transition name="fadeStart">
            <div
                class="tooltip"
                v-show="open"
                role="menu"
                aria-orientation="vertical"
            >
                <div class="tooltip-heading">
                    <h6 class="heading-title">Notifications</h6>
                    <a class="heading-link" href="#">Ignore All</a>
                </div>
                <ul class="notification-list">
                    <a v-for="(notification, index) in notifications"
                       :key="index"
                       :href="notification.data.link"
                       @click="markAsRead(notification.id, index)"
                       role="menuitem"
                    >
                        <li class="notification-item">
                            <div class="notification-image">
                                <img alt="User Photo" src="/images/avatars/default-avatar-1.png">
                            </div>
                            <div>
                                <p class="text-grey-darkest" v-text="notification.data.message"></p>
                                <p class="text-grey-40">1 hour ago</p>
                            </div>
                        </li>
                    </a>
                </ul>
            </div>
        </transition>
    </div>
</template>

<script>
export default {
    name: "Notification",
    data() {
        return {
            open: false,
            notifications: []
        }
    },
    methods: {
        markAsRead(notificationId, notificationIndex) {
            this.notifications.splice(notificationIndex, 1)
            axios.delete('/users/notifications/' + notificationId)
        }
    },
    mounted() {
        if (! this.$auth) return

        axios.get('/users/notifications').then(response => {
            this.notifications = response.data
        })
    }
}
</script>

<style scoped>

.tooltip {
    position: absolute;
    top: 3.25rem;
    right: 0;
    line-height: 1.5;
    color: #27303d;
    width: 20rem;
    background: #fff;
    border-radius: 5px;
    -webkit-box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.1);
    box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.1);
}

.tooltip::before {
    content: "";
    position: absolute;
    top: -0.4rem;
    right: 1.2rem;
    border-left: 1rem solid transparent;
    border-right: 1rem solid transparent;
    border-bottom: .75rem solid #fff;
}

.tooltip-heading {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: start;
    -ms-flex-align: start;
    align-items: flex-start;
    padding: 0.5rem 1rem;
    border-bottom: 0.01rem solid #eee;
    -webkit-justify-content: space-between;
    justify-content: space-between;
}

.notification-list > a {
    padding: 0.5rem 1rem;
    display: inline-block;
}

.notification-list > a:hover {
    background-color: rgba(0,0,0,.03);
}

.notification-item {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    padding: 0.65rem 0;
}

.notification-image {
    margin-right: 1rem;
}

.notification-image img {
    vertical-align: middle;
    width: 4rem;
    border-radius: 50%;
    max-width: 100%;
}

.fadeStart-enter-active {
    -webkit-animation: fadeStart 0.2s both ease-in-out;
    animation: fadeStart 0.2s both ease-in-out;
}

.fadeStart-leave-active {
    -webkit-animation: fadeEnd 0.2s both ease-in-out;
    animation: fadeEnd 0.2s both ease-in-out;
}

@-webkit-keyframes fadeStart {
    0% {
        opacity: 0;
        -webkit-transform: translate3d(0, 5px, 0);
        transform: translate3d(0, 5px, 0);
    }
    to {
        opacity: 1;
        -webkit-transform: translateZ(0);
        transform: translateZ(0);
        display: block;
    }
}

@keyframes fadeStart {
    0% {
        opacity: 0;
        -webkit-transform: translate3d(0, 5px, 0);
        transform: translate3d(0, 5px, 0);
    }
    to {
        opacity: 1;
        -webkit-transform: translateZ(0);
        transform: translateZ(0);
        display: block;
    }
}

@-webkit-keyframes fadeEnd {
    0% {
        opacity: 1;
        -webkit-transform: translateZ(0);
        transform: translateZ(0);
    }
    to {
        opacity: 0;
        -webkit-transform: translate3d(0, 5px, 0);
        transform: translate3d(0, 5px, 0);
    }
}

@keyframes fadeEnd {
    0% {
        opacity: 1;
        -webkit-transform: translateZ(0);
        transform: translateZ(0);
    }
    to {
        opacity: 0;
        -webkit-transform: translate3d(0, 5px, 0);
        transform: translate3d(0, 5px, 0);
    }
}
</style>

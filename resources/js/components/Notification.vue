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
                <svg width="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 611.999 611.999" class="text-white">
                    <path class="fill-current" d="M570.107 500.254c-65.037-29.371-67.511-155.441-67.559-158.622v-84.578c0-81.402-49.742-151.399-120.427-181.203C381.969 34 347.883 0 306.001 0c-41.883 0-75.968 34.002-76.121 75.849-70.682 29.804-120.425 99.801-120.425 181.203v84.578c-.046 3.181-2.522 129.251-67.561 158.622a17.257 17.257 0 007.103 32.986h164.88c3.38 18.594 12.172 35.892 25.619 49.903 17.86 18.608 41.479 28.856 66.502 28.856 25.025 0 48.644-10.248 66.502-28.856 13.449-14.012 22.241-31.311 25.619-49.903h164.88a17.26 17.26 0 0016.872-13.626 17.25 17.25 0 00-9.764-19.358zm-85.673-60.395c6.837 20.728 16.518 41.544 30.246 58.866H97.32c13.726-17.32 23.407-38.135 30.244-58.866h356.87zM306.001 34.515c18.945 0 34.963 12.73 39.975 30.082-12.912-2.678-26.282-4.09-39.975-4.09s-27.063 1.411-39.975 4.09c5.013-17.351 21.031-30.082 39.975-30.082zM143.97 341.736v-84.685c0-89.343 72.686-162.029 162.031-162.029s162.031 72.686 162.031 162.029v84.826c.023 2.596.427 29.879 7.303 63.465H136.663c6.88-33.618 7.286-60.949 7.307-63.606zm162.031 235.749c-26.341 0-49.33-18.992-56.709-44.246h113.416c-7.379 25.254-30.364 44.246-56.707 44.246z"/>
                    <path class="fill-current" d="M306.001 119.235c-74.25 0-134.657 60.405-134.657 134.654 0 9.531 7.727 17.258 17.258 17.258 9.531 0 17.258-7.727 17.258-17.258 0-55.217 44.923-100.139 100.142-100.139 9.531 0 17.258-7.727 17.258-17.258-.001-9.532-7.728-17.257-17.259-17.257z"/>
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

.notification-list {
    list-style-type: none;
    margin: 0 0 0.5rem;
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

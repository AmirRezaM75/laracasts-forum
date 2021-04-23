<template>
    <modal
        name="auth-modal"
        width="95%"
        height="95%"
        :maxWidth="1200"
        :maxHeight="800"
        :adpative="true"
        :scrollable="true"
        classes="rounded-none shadow-inner bg-white border-t-3 rounded-2xl max-h-screen"
        transition="modal-slide-up"
        @before-open="beforeOpen"
        @opened="opened"
        @toggle-form="toggle"
    >
        <section class="px-0 lg:px-4 shadow-inner h-full">
            <button
                @click="$modal.hide('auth-modal')"
                class="bg-grey-panel px-2 py-1 md:px-4 md:py-3 rounded-xl absolute z-10 right-0 pin-0 text-grey-darkest hover:text-blue"
                    style="transform: translate(-50%, 0px);">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" viewBox="0 0 12 16" class="fill-current">
                    <path d="M7.48 8l3.75 3.75-1.48 1.48L6 9.48l-3.75 3.75-1.48-1.48L4.52 8 .77 4.25l1.48-1.48L6 6.52l3.75-3.75 1.48 1.48z"></path>
                </svg>
            </button>

            <transition name="slide" mode="out-in">
                <register-form v-if="type === 'register'"></register-form>
                <login-form v-else></login-form>
            </transition>
        </section>
    </modal>
</template>

<script>
import LoginForm from "./LoginForm";
import RegisterForm from "./RegisterForm";

export default {
    name: "AuthModal",
    components: {
      LoginForm,
      RegisterForm
    },
    data() {
        return {
            type: 'register'
        }
    },
    methods: {
        beforeOpen(event) {
            this.type = event.params.type
        },
        opened() {
            this.$el.querySelector(".v--modal-box input:first-child").focus()
        },
        toggle() {
            this.type = this.type === 'register' ? 'login' : 'register'
        }
    }
}
</script>

<style scoped>
.slide-enter-active {
    animation: slideInLeft .5s;
}
.slide-leave-active {
    animation: slideInLeft .5s reverse;
}

@-webkit-keyframes slideInLeft {
    0% {
        -webkit-transform: translate3d(-100%, 0, 0);
        transform: translate3d(-100%, 0, 0);
        visibility: visible
    }

    to {
        -webkit-transform: translateZ(0);
        transform: translateZ(0)
    }
}

@keyframes slideInLeft {
    0% {
        -webkit-transform: translate3d(-100%, 0, 0);
        transform: translate3d(-100%, 0, 0);
        visibility: visible
    }

    to {
        -webkit-transform: translateZ(0);
        transform: translateZ(0)
    }
}
</style>

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
        @before-open="initializer"
        @toggle-form="toggle"
    >
        <section class="px-0 lg:px-4 shadow-inner h-full">
            <button class="bg-grey-panel px-2 py-1 md:px-4 md:py-3 rounded-xl absolute z-10 right-0 pin-0 text-grey-darkest hover:text-blue"
                    style="transform: translate(-50%, 0px);">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" viewBox="0 0 12 16" class="fill-current">
                    <path d="M7.48 8l3.75 3.75-1.48 1.48L6 9.48l-3.75 3.75-1.48-1.48L4.52 8 .77 4.25l1.48-1.48L6 6.52l3.75-3.75 1.48 1.48z"></path>
                </svg>
            </button>

            <transition name="fade">
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
        initializer(event) {
            this.type = event.params.type
        },
        toggle() {
            this.type = this.type === 'register' ? 'login' : 'register'
        }
    }
}
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity .5s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>

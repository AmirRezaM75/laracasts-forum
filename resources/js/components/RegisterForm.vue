<template>
    <div class="flex flex-col justify-between px-4 h-full overflow-y-auto">
        <div class="h-full flex items-center">
            <div class="container mx-auto w-full">
                <header class="flex text-center items-center justify-center">
                    <h1 class="text-3xl font-light tracking-tight text-black">
                        Sign Up!
                    </h1>
                </header>
                <div class="md:w-2/3 lg:w-1/3 md:mx-auto mt-8">
                    <form role="form"
                          method="POST"
                          @submit.prevent="register"
                          @keydown="errors.clear($event.target.id)"
                          spellcheck="false"
                    >
                        <div class="control max-w-sm mx-auto">
                            <label for="username" class="block font-bold text-2xs text-grey-dark">Username</label>
                            <div class="flex items-center relative borderd border-solid border-b border-grey-light">
                                <input type="text"
                                       id="username"
                                       v-model="username"
                                       autocomplete="username"
                                       placeholder="Enter Username"
                                       required
                                       class="text-black input is-minimal text-sm"
                                       style="border: none;"
                                >
                                <div class="w-4 h-4 rounded-full p-1 mx-auto flex justify-center items-center ml-4"
                                    :class="errors.has('username') || ! username ? 'bg-grey' : 'bg-blue'">
                                    <svg width="10" height="8" viewBox="0 0 10 8">
                                        <path fill="#FFF" fill-rule="evenodd" stroke="#FFF" stroke-width=".728"
                                              d="M3.533 5.646l-2.199-2.19c-.195-.194-.488-.194-.684 0-.195.195-.195.487 0 .682l2.883 2.87L9.055 1.51c.195-.194.195-.487 0-.681-.196-.195-.49-.195-.685 0L3.533 5.646z"></path>
                                    </svg>
                                </div>
                            </div>
                            <p v-show="errors.has('username')" class="text-red text-xs mt-2" v-text="errors.get('username')"></p>
                        </div>
                        <div class="control max-w-sm mx-auto">
                            <label for="email" class="block font-bold text-2xs text-grey-dark">Email</label>
                            <div class="flex items-center relative borderd border-solid border-b border-grey-light">
                                <input type="email"
                                       id="email"
                                       v-model="email"
                                       autocomplete="email"
                                       placeholder="Enter Email"
                                       required
                                       class="text-black input is-minimal text-sm"
                                       style="border: none;">
                                <div class="w-4 h-4 rounded-full p-1 mx-auto flex justify-center items-center ml-4"
                                    :class="errors.has('email') || ! email ? 'bg-grey' : 'bg-blue'">
                                    <svg width="10" height="8" viewBox="0 0 10 8">
                                        <path fill="#FFF" fill-rule="evenodd" stroke="#FFF" stroke-width=".728"
                                              d="M3.533 5.646l-2.199-2.19c-.195-.194-.488-.194-.684 0-.195.195-.195.487 0 .682l2.883 2.87L9.055 1.51c.195-.194.195-.487 0-.681-.196-.195-.49-.195-.685 0L3.533 5.646z"></path>
                                    </svg>
                                </div>
                            </div>
                            <p v-show="errors.has('email')" class="text-red text-xs mt-2" v-text="errors.get('email')"></p>
                        </div>
                        <div class="control max-w-sm mx-auto">
                            <label for="password" class="block font-bold text-2xs text-grey-dark">Password</label>
                            <div class="flex items-center relative borderd border-solid border-b border-grey-light">
                                <input :type="privateMode ? 'password' : 'text'"
                                       id="password"
                                       v-model="password"
                                       autocomplete="new-password"
                                       placeholder="Enter Password"
                                       required
                                       class="text-black input is-minimal text-sm"
                                       style="border: none;">
                                <button type="button"
                                        @click="privateMode = ! privateMode"
                                        title="Toggle private mode"
                                        class="ml-4 text-2xs font-bold text-grey"
                                        v-text="privateMode ? 'Show' : 'Hide'"
                                ></button>
                                <div class="w-4 h-4 rounded-full p-1 mx-auto flex justify-center items-center ml-4"
                                    :class="errors.has('password') || ! password ? 'bg-grey' : 'bg-blue'">
                                    <svg width="10" height="8" viewBox="0 0 10 8">
                                        <path fill="#FFF" fill-rule="evenodd" stroke="#FFF" stroke-width=".728"
                                              d="M3.533 5.646l-2.199-2.19c-.195-.194-.488-.194-.684 0-.195.195-.195.487 0 .682l2.883 2.87L9.055 1.51c.195-.194.195-.487 0-.681-.196-.195-.49-.195-.685 0L3.533 5.646z"></path>
                                    </svg>
                                </div>
                            </div>
                            <p v-show="errors.has('password')" class="text-red text-xs mt-2" v-text="errors.get('password')"></p>
                        </div>
                        <div class="control text-center mt-10">
                            <button type="submit"
                                    :disabled="loader"
                                    class="btn btn-blue w-full md:max-w-2/3 mx-auto flex items-center justify-center">
                                <loader v-show="loader"></loader>
                                Create Account
                            </button>
                            <a class="block mt-4 text-sm hover:underline"
                               @click.prevent="$parent.$emit('toggle-form')">
                                Already Have an Account?
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="relative text-center border-t border-solid border-transparent-10">
            <div class="lg:flex lg:justify-center lg:items-center"></div>
        </div>
    </div>
</template>

<script>
import ErrorHandler from "../mixins/ErrorHandler";

export default {
    name: "RegisterForm",
    mixins: [ErrorHandler],
    data() {
        return {
            email: '',
            password: '',
            username: '',
            privateMode: true,
            loader: false
        }
    },
    methods: {
        register() {
            this.loader = true
            axios.post('/register', {
                email: this.email,
                password: this.password,
                username: this.username
            }).then(response => {
                if (response.status === 204)
                    location.reload()
            }).catch(error => {
                this.loader = false
                this.handler(error, false)
            })
        }
    }
}
</script>

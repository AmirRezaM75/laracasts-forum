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
                    <form role="form" method="POST" @submit.prevent="register">
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
                                       style="border: none;">
                                <div class="w-4 h-4 rounded-full p-1 mx-auto flex justify-center items-center ml-4 bg-grey">
                                    <svg width="10" height="8" viewBox="0 0 10 8">
                                        <path fill="#FFF" fill-rule="evenodd" stroke="#FFF" stroke-width=".728"
                                              d="M3.533 5.646l-2.199-2.19c-.195-.194-.488-.194-.684 0-.195.195-.195.487 0 .682l2.883 2.87L9.055 1.51c.195-.194.195-.487 0-.681-.196-.195-.49-.195-.685 0L3.533 5.646z"></path>
                                    </svg>
                                </div>
                            </div>
<!--                            <p v-show="errors.has('username')" class="tw-text-red tw-text-xs tw-mt-2" v-text="errors.get('username')"></p>-->
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
                                <div class="w-4 h-4 rounded-full p-1 mx-auto flex justify-center items-center ml-4 bg-grey">
                                    <svg width="10" height="8" viewBox="0 0 10 8">
                                        <path fill="#FFF" fill-rule="evenodd" stroke="#FFF" stroke-width=".728"
                                              d="M3.533 5.646l-2.199-2.19c-.195-.194-.488-.194-.684 0-.195.195-.195.487 0 .682l2.883 2.87L9.055 1.51c.195-.194.195-.487 0-.681-.196-.195-.49-.195-.685 0L3.533 5.646z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="control max-w-sm mx-auto">
                            <label for="password" class="block font-bold text-2xs text-grey-dark">Password</label>
                            <div class="flex items-center relative borderd border-solid border-b border-grey-light">
                                <input type="password"
                                       id="password"
                                       v-model="password"
                                       autocomplete="new-password"
                                       placeholder="Enter Password"
                                       required="required"
                                       class="text-black input is-minimal text-sm"
                                       style="border: none;">
                                <button type="button"
                                        title="Toggle private mode"
                                        class="ml-4 text-2xs font-bold text-grey">
                                    Show
                                </button>
                                <div class="w-4 h-4 rounded-full p-1 mx-auto flex justify-center items-center ml-4 bg-grey">
                                    <svg width="10" height="8" viewBox="0 0 10 8">
                                        <path fill="#FFF" fill-rule="evenodd" stroke="#FFF" stroke-width=".728"
                                              d="M3.533 5.646l-2.199-2.19c-.195-.194-.488-.194-.684 0-.195.195-.195.487 0 .682l2.883 2.87L9.055 1.51c.195-.194.195-.487 0-.681-.196-.195-.49-.195-.685 0L3.533 5.646z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="control text-center mt-10">
                            <button type="submit" class="btn btn-blue w-full md:max-w-2/3 mx-auto">Create Account</button>
                            <a class="block mt-4 text-grey-darkest text-sm hover:underline"
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
export default {
    name: "RegisterForm",
    data() {
        return {
            email: '',
            password: '',
            username: ''
        }
    },
    methods: {
        register() {
            axios.post('register', {
                email: this.email,
                password: this.password,
                username: this.username
            }).then(response => {
                if (response.status === 204)
                    location.reload()
            }).catch(error => {
                console.log(error)
            })
        }
    }
}
</script>

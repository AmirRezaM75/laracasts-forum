<template>
    <form @submit.prevent="submit">
        <div class="flex items-center mb-6">
            <h2 class="text-black text-xl font-semibold md:mr-2">Update Your Account</h2>
        </div>
        <div class="control">
            <label for="username" class="block text-grey-40 font-semibold text-xs">Username:</label>
            <input id="username"
                   name="username"
                   v-model="username"
                   class="input h-8 is-minimal text-sm"
                   required
            >
        </div>
        <div class="control">
            <label for="email" class="block text-grey-40 font-semibold text-xs">Email:</label>
            <input id="email"
                   name="email"
                   v-model="email"
                   autocomplete="username"
                   class="input h-8 is-minimal text-sm"
                   required
            >
        </div>
        <div class="control">
            <label for="password" class="block text-grey-40 font-semibold text-xs">Password:</label>
            <input id="password"
                   name="password"
                   v-model="password"
                   type="password"
                   placeholder="****"
                   autocomplete="new-password"
                   class="input h-8 is-minimal text-sm"
            >
        </div>
        <div class="control">
            <div class="bg-black-transparent-1 border border-solid border-black-transparent-3 rounded-xl px-4 py-2 control flex justify-between items-center label text-grey-40 font-semibold text-xs">
                <span class="mr-4">Profile is Private</span>
                <label for="private" class="switch">
                    <input type="checkbox" id="private" v-model="private">
                    <div class="slider round"></div>
                </label>
            </div>
        </div>
        <div class="control mt-6">
            <button type="submit" class="btn btn-blue w-full md:w-auto mx-auto">Update Account</button>
        </div>
    </form>
</template>

<script>
import ErrorHandler from "../mixins/ErrorHandler";

export default {
    name: "UserAccountForm",
    mixins: [ErrorHandler],
    props: {
        user: {
            required: true,
            type: Object
        }
    },
    data() {
        return {
            email: this.user.email,
            username: this.user.username,
            private: this.user.private,
            password: null
        }
    },
    methods: {
        submit() {
            let data = {
                'username': this.username,
                'private': this.private,
                'email': this.email
            }

            if (this.password)
                data['password'] = this.password

            axios.patch('/profile', data)
                .then(response => {
                    flash('Your account has been updated.')
                })
                .catch(error => {
                    this.handler(error)
                })
        }
    }
}
</script>

<template>
    <div>
        <h2 class="text-black text-xl font-semibold md:mr-2 mb-6">Update Your Profile</h2>
        <form @submit.prevent="submit">
            <div class="control">
                <label for="profile.website" class="block text-grey-40 font-semibold text-xs">Personal Website:</label>
                <input id="profile.website"
                       name="profile.website"
                       v-model="profile.website"
                       placeholder="http://example.com"
                       class="input h-8 is-minimal text-sm"
                >
            </div>
            <div class="control">
                <label for="profile.twitter" class="block text-grey-40 font-semibold text-xs">Twitter Username:</label>
                <input id="profile.twitter"
                       name="profile.twitter"
                       v-model="profile.twitter"
                       placeholder="johndoe"
                       class="input h-8 is-minimal text-sm"
                >
            </div>
            <div class="control">
                <label for="profile.github" class="block text-grey-40 font-semibold text-xs">GitHub Username:</label>
                <input id="profile.github"
                       name="profile.github"
                       v-model="profile.github"
                       placeholder="johndoe"
                       class="input h-8 is-minimal text-sm"
                >
            </div>
            <div class="control">
                <label for="profile.employment" class="block text-grey-40 font-semibold text-xs">Place of Employment:</label>
                <input id="profile.employment"
                       name="profile.employment"
                       v-model="profile.employment"
                       placeholder="Acme Inc."
                       class="input h-8 is-minimal text-sm"
                >
            </div>
            <div class="control">
                <label for="profile.job" class="block text-grey-40 font-semibold text-xs">Job Title:</label>
                <input id="profile.job"
                       name="profile.job"
                       v-model="profile.job"
                       placeholder="Developer"
                       class="input h-8 is-minimal text-sm"
                >
            </div>
            <div class="control">
                <label for="profile.location" class="block text-grey-40 font-semibold text-xs">Hometown:</label>
                <input id="profile.location"
                       name="profile.location"
                       v-model="profile.location"
                       placeholder="New York"
                       class="input h-8 is-minimal text-sm">
            </div>
            <div class="control">
                <button type="submit" class="btn btn-blue w-full md:w-auto mx-auto">Update Profile</button>
            </div>
        </form>
    </div>
</template>

<script>
import ErrorHandler from "../mixins/ErrorHandler";

export default {
    name: "UserProfileForm",
    mixins: [ErrorHandler],
    data() {
        return {
            profile: {
                job: '',
                github: '',
                twitter: '',
                website: '',
                location: '',
                employment: ''
            }
        }
    },
    methods: {
        submit() {
            axios.patch('/profile/account', {
                profile: this.$data.profile
            }).then(response => {
                flash('Your profile has been updated.')
            }).catch(error => {
                this.handler(error)
            })
        }
    },
    created() {
        const profile = this.$auth.profile
        if (profile) {
            Object.keys(profile).forEach(item => {
                this.profile[item] = profile[item]
            });
        }
    }
}
</script>

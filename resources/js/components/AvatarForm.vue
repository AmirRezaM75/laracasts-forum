<template>
    <div v-if="$auth.owns(user, 'id')" class="flex items-center mt-4">
        <form enctype="multipart/form-data">
            <label for="avatar"
                   class="btn btn-outlined bg-transparent text-white border-transparent-25 px-5 py-25 mr-4 text-3xs">
                Edit Avatar
            </label>
            <input type="file" id="avatar" class="hidden" accept="image/*" @change="change">
        </form>
    </div>
</template>

<script>
export default {
    name: "AvatarForm",
    props: ['user'],
    methods: {
        change(event) {
            if (! event.target.files.length) return;

            let file = event.target.files[0]

            let reader = new FileReader()

            reader.readAsDataURL(file)

            reader.onload = e => {
                this.$auth.avatar = e.target.result
            }

            let data = new FormData

            data.append('avatar', file)

            axios.post('/users/' + this.$auth.id() + '/avatar', data)
                .then( res => flash('Avatar has been updated'))
        }
    }
}
</script>

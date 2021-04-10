<template>
    <div @click="toggle" class="dropdown relative" :class="styles">
        <div aria-haspopup="true" class="dropdown-toggle h-full">
            <button
                class="transition-all border border-solid border-black-transparent-3 hover:border-black-transparent-10 bg-black-transparent-2 hover:bg-black-transparent-3 font-semibold inline-flex items-center px-3 md:text-xs mobile:text-sm mobile:p-2 mobile:flex mobile:items-center h-full text-black-transparent-50 font-bold hover:text-blue text-sm"
                style="border-radius: 12px;"
            >
                <span class="relative" style="top: -3px;">...</span>
            </button>
        </div>
        <div
            :class="[status ? '' : 'hidden', align === 'right' ? 'right-0' : 'left-0']"
            class="dropdown-menu absolute z-10 py-2 rounded-lg shadow mt-2 is-light"
            style="width: 200px;">
            <slot></slot>
        </div>
    </div>
</template>

<script>
export default {
    name: "ConversationDropdown",
    props: {
        styles: String,
        align: {
            type: String,
            default: 'left'
        }
    },
    data() {
        return {
            status: false
        }
    },
    methods: {
        toggle() {
            this.status = ! this.status
        }
    }
}
</script>

<style scoped>

</style>

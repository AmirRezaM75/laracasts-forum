<template>
    <div class="flex items-center md:px-4">
        <button
            @click="toggle"
            class="forum-excerpt-toggle"
            :disabled="! excerpt"
            :class="{ 'is-active': ! excerpt }"
        >
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" class="mx-2">
                <g fill="#78909C" fill-rule="evenodd" class="forum-excerpt-toggle-lines">
                    <rect width="15" height="6" rx="2" class="forum-excerpt-toggle-line"></rect>
                    <rect width="15" height="6" y="9" rx="2" class="forum-excerpt-toggle-line"></rect>
                </g>
            </svg>
        </button>
        <button
            @click="toggle"
            class="forum-excerpt-toggle"
            :disabled="excerpt"
            :class="{ 'is-active': excerpt }"
        >
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" class="mx-2">
                <g fill="#78909C" fill-rule="evenodd" class="forum-excerpt-toggle-lines">
                    <rect width="15" height="4" rx="2" class="forum-excerpt-toggle-line"></rect>
                    <rect width="8" height="4" y="11" rx="2" class="forum-excerpt-toggle-line"></rect>
                    <rect width="15" height="4" y="5.5" rx="2" class="forum-excerpt-toggle-line"></rect>
                </g>
            </svg>
        </button>
    </div>
</template>

<script>
export default {
    name: "ExcerptButtons",
    data() {
        return {
            excerpt: true
        }
    },
    methods: {
        toggle() {
            this.excerpt = ! this.excerpt

            document.querySelectorAll(".conversation-list .conversation-list-item").forEach((function(element) {
                return element.classList.toggle("without-excerpt")
            }))

            /* TODO: Persist this setting to database */
        }
    }
}
</script>

<style scoped>

</style>

<template>
    <div class="select-wrap">
        <select
            @change="filter"
            class="text-grey-darker text-sm bg-grey-panel rounded-full px-5 py-3 flex items-center cursor-pointer leading-none"
            :style="{ width: selectWidth }">
            <option v-for="item in items"
                    :value="item['query']"
                    :selected="item['isActive']"
                    v-text="item['name']"
            >
            </option>
        </select>
        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="16" viewBox="0 0 10 16" class="fill-current text-grey-dark">
            <path d="M5 11L0 6l1.5-1.5L5 8.25 8.5 4.5 10 6z"></path>
        </svg>
    </div>
</template>

<script>
export default {
    name: "ThreadFilters",
    props: ['items'],
    data() {
        return {
            selectWidth: 'auto'
        }
    },
    methods: {
        filter(e) {
            this.setSelectWidth()
            location.href = '/threads' + e.target.value
        },
        setSelectWidth() {
            let text = this.$el.querySelector("select option:checked").innerText
            this.selectWidth = Math.round(text.length * 9) + 70 + "px"
        }
    },
    mounted() {
        this.setSelectWidth()
    }

}
</script>

<style scoped>

</style>

<template>
    <div class="select-wrap">
        <div class="select-wrap">
            <select
                @change="filter"
                class="text-grey-darker text-sm bg-grey-panel rounded-full px-5 cursor-pointer"
                :style="{ width: selectWidth }"
            >
                <option value="">All</option>
                <option
                    v-for="item in items"
                    :value="item.slug"
                    v-text="item.name"
                    :selected="selected && item.id === selected.id"
                ></option>
            </select>
            <svg xmlns="http://www.w3.org/2000/svg"
                 width="10"
                 height="16"
                 viewBox="0 0 10 16"
                 class="fill-current text-grey-darker">
                <path d="M5 11L0 6l1.5-1.5L5 8.25 8.5 4.5 10 6z"></path>
            </svg>
        </div>
    </div>
</template>

<script>
export default {
    name: "ThreadCategories",
    props: ['items', 'selected'],
    data() {
        return {
            selectWidth: 'auto'
        }
    },
    methods: {
        filter(e) {
            this.setSelectWidth()
            location.href = '/threads/' + e.target.value
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

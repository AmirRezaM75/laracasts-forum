<template>
    <nav v-if="hasPages" role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
        <span v-if="onFirstPage" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
            &laquo; Previous
        </span>
        <a v-else
           :href="previousPageUrl"
           @click.prevent="previous"
           rel="prev"
           class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
            &laquo; Previous
        </a>

        <a v-if="hasMorePages"
           :href="nextPageUrl"
           @click.prevent="next"
           rel="next"
           class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
            More &raquo;
        </a>
        <span v-else class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
            More &raquo;
        </span>
    </nav>
</template>

<script>
export default {
    name: "Paginator",
    props: ['data'],
    data() {
        return {
            page: 1,
            previousPageUrl: '',
            nextPageUrl: ''
        }
    },
    watch: {
        data() {
            this.previousPageUrl = this.data.prev_page_url,
            this.nextPageUrl = this.data.next_page_url,
            this.page = this.data.current_page
        }
    },
    computed: {
        onFirstPage() {
            return this.page === 1
        },
        hasPages() {
            return this.previousPageUrl !== null || this.nextPageUrl !== null
        },
        hasMorePages() {
            return this.nextPageUrl !== null
        }
    },
    methods: {
        broadcast() {
            return this.$emit('changed', this.page)
        },
        updateURL() {
          history.pushState(null, null, '?page=' + this.page)
        },
        next() {
            this.page++
            this.broadcast().updateURL()
        },
        previous() {
            this.page--
            this.broadcast().updateURL()
        }
    }
}
</script>

<template>
    <div class="forum-comment relative rounded-xl bg-black-transparent-1 border border-solid border-black-transparent-3 mb-2 is-reply">
        <div class="flex px-6 py-4 lg:p-5">
            <div class="hidden md:block mr-5 text-left">
                <a :href="ownerURL" class="block relative rounded-lg overflow-hidden mb-1">
                    <div class="flex items-start">
                        <img
                            :data-src="owner.avatar"
                            :alt="owner.username"
                            loading="lazy"
                            class="is-circle bg-white w-8 md:w-18 ls-is-cached lazyloaded"
                            :src="owner.avatar"
                            style="border-radius: 9px;"
                        />
                    </div>
                </a>
            </div>
            <div class="flex-1 relative">
                <header class="flex mb-4 justify-between">
                    <div class="md:hidden">
                        <a :href="ownerURL" class="block relative rounded-lg overflow-hidden mr-4">
                            <img
                                :data-src="owner.avatar"
                                :alt="owner.username"
                                loading="lazy"
                                class="lazyload is-circle bg-white w-8 md:w-18"
                                style="border-radius: 9px;"
                                :src="owner.avatar"
                            />
                        </a>
                    </div>
                    <div class="flex-1 leading-none text-left">
                        <div class="flex items-center">
                            <a :href="ownerURL" class="font-bold block font-lg mr-2 text-black" v-text="owner.username"></a>
                            <a
                                class="transition-all border border-solid border-black-transparent-3 hover:border-black-transparent-10 bg-black-transparent-2 hover:bg-black-transparent-3 font-semibold inline-flex items-center px-3 md:text-xs mobile:text-sm mobile:p-2 mobile:flex mobile:items-center text-black-transparent-50"
                                title="Original Poster"
                                style="border-radius: 12px; height: 24px;"
                            >
                                OP
                            </a>
                        </div>
                        <a class="font-semibold pt-1 md:pt-0 text-3xs text-grey-dark link">
                            <span class="text-grey-dark">Posted {{ creationTime }}</span>
                        </a>
                    </div>
                </header>
                <h1
                    id="conversation-title"
                    class="bg-blue-lightest font-bold text-black-transparent-75 px-6 py-4 rounded mb-2 md:mb-6 rounded-lg"
                    style="word-break: break-word;"
                    v-text="thread.title"
                >
                </h1>
                <div v-html="thread.body" class="content user-content text-black md:text-sm"></div>
                <div class="forum-comment-edit-links flex justify-end lg:justify-start relative mt-4 -mb-1 md:leading-none justify-start" style="height: 34px;">
                    <div @click="toggleDropdown" class="dropdown relative">
                        <div aria-haspopup="true" class="dropdown-toggle h-full">
                            <button
                                class="transition-all border border-solid border-black-transparent-3 hover:border-black-transparent-10 bg-black-transparent-2 hover:bg-black-transparent-3 font-semibold inline-flex items-center px-3 md:text-xs mobile:text-sm mobile:p-2 mobile:flex mobile:items-center h-full text-black-transparent-50 font-bold hover:text-blue text-sm"
                                style="border-radius: 12px;"
                            >
                                <span class="relative" style="top: -3px;">...</span>
                            </button>
                        </div>
                        <div
                            :class="dropdownStatus ? '' : 'hidden' "
                            class="dropdown-menu absolute z-10 py-2 rounded-lg shadow mt-2 left-0 is-light" style="width: 200px;">
                            <li v-if="isOwner" class="dropdown-menu-link"><a @click.prevent="edit">Edit</a></li>
                            <li v-if="isOwner" class="dropdown-menu-link"><a @click.prevent="destroy">Delete</a></li>
                            <li class="dropdown-menu-link"><a>Report Spam</a></li>
                        </div>
                    </div>
                    <!---->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import hljs from "highlight.js";

export default {
    name: "Thread",
    props: ['thread'],
    computed: {
        ownerURL() {
            return '@' + this.owner.username
        },
        owner() {
            return this.thread.user
        },
        creationTime() {
            let date = new Date(this.thread.created_at)
            return date.toLocaleDateString("en-US").split('/').reverse().join('/');
        },
        isOwner() {
            return this.authorize(user => user.id === this.thread.user_id)
        }
    },
    data() {
        return {
            dropdownStatus: false,
        }
    },
    methods: {
        edit() {
            //
        },
        destroy() {
            // axios.delete('/threads/' + this.thread.id);
        },
        highlight() {
            this.$el.querySelectorAll('.user-content pre code')
                .forEach(function (dom) {
                    return hljs.highlightElement(dom)
                })
        },
        toggleDropdown() {
            this.dropdownStatus = ! this.dropdownStatus
        }
    },
    mounted() {
        this.highlight();
    }
}
</script>

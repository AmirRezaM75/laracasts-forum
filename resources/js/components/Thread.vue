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
                    <conversation-dropdown>
                        <template v-if="$auth.owns(thread)">
                            <li class="dropdown-menu-link"><a @click.prevent="edit">Edit</a></li>
                            <li class="dropdown-menu-link"><a @click.prevent="destroy">Delete</a></li>
                        </template>
                        <li class="dropdown-menu-link"><a>Report Spam</a></li>
                    </conversation-dropdown>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ConversationDropdown from "./ConversationDropdown"
import ThreadModal from "./ThreadForm"
import hljs from "highlight.js"

export default {
    name: "Thread",
    components: { ConversationDropdown },
    computed: {
        thread() {
            return this.$store.state.thread
        },
        ownerURL() {
            return '@' + this.owner.username
        },
        owner() {
            return this.thread.user
        },
        creationTime() {
            return new Date(this.thread.created_at)
                .toLocaleDateString("en-US")
                .split('/')
                .reverse()
                .join('/');
        }
    },
    methods: {
        edit() {
            this.$modal.show('conversation-modal', { type: 'thread', model: this.thread});
        },
        destroy() {
            axios.delete('/threads/' + this.thread.id)
                .then(() => {
                    window.location.href = '/threads'
                })
        },
        highlight() {
            this.$el.querySelectorAll('.user-content pre code')
                .forEach(function (dom) {
                    return hljs.highlightElement(dom)
                })
        }
    },
    mounted() {
        this.highlight()
    },
    updated() {
        this.highlight()
    }
}
</script>

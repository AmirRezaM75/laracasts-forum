<template>
    <div
        :class="isBest ? 'bg-blue-lighter border-blue-light is-best' : 'bg-black-transparent-1 border-black-transparent-3'"
        class="forum-comment relative rounded-xl border border-solid mb-2 is-reply"
         :id="'reply-' + reply.id">
        <div class="flex px-6 py-4 lg:p-5">
            <div class="hidden md:block mr-5 text-left">
                <a :href="ownerURL"
                   class="block relative rounded-lg overflow-hidden mb-1">
                    <div class="flex items-start">
                        <img
                            loading="lazy"
                            class="is-circle bg-white w-8 md:w-18 lazyloaded"
                            :alt="reply.user.username"
                            :src="reply.user.avatar"
                            style="border-radius: 9px;"
                        /><!--TODO: append user avatar-->
                    </div>
                </a>
            </div>
            <div class="flex-1 relative">
                <header class="flex mb-4 justify-between">
                    <div class="md:hidden">
                        <a :href="ownerURL" class="block relative rounded-lg overflow-hidden mr-4">
                            <img
                                :alt="reply.user.username"
                                :src="reply.user.avatar"
                                class="lazyload is-circle bg-white w-8 md:w-18"
                                style="border-radius: 9px;"
                            />
                        </a>
                    </div>
                    <div class="flex-1 leading-none text-left">
                        <div class="flex items-center">
                            <a :href="ownerURL"
                               class="font-bold block font-lg mr-2 text-black"
                               v-text="reply.user.username"
                            ></a>
                        </div>
                        <a href="#" class="font-semibold pt-1 md:pt-0 text-3xs text-grey-dark link">
                            <span class="text-grey-dark">Posted {{ creationTime }}</span>
                        </a>
                    </div>
                    <div v-if="isBest" class="flex relative" style="top: -5px;">
                        <span title="Did this reply answer your question?"
                              class="rounded-2xl px-3 lg:px-6 font-bold uppercase inline-flex items-center text-3xs md:text-xs text-white"
                              style="background-image: linear-gradient(70deg, rgb(33, 200, 246) 21%, rgb(99, 123, 255) 117%);">
                            Best Answer
                        </span>
                    </div>
                </header>
                <div class="content user-content text-black md:text-sm">
                    <p v-html="reply.body"></p>
                </div>
                <div class="forum-comment-edit-links flex justify-end lg:justify-start relative mt-4 -mb-1 md:leading-none justify-start" style="height: 34px;">

                    <!-- TODO: unauthenticated users should see favorites count but it should be disabled-->
                    <favorite v-if="$auth" :reply="reply"></favorite>
                    <div class="flex show-on-hover">
                        <a
                            @click="$modal.show('conversation-modal', { type: 'reply', parentId })"
                            class="transition-all border border-solid border-black-transparent-3 hover:border-black-transparent-10 bg-black-transparent-2 hover:bg-black-transparent-3 font-semibold inline-flex items-center px-3 md:text-xs mobile:text-sm mobile:p-2 mobile:flex mobile:items-center mr-2 text-black"
                            style="border-radius: 12px;"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" viewBox="0 0 12 13" class="mr-1 lg:hidden">
                                <path
                                    fill="#78909C"
                                    fill-rule="evenodd"
                                    stroke="#78909C"
                                    stroke-width=".5"
                                    d="M6.96 1.877L4.34.542l.435 1.413a5.196 5.196 0 0 0-3.161 2.64C.32 7.133 1.267 10.2 3.73 11.455s5.5.218 6.794-2.32a5.203 5.203 0 0 0 .316-3.989l-1.145.369c.338.955.29 2.087-.22 3.086-.99 1.944-3.308 2.735-5.194 1.774-1.887-.962-2.61-3.302-1.619-5.246a4.085 4.085 0 0 1 2.461-2.045l.46 1.493 1.377-2.7z"
                                ></path>
                            </svg>
                            Reply
                        </a>
                        <button
                            v-if="$auth.owns(reply.thread)"
                            @click="markAsAnswer"
                            v-show="! isBest"
                            class="transition-all border border-solid border-black-transparent-3 hover:border-black-transparent-10 bg-black-transparent-2 hover:bg-black-transparent-3 font-semibold inline-flex items-center px-3 md:text-xs mobile:text-sm mobile:p-2 mobile:flex mobile:items-center btn normal-case font-semibold border border-solid border-black-transparent-3 bg-black-transparent-2 rounded-lg py-2 px-3 text-black h-full md:text-xs hover:bg-blue-lighter hover:text-blue hover:border-blue-light" type="submit" data-title="Answered your question?" title="Did this reply answer your question?" style="border-radius: 12px;">
                            Set Best Answer
                        </button>
                    </div>
                    <conversation-dropdown styles="show-on-hover lg:ml-auto" align="right">
                        <template v-if="$auth.owns(reply)">
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
    import Favorite from "./Favorite"
    import hljs from 'highlight.js'

    export default {
        props: ['model', 'index'],
        components: { Favorite, ConversationDropdown },
        data() {
            return {
                reply: this.model
            }
        },
        methods: {
            edit() {
                this.$modal.show('conversation-modal', { type: 'reply', model: this.reply });
            },
            destroy() {
                swal({
                    title: "Are you sure?",
                    text: "This will erase your reply.",
                    buttons: ["Cancel", "Delete"],
                    dangerMode: true
                }).then( t => {
                    t && axios.delete('/replies/' + this.reply.id)
                        .then( () => {
                            this.$store.commit('DELETE_REPLY', { parentId: this.reply.parent_id, index: this.index })
                            swal.close()
                            flash("Okay, your reply has been deleted.")
                        })
                })
            },
            markAsAnswer() {
                axios.post('/replies/' + this.reply.id + '/best')
                    .then( () => {
                        this.$store.state.thread['answer_id'] = this.reply.id
                    })
            },
            highlight() {
                this.$el.querySelectorAll('.user-content pre code')
                    .forEach(function (dom) {
                        return hljs.highlightElement(dom)
                    })
            }
        },
        computed: {
            creationTime() {
                return new Date(this.reply.created_at)
                    .toLocaleDateString("en-US")
                    .split('/')
                    .reverse()
                    .join('/');
            },
            parentId() {
                return this.reply.parent_id ?? this.reply.id
            },
            isBest() {
                return this.$store.state.thread['answer_id'] === this.reply.id
            },
            ownerURL() {
                return '/@' + this.reply.user.username
            },
        },
        mounted() {
            this.highlight()
        },
        updated() {
            this.highlight()
        }
    }
</script>
<!--TODO: process scss styles -->

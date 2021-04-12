<template>
    <div class="pointer-events-auto pt-5 md:pt-8 px-5 md:px-8">
        <form method="POST" autocomplete="off" @submit.prevent="submit">
            <div class="md:flex md:items-center pb-4 mb-4 border-b border-grey-light border-solid">
                <div class="md:flex-1 mr-4 mb-2 md:mb-0">
                    <label for="title">
                        <input
                            type="text"
                            id="title"
                            name="title"
                            v-model="form.title"
                            placeholder="Add a Title"
                            class="input placeholder-grey-darkest font-bold text-black border-0 p-0 h-auto"
                            required
                        >
                    </label>
                </div>
                <div class="md:mr-4">
                    <select class="select-css" v-model="form.category_id" required>
                        <option value="" disabled hidden>Select Channel</option><!--TODO: Fix-->
                        <option v-for="category in categories" :value="category.id" v-text="category.name"></option>
                    </select>
                </div>
                <img :src="this.$auth.avatar"
                     :alt="this.$auth.username"
                     width="30"
                     class="hidden md:inline-block is-circle bg-white"
                >
            </div>
            <div v-if="preview.status"
                 class="control user-content content lg:px-10 py-4 text-sm text-black overflow-y-auto"
                 style="max-height: 45vh;"
                 v-html="preview.content"
            ></div>
            <div v-else class="control">
                <textarea
                    id="body"
                    name="body"
                    v-model="form.body"
                    data-autosize=""
                    required="required"
                    placeholder="What's on your mind?"
                    class="textarea border-none mb-1 px-0 py-4 text-sm focus:border-grey hover:border-grey"
                    data-tribute="true"
                    style="min-height: 175px; max-height: 45vh; overflow: hidden; overflow-wrap: break-word; resize: none; height: 175px;"></textarea>
            </div>
            <div class="flex justify-between pt-px">
                <div class="mobile:hidden flex items-center text-xs mb-2">
                    <label for="markdown-preview" class="switch mr-2">
                        <input id="markdown-preview"
                               type="checkbox"
                               :disabled="form.body.length === 0"
                               @change="changePreview"
                        />
                        <div class="slider round" :class="form.body ? 'cursor-pointer' : 'cursor-not-allowed'"></div>
                    </label>
                    <span class="mr-3 font-semibold text-2xs"
                          :class="preview.status ? 'text-grey-dark' : 'text-grey-30'"
                          v-text="'Markdown Preview ' + (preview.status ? 'ON' : 'OFF')"
                    ></span>
                </div>
                <div class="flex md:justify-between pt-px">
                    <p class="mobile:hidden text-grey-30 text-2xs">
                        * You may use Markdown with
                        <a href="https://help.github.com/articles/creating-and-highlighting-code-blocks/" target="_blank" rel="noreferrer noopener">GitHub-flavored
                        </a>
                        code blocks.
                    </p>
                </div>
            </div>
            <footer class="border-t border-solid border-grey-light py-5 mt-1">
                <div class="flex w-full justify-end md:flex-none md:w-auto">
                    <div>
                        <a class="btn btn-grey mr-4 w-48 md:w-auto" @click.prevent="close">Cancel</a>
                    </div>
                    <div class="flex-1 md:flex-none">
                        <button
                            v-text=" mode === 'create' ? 'Post' : 'Update' "
                            class="btn btn-blue md:py-25 mobile:flex-1 h-full w-full md:w-auto max-w-full"></button>
                    </div>
                </div>
            </footer>
        </form>
    </div>
</template>

<script>
import TurndownService from "turndown";
import MarkdownPreview from "../mixins/MarkdownPreview";
import ErrorHandler from "../mixins/ErrorHandler";

export default {
    name: "ThreadModal",
    props: ['thread'],
    mixins: [MarkdownPreview, ErrorHandler],
    data() {
        return {
            form: {
                category_id: '',
                title: '',
                body: ''
            }
        }
    },
    computed: {
        mode() {
            return this.thread ? 'edit' : 'create'
        },
        endpoint() {
            return this.mode === 'create' ? '/threads' : '/threads/' + this.thread.id
        },
        categories() {
            return this.$store.state.categories
        }
    },
    created() {
        if (this.mode === 'edit') {
            let turndownService = new TurndownService({
                headingStyle: 'atx',
                codeBlockStyle: 'fenced'
            });
            this.form.body = turndownService.turndown(this.thread.body)
            this.form.category_id = this.thread.category_id
            this.form.title = this.thread.title
        }
    },
    methods: {
        close() {
            let element = document.querySelector(".v--modal-box");
            element.style.transition = "top .4s";
            element.style.top = "100vh";
            setTimeout(e => this.$modal.hide(this.mode + '-thread'), 500)
        },
        submit() {
            this.mode === 'edit' ? this.update() : this.store()
        },
        update() {
            axios.patch(this.endpoint, {
                'category_id': this.form.category_id,
                'title': this.form.title,
                'body': this.form.body
            }).then( ({data}) => {
                if (data.hasOwnProperty('redirect'))
                    window.location.href = data.redirect

                this.$store.commit('UPDATE_THREAD', {
                    thread: this.thread,
                    object: data.thread
                })

                flash('Your thread has been updated.')
            }).catch(error => {
                this.handler(error)
            })

            this.close()
        },
        store() {
            axios.post(this.endpoint, {
                'category_id': this.form.category_id,
                'title': this.form.title,
                'body': this.form.body
            }).then( ({data}) => {
                window.location.href = data.redirect
            }).catch(error => {
                this.handler(error)
            })

            this.close()
        }
    }
}
</script>

<style scoped>
    .select-css {
        display: block;
        font-size: 10px;
        font-weight: 600;
        color: #444;
        line-height: 1.3;
        padding: .6em 2.5em .5em 1.1em;
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
        margin: 0;
        border: 1px solid #ccc;
        cursor: pointer;
        border-radius: .5em;
        -moz-appearance: none;
        -webkit-appearance: none;
        appearance: none;
        background-color: #fff;
        background-image:
            url(data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23007CB2%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E),
            linear-gradient(180deg, #fff 0, #fff);
        background-repeat: no-repeat,repeat;
        background-position: right .7em top 50%,0 0;
        background-size: .65em auto,100%;
    }
</style>

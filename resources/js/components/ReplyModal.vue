<template>
    <div class="pointer-events-auto flex py-8 px-10 md:px-8 md:py-6">
        <form @submit.prevent="submit" class="flex-1">
            <div class="control flex items-center">
                <svg height="16px" viewBox="0 0 16 16" width="16px"
                     xmlns="http://www.w3.org/2000/svg"
                     class="fill-current text-grey-dark mr-2">
                    <g fill="none" fill-rule="evenodd" id="Icons with numbers" stroke="none" stroke-width="1">
                        <g id="Group" transform="translate(0.000000, -336.000000)" class="fill-current">
                            <path d="M0,344 L6,339 L6,342 C10.5,342 14,343 16,348 C13,345.5 10,345 6,346 L6,349 L0,344 L0,344 Z M0,344"></path>
                        </g>
                    </g>
                </svg>
                <p class="font-bold">
                    {{ mode === 'edit' ? 'Edit Reply' : 'Reply to' }}
                    <strong class="text-blue uppercase" v-if="mode === 'create'"></strong>
                </p>
            </div>
            <div class="control">
                <div v-if="preview.status"
                     v-html="preview.content"
                     class="control user-content content border-t border-b border-solid border-grey-light lg:px-10 py-4 text-sm text-black overflow-y-auto"
                     style="min-height: 244px; max-height: 45vh;">
                </div>
                <textarea
                    v-else
                    required
                    name="body"
                    v-model="form.body"
                    class="textarea mb-1 border-l-0 border-r-0 px-0 py-4 text-sm focus:border-grey-light"
                    style="min-height: 150px; max-height: 45vh; overflow: hidden; overflow-wrap: break-word; resize: none; height: 150px;"
                ></textarea>
            </div>
            <div class="flex items-center justify-between">
                <div>
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
                    <div class="flex">
                        <div class="flex-1 help">
                            <p class="mobile:hidden text-grey-30 text-2xs">
                                * You may use Markdown with
                                <a href="https://help.github.com/articles/creating-and-highlighting-code-blocks/"
                                   target="_blank" rel="noreferrer noopener">
                                    GitHub-flavored
                                </a>
                                code blocks.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mobile:flex mobile:w-full mobile:justify-center">
                    <button @click="close" class="btn mr-4 md:py-25" type="button">Cancel</button>
                    <button
                        type="submit"
                        title="Cmd + Enter"
                        class="md:py-25 mobile:flex-1 btn btn-blue"
                        v-text=" mode === 'create' ? 'Post' : 'Update' "
                    ></button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import DOMPurify from 'dompurify'
import hljs from 'highlight.js'
import TurndownService from 'turndown'

export default {
    name: "ReplyModal",
    props: ['reply'],
    data() {
        return {
            form: {
                body: ''
            },
            preview: {
                status: false,
                content: ''
            }
        }
    },
    computed: {
        mode() {
            return this.reply ? 'edit' : 'create'
        },
        endpoint() {
            return this.mode === 'create'
                ? '/threads/' + window.location.pathname.match(/\/threads\/\w+\/(\w+)/)[1] + '/replies'
                : '/replies/' + this.reply.id
        }
    },
    created() {
        if (this.mode === 'edit') {
            let turndownService = new TurndownService({
                headingStyle: 'atx',
                codeBlockStyle: 'fenced'
            });
            this.form.body = turndownService.turndown(this.reply.body)
        }
    },
    methods: {
        close() {
            let element = document.querySelector(".v--modal-box");
            element.style.transition = "top .4s";
            element.style.top = "100vh";
            setTimeout(e => this.$modal.hide(this.mode + '-reply'), 500)
        },
        submit() {
          this.mode === 'edit' ? this.update() : this.store()
        },
        update() {
            axios.patch(this.endpoint, {
                'body': this.form.body
            }).then(response => {
                this.$store.commit('UPDATE_REPLY', {
                    reply: this.reply,
                    value: response.data.body
                })

                flash('Your reply has been updated.')
            }).catch(error => {
                this.handler(error)
            })

            this.close()
        },
        store() {
            axios.post(this.endpoint, {
                'body': this.form.body
            }).then(({data}) => {
                flash('Your reply has been created.')
                this.$store.commit('ADD_REPLY', data)
            }).catch(error => {
                this.handler(error)
            })

            this.close()
        },
        handler(error) {
            // TODO: any better single word method name?
            // TODO: Support for showing multiple flash messages
            // TODO: Extract to dedicated mixin?
            let data = error.response.data
            if (data.hasOwnProperty('errors')) {
                Object.keys(data['errors']).forEach(function (key) {
                    flash(data['errors'][key][0], 'danger')
                })
            } else {
                flash(data.message, 'danger')
            }
        },
        markdown() {
            axios.post('/markdown', {
                markdown: this.form.body
            })
            .then(({data}) => {
                this.preview.content =
                    DOMPurify.sanitize(
                        data,
                        { USE_PROFILES: { html: true } }
                    )

                this.$nextTick(() => this.highlight())
            })
        },
        highlight() {
            this.$el.querySelectorAll('.user-content pre code')
                .forEach(function (dom) {
                    return hljs.highlightElement(dom)
                })
        },
        changePreview() {
            this.preview.status = ! this.preview.status

            if (this.preview.status)
                this.markdown()
        }
    },
}
</script>


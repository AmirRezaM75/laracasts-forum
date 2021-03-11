<template>
    <div class="v--modal-box v--modal conversation-modal">
        <div class="pointer-events-auto flex py-8 px-10 md:px-8 md:py-6">
            <div class="flex-1">
                <div class="control flex items-center">
                    <svg height="16px" viewBox="0 0 16 16" width="16px"
                         xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink"
                         class="fill-current text-grey-dark mr-2">
                        <g fill="none" fill-rule="evenodd" id="Icons with numbers" stroke="none" stroke-width="1">
                            <g id="Group" transform="translate(0.000000, -336.000000)" class="fill-current">
                                <path
                                    d="M0,344 L6,339 L6,342 C10.5,342 14,343 16,348 C13,345.5 10,345 6,346 L6,349 L0,344 L0,344 Z M0,344"></path>
                            </g>
                        </g>
                    </svg>
                    <p class="font-bold">
                        {{ mode === 'edit' ? 'Edit Reply' : 'Reply to' }}
                        <strong class="text-blue uppercase" v-if="mode === 'create'"></strong>
                    </p>
                </div>
                <div class="control">
                    <textarea
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
                            <label for="show_profile" class="switch mr-2">
                                <input id="show_profile" name="show_profile" type="checkbox" disabled="disabled"/>
                                <div class="slider round cursor-not-allowed"></div>
                            </label>
                            <span class="mr-3 font-semibold text-2xs text-grey-30">Markdown Preview OFF</span>
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
                        <button @click="close" class="btn mr-4 md:py-25">Cancel</button>
                        <button
                            @click="submit"
                            title="Cmd + Enter"
                            class="md:py-25 mobile:flex-1 btn btn-blue"
                            v-text=" mode === 'create' ? 'Post' : 'Update' "
                        ></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ReplyModal",
    props: ['reply'],
    data() {
        return {
            form: {
                body: ''
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
        if (this.mode === 'edit')
            this.form.body = this.reply.body
    },
    methods: {
        close() {
            let element = document.querySelector(".vm--modal");
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
                flash('Your reply has been updated.')
                this.close();
                window.events.$emit('reply-updated-' + this.reply.id, { body: this.form.body })
            })
        },
        store() {
            axios.post(this.endpoint, {
                'body': this.form.body
            }).then(({data}) => {
                flash('Your reply has been created.')
                this.close();
                window.events.$emit('reply-created', data)
            })
        }
    },
}
</script>

<style scoped>
.v--modal-block-scroll {
    overflow: hidden;
    width: 100vw;
}
.v--modal-overlay {
    position: fixed;
    box-sizing: border-box;
    left: 0;
    top: 0;
    width: 100%;
    height: 100vh;
    background: rgba(0, 0, 0, 0.2);
    z-index: 999;
    opacity: 1;
}
.v--modal-overlay.scrollable {
    height: 100%;
    min-height: 100vh;
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
}
.v--modal-overlay .v--modal-background-click {
    width: 100%;
    min-height: 100%;
    height: auto;
}
.v--modal-overlay .v--modal-box {
    position: relative;
    overflow: hidden;
    box-sizing: border-box;
}
.v--modal-overlay.scrollable .v--modal-box {
    margin-bottom: 2px;
}
.v--modal {
    background-color: white;
    text-align: left;
    border-radius: 3px;
    box-shadow: 0 20px 60px -2px rgba(27, 33, 58, 0.4);
    padding: 0;
}
.v--modal.v--modal-fullscreen {
    width: 100vw;
    height: 100vh;
    margin: 0;
    left: 0;
    top: 0;
}
.v--modal-top-right {
    display: block;
    position: absolute;
    right: 0;
    top: 0;
}
.overlay-fade-enter-active,
.overlay-fade-leave-active {
    transition: all 0.2s;
}
.overlay-fade-enter,
.overlay-fade-leave-active {
    opacity: 0;
}
.nice-modal-fade-enter-active,
.nice-modal-fade-leave-active {
    transition: all 0.4s;
}
.nice-modal-fade-enter,
.nice-modal-fade-leave-active {
    opacity: 0;
    transform: translateY(-20px);
}

.v--modal-overlay[data-modal="reply-modal"] {
    background: transparent !important;
    pointer-events: none;
}
</style>

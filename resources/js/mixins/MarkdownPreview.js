import DOMPurify from "dompurify";
import hljs from "highlight.js";

export default {
    data() {
        return {
            preview: {
                status: false,
                content: ''
            },
        }
    },
    methods: {
        markdown() {
            axios.post('/markdown', {
                markdown: this.form.body
            })
                .then(({data}) => {
                    this.preview.content =
                        DOMPurify.sanitize(
                            data,
                            {USE_PROFILES: {html: true}}
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
            this.preview.status = !this.preview.status

            if (this.preview.status)
                this.markdown()
        }
    }
}

<script>
    import ReplyModal from "./ReplyModal";
    import Favorite from "./Favorite";

    export default {
        props: ['model'],
        components: { Favorite },
        data() {
            return {
                reply: null
            }
        },
        methods: {
            edit() {
                this.$modal.show(ReplyModal,
                    { reply: this.reply },
                    {
                        height: "auto",
                        width: "800",
                        adaptive: true,
                        'pivot-y': 1,
                        transition: "modal-slide-up",
                        shiftY: 1,
                        'click-to-close': false,
                        name: "edit-reply"
                    }
                );
            },
            destroy() {
                axios.delete('/replies/' + this.reply.id)
                    .then(function() {
                        window.location.reload();
                    })
            }
        },
        created() {
            this.reply = this.model
            window.events.$on('reply-updated-' + this.reply.id, e => {
                this.reply.body = e.body;
            })
        }
    }
</script>
<!--TODO: process scss styles -->

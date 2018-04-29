<script>
    export default {
        props: ['attributes'],
        data() {
            return {
                editing: false,
                body: this.attributes.body
            };
        },
        methods: {
            update() {
                var context = this;
                axios.patch('/replies/' + this.attributes.id, {'body':this.body}).then(function(reply){
                    context.body = reply.data.body;
                    context.editing = false;

                    flash('Updated Reply');
                });
            }
        }
    }
</script>
<script>
    import Favorite from './Favorite.vue';
    export default {
        props: ['attributes'],
        components : { Favorite },
        data() {
            return {
                editing: false,
                body: this.attributes.body
            };
        },
        methods: {
            update() {
                var context = this;
                axios.patch('/replies/' + this.attributes.id, {'body':this.body})
                .then(function({data}) {
                    context.body = data.reply.body;
                    context.editing = false;

                    flash('Updated Reply');
                });
            },
            destroy() {
                var context = this;
                axios.delete('/replies/' + this.attributes.id)
                .then(function() {
                    $(context.$el).fadeOut(300, () => {
                        flash('Deleted Reply');
                    });
                });
            }
        }
    }
</script>
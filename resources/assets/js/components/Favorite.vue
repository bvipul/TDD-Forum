<template>
     <button class="btn btn-default" @click="toggle">
        <span :class="classes"></span>
        <span v-text="favoritesCount"></span>
    </button>
</template>

<script>
    export default {
        props : ['reply'],
        data() {
            return {
                favoritesCount: this.reply.favoritesCount,
                isFavorited: false
            }
        },

        computed: {
            classes() {
                return ['glyphicon', 'glyphicon-heart', this.isFavorited ? 'text-danger' : ''];
            }
        },

        methods: {
            toggle() {
                var context = this;
                if(this.isFavorited) {
                    axios.delete('/replies/' + this.reply.id + '/favorites');
                }
                else {
                    axios.post('/replies/' + this.reply.id + '/favorite')
                    .then(function({data}) {
                        context.isFavorited = true;
                    });
                }
            }
        }
    }
</script>

<template>
    <div>
        <new-comment :store-comment-endpoint="this.storeCommentEndpoint" :login-endpoint="this.loginEndpoint" @created="add"></new-comment>
        
        <div v-for="(comment, index) in comments">
            <comment :comment="comment" :endpoint="'/comment/' + comment.id" :login-endpoint="loginEndpoint" :comment-creator-endpoint="'/p/' + comment.creator.username + '/comments'" @deleted="remove(index)" :profileView="false"></comment>
        </div>

        <infinite-loading @distance="1" @infinite="infiniteHandler">
            <div slot="no-more">Больше нет комментариев.</div>
            <div slot="no-results">Пока нет комментариев.</div>
        </infinite-loading>
    </div>
</template>

<script>
    import Comment from './Comment.vue';
    import NewComment from './NewComment.vue';
    import InfiniteLoading from 'vue-infinite-loading';

    export default {
        props: [
            'article',
            'getCommentsEndpoint',
            'storeCommentEndpoint',
            'loginEndpoint',
        ],
        components: {
            Comment,
            NewComment,
            InfiniteLoading
        },
        data() {
            return {
                comments: [],
                page: 1,
            };
        },
        computed: {
            
        },
        methods: {
            infiniteHandler($state) {
                let vm = this;
 
                axios.get(this.getCommentsEndpoint + '?page=' + this.page)
                    .then(({data}) => {
                        $.each(data.data, function(key, value) {
                            vm.comments.push(value);
                        });

                        if (data.last_page > this.page) {
                            $state.loaded();

                            this.page++;
                        } else {
                            $state.complete();
                        }
                    }
                ); 
            },
            add(comment) {
                this.comments.push(comment);

                this.$emit('added');
            },
            remove(index) {
                this.comments.splice(index, 1);

                this.$emit('removed');

                flash('Коментарий удален');
            }
        }
    }
</script>
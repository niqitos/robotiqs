<template>
    <div>
        <div v-for="(activity, index) in activities">
            <comment :comment="activity.subject" :endpoint="'/comment/' + activity.subject.id" login-endpoint="this.login" :comment-creator-endpoint="'/p/' + activity.subject.creator.username + '/comments'" @deleted="remove(index)" :profileView="true"></comment>
        </div>
        <infinite-loading @distance="1" @infinite="infiniteHandler">
            <div slot="no-more">Больше нет комментариев.</div>
            <div slot="no-results">Пока нет комментариев.</div>
        </infinite-loading>
    </div>
</template>

<script>
    import Comment from './Comment.vue';
    import InfiniteLoading from 'vue-infinite-loading';

    export default {
        props: [
            'endpoint',
            'login',
        ],
        components: {
            Comment,
            InfiniteLoading
        },
        data() {
            return {
                activities: [],
                page: 1,
            };
        },
        methods: {
            infiniteHandler($state) {
                let vm = this;

                console.log(this.activities);
 
                axios.get(this.endpoint + '?page=' + this.page)
                    .then(({data}) => {
                        $.each(data.data, function(key, value) {
                            vm.activities.push(value);
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
            remove(index) {
                this.activities.splice(index, 1);

                this.$emit('removed');

                flash('Коментарий удален');
            }
        },
    }
</script>

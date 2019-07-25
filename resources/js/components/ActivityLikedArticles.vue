<template>
    <div>
        <div v-for="activity in activities">
            <article-single :article="activity.subject.subject"></article-single>
        </div>
        <infinite-loading @distance="1" @infinite="infiniteHandler">
            <div slot="no-more">Больше нет статей.</div>
            <div slot="no-results">Пока нет статей.</div>
        </infinite-loading>
    </div>
</template>

<script>
    import ArticleSingle from '../pages/ArticleSingle.vue';
    import InfiniteLoading from 'vue-infinite-loading';

    export default {
        props: [
            'endpoint'
        ],
        components: {
            ArticleSingle,
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

                // console.log(this.activities);
 
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
        },
    }
</script>

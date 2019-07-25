<template>
    <div class="row justify-content-center">
        <div class="col-lg-8 px-0">
            <div v-for="article in articles">
                <article-single :article="article"></article-single>
            </div>
            <infinite-loading @distance="1" @infinite="infiniteHandler">
                <div slot="no-more">Больше нет статей.</div>
                <div slot="no-results">Пока нет статей.</div>
            </infinite-loading>
        </div>
    </div>
</template>

<script>
    import ArticleSingle from './ArticleSingle.vue';
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
                articles: [],
                page: 1,
            };
        },
        methods: {
            infiniteHandler($state) {
                let vm = this;
 
                axios.get(this.endpoint + '?page=' + this.page)
                    .then(({data}) => {
                        $.each(data.data, function(key, value) {
                            vm.articles.push(value);
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

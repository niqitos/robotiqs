<template>
    <div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="articles-tab" data-toggle="tab" href="#articles" role="tab" aria-controls="articles" aria-selected="true" @click="loadArticles">
                    {{ this.articles }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="comments-tab" data-toggle="tab" href="#comments" role="tab" aria-controls="comments" aria-selected="false" @click="loadComments">
                    {{ this.comments }}
                </a>
            </li>
        </ul>
        <div class="tab-content pt-3" id="myTabContent">
            <div class="tab-pane fade show active" id="articles" role="tabpanel" aria-labelledby="articles-tab" v-if="!commentsTab">
                <activity-liked-articles :endpoint="this.likedArticlesEndpoint"></activity-liked-articles>
            </div>
            <div class="tab-pane fade" id="comments" role="tabpanel" aria-labelledby="comments-tab" v-if="commentsTab">
                <activity-liked-comments :endpoint="this.likedCommentsEndpoint" :login="this.loginEndpoint"></activity-liked-comments>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'loginEndpoint',
            'likedCommentsEndpoint',
            'likedArticlesEndpoint',
            'articles',
            'comments',
        ],
        data() {
            return {
                commentsTab: false
            }
        },
        methods: {
            loadArticles() {
                this.commentsTab = false;
            },
            loadComments() {
                this.commentsTab = true;
            }
        }
    }
</script>

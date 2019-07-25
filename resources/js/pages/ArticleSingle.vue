<template>
    <article class="mb-3 shadow-sm">
        <div class="article-header">
            <div class="header-options">
                <div>
                    <a :href="this.article.topic.slug" class="text-decoration-none d-inline-flex align-items-center mr-3">
                        {{ this.article.topic.name }}
                    </a>
                    <a :href="'/p/' + this.article.author.username + '/articles'" class="font-weight-bold mr-3">
                        {{ this.article.author.name }}
                    </a>
                </div>
                <time class="text-muted pt-2 pt-sm-0">
                    {{ this.article.createdAtForHumans }}
                </time>
            </div>
            <h3 class="my-0">
                <a :href="'/'+this.article.topic.slug+'/'+this.article.slug">
                    {{ this.article.title }}
                </a>
            </h3>
        </div>
        <div class="article-body">
            <img :src="'/images/'+this.article.image" :alt="this.article.title">
        </div>
        <div class="article-options">
            <a :href="'/'+this.article.topic.slug+'/'+this.article.slug+'#comments'" class="btn p-0 text-muted mr-3">
                <i class="far fa-comment"></i>
                <span class="ml-1">{{ this.article.comments_count }}</span>
            </a>
            <like :subject="this.article" :login-endpoint="loginEndpoint" :like-endpoint="'/like/article/' + this.article.slug" ></like>
        </div>
    </article>
</template>

<script>
    export default {
        props: [
            'article'
        ],
        data() {
            return {
                loginEndpoint: "/вхід"
            }  
        }
    }
</script>

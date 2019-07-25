<template>
    <div :id="'comment-' + id" class="comment">
        <div class="comment-header">
            <div class="pb-2" v-if="this.profileView">
                у відповідь на 
                <a :href="'/'+comment.article.topic.slug+'/'+comment.article.slug" class="font-weight-bold">
                    {{ comment.article.title }}
                </a>
            </div>
            <a :href="this.commentCreatorEndpoint" class="font-weight-bold mr-3" v-text="comment.creator.name"></a>
            <time class="text-muted" v-text="comment.createdAtForHumans"></time>
        </div>
        <div class="comment-body">
            <medium-editor v-if="editing" :text='body' :options='options' @edit='bodyEdit'></medium-editor>

            <div v-else v-html="body"></div>
        </div>
        <div class="comment-options">
            <like :subject="comment" :login-endpoint="this.loginEndpoint" :like-endpoint="'/like/comment/' + comment.id" v-if="!editing"></like>
            <button class="btn btn-sm border-0 p-0 mr-3" v-if="!editing && canUpdate" @click="editing = true">Редактировать</button>
            <button class="btn btn-sm border-0 p-0 text-danger" v-if="!editing && canUpdate" @click="destroy">Удалить</button>

            <button class="btn btn-sm border-0 p-0 mr-3" v-if="editing" @click="update">Обновить</button>
            <button class="btn btn-sm border-0 p-0 text-muted" v-if="editing" @click="editing = false">Отменить</button>
        </div>
    </div>
</template>


<script>
    import Like from './Like.vue';
    import MediumEditor from 'vue2-medium-editor';

    export default {
        props: [
            'comment',
            'profileView',
            'endpoint',
            'loginEndpoint',
            'commentCreatorEndpoint',
            // 'creatorRoute',
            // 'likeRoute',
            // 'unlikeRoute',
            // 'updateLang',
            // 'cancelLang',
            // 'editLang',
            // 'deleteLang',
        ],
        components: {
            Like,
            MediumEditor
        },
        data () {
            return {
                editing: false,
                id: this.comment.id,
                body: this.comment.body,
                options: {
                    buttonLabels: 'fontawesome',
                    toolbar: this.optionsBodyToolbar,
                    placeholder: {
                        text: this.placeholderBody,
                        hideOnClick: true
                    },
                },
            }
        },
        computed: {
            canUpdate() {
                return this.authorize(user => this.comment.user_id == user.id);
            },
            partialName: function() {
                Vue.partial(this.body, this.hashTags(this.body));
                return this.body;
            }
        },
        methods: {
            bodyEdit(text) {
                this.body = text.api.origElements.innerHTML;
            },
            update() {
                axios.patch(this.endpoint, {
                    body: this.body
                });

                this.editing = false;

                flash('Коментарий оновлен');
            },
            destroy() {
                axios.delete(this.endpoint);

                this.$emit('deleted', this.comment.id);

                flash('Коментарий удален');
            }
        }
    }
</script>
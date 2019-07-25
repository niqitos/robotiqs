<script>
    import Comments from '../components/Comments.vue';
    import Read from '../components/Read.vue';
    import Like from '../components/Like.vue';
    import vSelect from 'vue-select'
    import MediumEditor from 'vue2-medium-editor';

    export default {
        props: [
            'article',
            'updateEndpoint',
            'topics',
        ],
        components: {
            Comments,
            Read,
            Like,
            vSelect,
            MediumEditor
        },
        data() {
            return {
                editing: false,
                commentsCount: this.article.comments_count,
                topic: {
                    id: this.article.topic.id,
                    name: this.article.topic.name
                },
                title: this.article.title,
                body: this.article.body,
                selectOptions: Object.values(this.topics),
                optionsTitle: {
                    toolbar: false,
                    placeholder: {
                        text: this.placeholderTitle,
                        hideOnClick: true
                    },
                },
                optionsBody: {
                    buttonLabels: 'fontawesome',
                    toolbar: this.optionsBodyToolbar,
                    placeholder: {
                        text: this.placeholderBody,
                        hideOnClick: true
                    },
                },
            };
        },
        methods: {
            titleEdit(text) {
                console.log(this.topics);
                this.title = text.api.origElements.innerHTML;
            },
            bodyEdit(text) {
                this.body = text.api.origElements.innerHTML;
            },
            update() {
                axios.patch(this.updateEndpoint, {
                    topic_id: this.topic.id,
                    title: this.title,
                    body: this.body,
                });

                this.editing = false;

                flash('Статья обновлена');
            }
        }
    }
</script>
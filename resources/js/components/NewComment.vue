<template>
    <div class="comment">
        <div class="comment-header"></div>
        <div class="comment-body">
            <medium-editor :text='body' :options='options' @edit='bodyEdit'></medium-editor>
        </div>
        <div class="comment-options">
            <button type="submit" class="btn btn-sm border-0 p-0" @click="addComment">Ответить</button>
        </div>
    </div>
</template>

<script>
    import MediumEditor from 'vue2-medium-editor';

    export default {
        props: [
            'storeCommentEndpoint',
            'loginEndpoint'
        ],
        components: {
            MediumEditor
        },
        data() {
            return {
                body: '',
                options: {
                    toolbar: this.optionsBodyToolbar,
                    placeholder: {
                        text: 'Ваш ответ...',
                        hideOnClick: true
                    },
                },
            };
        },
        computed: {
            signedIn() {
                return window.App.signedIn;
            }
        },
        methods: {
            bodyEdit(text) {
                this.body = text.api.origElements.innerHTML;
            },
            addComment() {
                if (this.signedIn) {
                    axios.post(this.storeCommentEndpoint, {
                        body: this.body
                    }).then(({data}) => {
                        this.body = '';

                        flash('Вашу відповідь розміщено');

                        this.$emit('created', data);
                    });
                } else {
                    window.location.href = this.loginEndpoint;
                }
            }
        }
    }
</script>
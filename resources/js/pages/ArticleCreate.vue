<template>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <article class="create">
                <div class="form-group" style="width:250px">
                    <v-select :options="options" :clearable="false" :placeholder="this.placeholderSelect" v-model="topic" label="name"></v-select>
                </div>
                <div class="form-group">
                    <medium-editor :text='title' :options='optionsTitle' custom-tag='h1' @edit="titleEdit"></medium-editor>
                </div>
                <div class="form-group">
                    <medium-editor :text='body' :options='optionsBody' @edit='bodyEdit'></medium-editor>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn border rounded" @click="submit">{{ buttonName }}</button>
                </div>
            </article>
        </div>
    </div>
</template>

<script>
    import vSelect from 'vue-select'
    import MediumEditor from 'vue2-medium-editor';

    export default {
        props: [
            'endpoint',
            'placeholderSelect',
            'placeholderBody',
            'placeholderTitle',
            'buttonName',
            'topics',
        ],
        components: {
            vSelect,
            MediumEditor
        },
        data() {
            return {
                title: '',
                body: '',
                topic: '',
                options: Object.values(this.topics),
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
            }
        },
        methods: {
            titleEdit(text) {
                this.title = text.api.origElements.innerHTML;
            },
            bodyEdit(text) {
                this.body = text.api.origElements.innerHTML;
            },
            submit() {
                if (this.title.length && this.body.length && this.topic.id) {
                    axios.post(this.endpoint, {
                        title: this.title,
                        body: this.body,
                        topic_id: this.topic.id,
                    }).then(({data}) => {
                        window.location.href = `/${data.topic.slug}/${data.slug}`;
                    });
                }
            }
        }
    }
</script>

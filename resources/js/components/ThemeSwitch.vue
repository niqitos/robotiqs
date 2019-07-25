<template>
    <form class="dropdown-item theme">
        <div class="custom-control custom-switch d-flex align-items-center small">
            <input type="checkbox" class="custom-control-input" id="theme" @change="this.change" v-model="checked">
            <label class="custom-control-label d-flex align-items-center" for="theme">{{ this.label }}</label>
        </div>
    </form>
</template>

<script>
    export default {
        props: [
            'currentTheme', 
            'endpoint',
            'label'
        ],
        data () {
            return {
                theme: this.currentTheme,
                checked: this.currentTheme === 'dark' ? 'checked' : null
            }
        },
        methods: {
            change() {
                axios.post(this.endpoint, {
                    theme: this.theme
                }).then(({data}) => {
                    let app = document.getElementById('app');

                    app.classList.add(data.theme);
                    app.classList.remove(this.theme);

                    this.theme = data.theme;
                });
            },
        }
    }
</script>

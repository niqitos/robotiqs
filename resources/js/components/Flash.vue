<template>
    <div class="alert alert-success alert-flash alert-dismissible fade show" role="alert" v-show="show">
        <strong class="alert-type">{{ type }}</strong> {{ message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</template>

<script>
    export default {
        props: [
            'flashMessage', 
            'flashType',
        ],
        data: function () {
            return {
                type: 'Готово!', //this.flashType,
                message: '',
                show: false
            }
        },
        created() {
            if (/*this.flashType &&*/ this.flashMessage) {
                this.flash(/*this.flashType, */this.flashMessage);
            }

            window.events.$on('flash', message => this.flash(message));
        },
        methods: {
            flash(message) {
                // this.type = type;
                this.message = message;
                this.show = true;
                this.hide();
            },
            hide() {
                setTimeout(() => {
                    this.show = false
                }, 3000);
            }
        }
    }
</script>

<style>
    .alert-flash {
        position: fixed;
        bottom: 1rem;
        right: 1rem;
    }
    .alert-type {
        text-transform: capitalize;
    }
</style>

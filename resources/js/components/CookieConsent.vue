<template>
    <vue-cookieconsent>
        <template slot="message">
            <span class="my-1" style="font-size: 0.875rem">{{ this.message }}</span>
            <a class="btn btn-sm btn-link border-0 p-0 ml-2 mr-3 my-1" :href="this.privacyEndpoint" v-html="this.read"></a>
        </template>
        <template slot="button">
            <button class="btn btn-sm border rounded" v-html="this.accept"></button>
        </template>
    </vue-cookieconsent>
</template>

<script>
    import VueCookieconsent from 'vue-cookieconsent-component';

    export default {
        props: [
            'privacyEndpoint',
            'message',
            'read',
            'accept',
        ],
        components: {
            VueCookieconsent
        },
    }
</script>

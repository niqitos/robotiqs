<template>
    <a class="dropdown-item small" :href="this.endpoint" @click.prevent="logout">
        {{ this.label }}
    </a>
</template>

<script>
    export default {
        props: [
            'endpoint', 
            'label',
        ],
        methods: {
            logout() {
                axios.post(this.endpoint)
                    .then(function() {
                        document.location.reload();
                    });
            },
        }
    }
</script>

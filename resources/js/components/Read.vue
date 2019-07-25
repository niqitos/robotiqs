<template>
    <button type="button" class="btn border-0 p-0 mr-3" :class="color" @click="readArticle">
        <i class="fas fa-headphones-alt"></i>
    </button>
</template>


<script>
    export default {
        props: [
            'article'
        ],

        data() {
            return {
                active: false,
            }
        },
        computed: {
            color() {
                return [this.active ? 'text-danger' : 'text-muted'];
            }
        },
        methods: {
            readArticle() {
                this.active = true;

                const utt = new SpeechSynthesisUtterance(this.article);

                // Prevent garbage collection of utt object
                console.log(utt);

                utt.addEventListener('end', () => {
                    this.active = false;
                });

                // just for debugging completeness, no errors seem to be thrown though
                utt.addEventListener('error', (err) => {
                    console.log('err', err)
                });

                speechSynthesis.speak(utt);
                setTimeout(() => {
                    console.log('finished?');
                }, 1500);
            },
        }
    }
</script>
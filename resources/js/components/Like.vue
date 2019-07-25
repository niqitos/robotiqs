<template>
    <button type="submit" class="btn border-0 p-0 mr-3" :class="color" @click="toggle">
        <i class="fa-heart" :class="isFilled"></i>
        <span class="ml-1" v-text="count"></span>
    </button>
</template>

<script>
    export default {
        props: [
            'subject',
            'loginEndpoint',
            'likeEndpoint',
        ],
        data() {
            return {
                count: this.subject.likesCount,
                active: this.subject.isLiked,
            }
        },
        computed: {
            isFilled() {
                return [this.active ? 'fas' : 'far'];
            },
            color() {
                return [this.active ? 'text-danger' : 'text-muted'];
            },
            signedIn() {
                return window.App.signedIn;
            },
        },
        methods: {
            toggle() {
                this.active ? this.unlike() : this.like();
            },
            like() {
                if (this.signedIn) {
                    axios.post(this.likeEndpoint);
                
                    this.count++;
                    this.active = true;
                } else {
                    window.location.href = this.loginEndpoint;
                }
            },
            unlike() {
                axios.delete(this.likeEndpoint);

                this.count--;
                this.active = false;
            }
        }
    }
</script>
<template>
    <div class="w-1/4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 fixed bottom-0 right-0 rounded-l" style="bottom: 40px" role="alert" v-show="show">
        <p class="font-bold">Takk fyrir að velja Park and fly!</p>
        <p>{{ body }}</p>
    </div>
</template>

<script>
    export default {
        props: ['message'],

        data() {
            return {
                body: '',
                show: false
            }
        },

        created() {
            if (this.message) {
                this.flash(this.message)
            }

            window.events.$on('flash', message => {
                this.flash(message);
            });
        },

        methods: {
            flash(message) {
                this.body = message;
                this.show = true;

                this.hide();
            },

            hide() {
                setTimeout(() => {
                    this.show = false;
                }, 3000);
            }
        }
    }
</script>


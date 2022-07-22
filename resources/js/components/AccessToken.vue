<template>
    <div>
        <div class="btn" @click="generate">
            Generate Token
        </div>
        <v-modal height="auto" width="200" name="access_token">
            <div class="modal-wrapper">
                Your access token is: <h1>{{ token }}</h1>
            </div>
        </v-modal>
    </div>
</template>

<script>
export default {
    name: "AccessToken",
    data: () => ({
        token: ''
    }),
    methods: {
        async generate() {
            await axios.get("api/access-token").then(response => {
                this.token = response.data
                this.$modal.show('access_token')
            })
        }
    }
}
</script>

<style scoped>
.btn {
    position: absolute;
    bottom: 0;
    left: 0;
    background: #cbd5e0;
    border-radius: 8px;
    cursor: pointer;
    padding: 10px;
    margin: 20px
}

.modal-wrapper {
    padding: 20px;
}

.modal-wrapper h1{
    font-weight: bold;
}
</style>

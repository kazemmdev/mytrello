<template>
    <div class="card">
        <h3 @click="show">{{ card.title }}</h3>
        <v-modal height="auto" :name="'modal_'+card.id">
            <div class="modal-wrapper">
                <input type="text" v-model="title" placeholder="Enter a title">
                <textarea rows="4" v-model="description" placeholder="Enter your description"/>
                <div class="btn-row">
                    <div class="btn btn-primary" @click="update">Save</div>
                    <div class="btn btn-danger" @click="remove">remove</div>
                </div>
            </div>
        </v-modal>
    </div>
</template>

<script>
export default {
    name: "CardBox",
    props: ['card'],
    data: () => ({
        title: '',
        description: '',
    }),
    methods: {
        show() {
            this.title = this.card.title
            this.description = this.card.description
            this.$modal.show('modal_' + this.card.id)
        },

        async update() {
            await axios.patch('api/cards/' + this.card.id, {

                title: this.title,
                description: this.description
            }).then(() => {
                this.$modal.hide('modal_' + this.card.id)
                this.$emit('update-card', true)
            })
        },
        async remove() {
            await axios.delete('api/cards/' + this.card.id).then(() => {
                this.$modal.hide('modal_' + this.card.id)
                this.$emit('remove-card', true)
            })
        }
    }
}
</script>

<style scoped>
.card {
    background-color: #fff;
    border-radius: 3px;
    box-shadow: 0 1px 2px #091e4240;
    cursor: pointer;
    display: block;
    margin-bottom: 8px;
    max-width: 300px;
    min-height: 20px;
    position: relative;
    text-decoration: none;
    z-index: 0;
    padding: 8px;
}

.btn-row {
    margin-top: 5px;
    display: flex;
    gap: 5px;
}

.btn {
    color: white;
    padding: 8px 10px;
    border-radius: 4px;
    min-width: 40px;
    text-align: center;
}

.btn-primary {
    background: #3869d4;
}

.btn-primary:hover {
    background: #275fd2;
}

.btn-danger {
    background: #ef4e4e;
}

.btn-danger:hover {
    background: #ce3434;
}

input, textarea {
    width: 100%;
    padding: 8px;
    background-color: #fff;
    display: block;
    margin: 0;
    border: none;
    border-bottom: 2px solid #eee;
    outline: none;
    transition: all ease ;
}

input:focus, textarea:focus {
    border-bottom: 2px solid #989898;
}

.modal-wrapper {
    display: flex;
    flex-direction: column;
    padding: 20px;
    gap: 10px;
}

</style>

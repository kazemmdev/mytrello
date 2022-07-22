<template>
    <div class="box">
        <div v-if="show">
            <input type="text" v-model="title" placeholder="Enter a title">
            <div class="btn-row">
                <div class="btn btn-primary" @click="save">Save</div>
                <div class="btn btn-danger" @click="cancel">×</div>
            </div>
        </div>
        <div v-else @click="show=true">+ Add a card</div>
    </div>
</template>

<script>

export default {
    name: "CardAdder",
    props: ['parentId'],
    data: () => ({
        show: false,
        title: ''
    }),
    methods: {
        async save() {
            await axios.post("api/cards", {
                column_id: this.parentId,
                title: this.title
            }).then(() => {
                this.$emit('new-card', true)
                this.cancel()

            }).catch(err => {
                console.log(err)
            })
        },
        cancel() {
            this.show = false
            this.title = ''
        }
    }
}
</script>

<style scoped>
.box {
    margin-top: 5px;
    background-color: #ebecf0aa;
    border-radius: 3px;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    position: relative;
    white-space: normal;
    width: 100%;
    padding: 8px;
    cursor: pointer;
}

.box:hover {
    background: #cbd5e0;
}

.btn-row {
    margin-top: 5px;
    display: flex;
    gap: 5px;
}

.btn {
    padding: 4px 8px;
    border-radius: 4px;
    min-width: 40px;
    text-align: center;
    line-height: 1;
}

.btn-primary {
    color: white;
    background: #3869d4;
    padding-top: 7px;
}

.btn-primary:hover {
    background: #275fd2;
}

.btn-danger {
    color: #2d3748;
    background: #e2e8f0;
    font-size: 24px;
}

.btn-danger:hover {
    color: #ef4e4e;
}

input {
    width: 100%;
    padding: 8px;
    background-color: #fff;
    box-shadow: inset 0 0 0 2px #0079bf;
    display: block;
    margin: 0;
    border-radius: 5px;
}
</style>

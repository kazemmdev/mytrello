<template>
    <div class="container">
        <div class="wrapper">
            <div class="columns">
                <ColumnBox v-for="column in columns" :column="column" :key="column.id" @fetch="fetch">
                    <draggable :list="column.cards" group="group" @change="drag($event, column.id)">
                        <CardBox v-for="card in column.cards" :card="card" :key="card.id" @remove-card="fetch" @update-card="fetch"/>
                    </draggable>
                    <CardAdder :parent-id="column.id" @new-card="fetch"/>
                </ColumnBox>
                <ColumnAdder @new-column="fetch"/>
            </div>
        </div>
        <DBExport/>
        <AccessToken/>
    </div>
</template>

<script>
import draggable from "vuedraggable";

import ColumnAdder from "./components/ColumnAdder";
import ColumnBox from "./components/ColumnBox";
import CardBox from "./components/CardBox";
import CardAdder from "./components/CardAdder";
import DBExport from "./components/DBExport";
import AccessToken from "./components/AccessToken";

export default {
    name: 'App',
    components: {AccessToken, DBExport, CardAdder, ColumnAdder, CardBox, ColumnBox, draggable},
    data: () => ({
        columns: []
    }),
    mounted() {
        this.fetch()
    },
    methods: {
        async fetch() {
            await axios.get('api/columns').then(response => {
                this.columns = response.data
            })
        },
        async drag(e, id) {
            if (e?.moved) {
                await axios.patch('api/cards/' + e.moved.element.id, {
                    column_id: id,
                    priority: e.moved.newIndex + 1

                }).then(() => this.fetch())
            }

            if (e?.added) {
                await axios.patch('api/cards/' + e.added.element.id, {
                    column_id: id,
                    priority: e.added.newIndex + 1

                }).then(() => this.fetch())
            }
        }
    }
}
</script>

<style scoped>
.container {
    width: 100%;
    min-height: 100vh;
    background: #414f5a;
    overflow-x: auto;
}

.wrapper {
    position: relative;
    width: 100%;
    padding: 20px;
}

.columns {
    display: flex;
    gap: 10px;
}
</style>

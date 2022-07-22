<template>
    <div class="btn" @click="download">
        Export DB
    </div>
</template>

<script>
export default {
    name: "DBExport",
    methods: {
        async download() {
            await axios.get("api/export-db").then(response => {
                const url = window.URL.createObjectURL(new Blob([response.data], {type: 'application/sql'}));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', 'data.sql');
                document.body.appendChild(link);
                link.click();
            })
        }
    }
}
</script>

<style scoped>
.btn {
    position: absolute;
    bottom: 0;
    right: 0;
    background: #cbd5e0;
    border-radius: 8px;
    cursor: pointer;
    padding: 10px;
    margin: 20px
}
</style>

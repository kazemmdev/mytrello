<template>
  <div class="list">
    <div>
      <div v-if="edit">
        <input type="text" v-model="title" placeholder="Enter a title">
        <div class="btn-row">
          <div class="btn btn-primary" @click="update">Save</div>
          <div class="btn btn-danger" @click="cancel">×</div>
        </div>
      </div>
      <div class="header" v-else @click="setUpdate">
        <h2>{{ column.title }}</h2>
        <div class="close" @click="remove">×</div>
      </div>
      <slot/>
    </div>
  </div>
</template>

<script>
import CardBox from "./CardBox";
import CardAdder from "./CardAdder";
import draggable from 'vuedraggable'


export default {
  name: "ColumnBox",
  components: {CardAdder, CardBox, draggable},
  props: ['column'],
  data: () => ({
    title: '',
    edit: false
  }),
  methods: {
    async remove() {
      await axios.delete("api/columns/" + this.column.id).then(() => {
        this.$emit('fetch', true)
      })
    },
    async update() {
      await axios.patch("api/columns/" + this.column.id, {
        title: this.title
      }).then(() => {
        this.$emit('fetch', true)
        this.cancel()
      })
    },

    cancel() {
      this.title = ''
      this.edit = false
    },
    setUpdate() {
      this.title = this.column.title
      this.edit = true
    }
  }
}
</script>

<style scoped>
.list {
  background-color: #ebecf0;
  border-radius: 3px;
  box-sizing: border-box;
  display: flex;
  flex-direction: column;
  height: fit-content;
  position: relative;
  white-space: normal;
  min-width: 270px;
  padding: 8px;
}

.header {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

h2 {
  font-size: 18px;
  font-weight: bold;
  cursor: pointer;
}

.close {
  color: #2d3748;
  font-size: 24px;
  cursor: pointer;
  padding-right: 10px;
}


.btn-row {
  margin: 8px 0;
  display: flex;
  gap: 5px;
}

.btn {
  padding: 4px 8px;
  border-radius: 4px;
  min-width: 40px;
  text-align: center;
  line-height: 1;
  cursor: pointer;
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

import Vue from "vue"
import App from './App.vue'
import VModal from 'vue-js-modal'

import "./bootstrap"
import "./components/index"

window.Vue = Vue;

Vue.use(VModal, { componentName: 'v-modal' })
Vue.config.productionTip = false

new Vue({
    render: h => h(App),
}).$mount('#app')

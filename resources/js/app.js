

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import vuetify from './vuetify'



Vue.use(vuetify);

Vue.component('AppHome',require('./components/AppHome.vue').default);

import router from './Router/router'
const app = new Vue({
    vuetify,
    router,
    el: '#app',
});

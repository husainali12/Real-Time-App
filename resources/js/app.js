

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import vuetify from './vuetify'

import User from './Helpers/User.js'

window.User = User;
//console.log(User.id());

Vue.use(vuetify);

window.EventBus = new Vue;

Vue.component('AppHome',require('./components/AppHome.vue').default);

import router from './Router/router'
const app = new Vue({
    vuetify,
    router,
    el: '#app',
});

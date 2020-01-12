

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import vuetify from './vuetify'

import User from './Helpers/User.js'
import Exception from './Helpers/Exception'


window.User = User;

window.Exception = Exception;
//console.log(User.id());

Vue.use(vuetify,{
    iconfont:'mdi'
});

import VueSimplemde from 'vue-simplemde'

Vue.component('vue-simplemde', VueSimplemde);
import md from 'marked'

window.md = md;

window.EventBus = new Vue;

Vue.component('AppHome',require('./components/AppHome.vue').default);

import router from './Router/router'
const app = new Vue({
    vuetify,
    router,
    el: '#app',
});

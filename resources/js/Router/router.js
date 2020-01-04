import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import Login from '../components/login/Login/Login'
import SignUp from "../components/login/SignUp/SignUp";
import Forum from "../components/Forum/Forum";
import Logout from "../components/login/Logout";

const routes = [
    { path: '/login', component: Login },
    { path: '/logout', component: Logout},
    { path: '/signup',component: SignUp},
    { path: '/forum' ,name:'forum',component:Forum}
]

const router = new VueRouter({
    routes, // short for `routes: routes`
    hashbang:false,
    mode:'history'
})

export default router